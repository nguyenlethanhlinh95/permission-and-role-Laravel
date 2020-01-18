<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // create permissions table
        Schema::create('permissions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('display_name');
            $table->timestamps();
        });

        // create role_permission table
        Schema::create('role_permission', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('role_id');
            $table->foreign('role_id')
                ->references('id')
                ->on('roles')
                ->onDelete('cascade');

            $table->unsignedInteger('permission_id');
            $table->foreign('permission_id')
                ->references('id')
                ->on('permissions')
                ->onDelete('cascade');

            $table->timestamps();
        });

        // insert data to perssion
        // Insert some stuff
        DB::table('permissions')->insert(
            [
                // user
               [
                   'name' => 'user_list',
                   'display_name' => 'Danh sách người dùng'
               ],
                [
                    'name' => 'user_add',
                    'display_name' => 'Thêm mới người dùng'
                ],
                [
                    'name' => 'user_edit',
                    'display_name' => 'Chỉnh sửa người dùng'
                ],
                [
                    'name' => 'user_delete',
                    'display_name' => 'Xóa người dùng'
                ],

                // role
                [
                    'name' => 'role_list',
                    'display_name' => 'Danh sách quyền'
                ],
                [
                    'name' => 'role_add',
                    'display_name' => 'Thêm mới quyền'
                ],
                [
                    'name' => 'role_edit',
                    'display_name' => 'Chỉnh sửa quyền'
                ],
                [
                    'name' => 'role_delete',
                    'display_name' => 'Xóa người quyền'
                ],
            ]
        );

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('role_permission');
        Schema::dropIfExists('permissions');
    }
}
