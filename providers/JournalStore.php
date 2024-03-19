<?php

namespace App\Providers;

use App\Models\Journal;
use App\Models\CRUD;
use App\Providers\View;



class JournalStore extends CRUD {

    static public function store(){


        if(isset($_SESSION['user_id'])) {
            if(!isset($_SERVER['REDIRECT_URL'])) $_SERVER['REDIRECT_URL'] = 'From outside this site';

            $data = ['ip_address' => $_SERVER['REMOTE_ADDR'], 'username' => $_SESSION['user_name'], 'page_visited' => $_SERVER['REDIRECT_URL'], 'user_id' => $_SESSION['user_id']];
        } else {
            $_SESSION['user_name'] = 'guest';
            $_SESSION['user_id'] = NULL;
            $data = ['ip_address' => $_SERVER['REMOTE_ADDR'], 'username' => $_SESSION['user_name'], 'user_id' => $_SESSION['user_id']];
            if(isset($_SERVER['REDIRECT_URL'])) $data['page_visited'] = $_SERVER['REDIRECT_URL'];
        }

            $journal = new Journal;
            $insert = $journal->insert($data);   
      
        }
    }
