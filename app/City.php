<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = [
        'title_ka', 'title_en', 'address_ka', 'address_en'
    ];
}
