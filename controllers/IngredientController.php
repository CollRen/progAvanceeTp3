<?php

namespace App\Controllers;

use App\Models\Ingredient;
use App\Models\IngredientCat;  // Besoin de ça
use App\Providers\View;
use App\Providers\Validator;


class IngredientController
{

    public function index()
    {
        $ingredient = new Ingredient;
        $select = $ingredient->select();


        $ingredientCat = new IngredientCat; // Besoin de ça
        $selectCat = $ingredientCat->select(); // Besoin de ça

        if ($select && $selectCat) {
            return View::render('ingredient/index', ['ingredients' => $select, 'ingredientcats' => $selectCat]); // Besoin de ça
        } else {
            return View::render('error');
        }
    }

    public function show($data = [])
    {
        if (isset($data['id']) && $data['id'] != null) {
            print_r($data);
            $ingredient = new Ingredient;
            $selectId = $ingredient->selectId($data['id']);

            if ($selectId) {
                $ingredientCat = new IngredientCat;
                $selectCat = $ingredientCat->select();
                return View::render('ingredient/show', ['ingredient' => $selectId, 'ingredientcats' => $selectCat]);
            } else {
                return View::render('error');
            }
        } else {
            return View::render('error', ['message' => 'Could not find this data']);
        }
    }

    public function create()
    {

        $ingredientCat = new IngredientCat;
        $selectCat = $ingredientCat->select();
        return View::render('ingredient/create', ['ingredientcats' => $selectCat]);
    }

    public function store($data)
    {

        $validator = new Validator;

        $validator->field('nom', $data['nom'], 'Le nom')->min(2)->max(45)->required();

        if ($validator->isSuccess()) {
            $ingredient = new Ingredient;
            $insert = $ingredient->insert($data);
            if ($insert) {
                return View::redirect('ingredient');
            } else {
                return View::render('error');
            }
        } else {
            $errors = $validator->getErrors();
            $ingredientCat = new IngredientCat;
            $selectCat = $ingredientCat->select();
            return View::render('ingredient/create', ['errors' => $errors, 'ingredient' => $data, 'ingredientcats' => $selectCat]);
        }
    }

    public function edit($data = [])
    {
        if (isset($data['id']) && $data['id'] != null) {
            $ingredient = new Ingredient;
            $selectId = $ingredient->selectId($data['id']);
            if ($selectId) {
                $ingredientCat = new IngredientCat;
                $selectCat = $ingredientCat->select();

                return View::render('ingredient/edit', ['ingredient' => $selectId, 'ingredientcats' => $selectCat]);
            } else {
                return View::render('error');
            }
        } else {
            return View::render('error', ['message' => 'Could not find this data']);
        }
    }
    public function update($data, $get)
    {
        $id = $_GET['id']; // S'il n'y a pas de changement

        $validator = new Validator;
        $validator->field('nom', $data['nom'], 'Le nom')->min(2)->max(45);

        if ($validator->isSuccess()) {
            $ingredient = new Ingredient;
            $update = $ingredient->update($data, $get['id']);

            if ($update) {
                return View::redirect('ingredient/show?id=' . $get['id']);
            } else {
                return View::redirect('ingredient/show?id=' . $id);
            }
        } else {
            $errors = $validator->getErrors();
            //print_r($errors);
            return View::render('ingredient/edit', ['errors' => $errors, 'ingredient' => $data]);
        }
    }

    public function delete($data)
    {
        $ingredient = new  Ingredient;
        $delete = $ingredient->delete($data['id']);
        if ($delete) {
            return View::redirect('ingredient');
        } else {
            return View::render('error');
        }
    }
}
