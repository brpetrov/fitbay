<?php

namespace App\Http\Controllers;

use App\Models\Day;
use App\Models\User;
use App\Models\Workout;
use Illuminate\Http\Request;

class WorkoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $workouts = auth()->user()->workouts()->get();
        return view('workouts.index', compact('workouts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('workouts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(User $user, Workout $workout, Request $request)
    {

        $attributes = request()->validate([
            'name' => 'required',
            'body' => 'required',
            'level' => 'required',
            'image_url' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if (request()->hasFile('image_url')) {
            $image = $request->file('image_url');
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $new_name);
            $attributes['image_url'] = $new_name;
        }


        $attributes['user_id'] = auth()->id();

        $workout = auth()->user()->workouts()->create($attributes);
        return redirect('/workouts');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Workout  $workout
     * @return \Illuminate\Http\Response
     */
    public function show(Workout $workout)
    {
        if (auth()->user()->isNot($workout->user)) {
            abort(403);
        }
        return view('workouts.show', compact('workout'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Workout  $workout
     * @return \Illuminate\Http\Response
     */
    public function edit(Workout $workout)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Workout  $workout
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Workout $workout)
    {
        $attributes = request()->validate([
            'name' => 'required',
            'body' => 'required',
            'level' => 'required',
            'image_url' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if (request()->hasFile('image_url')) {
            $image = $request->file('image_url');
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $new_name);
            $attributes['image_url'] = $new_name;
        }
        $workout->update($attributes);
        return redirect($workout->path());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Workout  $workout
     * @return \Illuminate\Http\Response
     */
    public function destroy(Workout $workout)
    {
        $workout->delete();
        return redirect('/workouts');
    }
}
