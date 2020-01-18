<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserRequest;
use App\Repositories\Role\RoleRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    private $user_repository;
    private $role_repository;

    public function __construct(UserRepositoryInterface $userRepository, RoleRepositoryInterface $roleRepository)
    {
        $this->user_repository = $userRepository;
        $this->role_repository = $roleRepository;

        //setup middleware
        $this->middleware('checkAcl:user_list')->only('index');
        $this->middleware('checkAcl:user_add')->only('create', 'store');
        $this->middleware('checkAcl:user_delete')->only('show', 'destroy');
        $this->middleware('checkAcl:user_edit')->only('edit', 'update');

//        $left_join = DB::table('users')
//            ->leftJoin('role_user', 'users.id', '=', 'role_user.user_id')
//            ->get();

        //dd($left_join);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = $this->user_repository->getUserPagination();
        return view('admin.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $roles = $this->role_repository->getAll();
        return view('admin.user.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        //
        try{
            DB::beginTransaction();
            $roles = $request->role;
            //dd($roles);
            $formInput = $request->all();

            $userCreate = User::create([
               'name' =>  $formInput['name'],
                'email' => $formInput['email'],
                'password' => Hash::make($formInput['password'])
            ]);

            $userCreate->roles()->attach($roles);

            DB::commit();

            return redirect()
                ->route('user.index')
                ->with('suc', 'You succesfully created a user.');
        }
        catch (\Exception $exception)
        {
            DB::rollBack();
            return redirect()
                ->route('user.index')
                ->with('err', 'You error when create a user.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        try{
            $user = $this->user_repository->getUserById($id);
            return view('admin.user.show', compact('user'));
        }
        catch (\Exception $exception)
        {
            return redirect()
                ->route('user.index')
                ->with('err', 'You error when create a user.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // edit user
        $user = $this->user_repository->getUserById($id);
        $roles = $this->role_repository->getAll();
        $user_role = $user->roles;
        return view('admin.user.detail', compact('user', 'roles', 'user_role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $user = $this->user_repository->getUserById($id);

        $formInput = $request->all();
        $user->fill($formInput)->save();

        $roles = $request->role;
        // delete roles
        $user->roles()->detach();
        $user->roles()->attach($roles);

        Session::flash('inf', 'You succesfully updated a Post.');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // delete user
        try{
            DB::beginTransaction();

            $isDeleteUser = $this->user_repository->delete($id);
            if ($isDeleteUser)
            {
                Session::flash('suc', 'You succesfully Deleted a page.');
                DB::commit();
                return redirect()->route('user.index');
            }
            else {
                Session::flash('err', 'You not Deleted a user.');
                return redirect()->back();
            }
            DB::rollBack();
        }
        catch (\Exception $exception)
        {
            DB::rollBack();
            return redirect()
                ->route('user.index')
                ->with('err', 'You error when delete a user.');
        }
    }
}
