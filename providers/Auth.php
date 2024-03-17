<?php
namespace App\Providers;
use App\Providers\View;

class Auth {
    static public function session($arrayCanVisit){
      
        if(isset($_SESSION['fingerPrint']) and $_SESSION['fingerPrint']==md5($_SERVER['HTTP_USER_AGENT'] . $_SERVER['REMOTE_ADDR'])){

        } else{
           return view::redirect('login');
        }
      }

      static public function journal(){
        $userIpAddress = $_SERVER['REMOTE_ADDR'];
        $userName = $_SESSION['user_name'];
      }

      static public function verifyAcces($arrayCanVisit){
        if(!isset($_SESSION['privilege_id'])) $_SESSION['privilege_id'] = 4;

        if(in_array($_SESSION['privilege_id'], $arrayCanVisit)){
          return TRUE;
      } else{
         return view::redirect('login');
      }
}}
