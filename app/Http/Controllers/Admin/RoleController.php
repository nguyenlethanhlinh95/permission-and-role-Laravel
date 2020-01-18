<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\RoleRequest;
use App\Repositories\Permission\PermissionRepositoryInterface;
use App\Repositories\Role\RoleRepositoryInterface;
use App\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    private $role_repository;
    private $permission_repository;
    public function __construct(RoleRepositoryInterface $roleRepository, PermissionRepositoryInterface $permissionRepository)
    {
        $this->role_repository = $roleRepository;
        $this->permission_repository = $permissionRepository;

        //setup middleware
        $this->middleware('checkAcl:role_add')->only('create', 'store');
        $this->middleware('checkAcl:role_list')->only('index');
        $this->middleware('checkAcl:role_delete')->only('show', 'destroy');
        $this->middleware('checkAcl:role_edit')->only('edit', 'update');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // list roles
        try{
            $roles = $this->role_repository->getRolePagination();
            return view('admin.role.index', compact('roles'));
        }
        catch (\Exception $exception)
        {
            abort('404');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        try{
            $permissions = $this->permission_repository->getAll();
            //dd($permissions);
            return view('admin.role.create', compact('permissions'));
        }
        catch (\Exception $exception)
        {
            abort('404');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        //
        try{
            DB::beginTransaction();
            $formInput = $request->except('permission');
            $permissions = $request->permission;

            $roleCreate = Role::create($formInput);
            //create role permission
            $roleCreate->permissions()->attach($permissions);

            DB::commit();

            return redirect()
                ->route('role.index')
                ->with('suc', 'You succesfully created a role.');
        }
        catch (\Exception $exception)
        {
            DB::rollBack();
            return redirect()
                ->route('role.index')
                ->with('err', 'You error when create a role.');
            //Log::error($exception->getMessage() . $exception->getLine());
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // edit
        try{
            $role = $this->role_repository->getDetail($id);
            $permissions = $this->permission_repository->getAll();
            $permissions_of_role = $this->role_repository->getAllPermissionOfRole($id);
            return view('admin.role.detail', compact('role', 'permissions', 'permissions_of_role'));
        }
        catch (\Exception $exception)
        {
            return redirect()
                ->route('role.index')
                ->with('err', 'You error when edit a role.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, $id)
    {
        // update role
        try{
            DB::beginTransaction();

            $role = $this->role_repository->getDetail($id);
            $formInput = $request->all();
            $role->fill($formInput)->save();

            $permissions = $request->permission;
            // delete permissions
            $role->permissions()->detach();
            $role->permissions()->attach($permissions);

            DB::commit();
            return redirect()->back()->with('inf','You succesfully updated a Role.');
        }
        catch (\Exception $exception)
        {
            DB::rollBack();
            return redirect()
                ->route('role.index')
                ->with('err', 'You error when create a role.');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
