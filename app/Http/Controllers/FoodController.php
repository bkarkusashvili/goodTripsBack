<?php

namespace App\Http\Controllers;

use App\Food;
use App\Image;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\AdminController;

class FoodController extends AdminController
{
    protected $model = 'App\Food';

    protected $select = ['id', 'title_ka', 'title_en', 'price', 'trending', 'category_id', 'image_id'];

    protected $modelName = 'food';

    protected $title = 'Foods';

    protected $mainInputs = [
        [ 'name' => 'title_ka', 'type' => 'text', 'title' => 'სათაური (ქარ.)', 'size' => 6 ],
        [ 'name' => 'title_en', 'type' => 'text', 'title' => 'სათაური (ინგ.)', 'size' => 6 ],
        [ 'name' => 'price', 'type' => 'number', 'title' => 'ფასი' ],
    ];

    protected $asideInputs = [
        [ 'name' => 'trending', 'type' => 'checkbox', 'title' => 'Trending' ],
        [ 'name' => 'category_id', 'type' => 'select', 'title' => 'კატეგორია' ],
        [ 'name' => 'image', 'type' => 'file', 'title' => 'მთავარი სურათი' ],
    ];

    protected $headers = [
        'id' => 'ID',
        'image' => 'სურათი',
        'title_ka' => 'სახელი (ქარ.)',
        'title_en' => 'სახელი (ინგ.)',
        'trending_index' => 'Trending',
        'price' => 'ფასი',
        'category' => 'კატეგორია',
    ];

    protected $createValidators = [
        'title_ka' => 'required|string|max:255',
        'title_en' => 'required|string|max:255',
        'price' => 'required|numeric',
        'trending' => 'sometimes|accepted',
        'category_id' => 'required|numeric',
        'image' => 'required|image',
    ];

    protected $updateValidators = [
        'title_ka' => 'required|string|max:255',
        'title_en' => 'required|string|max:255',
        'price' => 'required|numeric',
        'trending' => 'sometimes|accepted',
        'category_id' => 'required|numeric',
        'image' => 'nullable|image|max:10240',
    ];

    public function __construct() {
        $this->asideInputs[1]['options'] = [
            ['value' => '', 'title' => 'აირჩეი'],
            Category::select('id as value', 'title_ka as title')->get()
        ];
    }

    public function beforeStore($data)
    {   
        $data['image_id'] = Image::upload($data['image'])->id;
        unset($data['image']);

        return $data;   
    }

    public function beforeUpdate($data)
    {
        // Remove trending
        $data['trending'] = isset($data['trending']) ? $data['trending'] : 'off';

        if (!isset($data['image'])) { return $data; }

        $data['image_id'] = Image::replace($this->model->image->id, $data['image'])->id;
        unset($data['image']);

        return $data;   
    }

    public function beforeDestroy($data)
    {
        return Image::remove($data->image->id);
    }

}
