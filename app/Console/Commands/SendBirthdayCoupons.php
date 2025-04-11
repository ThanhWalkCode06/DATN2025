<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Support\Str;
use App\Models\PhieuGiamGia;
use Illuminate\Support\Carbon;
use Illuminate\Console\Command;
use App\Mail\BirthdayCouponMail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendBirthdayCoupons extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-birthday-coupons';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send birthday coupons to users';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Log::info('Starting birthday coupon check.');

        $today = Carbon::today();
        $users = User::whereRaw('DAY(ngay_sinh) = ? AND MONTH(ngay_sinh) = ?', [
            $today->day,
            $today->month,
        ])->whereNotNull('ngay_sinh')->get();

        if ($users->isEmpty()) {
            Log::info('Không có người dùng nào sinh nhật hôm nay.');
            return;
        }

        foreach ($users as $user) {
            // Kiểm tra mã sinh nhật năm nay
            $existingCoupon = PhieuGiamGia::where('ma_phieu', 'like', 'BIRTHDAY' . $user->username . '-' . $today->year . '%')
                ->whereYear('created_at', $today->year)
                ->first();

            if ($existingCoupon) {
                Log::info("Birthday coupon already created for user ID {$user->id} this year.");
                continue;
            }

            // Tạo mã
            do {
                $couponCode = Str::upper('BIRTHDAY' . $user->username . '-' . $today->year . '-' . Str::random(6));
            } while (PhieuGiamGia::where('ma_phieu', $couponCode)->exists());

            $coupon = PhieuGiamGia::create([
                'ma_phieu' => $couponCode,
                'ten_phieu' => "Mừng Sinh nhật ".$user->username." thời gian: . $today->year",
                'ngay_bat_dau' => now(),
                'ngay_ket_thuc' => $today->copy()->addDays(7),
                'gia_tri' => 30,
                'trang_thai' => 1,
                'mo_ta' => "Mừng sinh nhật",
                'muc_giam_toi_da' => 49000,
                'muc_gia_toi_thieu' => 100000,
            ]);

            // Gửi email
            try {
                Mail::to($user->email)->send(new BirthdayCouponMail($user, $coupon));
                Log::info("Đã gửi mã giảm giá tới người dùng id {$user->id}: {$couponCode}");
            } catch (\Exception $e) {
                Log::error("Gửi thất bại tới user ID {$user->id}: {$e->getMessage()}");
            }
        }

        Log::info('Birthday coupon check completed.');
    }
}
