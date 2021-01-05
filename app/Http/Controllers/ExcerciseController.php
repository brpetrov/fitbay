<?php

namespace App\Http\Controllers;

use App\Models\Day;
use App\Models\Excercise;
use App\Models\Workout;
use Illuminate\Http\Request;

class ExcerciseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Workout $workout, Day $day)
    {
        if (auth()->user()->isNot($workout->user)) {
            abort(403);
        }
        $attributes = request()->validate([
            'name' => 'required',
            'weight' => 'required|numeric',
            'sets' => 'required|numeric',
            'reps' => 'required|numeric'
        ]);
        $attributes['day_id'] = $day->id;
        $excercise = $day->excercises()->create($attributes);

        return redirect($day->path());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Excercise  $excercise
     * @return \Illuminate\Http\Response
     */
    public function show(Excercise $excercise)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Excercise  $excercise
     * @return \Illuminate\Http\Response
     */
    public function edit(Excercise $excercise)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Excercise  $excercise
     * @return \Illuminate\Http\Response
     */
    public function update(Workout $workout, Day $day, Excercise $excercise)
    {
        if (auth()->user()->isNot($workout->user)) {
            abort(403);
        }

        $attributes = request()->validate([
            'name' => 'required',
            'weight' => 'required|numeric',
            'sets' => 'required|numeric',
            'reps' => 'required|numeric'
        ]);

        $excercise->update($attributes);
        return redirect($day->path());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Excercise  $excercise
     * @return \Illuminate\Http\Response
     */
    public function destroy(Workout $workout, Day $day, Excercise $excercise)
    {
        $excercise->delete();
        return redirect($day->path());
    }
}
