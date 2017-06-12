<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Laracasts\Flash\Flash;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = ['permissions' => Permission::all()];

        return view('admin.permissions.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // Normalise slug.
        if ($slug = $request->input('slug')) {
            $request->merge(['slug' => Str::slug($slug, config('roles.separator'))]);
        }

        $this->validate($request, [
            'name' => 'required|string',
            'slug' => 'required|string|unique:permissions',
            'description' => 'string|nullable',
            'model' => 'string|nullable'
        ]);

        $input = $request->all();

        $permission = Permission::create($input);

        Flash::success('Permission created successfully.');

        return redirect()->route('admin.permissions.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Permission $permission
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $permission)
    {
        return $this->edit($permission);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Permission $permission
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        return view('admin.permissions.edit')->with(['permission' => $permission]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Permission $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {
        // Normalise slug.
        if ($slug = $request->input('slug', false)) {
            $request->merge(['slug' => Str::slug($slug, config('roles.separator'))]);
        }

        $this->validate($request, [
            'name' => 'required|string',
            'slug' => ['required', 'string', Rule::unique('permissions')->ignore($permission->id, 'id')],
            'description' => 'string|nullable',
            'model' => 'string|nullable'
        ]);

        $permission->fill($request->all());

        if ($permission->save()) {

            Flash::success('Permission updated successfully.');

            return redirect()->back();
        }

        Flash::error('Permission update failed.');

        return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Permission $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        $permission->delete();

        Flash::success("The $permission->name permission was deleted.");

        return redirect()->back();
    }
}
