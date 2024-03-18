<?php

namespace App\Models;
use App\Models\CRUD;


use App\Providers\Auth;
use App\Models\Auteur;
use App\Providers\View;
use App\Providers\Validator;


class Journal extends CRUD{
    protected $table = 'journal';
    protected $primaryKey = 'id';
    protected $isAuth = [1, 4];
    protected $fillable = ['ip_address', 'username', 'page_visited', 'user_id'];

    //- Page visitée: $_SERVER[SCRIPT_FILENAME] || REDIRECT_URL || Les deux . */
    static public function record()
    {
/* 
        $record = ['ip_address' => $_SERVER['REMOTE_ADDR'], 'username' => $userName = $_SESSION['user_name'], 'page_visited' => $_SERVER['SCRIPT_FILENAME'], 'user_id' => $_SESSION['user_id']];

        echo '<br>';
        print_r($record);
        echo '<br>';
        echo '<br>'; */
    }
}

