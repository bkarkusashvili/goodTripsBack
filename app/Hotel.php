<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    protected $fillable = [
        'title_ka', 'title_en', 'address_ka', 'address_en', 'description_ka', 'description_en', 'author_ka', 'author_en', 'services', 'website', 'email', 'mobile', 'location', 'gallery', 'image_id'
    ];

    public function image()
    {
        return $this->hasOne('App\Image', 'id', 'image_id');
    }

    
    public function getMobileAttribute($value)
    {
        return number_format($value, 0, '', ' ');
    }
    
    public function getServicesAttribute($value)
    {
        return json_decode($value);
    }

    public function setMobileAttribute($value)
    {
        $this->attributes['mobile'] = preg_replace('/[^0-9()]+/', '', $value);
    }

    public function getGalleryAttribute($value)
    {
        return Image::select('url')->find(json_decode($value));
    }
}
