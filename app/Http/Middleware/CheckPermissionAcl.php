<?php

namespace App\Http\Middleware;

use App\Repositories\Permission\PermissionRepositoryInterface;
use App\Repositories\Role\RoleRepositoryInterface;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckPermissionAcl
{
    private $role_repository;
    private $permission_repository;
    public function __construct(RoleRepositoryInterface $roleRepository, PermissionRepositoryInterface $permissionRepository)
    {
        $this->permission_repository = $permissionRepository;
        $this->role_repository = $roleRepository;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $permission = null)
    {
        // lay tat ca cac quyen khi user login vao he thong

        //1. Lay tat ca cac role cua user
        $user_id = Auth::id();
        $rolesOfUser = $this->role_repository->getAllRoleOfUser($user_id);
        //2. lay tat ca cac quyen cua user
        $permissionsOfUser = $this->role_repository->getAllPermissionOfUser($rolesOfUser);

        // lay ra man hinh tuong ung va check phan quyen
        $checkPermission = $this->permission_repository->getIdPermissionFromName($permission);
        //dd($checkPermission);
        // kiem tra user duoc phep vao man hinh nay khong?
        if ($permissionsOfUser->contains($checkPermission))
        {
            return $next($request);
        }
        return abort('401');

        //return $next($request);
    }
}
