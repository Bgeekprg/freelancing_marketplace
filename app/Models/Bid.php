<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    use HasFactory;
    protected $fillable = [
        'hrs_rate',
        'bid_desc',
        'expected_hrs',
        'required_deposit',
        'full_project_budget',
        'order_id',
        'status',
        'freelancer_id',
        
    ];
    public $timestamps = false;   

    
}

