<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\AdminController;

class ServiceController extends AdminController
{
    protected $model = 'App\Service';

    protected $select = ['id', 'title_ka', 'title_en'];

    protected $modelName = 'service';

    protected $title = 'Services';

    protected $mainInputs = [
        [ 'name' => 'title_ka', 'type' => 'text', 'title' => 'სათაური (ქარ.)', 'size' => 6 ],
        [ 'name' => 'title_en', 'type' => 'text', 'title' => 'სათაური (ინგ.)', 'size' => 6 ],
    ];

    protected $headers = [
        'id' => 'ID',
        'title_ka' => 'სახელი (ქარ.)',
        'title_en' => 'სახელი (ინგ.)'
    ];

    protected $createValidators = [
        'title_ka' => 'required|string|max:255',
        'title_en' => 'required|string|max:255',
    ];
}
