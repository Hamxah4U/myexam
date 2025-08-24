<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    /** @use HasFactory<\Database\Factories\QuestionFactory> */
    use HasFactory;
    protected $guarded = [];

    public function answers(){
        return $this->hasMany(Answer::class);
    }

    public function users(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
