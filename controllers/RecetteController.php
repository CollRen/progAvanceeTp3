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
        $recette = new Recette;
        $arrayAuth = $recette->isAuth();
        Auth::verifyAcces($arrayAuth);
        JournalStore::store();;
    }

    public function index()

    {

        $recette = new Recette;
        $select = $recette->select();

        $auteur = new Auteur;
        $selectAuteurs = $auteur->select();

        $recetteCats = new RecetteCategorie;
        $selectCat = $recetteCats->select();

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

            // Préparer l'affichage Recette à 1 ingrédient
            if (is_array($selectRHI) && isset($selectRHI['id'])) {
                $nomIngredients = $ingredient->selectId($selectRHI['ingredient_id']);
                $nomUmesure = $umesure->selectId($selectRHI['unite_mesure_id']);
                $nomIngredients = $ingredient->selectId($selectRHI['ingredient_id']);
                $recetteHis = ['quantite' => $selectRHI['quantite'], 'id' => $selectRHI['id'], 'recette_id' => $selectRHI['recette_id'], 'unite_mesure_id' => $selectRHI['unite_mesure_id'], 'ingredient_id' => $selectRHI['ingredient_id'], 'unite_mesure_nom' => $nomUmesure['nom'], 'ingredient_nom' => $nomIngredients['nom']];
                return View::render('recette/show', ['recette' => $selectId, 'recetteCat' => $selectCatId, 'auteur' => $selectAuteurId, 'recettehasingredient' => $recetteHis, 'ingredients' => $selectIngredients, 'umesures' => $selectUmesure]);

                // Préparer l'affichage Recette à 2 ingrédients
            } elseif (isset($selectRHI[0][0])) {
                foreach ($selectRHI as $row) {

                    $nomIngredients[$i] = $ingredient->selectId($row['ingredient_id']);
                    $nomUmesure[$i] = $umesure->selectId($row['unite_mesure_id']);
                    $nomIngredients[$i] = $ingredient->selectId($row['ingredient_id']);
                    $recetteHis[$i] = ['quantite' => $row['quantite'], 'id' => $row['id'], 'recette_id' => $row['recette_id'], 'unite_mesure_id' => $row['unite_mesure_id'], 'ingredient_id' => $row['ingredient_id'], 'unite_mesure_nom' => $nomUmesure[$i]['nom'], 'ingredient_nom' => $nomIngredients[$i]['nom']];
                    $i++;
                };
                return View::render('recette/show', ['recette' => $selectId, 'recetteCat' => $selectCatId, 'auteur' => $selectAuteurId, 'recettehasingredients' => $recetteHis, 'ingredients' => $selectIngredients, 'umesures' => $selectUmesure]);

                // Préparer l'affichage d'une Recette qui n'a pas ingrédient
            } else {

                return View::render('recette/show', ['recette' => $selectId, 'recetteCat' => $selectCatId, 'auteur' => $selectAuteurId]);
            }
        }
    }



    public function create()
    {
        $arrayCanEnter = [1, 2, 3];
        Auth::verifyAcces($arrayCanEnter);

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
        $arrayCanEnter = [1, 2, 3];
        Auth::verifyAcces($arrayCanEnter);

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
    {
        $arrayCanEnter = [1, 2, 3];
        Auth::verifyAcces($arrayCanEnter);

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
        $arrayCanEnter = [1, 2, 3];
        Auth::verifyAcces($arrayCanEnter);

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
        $arrayCanEnter = [1, 2, 3];
        Auth::verifyAcces($arrayCanEnter);

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

        $pageToPrint = file_get_contents($_SERVER['HTTP_REFERER']);



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
