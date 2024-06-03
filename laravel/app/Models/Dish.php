<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    protected $table = 'dishes';
    protected $primaryKey = 'dish_id';
    protected $fillable = [
        'category_id',
        'dish_name',
        'dish_detail',
        'dish_image',
        'dish_status'
    ];
}