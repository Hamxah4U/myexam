<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $guarded = [];

    public function course(){
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function questions(){
         return $this->hasMany(Question::class, 'course_id', 'course_id');
    }
}
