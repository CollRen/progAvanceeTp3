<?php

namespace App\Providers;

use App\Providers\Auth;
use App\Models\Auteur;
use App\Providers\View;
use App\Providers\Validator;


class Journal
{
    //- Page visitée: $_SERVER[SCRIPT_FILENAME] || REDIRECT_URL || Les deux . */
    static public function record()
    {

        $record = ['ip_address' => $_SERVER['REMOTE_ADDR'], 'username' => $userName = $_SESSION['user_name'], 'page_visited' => $_SERVER['SCRIPT_FILENAME'], 'user_id' => $_SESSION['user_id']];

        echo '<br>';
        print_r($record);
        echo '<br>';
        echo '<br>';
    }
}

