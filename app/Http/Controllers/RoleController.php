<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Permission;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class RoleController extends Controller
{

    public function index()
    {
        //abort_if(Gate::denies('view_roles'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::paginate(5);

        trail('Role-view', 'Roles listing');
        return view('roles.index', compact('roles'));
    }


    public function create()
    {

        trail('Role-create-view', 'create view loaded');
        $permissions = Permission::all();
        return view('roles.create', compact('permissions'));
    }

    public function store(StoreRoleRequest $request)
    {
//      $maker = user()->creator_id;

        $role = Role::create($request->all());
        $role->permissions()->sync($request->input('permissions', []));

        trail('Role-create', 'role created successfully');

        flash('Role created successfully')->important();
        return redirect()->route('roles.index');
    }

    public function show($id)
    {
        //abort_if(Gate::denies('view_roles'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        trail('Roles', 'view role permissions');

//        if ($role = $role->find($role)) {
//            $permissions = $role->permissions()->get();
//        }


        $role = Role::findOrFail($id);
        $permissions = $role->load('permissions');

        return view('roles.show', compact('role', 'permissions'));
    }

    public function edit($id)
    {
      //  abort_if(Gate::denies('manage_role'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        trail('Roles', 'Edit role');

        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        return view('roles.edit', compact('role', 'permissions'));
    }

    public function update(UpdateRoleRequest $request, $id)
    {
        $role = Role::findOrFail($id);

        $input = $request->except(['permissions']);

        $role->fill($input)->save();
        if ($request->permissions <> ''){
            $role->permissions()->sync($request->permissions);
        }

        trail('Roles', 'Edit role');

        flash('Role updated successfully')->important();
        return redirect()->route('roles.index');

    }

    public function destroy($id)
    {
        //
    }
}
