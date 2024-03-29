<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    protected $fillable = [
        'title_ka', 'title_en', 'price', 'trending', 'image_id', 'category_id',
    ];

    public function image()
    {
        return $this->hasOne('App\Image', 'id', 'image_id');
    }

    public function getCategoryAttribute($data)
    {
        return $this->hasOne('App\Category', 'id', 'category_id')->first()->title_ka;
    }

    public function getTrendingIndexAttribute()
    {
        return [
            '<span class="text-danger">No</span>',
            '<span class="text-success">Yes</span>',
        ][$this->trending];
    }

    public function setTrendingAttribute($value)
    {
        $this->attributes['trending'] = ['on' => true, 'off' => false][$value];
    }
    
}
