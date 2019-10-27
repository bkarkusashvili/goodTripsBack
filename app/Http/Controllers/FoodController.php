<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\AdminController;

class FoodController extends AdminController
{
    protected $model = 'App\Food';

    protected $select = ['id', 'name', 'email'];

    protected $modelName = 'food';

    protected $title = 'Foods';

    protected $mainInputs = [
        [ 'name' => 'title_ka', 'type' => 'text', 'title' => 'სათაური (ქარ.)' ],
        [ 'name' => 'title_en', 'type' => 'text', 'title' => 'სათაური (ინგ.)' ],
    ];

    protected $asideInputs = [
        [ 'name' => 'image', 'type' => 'text', 'title' => 'სურათი' ],
    ];

    protected $headers = [
        'id' => 'ID',
        'image' => 'სურათი',
        'title_ka' => 'სახელი (ქარ.)'
    ];

    protected $createValidators = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users|max:255',
        'password' => 'required|confirmed|min:6'
    ];

    protected $updateValidators = [
        'name' => 'required|string|max:255',
        'password' => 'nullable|confirmed|min:6'
    ];

    public function beforeStore($data)
    {
        $data['password'] = Hash::make($data['password']);

        return $data;
    }

    public function beforeUpdate($data)
    {
        if ($data['password']) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        return $data;
    }

    public function beforeDestroy($user)
    {
        return $user->id !== 1;
    }

    public function updateCreateData($inputs)
    {
        $inputs['main'][1]['disabled'] = true;
        
        return $inputs;
    }
}
