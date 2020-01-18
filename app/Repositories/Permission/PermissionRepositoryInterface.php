<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 1/17/2020
 * Time: 2:43 PM
 */

namespace App\Repositories\Permission;


interface PermissionRepositoryInterface
{
    public function getPermissionPagination();
    public function getAll();
    public function getDetail($id);
    public function delete($id);
    public function getIdPermissionFromName($permission_name);
}