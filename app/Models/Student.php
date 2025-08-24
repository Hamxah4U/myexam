<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

// class Student extends Model
class Student extends Authenticatable 
{
    use Notifiable;
    protected $guarded = [];
}
