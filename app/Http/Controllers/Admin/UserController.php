<?php

namespace App\Http\Controllers\Admin;

use App\Events\AdminCreatedUser;
use App\Http\Controllers\Controller;
use App\Permission;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Laracasts\Flash\Flash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = ['users' => User::all()];

        return view('admin.users.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // Normalise email.
        if ($email = $request->input('email', false)) {
            $request->merge(['email' => Str::lower($email)]);
        }

        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
        ]);

        $input = $request->all();

        $input = array_merge($input, ['password' => 'password']);

        $user = User::create($input);

        event(new AdminCreatedUser($user));

        Flash::success('User created successfully.');

        return redirect()->route('admin.users.edit', ['user' => $user->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return $this->edit($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {

        $user->load(['roles', 'userPermissions']);

        $data = [
            'user' => $user,
            'roles' => Role::all('id', 'name')->whereNotIn('id', $user->roles->pluck('id')),
            'permissions' => Permission::all('id', 'name')->whereNotIn('id', $user->getPermissions()->pluck('id'))
        ];

        return view('admin.users.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {

        // Normalise email.
        if (!$request->has('email')) {
            $request->merge(['email' => Str::lower($request->input('email'))]);
        }

        $this->validate($request, [
            'name' => 'required|string',
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id, 'id')],
        ]);

        $user->fill($request->all());

        if ($user->save()) { //TODO: better error handling.

            Flash::success('User updated successfully.');

            return redirect()->back();
        }

        Flash::error('User update failed.');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        Flash::success("The user $user->name was deleted.");

        return redirect()->back();
    }


    public function attachPermission(User $user, Request $request)
    {
        $permission = Permission::FindOrFail($request->input('permission'));

        if ($user->attachPermission($permission) === true) { //Note: returns null if successful.
            Flash::warning("$user->name already has the $permission->name permission.");
        } else {
            Flash::success("The $permission->name permission was attached to the user $user->name.");
        }

        return redirect()->back();
    }


    public function detachPermission(User $user, Permission $permission)
    {

        if ($user->detachPermission($permission)) {//Note: returns id if successful else zero.
            Flash::success("The $permission->name permission was detach from the user $user->name.");
        } else {
            Flash::error("The $permission->name permission could not be detach from the user $user->name.");
        }

        return redirect()->back();
    }

    public function attachRole(User $user, Request $request)
    {
        $role = Role::FindOrFail($request->input('role'));

        if ($user->attachRole($role) === true) {
            Flash::warning("$user->name already has the $role->name role.");
        } else {
            Flash::success("The $role->name role was attached to the user $user->name.");
        }

        return redirect()->back();
    }


    public function detachRole(User $user, Role $role)
    {
        if ($user->detachRole($role)) {//Note: returns id if successful else zero.
            Flash::success("The $role->name role was detach from the user $user->name.");
        } else {
            Flash::error("The $role->name role could not be detach from the user $user->name.");
        }

        return redirect()->back();
    }
}
