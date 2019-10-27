<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\AdminController;

class UserController extends AdminController
{
    protected $model = 'App\User';

    protected $select = ['id', 'name', 'email'];

    protected $modelName = 'user';

    protected $title = 'User';

    protected $mainInputs = [
        [ 'name' => 'name', 'type' => 'text', 'title' => 'სახელი' ],
        [ 'name' => 'email', 'type' => 'email', 'title' => 'მეილი' ],
        [ 'name' => 'password', 'type' => 'password', 'title' => 'პაროლი', 'size' => '6' ],
        [ 'name' => 'password_confirmation', 'type' => 'password', 'title' => 'პაროლის გამეორება', 'size' => '6' ],
    ];

    protected $headers = [
        'id' => 'ID',
        'name' => 'name',
        'email' => 'email'
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
