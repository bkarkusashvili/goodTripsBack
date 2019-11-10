<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\AdminController;

class CityController extends AdminController
{
    protected $model = 'App\City';

    protected $select = ['id', 'title_ka', 'title_en', 'address_ka', 'address_en'];

    protected $modelName = 'city';

    protected $title = 'Cities';

    protected $mainInputs = [
        [ 'name' => 'title_ka', 'type' => 'text', 'title' => 'სათაური (ქარ.)', 'size' => 6 ],
        [ 'name' => 'title_en', 'type' => 'text', 'title' => 'სათაური (ინგ.)', 'size' => 6 ],
        [ 'name' => 'address_ka', 'type' => 'text', 'title' => 'მისამართი (ქარ.)', 'size' => 6 ],
        [ 'name' => 'address_en', 'type' => 'text', 'title' => 'მისამართი (ინგ.)', 'size' => 6 ],
    ];

    protected $headers = [
        'id' => 'ID',
        'title_ka' => 'სახელი (ქარ.)',
        'title_en' => 'სახელი (ინგ.)',
        'address_ka' => 'მისამართი (ქარ.)',
        'address_en' => 'მისამართი (ინგ.)'
    ];

    protected $createValidators = [
        'title_ka' => 'required|string|max:255',
        'title_en' => 'required|string|max:255',
        'address_ka' => 'required|string|max:255',
        'address_en' => 'required|string|max:255',
    ];

}
