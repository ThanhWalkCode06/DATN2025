<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Permission;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

use function PHPUnit\Framework\isEmpty;

class DynamicPermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        if (!$user) {
            abort(403);
        }
        // Nếu user là admin, bỏ qua kiểm tra quyền
        if ($user->hasRole('SuperAdmin')) {
            return $next($request);
        }

        // Lấy tên route hiện tại
        $routeName = $request->route()->getName();
        if (!$routeName) {
            // dd('what');
            return $next($request); // Bỏ qua nếu route không có tên
        }
        // dd('hi');
        // Chuyển đổi route thành quyền
        $permission = $this->convertRouteToPermission($routeName);


        $permission = Permission::where('name', $permission)->first();

        if (!$permission) {
            return $next($request);
        }else if( $permission && !$user->hasPermissionTo($permission)){
            abort(403);
        }

        // Nếu là quyền xóa, kiểm tra xem user có phải là người tạo không
        if (str_ends_with($routeName, '.destroy')) {
            $modelClass = $this->getModelClassFromRoute($routeName);
            if ($modelClass) {
                $resourceName = Str::singular(explode('.', $routeName)[0]);
                $resourceId = $request->route('user');
                $model = $modelClass::find($resourceId);
                // dd($model,$resourceId,$resourceName);
                if (!$model || $model->user_id !== $user->id) {
                    session()->flash('error','Chỉ có người tạo hoặc superAdmin mới có quyền xóa ');
                    return redirect()->back();
                }
            }
        }

        return $next($request);
    }

    private function convertRouteToPermission($routeName)
    {
        $map = [
            'index'   => 'view',
            'search'   => 'view',
            'create'  => 'add',
            'store'   => 'add',
            'show'    => 'view',
            'edit'    => 'update',
            'update'  => 'update',
            'destroy' => 'delete',
        ];

        $parts = explode('.', $routeName);
        // dd($parts);
        if (count($parts) < 2) {
            return $routeName; // Trả về nguyên bản nếu không đúng chuẩn
        }

        $resource = $parts[0]; // Lấy phần "posts", "users", ...
        $action = $parts[1]; // Lấy phần "index", "create", ...
        return isset($map[$action]) ? "{$resource}-{$map[$action]}" : $routeName;
    }

    /**
     * Lấy model class từ route (posts → Post::class)
     */
    private function getModelClassFromRoute($routeName)
    {
        $map = [
            // 'danhmucsanphams'    => \App\Models\BaiViet::class,
            'baiviets'    => \App\Models\BaiViet::class,
            // 'users'    => \App\Models\User::class,
            // 'phieugiamgias' => \App\Models\PhieuGiamGia::class,
            // 'sanphams' => \App\Models\SanPham::class,
            // 'danhmucs' => \App\Models\DanhMucSanPham::class,
            // 'donhangs' => \App\Models\DonHang::class,
            // 'bienthes' => \App\Models\BienThe::class,
            // 'thuoctinhs' => \App\Models\ThuocTinh::class,
        ];

        $resource = explode('.', $routeName)[0];
        // dd($map[$resource],$resource);
        return $map[$resource] ?? null;
    }
}
