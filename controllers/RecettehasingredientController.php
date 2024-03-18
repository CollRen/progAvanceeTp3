<?php

namespace App\Controllers;

use App\Providers\JournalStore;
use App\Providers\Auth;
use App\Models\RecetteCategorie;
use App\Models\Recette;
use App\Models\Umesure;
use App\Models\Ingredient;
use App\Models\Auteur;
use App\Models\Recettehasingredient;
use App\Providers\View;
use App\Providers\Validator;
use PharData;

class RecettehasingredientController
{

    public function __construct()
    {
        $recetteHI = new Recettehasingredient;
        $arrayAuth = $recetteHI->isAuth();
        Auth::verifyAcces($arrayAuth);
        JournalStore::store();;
    }

    public function index()
    {

        $recette = new Recette;
        $select = $recette->select();

        $umesure = new Umesure;
        $selectUmesure = $umesure->select();

        $ingredient = new Ingredient;
        $selectIngredient = $ingredient->select();

        $recettehasingredient = new Recettehasingredient;
        $select = $recettehasingredient->select();


        //include('views/recettehasingredient/index.php');
        if ($select) {
            return View::render('recettehasingredient/index', ['recettehasingredients' => $select, 'umesures' => $selectUmesure, 'ingredients' => $selectIngredient]);
        } else {
            return View::render('error');
        }
    }

    public function show($data = [])
    {
        if (isset($data['id']) && $data['id'] != null) {
            $recettehasingredient = new Recettehasingredient;
            $selectId = $recettehasingredient->selectId($data['id']);
            if ($selectId) {
                return View::render('recettehasingredient/show', ['recettehasingredient' => $selectId]);
            } else {
                return View::render('error');
            }
        } else {
            return View::render('error', ['message' => 'Could not find this data']);
        }
    }

    public function create($data = NULL)
    {


        $data['id'] ? $recette_id = $data['id'] : $recette_id = $data['recette_id'];

        $umesure = new Umesure;
        $selectUmesure = $umesure->select();

        $ingredient = new Ingredient;
        $selectIngredient = $ingredient->select();

        return View::render('recettehasingredient/create', ['recette_id' => $recette_id, 'umesures' => $selectUmesure, 'ingredients' => $selectIngredient]);
    }

    public function store($data)
    {


        /*         $validator = new Validator;
        $validator->field('nom', $data['nom'], 'Le nom')->min(2)->max(45);
        $validator->field('ingredient_categorie_id', $data['ingredient_categorie_id'], 'Le ID')->min(1)->max(45);
 */
        if ($data['unite_mesure_id']) {

            $recettehasingredient = new Recettehasingredient;
            $insert = $recettehasingredient->insert($data);


            if ($insert) {

                $umesure = new Umesure;
                $selectUmesure = $umesure->select();

                $ingredient = new Ingredient;
                $selectIngredient = $ingredient->select();
                $selectRHI =  $recettehasingredient->select();


                return View::render('recettehasingredient/create', ['recette_id' => $data['recette_id'], 'recettehasingredients' => $selectRHI, 'umesures' => $selectUmesure, 'ingredients' => $selectIngredient]);
            } else {
                return View::render('error');
            }
        } else {
            $errors = $validator->getErrors();

            return View::render('recettehasingredient/create', ['errors' => $errors, 'recettehasingredient' => $data]);
        }
    }

    public function edit($data = [])
    {   //print_r($data); die(); // Array ( [recette_id] => 10 [ingredient_id] => 1 [id] => 25 )

        if (isset($data['id']) && $data['ingredient_id'] != null) {


            $recettehasingredient = new Recettehasingredient;
            $selectId = $recettehasingredient->selectId($data['id']);
            // print_r($data['id']); die();
            // 25
            //print_r($selectId); die();
            // Array ( [id] => 25 [0] => 25 [recette_id] => 10 [1] => 10 [ingredient_id] => 1 [2] => 1 [quantite] => 0.5 [3] => 0.5 [unite_mesure_id] => 1 [4] => 1 )
            $umesure = new Umesure;
            $selectUmesure = $umesure->select();
            // print_r($selectUmesure); die();
            // Array ( [0] => Array ( [id] => 1 [0] => 1 [nom] => TBS [1] => TBS ) [1] => Array ( [id] => 2 [0] => 2 [nom] => Tbs [1] => Tbs ) [2] => Array ( [id] => 3 [0] => 3 [nom] => ml [1] => ml ) [3] => Array ( [id] => 4 [0] => 4 [nom] => --- [1] => --- ) [4] => Array ( [id] => 5 [0] => 5 [nom] => lb [1] => lb ) [5] => Array ( [id] => 6 [0] => 6 [nom] => gr [1] => gr ) [6] => Array ( [id] => 7 [0] => 7 [nom] => --- [1] => --- ) [7] => Array ( [id] => 8 [0] => 8 [nom] => oz [1] => oz ) [8] => Array ( [id] => 9 [0] => 9 [nom] => Cup [1] => Cup ) )

            $ingredient = new Ingredient;
            $selectIngredient = $ingredient->select();
            // print_r($selectIngredient); die();
            // Array ( [0] => Array ( [id] => 1 [0] => 1 [nom] => Poulet [1] => Poulet [ingredient_categorie_id] => 1 [2] => 1 ) [1] => Array ( [id] => 2 [0] => 2 [nom] => Truites [1] => Truites [ingredient_categorie_id] => 8 [2] => 8 ) [2] => Array ( [id] => 3 [0] => 3 [nom] => Artichauds [1] => Artichauds [ingredient_categorie_id] => 7 [2] => 7 ) )

            if ($selectId) {
                return View::render('recettehasingredient/edit', ['recettehasingredients' => $selectId, 'umesures' => $selectUmesure, 'ingredients' => $selectIngredient]);
            } else {
                return View::render('error');
            }
        } else {
            return View::render('error', ['message' => 'Could not find this data']);
        }
    }
    public function update($data, $get)
    {
        $data['recette_id'] = $get['recette_id'];

        $validator = new Validator;
        $validator->fieldkeys('ingredient_id', $data['ingredient_id'], 'recette_id', $get['recette_id'])->uniquekeys('Recettehasingredient');


        
        if ($validator->isSuccess()) {
 
            $recettehasingredient = new Recettehasingredient;
            $update = $recettehasingredient->update($data, $get['id']);

            $recette = new Recette;
            $selectId = $recette->selectId($get['recette_id']);

            if ($update) {
                return View::redirect('recette/show?id=' . $get['recette_id'] . '&recette_categorie_id=' . $selectId['recette_categorie_id'] . '&auteur_id=' . $selectId['auteur_id']);
            } else {
                return View::render('error');
            }
        } else {
            $errors = $validator->getErrors();

            return View::render('recettehasingredient/edit', ['errors' => $errors, 'recettehasingredient' => $data]);
        }
    }

    public function delete($data)
    {
        $recettehasingredient = new  Recettehasingredient;
        $delete = $recettehasingredient->delete($data['recette_id']);
        if ($delete) {
            return true;
            /* return View::redirect('recettehasingredient'); */
        } else {
            return View::render('error');
        }
    }
}
