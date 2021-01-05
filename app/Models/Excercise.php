<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Excercise extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function path()
    {
        return "{$this->day->path()}/excercises/$this->id";
    }

    public function day()
    {
        return $this->belongsTo(Day::class);
    }
}
