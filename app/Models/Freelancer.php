<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Freelancer extends Model
{
    use HasFactory;

    protected $fillable = [
        'firstname',
        'lastname',
        'username',
        'contact',
        'profilepic',
        'gender',
        'email',
        'password',
        'description',
        'state_id',
        'Profession',
        'Availability',
    ];

    public $timestamps = false;

}
