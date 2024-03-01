<?php

namespace App\Controllers;

use App\Models\Recette;
use App\Models\Auteur;
use App\Models\RecetteCategorie;
use App\Providers\View;
use App\Providers\Validator;


class HomeController
{

    public function index()
    {
        $recette = new Recette;
        $select = $recette->select();

        $auteur = new Auteur;
        $selectAuteurs = $auteur->select();

        $recetteCats = new RecetteCategorie;
        $selectCat = $recetteCats->select();
        //print_r($select);
        //include('views/recette/index.php');
        if ($select) {
            return View::render('recette/index', ['recettes' => $select, 'recetteCats' => $selectCat, 'auteurs' => $selectAuteurs]);
        } else {
            return View::render('error');
        }
    }
}