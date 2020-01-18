<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 1/17/2020
 * Time: 2:42 PM
 */

namespace App\Repositories\Role;


interface RoleRepositoryInterface
{
    public function getRolePagination();
    public function getAll();
    public function getDetail($id);
    public function delete($id);
    public function getAllPermissionOfRole($role_id);
    public function getAllRoleOfUser($user_id);
    public function getAllPermissionOfUser($list_role);
}