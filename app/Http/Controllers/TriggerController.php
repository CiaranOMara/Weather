<?php

namespace App\Http\Controllers;

use App\User;
use App\Trigger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Laracasts\Flash\Flash;

class TriggerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('view', Trigger::class);

        $data = [
            'triggers' => Trigger::with('creator')->get(),
            'user_trigger_ids' => Auth::user()->triggers->pluck('id')->toArray()
        ];

        return view('triggers.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Trigger::class);

        return view('triggers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Trigger::class);

        $user_id = $request->user()->id;

        if (!$request->has('creator_id')) {
            $request->merge(['creator_id' => $user_id]);
        }

        $this->validate($request, [
            'description' => 'nullable|string',
            'condition' => ['required', Rule::in(array_keys(Trigger::$conditions))],
            'value' => 'required|numeric',
            'observing' => ['required', Rule::in(array_keys(Trigger::$models))],
            'creator_id' => 'required|integer|exists:users,id',
        ]);


        $input = $request->all();

        $trigger = Trigger::create($input);

        // assign subscription
        $trigger->users()->attach($user_id);

        Flash::success('Trigger created successfully.');

        return redirect()->route('triggers.edit', ['trigger' => $trigger->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Trigger $trigger)
    {
        $this->authorize('view', $trigger);

        return $this->edit($trigger);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Trigger $trigger)
    {
        $this->authorize('update', $trigger);

        $data = [
            'trigger' => $trigger,
            'users' => User::all('id', 'name', 'email')->whereNotIn('id', $trigger->users->pluck('id'))
        ];

        return view('triggers.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Trigger $trigger)
    {
        $this->authorize('update', $trigger);

        $user_id = $request->user()->id;

        if (!$request->has('creator_id')) {
            $request->merge(['creator_id' => $user_id]);
        }

        $this->validate($request, [
            'description' => 'nullable|string',
            'condition' => ['required', Rule::in(array_keys(Trigger::$conditions))],
            'value' => 'required|numeric',
            'observing' => ['required', Rule::in(array_keys(Trigger::$models))],
            'creator_id' => 'required|integer|exists:users,id',
        ]);

        $trigger->fill($request->all());

        if ($trigger->save()) { //TODO: better error handling.

            Flash::success('Trigger updated successfully.');

            return redirect()->back();
        }

        Flash::error('Trigger update failed.');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Trigger $trigger)
    {
        $this->authorize('delete', $trigger);

        $trigger->delete();

        Flash::success("The trigger was deleted.");

        return redirect()->back();
    }

    public function attachUser(Trigger $trigger, Request $request)
    {
        $user = User::FindOrFail($request->input('user'));

        $this->authorize('attachUser', [Trigger::class, $user]);

        $trigger->users()->attach($user->id);

        Flash::success("$user->name user was subscribed to the trigger.");

        return redirect()->back();
    }


    public function detachUser(Trigger $trigger, User $user)
    {

        $this->authorize('detachUser', [Trigger::class, $user]);

        $trigger->users()->detach($user->id);

        Flash::success("$user->name was un-subscribed from the trigger.");

        return redirect()->back();
    }
}
