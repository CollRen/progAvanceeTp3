<?php

namespace App\Controllers;

use App\Providers\JournalStore;

use App\Providers\Auth;
use App\Models\Recette;
use App\Models\Auteur;
use App\Models\RecetteCategorie;
use App\Models\Umesure;
use App\Models\Ingredient;
use App\Models\Recettehasingredient;
use App\Providers\View;
use App\Providers\Validator;
use DateTime;
use Dompdf\Dompdf;


class RecetteController
{

    public function __construct()
    {
        JournalStore::store();
        //Auth::session();
    }
    /* 
- Adresse IP
- Date
- Nom d'utilisateur (si l'utilisateur est connecté, sinon s'inscrire en tant que visiteur)
- user_id: $_SERVER[HTTP_SEC_FETCH_USER]
- Page visitée: $_SERVER[SCRIPT_FILENAME] || REDIRECT_URL || Les deux . */


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


    public function show($data = [])
    {       // id vaut pour recette_id
        if (isset($data['id']) && $data['id'] != null) {
            $recette = new Recette;
            $selectId = $recette->selectId($data['id']);
            $recetteCat = new RecetteCategorie;
            $selectCatId = $recetteCat->selectId($data['recette_categorie_id']);

            $auteur = new Auteur;
            $selectAuteurId = $auteur->selectId($data['auteur_id']);

            $umesure = new Umesure;
            $selectUmesure = $umesure->select();

            $ingredient = new Ingredient;
            $selectIngredients = $ingredient->select();

            $recettehasingredient = new Recettehasingredient;
            $selectRHI = $recettehasingredient->selectId($data['id'], 'recette_id');



            $recetteHis[] = '';
            $i = 0;

            if (is_array($selectRHI[0])) {
                foreach ($selectRHI as $row) {

                    $nomIngredients[$i] = $ingredient->selectId($row['ingredient_id']);
                    $nomUmesure[$i] = $umesure->selectId($row['unite_mesure_id']);
                    $nomIngredients[$i] = $ingredient->selectId($row['ingredient_id']);
                    $recetteHis[$i] = ['quantite' => $row['quantite'], 'id' => $row['id'], 'recette_id' => $row['recette_id'], 'unite_mesure_id' => $row['unite_mesure_id'], 'ingredient_id' => $row['ingredient_id'], 'unite_mesure_nom' => $nomUmesure[$i]['nom'], 'ingredient_nom' => $nomIngredients[$i]['nom']];
                    $i++;
                };
            } else {
                // print_r($selectRHI); die();
                $row = $selectRHI;
                $nomIngredients = $ingredient->selectId($row['ingredient_id']);
                $nomUmesure = $umesure->selectId($row['unite_mesure_id']);
                $nomIngredients = $ingredient->selectId($row['ingredient_id']);
                $recetteHis = ['quantite' => $row['quantite'], 'id' => $row['id'], 'recette_id' => $row['recette_id'], 'unite_mesure_id' => $row['unite_mesure_id'], 'ingredient_id' => $row['ingredient_id'], 'unite_mesure_nom' => $nomUmesure['nom'], 'ingredient_nom' => $nomIngredients['nom']];
            }



            if ($selectId && is_array($selectRHI[0])) {
                return View::render('recette/show', ['recette' => $selectId, 'recetteCat' => $selectCatId, 'auteur' => $selectAuteurId, 'recettehasingredients' => $recetteHis, 'ingredients' => $selectIngredients, 'umesures' => $selectUmesure]);
            } elseif ($selectId) {
                return View::render('recette/show', ['recette' => $selectId, 'recetteCat' => $selectCatId, 'auteur' => $selectAuteurId, 'recettehasingredient' => $recetteHis, 'ingredients' => $selectIngredients, 'umesures' => $selectUmesure]);
            } else {
                return View::render('error');
            }
        } else {
            return View::render('error', ['message' => 'Could not find this data']);
        }
    }


    public function create()
    {
        //Auth::session();

        $recetteCategorie = new RecetteCategorie;
        $recetteCategorieSelect = $recetteCategorie->select();

        $recetteAuteur = new Auteur;
        $recetteAuteurSelect = $recetteAuteur->select();

        $umesure = new Umesure;
        $selectUmesure = $umesure->select();

        $ingredient = new Ingredient;
        $selectIngredient = $ingredient->select();

        $recettehasingredient = new Recettehasingredient;
        $selectRHI = $recettehasingredient->select();



        return View::render('recette/create', ['recetteCategories' => $recetteCategorieSelect, 'recetteAuteurs' => $recetteAuteurSelect, 'recettehasingredients' => $selectRHI, 'umesures' => $selectUmesure, 'ingredients' => $selectIngredient]);
    }


