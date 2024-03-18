<?php

namespace App\Controllers;

use App\Providers\JournalStore;

use App\Models\User;
use App\Providers\Auth;
use App\Models\Privilege;
use App\Providers\View;
use App\Providers\Validator;

class UserController
{

    public function __construct()
    {
        $user = new User;
        $arrayAuth = $user->isAuth();
        Auth::verifyAcces($arrayAuth);
    }

    public function create()
    {

        $privilege = new Privilege;
        $privileges = $privilege->select('privilege');
        return View::render('user/create', ['privileges' => $privileges]);
    }




    public function store($data)
    {

        $validator = new Validator;
        $validator->field('name', $data['name'])->min(2)->max(50);
        $validator->field('username', $data['username'])->min(2)->max(50)->email()->unique('User');
        $validator->field('password', $data['password'])->min(6)->max(20);
        $validator->field('email', $data['email'])->required()->max(100)->email()->unique('User');
        $validator->field('privilege_id', $data['privilege_id'], 'Privilege')->required();


        if ($validator->isSuccess()) {
            $user = new User;

            $data['password'] = $user->hashPassword($data['password']);
            //$data['email'] = $data['username'];
            $insert = $user->insert($data);
            if ($insert) {
                return View::redirect('login');
            } else {
                return View::render('error');
            }
        } else {
            $errors = $validator->getErrors();
            $privilege = new Privilege;
            $privileges = $privilege->select('privilege');
            return View::render('user/create', ['errors' => $errors, 'user' => $data, 'privileges' => $privileges]);
        }
    }
}
