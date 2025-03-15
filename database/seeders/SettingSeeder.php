<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Setting;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = Setting::updateOrCreate(
            [
                'mail_mailer' => 'smtp',
                'mail_host' => 'smtp.gmail.com',
                'mail_port' => '587',
                'mail_username' => '',
                'mail_password' => '',
                'mail_encryption' => '',
                'mail_from_address' => '',
                'mail_from_name' => '',
                'name_website' => 'Seven Star',
                'location' => 'Trịnh Văn Bô, Hà Nội',
                'email_owner' => 'thanhchillchill@gmail.com',
                'logo' => 'images/logo.png',
            ]
        );
    }
}
