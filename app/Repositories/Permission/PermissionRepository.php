<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 1/17/2020
 * Time: 2:44 PM
 */

namespace App\Repositories\Permission;

use App\Permission;
use Illuminate\Support\Facades\DB;

class PermissionRepository implements PermissionRepositoryInterface
{
    private $permissions;
    public function __construct()
    {
        $this->permissions = Permission::all();
    }
    public function getPermissionPagination()
    {
        // TODO: Implement getPermissionPagination() method.
        try{
            $roles=\Config::get('app.pagi');
            return Permission::paginate($roles);
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
            return $this->permissions;
        }
        catch (\Exception $exception)
        {
            return null;
        }
    }

    public function getDetail($id)
    {
        // TODO: Implement getDetail() method.
        try{
            $per = $this->permissions->find($id);
            return $per;
        }
        catch (\Exception $exception)
        {
            return null;
        }
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
        try{
            $per = $this->getDetail($id);
            if ($per != null){
                $per->delete();
                return true;
            }
            return false;
        }
        catch (\Exception $exception)
        {
            return false;
        }
    }

    public function getIdPermissionFromName($permission_name)
    {
        // TODO: Implement getIdPermissionFromName() method.
        try{
            $permission_id = DB::table('permissions')
                ->where('name', $permission_name)
                ->value('id');
            return $permission_id;
        }
        catch (\Exception $exception)
        {
            return null;
        }
    }
}