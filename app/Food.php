<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    protected $fillable = [
        'title_ka', 'title_en', 'price', 'image_id', 'category_id',
    ];
}
