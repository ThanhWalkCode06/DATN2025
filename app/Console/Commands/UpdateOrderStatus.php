<?php

namespace App\Console\Commands;

use App\Models\DonHang;
use Illuminate\Support\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class UpdateOrderStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-order-status';
    protected $description = 'Cập nhật trạng thái đơn hàng từ 4 lên 5 sau 2 tuần';
    /**
     * The console command description.
     *
     * @var string
     */

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $orders = DonHang::where('trang_thai_don_hang', 3)
            ->where('updated_at', '<=', Carbon::now()->subWeeks(2))
            ->get();

        if($orders->isNotEmpty()){
            foreach ($orders as $order) {
                $order->trang_thai_don_hang = 4;
                $order->trang_thai_thanh_toan = 1;
                $order->updated_at = Carbon::now(); // Cập nhật thời gian
                $order->save();
                $this->info("Đã cập nhật đơn hàng ID {$order->id} lên  4.");
            }
            Log::info("Updated order ID {$order->id} to status 4.");
            $this->info('Đơn hàng đã được cập nhật.');
        }else{
            Log::info("Không có đơn hàng nào cần cập nhật");
        }

    }
}
