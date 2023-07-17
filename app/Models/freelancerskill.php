<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class freelancerskill extends Model
{
    use HasFactory;
    protected $fillable=[
        'freelancer_id',
        'skill_id'
    ];
    public $timestamps=false;
}
