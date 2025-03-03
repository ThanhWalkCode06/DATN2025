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
                'name' => 'sanphams-view',
                'description' => 'Xem sản phẩm',
                'guard_name' => 'web',
            ],
            [
                'name' => 'sanphams-add',
                'description' => 'Thêm sản phẩm',
                'guard_name' => 'web',
            ],
            [
                'name' => 'sanphams-update',
                'description' => 'Sửa sản phẩm',
                'guard_name' => 'web',
            ],
            [
                'name' => 'sanphams-delete',
                'description' => 'Xóa sản phẩm',
                'guard_name' => 'web',
            ],
            [
                'name' => 'donhangs-view',
                'description' => 'Xem đơn hàng',
                'guard_name' => 'web',
            ],
            [
                'name' => 'donhangs-add',
                'description' => 'Thêm đơn hàng',
                'guard_name' => 'web',
            ],
            [
                'name' => 'donhangs-update',
                'description' => 'Sửa đơn hàng',
                'guard_name' => 'web',
            ],
            [
                'name' => 'donhangs-delete',
                'description' => 'Xóa đơn hàng',
                'guard_name' => 'web',
            ],
            [
                'name' => 'baiviets-view',
                'description' => 'Xem bài viết',
                'guard_name' => 'web',
            ],
            [
                'name' => 'baiviets-add',
                'description' => 'Thêm bài viết',
                'guard_name' => 'web',
            ],
            [
                'name' => 'baiviets-update',
                'description' => 'Sửa bài viết',
                'guard_name' => 'web',
            ],
            [
                'name' => 'baiviets-delete',
                'description' => 'Xóa bài viết',
                'guard_name' => 'web',
            ],
            [
                'name' => 'phieugiamgias-view',
                'description' => 'Xem phiếu khuyến mãi',
                'guard_name' => 'web',
            ],
            [
                'name' => 'phieugiamgias-add',
                'description' => 'Thêm phiếu khuyến mãi',
                'guard_name' => 'web',
            ],
            [
                'name' => 'phieugiamgias-update',
                'description' => 'Sửa phiếu khuyến mãi',
                'guard_name' => 'web',
            ],
            [
                'name' => 'phieugiamgias-delete',
                'description' => 'Xóa phiếu khuyến mãi',
                'guard_name' => 'web',
            ],
            [
                'name' => 'users-view',
                'description' => 'Xem tài khoản khuyến mãi',
                'guard_name' => 'web',
            ],
            [
                'name' => 'users-add',
                'description' => 'Thêm tài khoản khuyến mãi',
                'guard_name' => 'web',
            ],
            [
                'name' => 'users-update',
                'description' => 'Sửa tài khoản khuyến mãi',
                'guard_name' => 'web',
            ],
            [
                'name' => 'users-delete',
                'description' => 'Xóa tài khoản khuyến mãi',
                'guard_name' => 'web',
            ],
            [
                'name' => 'danhmucsanphams-view',
                'description' => 'Xem Danh mục sản phẩm',
                'guard_name' => 'web',
            ],
            [
                'name' => 'danhmucsanphams-add',
                'description' => 'Thêm Danh mục sản phẩm',
                'guard_name' => 'web',
            ],
            [
                'name' => 'danhmucsanphams-update',
                'description' => 'Sửa Danh mục sản phẩm',
                'guard_name' => 'web',
            ],
            [
                'name' => 'danhmucsanphams-delete',
                'description' => 'Xóa Danh mục sản phẩm',
                'guard_name' => 'web',
            ],
            [
                'name' => 'danhmucbaiviets-view',
                'description' => 'Xem Danh mục bài viết',
                'guard_name' => 'web',
            ],
            [
                'name' => 'danhmucbaiviets-add',
                'description' => 'Thêm Danh mục bài viết',
                'guard_name' => 'web',
            ],
            [
                'name' => 'danhmucbaiviets-update',
                'description' => 'Sửa Danh mục bài viết',
                'guard_name' => 'web',
            ],
            [
                'name' => 'danhmucbaiviets-delete',
                'description' => 'Xóa Danh mục bài viết',
                'guard_name' => 'web',
            ],
            [
                'name' => 'bienthes-view',
                'description' => 'Xem biến thể',
                'guard_name' => 'web',
            ],
            [
                'name' => 'bienthes-add',
                'description' => 'Thêm biến thể',
                'guard_name' => 'web',
            ],
            [
                'name' => 'bienthes-update',
                'description' => 'Sửa biến thể',
                'guard_name' => 'web',
            ],
            [
                'name' => 'bienthes-delete',
                'description' => 'Xóa biến thể',
                'guard_name' => 'web',
            ],
            [
                'name' => 'thuoctinhs-view',
                'description' => 'Xem thuộc tính',
                'guard_name' => 'web',
            ],
            [
                'name' => 'thuoctinhs-add',
                'description' => 'Thêm thuộc tính',
                'guard_name' => 'web',
            ],
            [
                'name' => 'thuoctinhs-update',
                'description' => 'Sửa thuộc tính',
                'guard_name' => 'web',
            ],
            [
                'name' => 'thuoctinhs-delete',
                'description' => 'Xóa thuộc tính',
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
