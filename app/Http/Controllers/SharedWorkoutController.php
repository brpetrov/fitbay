<?php

namespace App\Http\Controllers;

use App\Models\Day;
use App\Models\User;
use App\Models\Workout;

use Illuminate\Http\Request;

class SharedWorkoutController extends Controller
{
    public function index()
    {
        $sharedWorkouts = Workout::latest()->paginate(9);
        return view('workouts.shared.index', compact('sharedWorkouts'));
    }
}
