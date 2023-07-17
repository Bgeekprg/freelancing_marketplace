<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
     protected $fillable = [
        'order_title',
        'subcategory_id',
        'order_desc',
        'budget',
        'skills',
        'client_id',
        'freelancer_id',
        'order_type',
        'order_info',
        
    ];
    public $timestamps = false;
}
