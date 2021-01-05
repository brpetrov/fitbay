<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workout extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function path()
    {
        return "/workouts/{$this->id}";
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function days()
    {
        return $this->hasMany(Day::class);
    }

    public function addDay($name)
    {
        return $this->days()->create(compact('name'));
    }
}
