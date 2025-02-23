<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AddPermissionAndRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permit = [
            [
                'name' => 'product-view',
                'description' => 'Xem sản phẩm',
                'guard_name' => 'web',
            ],
            [
                'name' => 'product-add',
                'description' => 'Thêm sản phẩm',
                'guard_name' => 'web',
            ],
            [
                'name' => 'product-update',
                'description' => 'Sửa sản phẩm',
                'guard_name' => 'web',
            ],
            [
                'name' => 'product-delete',
                'description' => 'Xóa sản phẩm',
                'guard_name' => 'web',
            ],
            [
                'name' => 'order-view',
                'description' => 'Xem đơn hàng',
                'guard_name' => 'web',
            ],
            [
                'name' => 'order-add',
                'description' => 'Thêm đơn hàng',
                'guard_name' => 'web',
            ],
            [
                'name' => 'order-update',
                'description' => 'Sửa đơn hàng',
                'guard_name' => 'web',
            ],
            [
                'name' => 'order-delete',
                'description' => 'Xóa đơn hàng',
                'guard_name' => 'web',
            ],
            [
                'name' => 'article-view',
                'description' => 'Xem bài viết',
                'guard_name' => 'web',
            ],
            [
                'name' => 'article-add',
                'description' => 'Thêm bài viết',
                'guard_name' => 'web',
            ],
            [
                'name' => 'article-update',
                'description' => 'Sửa bài viết',
                'guard_name' => 'web',
            ],
            [
                'name' => 'article-delete',
                'description' => 'Xóa bài viết',
                'guard_name' => 'web',
            ],
            [
                'name' => 'voucher-view',
                'description' => 'Xem phiếu khuyến mãi',
                'guard_name' => 'web',
            ],
            [
                'name' => 'voucher-add',
                'description' => 'Thêm phiếu khuyến mãi',
                'guard_name' => 'web',
            ],
            [
                'name' => 'voucher-update',
                'description' => 'Sửa phiếu khuyến mãi',
                'guard_name' => 'web',
            ],
            [
                'name' => 'voucher-delete',
                'description' => 'Xóa phiếu khuyến mãi',
                'guard_name' => 'web',
            ],
            [
                'name' => 'account-view',
                'description' => 'Xem tài khoản khuyến mãi',
                'guard_name' => 'web',
            ],
            [
                'name' => 'account-add',
                'description' => 'Thêm tài khoản khuyến mãi',
                'guard_name' => 'web',
            ],
            [
                'name' => 'account-update',
                'description' => 'Sửa tài khoản khuyến mãi',
                'guard_name' => 'web',
            ],
            [
                'name' => 'account-delete',
                'description' => 'Xóa tài khoản khuyến mãi',
                'guard_name' => 'web',
            ],

        ];

        // Xóa cache để đảm bảo cập nhật quyền chính xác
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        foreach($permit as $item){
            Permission::updateOrCreate(
                ['name' => $item['name']], // Điều kiện tìm kiếm
                ['description' => $item['description'], 'guard_name' => $item['guard_name']] // Cập nhật hoặc tạo mới
            );
        }
        $role = Role::updateOrCreate(['name'=>'SuperAdmin', 'guard_name'=>'web']);
        $role->syncPermissions(Permission::all());

    }
}
