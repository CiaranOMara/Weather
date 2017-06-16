<?php

namespace App\Http\Controllers;

use App\User;
use App\Watcher;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Laracasts\Flash\Flash;

class WatcherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('view', Watcher::class);

        $data = ['watchers' => Watcher::all()];

        return view('watchers.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Watcher::class);

        return view('watchers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Watcher::class);

        $user_id = $request->user()->id;

        if (!$request->has('creator_id')) {
            $request->merge(['creator_id' => $user_id]);
        }

        $this->validate($request, [
            'description' => 'nullable|string',
            'condition' => ['required', Rule::in(array_keys(Watcher::$conditions))],
            'trigger_value' => 'required|numeric',
            'observing' => ['required', Rule::in(array_keys(Watcher::$models))],
            'creator_id' => 'required|integer|exists:users,id',
        ]);


        $input = $request->all();

        $watcher = Watcher::create($input);

        // assign subscription
        $watcher->users()->attach($user_id);

        Flash::success('Watcher created successfully.');

        return redirect()->route('watchers.edit', ['watcher' => $watcher->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Watcher $watcher)
    {
        $this->authorize('view', $watcher);

        return $this->edit($watcher);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Watcher $watcher)
    {
        $this->authorize('update', $watcher);

        $data = [
            'watcher' => $watcher,
            'users' => User::all('id', 'name', 'email')->whereNotIn('id', $watcher->users->pluck('id'))
        ];

        return view('watchers.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Watcher $watcher)
    {
        $this->authorize('update', $watcher);

        $user_id = $request->user()->id;

        if (!$request->has('creator_id')) {
            $request->merge(['creator_id' => $user_id]);
        }

        $this->validate($request, [
            'description' => 'nullable|string',
            'condition' => ['required', Rule::in(array_keys(Watcher::$conditions))],
            'trigger_value' => 'required|numeric',
            'observing' => ['required', Rule::in(array_keys(Watcher::$models))],
            'creator_id' => 'required|integer|exists:users,id',
        ]);

        $watcher->fill($request->all());

        if ($watcher->save()) { //TODO: better error handling.

            Flash::success('Watcher updated successfully.');

            return redirect()->back();
        }

        Flash::error('Watcher update failed.');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Watcher $watcher)
    {
        $this->authorize('delete', $watcher);

        $watcher->delete();

        Flash::success("The watcher was deleted.");

        return redirect()->back();
    }

    public function attachUser(Watcher $watcher, Request $request)
    {
        $this->authorize('attachUser', $watcher);

        $user = User::FindOrFail($request->input('user'));

        $watcher->users()->attach($user->id);

        Flash::success("$user->name user was subscribed to the watcher.");

        return redirect()->back();
    }


    public function detachUser(Watcher $watcher, User $user)
    {
        $this->authorize('detachUser', [$watcher, $user]);

        $watcher->users()->detach($user->id);

        Flash::success("$user->name was un-subscribed from the watcher.");

        return redirect()->back();
    }
}
