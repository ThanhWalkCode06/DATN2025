<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::firstOrCreate(
            ['email' => 'thanhnguyen062004@gmail.com'],
            [
                'username' => 'admin',
                'password' => Hash::make('123456'), // Mật khẩu nên mã hóa
                'ten_nguoi_dung' => 'Admin',

                'so_dien_thoai' => '0987654321'
            ]
        );
        $permissions = Permission::all();
        $roleSuperAdmin = Role::findByName('SuperAdmin');
        $user->assignRole('SuperAdmin');
        $user->syncPermissions(Permission::get());
    }
}