    public function store($data)
    {

        $validator = new Validator;
        $validator->field('titre', $data['titre'])->min(2)->max(60)->required();
        $validator->field('description', $data['description'])->max(256)->required();
        $validator->field('temps_preparation', $data['temps_preparation'])->max(4)->number()->required();
        $validator->field('temps_cuisson', $data['temps_cuisson'])->max(4)->number()->required();
        $validator->field('recette_categorie_id', $data['recette_categorie_id'])->max(5)->int()->required();
        $validator->field('auteur_id', $data['auteur_id'])->max(5)->int()->required();

        if ($validator->isSuccess()) {
            $recette = new Recette;
            $insert = $recette->insert($data);

            if ($insert) {

                //On enregristre un premier ingrédient ici ?
                /*             $recetteHasI = new Recettehasingredient;
            $insertHasI = $recetteHasI->insert($data); */

                $umesure = new Umesure;
                $selectUmesure = $umesure->select();

                $ingredient = new Ingredient;
                $selectIngredient = $ingredient->select();

                return View::redirect('recettehasingredient/create?id=' . $insert);
            } else {
                return View::render('error');
            }
        } else {

            $errors = $validator->getErrors();

            $recetteCategorie = new RecetteCategorie;
            $recetteCategorieSelect = $recetteCategorie->select();

            $recetteAuteur = new Auteur;
            $recetteAuteurSelect = $recetteAuteur->select();

            return View::render('recette/create', ['errors' => $errors, 'recette' => $data, 'recetteCategories' => $recetteCategorieSelect, 'recetteAuteurs' => $recetteAuteurSelect]);
        }
    }


    public function edit($data = [])
    {   /* print_r($data); die(); */

        if (isset($data['id']) && $data['id'] != null) {
            $recette = new Recette;
            $selectId = $recette->selectId($data['id']);

            $recetteCategorie = new RecetteCategorie;
            $recetteCategorieSelect = $recetteCategorie->select();

            $recetteAuteur = new Auteur;
            $recetteAuteurSelect = $recetteAuteur->select();

            if ($selectId) {
                return View::render('recette/edit', ['recette' => $selectId, 'recetteCats' => $recetteCategorieSelect, 'auteurs' => $recetteAuteurSelect]);
            } else {
                return View::render('error');
            }
        } else {
            return View::render('error', ['message' => 'Nous ne trouvons pas ces données']);
        }
    }


    public function update($data, $get)
    {

        $validator = new Validator;
        $validator->field('titre', $data['titre'])->min(2)->max(60)->required();
        $validator->field('description', $data['description'])->max(256)->required();
        $validator->field('temps_preparation', $data['temps_preparation'])->max(4)->number()->required();
        $validator->field('temps_cuisson', $data['temps_cuisson'])->max(4)->number()->required();
        $validator->field('recette_categorie_id', $data['recette_categorie_id'])->max(5)->int()->required();
        $validator->field('auteur_id', $data['auteur_id'])->max(5)->int()->required();

        if ($validator->isSuccess()) {
            $recette = new Recette;
            $update = $recette->update($data, $get['id']);
            if ($update) {
                return View::redirect('recette/show?id=' . $get['id'] . '&recette_categorie_id=' . $data['recette_categorie_id'] . '&auteur_id=' . $data['auteur_id']);
            } else {
                return View::render('error');
            }
        } else {
            $errors = $validator->getErrors();

            $recetteCategorie = new RecetteCategorie;
            $recetteCategorieSelect = $recetteCategorie->select();

            $recetteAuteur = new Auteur;
            $recetteAuteurSelect = $recetteAuteur->select();
            return View::render('recette/create', ['errors' => $errors, 'recette' => $data, 'recetteCategories' => $recetteCategorieSelect, 'recetteAuteurs' => $recetteAuteurSelect]);
        }
    }


    public function delete($data)
    {

        $recettehasingredient = new Recettehasingredient;
        $selectRHI = $recettehasingredient->select();

        $i = 0;
        foreach ($selectRHI as $row) {
            if ($row['recette_id'] == $data['id']) {
                $RHIdelete = $recettehasingredient->delete($row['recette_id']);
            }
        }


        $recette = new  Recette;
        $delete = $recette->delete($data['id']);
        if ($delete) {
            return View::redirect('recette');
        } else {
            return View::render('error');
        }
    }

    public function pdf()
    {

    $pageToPrint = file_get_contents('http://localhost:8000/htdSession_H23_24/php/travaux/sommatifs/tp3/recette_MVC_tp3/recette/show?id=9&recette_categorie_id=3&auteur_id=1/');



        // instantiate and use the dompdf class
        $dompdf = new Dompdf();
        $dompdf->loadHtml($pageToPrint);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream();
        //return View::redirect('recette/pdf');
    }
}
