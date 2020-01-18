<?php
/**
 * Created by PhpStorm.
 * User: Computer of Linh
 * Date: 12/28/2019
 * Time: 2:42 PM
 */

namespace App\Repositories\User;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Mockery\Exception;

class UserRepository implements UserRepositoryInterface
{
    public function getUserPagination()
    {
        // TODO: Implement getUserPagination() method.
        $page=\Config::get('app.pagi');
        return User::paginate($page);
        //return null;
    }

    public function getId(){
        return Auth::user()->id;
    }

    public function getUserById($user_id)
    {
        try{
            $user = User::find($user_id);
            if ($user != null){
                return $user;
            }else{
                return null;
            }
        }
        catch (Exception $exception){
            return null;
        }
    }

    public function getUser()
    {
        // TODO: Implement getUser() method.
        try{
            return Auth::user();
        }catch(Exception $exception){
            return null;
        }
    }

    public function checkPassword($user_password){
        try{
            if(!Hash::check($user_password, Auth::user()->password)){
                return false;
            }else{
                return true;
            }
        }catch(Exception $exception){
            return false;
        }
    }

    public function updatePassword($new_user_password){
        try{
            $user = $this->getUser();
            $user->fill(['password' => Hash::make($new_user_password)])->save();
        }catch(Exception $exception){
            return false;
        }
    }

    public function delete($user_id)
    {
        // TODO: Implement delete() method.
        try{
            $user = $this->getUserById($user_id);
            if ($user != null)
            {
                $user->delete();
                return true;
            }
            return false;
        }
        catch (\Exception $exception)
        {
            return false;
        }
    }

}