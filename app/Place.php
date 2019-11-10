<?php

namespace App;

use App\Image;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    protected $fillable = ['title_ka', 'title_en', 'address_ka', 'address_en', 'description_ka', 'description_en', 'location', 'gallery', 'image_id', 'trending'];

    public function image()
    {
        return $this->hasOne('App\Image', 'id', 'image_id');
    }

    public function getGalleryAttribute($value)
    {
        return Image::select('url')->find(json_decode($value));
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
