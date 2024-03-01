<?php
namespace App\Controllers;

use App\Models\IngredientCat;
use App\Providers\View;
use App\Providers\Validator;


class IngredientCatController {

    public function index(){
        $ingredientCat = new IngredientCat;
        $select = $ingredientCat->select();
        //print_r($select);
        //include('views/ingredientCat/index.php');
        if($select){
            return View::render('ingredientCat/index', ['ingredientcats' => $select]);
        }else{
            return View::render('error');
        }    
    }

    public function show($data = []){
        if(isset($data['id']) && $data['id']!=null){
            $ingredientCat = new IngredientCat;
            $selectId = $ingredientCat->selectId($data['id']);
            if($selectId){
                return View::render('ingredientCat/show', ['ingredientCat' => $selectId]);
            }else{
                return View::render('error');
            }
        }else{
            return View::render('error', ['message'=>'Could not find this data']);
        }
    }

    public function create(){
        return View::render('ingredientCat/create');
    }

    public function store($data){
        
        $validator = new Validator;
        $validator->field('nom', $data['nom'], 'Le nom')->min(2)->max(45);

        if($validator->isSuccess()){
            $ingredientCat = new IngredientCat;
            $insert = $ingredientCat->insert($data);        
            if($insert){
                return View::redirect('ingredientCat');
            }else{
                return View::render('error');
            }
        }else{
            $errors = $validator->getErrors();
            //print_r($errors);
            return View::render('ingredientCat/create', ['errors'=>$errors, 'ingredientCat' => $data]);
        }
    }

    public function edit($data = []){
        if(isset($data['id']) && $data['id']!=null){
            $ingredientCat = new IngredientCat;
            $selectId = $ingredientCat->selectId($data['id']);
            if($selectId){
                return View::render('ingredientCat/edit', ['ingredientCat' => $selectId]);
            }else{
                return View::render('error');
            }
        }else{
            return View::render('error', ['message'=>'Could not find this data']);
        }
    }
    public function update($data, $get){
        // $get['id'];
        $validator = new Validator;
        $validator->field('nom', $data['nom'], 'Le nom')->min(2)->max(45);

        if($validator->isSuccess()){
                $ingredientCat = new IngredientCat;
                $update = $ingredientCat->update($data, $get['id']);

                if($update){
                    return View::redirect('ingredientCat/show?id='.$get['id']);
                }else{
                    return View::render('error');
                }
        }else{
            $errors = $validator->getErrors();
            //print_r($errors);
            return View::render('ingredientCat/edit', ['errors'=>$errors, 'ingredientCat' => $data]);
        }
    }

    public function delete($data){
        $ingredientCat = new  IngredientCat;
        $delete = $ingredientCat->delete($data['id']);
        if($delete){
            return View::redirect('ingredientCat');
        }else{
            return View::render('error');
        }
    }
}