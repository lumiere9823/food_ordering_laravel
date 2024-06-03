<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    protected $primaryKey = 'category_id';
    
    protected $fillable = [
        'category_name','order_number','category_status','added_on'
    ];

}
