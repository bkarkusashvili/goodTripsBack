<?php

namespace App\Http\Controllers;

use App\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\AdminController;

class PlaceController extends AdminController
{
    protected $model = 'App\Place';

    protected $select = ['id', 'title_ka', 'title_en', 'address_ka', 'address_en', 'description_ka', 'description_en', 'location', 'gallery', 'image_id', 'trending'];

    protected $modelName = 'place';

    protected $title = 'Places';

    protected $mainInputs = [
        [ 'name' => 'title_ka', 'type' => 'text', 'title' => 'სათაური (ქარ.)', 'size' => 6 ],
        [ 'name' => 'title_en', 'type' => 'text', 'title' => 'სათაური (ინგ.)', 'size' => 6 ],
        [ 'name' => 'address_ka', 'type' => 'text', 'title' => 'მისამართი (ქარ.)', 'size' => 6 ],
        [ 'name' => 'address_en', 'type' => 'text', 'title' => 'მისამართი (ინგ.)', 'size' => 6 ],
        [ 'name' => 'description_ka', 'type' => 'textarea', 'title' => 'აღწერა (ქარ.)', 'class' => 'description tinymce' ],
        [ 'name' => 'description_en', 'type' => 'textarea', 'title' => 'აღწერა (ინგ.)', 'class' => 'description tinymce' ],
        [ 'name' => 'gallery', 'type' => 'gallery', 'title' => 'სურათების არჩევა' ],
        [ 'name' => 'location', 'type' => 'map', 'title' => 'რუკა' ],
    ];

    protected $asideInputs = [
        [ 'name' => 'trending', 'type' => 'checkbox', 'title' => 'Trending' ],
        [ 'name' => 'image', 'type' => 'file', 'title' => 'მთავარი სურათი' ],
    ];

    protected $headers = [
        'id' => 'ID',
        'image' => 'სურათი',
        'title_ka' => 'სახელი (ქარ.)',
        'title_en' => 'სახელი (ინგ.)',
        'trending_index' => 'Trending',
    ];

    protected $createValidators = [
        'title_ka' => 'required|string|max:255',
        'title_en' => 'required|string|max:255',
        'address_ka' => 'required|string',
        'address_en' => 'required|string',
        'description_ka' => 'required|string',
        'description_en' => 'required|string',
        'gallery' => 'nullable|array',
        'gallery.*' => 'image',
        'location' => 'nullable|string',
        'trending' => 'sometimes|accepted',
        'image' => 'required|image',
    ];

    protected $updateValidators = [
        'title_ka' => 'required|string|max:255',
        'title_en' => 'required|string|max:255',
        'address_ka' => 'required|string',
        'address_en' => 'required|string',
        'description_ka' => 'required|string',
        'description_en' => 'required|string',
        'gallery' => 'nullable|array',
        'gallery.*' => 'image',
        'location' => 'nullable|string',
        'trending' => 'sometimes|accepted',
        'image' => 'nullable|image',
    ];

    public function beforeStore($data)
    {   
        if (isset($data['gallery'])) {
            $gallery = [];
            foreach ($data['gallery'] as $image) {
                $gallery[] = Image::upload($image)->id;
            }
            $data['gallery'] = json_encode($gallery);
        }

        $data['image_id'] = Image::upload($data['image'])->id;
        unset($data['image']);

        return $data;
    }

    public function beforeUpdate($data)
    {
        // Remove trending
        $data['trending'] = isset($data['trending']) ? $data['trending'] : 'off';

        if (isset($data['image'])) {
            $data['image_id'] = Image::replace($this->model->image->id, $data['image'])->id;
            unset($data['image']);
        }
        
        if (isset($data['gallery'])) {
            $gallery = json_decode($this->model->gallery);
            foreach ($data['gallery'] as $image) {
                $gallery[] = Image::upload($image)->id;
            }
            $data['gallery'] = json_encode($gallery);
        }

        return $data;   
    }

    public function beforeDestroy($data)
    {
        $status = true;
        $status = Image::remove($data->image->id);

        foreach (json_decode($data->gallery) as $image) {
            $status = Image::remove($image);
        }

        return true;
    }
}
