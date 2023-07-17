<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Client as Authenticatable;
use AuthenticatesUser;
class Client extends Model
{  
   
    use HasFactory;
    protected $guard="client";
    protected $fillable=[
    'firstname',
    'lastname',
    'username',
    'contact',
    'gender',
    'profilepic',
    'email',
    'password',
];

public $timestamps = false;   
}
