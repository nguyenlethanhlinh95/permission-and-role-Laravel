<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 1/17/2020
 * Time: 2:43 PM
 */

namespace App\Repositories\Role;


use App\Role;
use Illuminate\Support\Facades\DB;

class RoleRepository implements RoleRepositoryInterface
{
    private $roles;
    public function __construct()
    {
        $this->roles = Role::all();
    }

    public function getRolePagination()
    {
        // TODO: Implement getUserPagination() method.
        try{
            $roles=\Config::get('app.pagi');
            return Role::paginate($roles);
            //return $this->roles->paginate($roles);
        }
        catch (\Exception $exception)
        {
            return null;
        }
    }

    public function getAll()
    {
        // TODO: Implement getAll() method.
        try{
            return $this->roles;
        }
        catch (\Exception $exception)
        {
            return null;
        }
    }

    public function getDetail($id)
    {
        // TODO: Implement getDetail() method.
        $role = $this->roles->find($id);
        return $role;
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
        try{
            $role = $this->getDetail($id);
            if ($role != null){
                $role->delete();
                return true;
            }
            return false;
        }
        catch (\Exception $exception)
        {
            return false;
        }
    }

    public function getAllPermissionOfRole($role_id)
    {
        // TODO: Implement getAllPermissionOfRole() method.
        try{
            $permissions = DB::table('role_permission')
                ->where('role_id',$role_id)
                ->pluck('permission_id');
            return $permissions;
        }
        catch (\Exception $exception)
        {
            return null;
        }
    }

    public function getAllRoleOfUser($user_id)
    {
        // TODO: Implement getAllRoleOfUser() method.
        try{
            $roles = DB::table('role_user')
                ->where('user_id',$user_id)
                ->pluck('role_id');
            return $roles;
        }
        catch (\Exception $exception)
        {
            return null;
        }
    }

    // get all permissions of roles
    public function getAllPermissionOfUser($list_role)
    {
        // TODO: Implement getAllPermissionOfUser() method.
        try{
            $permissionsOfUser = DB::table('role_permission')
                ->join('roles', 'roles.id','=', 'role_permission.role_id')
                ->join('permissions', 'role_permission.permission_id', '=', 'permissions.id')
                ->whereIn('roles.id', $list_role)
                ->select('permissions.id')
                ->get()
                ->pluck('id')
                ->unique();
            return $permissionsOfUser;
        }
        catch (\Exception $exception)
        {
            return null;
        }
    }
}