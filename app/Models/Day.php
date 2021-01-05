<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function path()
    {
        return "/workouts/{$this->workout->id}/days/{$this->id}";
    }

    public function workout()
    {
        return $this->belongsTo(Workout::class);
    }

    public function excercises()
    {
        return $this->hasMany(Excercise::class);
    }
}
