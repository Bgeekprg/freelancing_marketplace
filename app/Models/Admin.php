<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;
    protected $fillable=[
        'admin_id',
        'username',
        'firstname',
        'lastname',
        'email',
        'password'
    ];
    public $timestamps = false;   
}
