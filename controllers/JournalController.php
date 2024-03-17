<?php

namespace App\Controllers;

use App\Providers\JournalStore;

use App\Models\Journal;
use App\Providers\Auth;
use App\Providers\View;

class JournalController
{
    public function __construct()
    {
        $journal = new Journal;
        $arrayAuth = $journal->isAuth();
        Auth::session($arrayAuth);
    }
    public function index()
    {
        $journal = new Journal;
        $select = $journal->select();

        if ($select) {

            return View::render('journal/index', ['journals' => $select]);
        } else {
            return View::render('error');
        }
    }
}
