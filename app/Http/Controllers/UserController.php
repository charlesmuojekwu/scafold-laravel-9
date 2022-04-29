<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index() 
    {
        $data = [
            'name' => 'Franon',
            'email' => 'on52@bitfumes.com',
            'password' => 'password'
        ];

        User::create($data);

        $user = User::all();

        return $user;
    }
}
