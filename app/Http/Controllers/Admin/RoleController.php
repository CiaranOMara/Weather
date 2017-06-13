<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Permission;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Laracasts\Flash\Flash;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('view', Role::class);

        $data = ['roles' => Role::all()];

        return view('admin.roles.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Role::class);

        return view('admin.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Role::class);

        // Add default level if not present.
        if (!$request->has('level')) {
            $request->merge(['level' => '1']);
        }

        // Normalise slug.
        if ($slug = $request->input('slug')) {
            $request->merge(['slug' => Str::slug($slug, config('roles.separator'))]);
        }

        $this->validate($request, [
            'name' => 'required|string',
            'slug' => 'required|string|unique:roles',
            'description' => 'string|nullable',
            'level' => 'integer'
        ]);

        $input = $request->all();

        $role = Role::create($input);

        Flash::success('Role created successfully.');

        return redirect()->route('admin.roles.edit', ['role' => $role->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Role $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        $this->authorize('view', $role);

        return $this->edit($role);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Role $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $this->authorize('update', $role);

        $data = [
            'role' => $role,
            'permissions' => Permission::all('id', 'name')->whereNotIn('id', $role->permissions->pluck('id'))
        ];

        return view('admin.roles.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Role $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $this->authorize('update', $role);


        // Add default level if not present.
        if (!$request->has('level')) {
            $request->merge(['level' => '1']);
        }

        // Normalise slug.
        if ($slug = $request->input('slug')) {
            $request->merge(['slug' => Str::slug($slug, config('roles.separator'))]);
        }

        $this->validate($request, [
            'name' => 'required|string',
            'slug' => ['required', 'string', Rule::unique('roles')->ignore($role->id, 'id')],
            'description' => 'string|nullable',
            'level' => 'integer'
        ]);

        $role->fill($request->all());

        if ($role->save()) {

            Flash::success('Role updated successfully.');

            return redirect()->back();
        }

        Flash::error('Role update failed.');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $this->authorize('delete', $role);

        $role->delete();

        Flash::success("The $role->name role was deleted.");

        return redirect()->back();
    }

    public function attachPermission(Role $role, Request $request)
    {

        $this->authorize('attachPermission', $role);


        $permission = Permission::FindOrFail($request->input('permission'));

        $role->permissions()->attach($permission->id);

        Flash::success("The $permission->name permission was added to the $role->name role.");

        return redirect()->back();
    }


    public function detachPermission(Role $role, Permission $permission)
    {
        $this->authorize('detachPermission', [$role, $permission]);

        $role->permissions()->detach($permission->id);

        Flash::success("The $permission->name permission was removed from the $role->name role.");

        return redirect()->back();
    }
}
