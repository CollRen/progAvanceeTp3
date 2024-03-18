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


class RecettehasingredientController
{

    public function __construct()
    {
        $recetteHI = new Recettehasingredient;
        $arrayAuth = $recetteHI->isAuth();
        Auth::verifyAcces($arrayAuth);
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
    {

        if (isset($data['id']) && $data['ingredient_id'] != null) {

            $recettehasingredient = new Recettehasingredient;
            $selectId = $recettehasingredient->selectId($data['id']);
            // Array ( [id] => 12 [0] => 12 [recette_id] => 6 [1] => 6 [ingredient_id] => 1 [2] => 1 [quantite] => [3] => [unite_mesure_id] => 2 [4] => 2 )
            $umesure = new Umesure;
            $selectUmesure = $umesure->select();

            $ingredient = new Ingredient;
            $selectIngredient = $ingredient->select();

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


        $validator = new Validator;
        $validator->fieldkeys('ingredient_id', $data['ingredient_id'], 'recette_id', $get['recette_id'])->uniquekeys('Recettehasingredient');


        if ($validator->isSuccess()) {
            // Suis rendu là ( le rtr de fetch vaut 0)
            $data['recette_id'] = $get['recette_id'];
            $recettehasingredient = new Recettehasingredient;

            $update = $recettehasingredient->update($data, $get['recette_id'], $get['ingredient_id']);

            if ($update) {

                $recette = new Recette;
                $selectId = $recette->selectId($get['recette_id']);

                $recetteCat = new RecetteCategorie;
                $selectCatId = $recetteCat->selectId($selectId['recette_categorie_id']);

                $auteur = new Auteur;
                $selectAuteur = $auteur->selectId($selectId['auteur_id']);

                $umesure = new Umesure;
                $selectUmesure = $umesure->select();

                $ingredient = new Ingredient;
                $selectIngredient = $ingredient->select();

                $recettehasingredient = new Recettehasingredient;
                $selectRHI = $recettehasingredient->selectId($get['recette_id']);

                foreach ($selectRHI as $row) {

                    $unite = $umesure->selectId($row['unite_mesure_id']);
                    $ingredients = $ingredient->selectId($row['ingredient_id']);
                    $ingredientId = $row['ingredient_id'];


                    $recetteHis[] = ['recette_id' => $row['recette_id'], 'unite_mesure_id' => $row['unite_mesure_id'], 'unite_mesure_nom' => $unite['nom'], 'ingredient_nom' => $ingredients['nom'], 'quantite' => $row['quantite'], 'ingredient_id' => $row['ingredient_id']];
                }


                return View::render('recette/show', ['recette' => $selectId, 'recetteCat' => $selectCatId, 'auteur' => $selectAuteur, 'recettehasingredients' => $selectRHI, 'umesures' => $selectUmesure, 'ingredients' => $selectIngredient]);
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
