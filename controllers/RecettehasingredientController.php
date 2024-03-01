<?php
namespace App\Controllers;

use App\Models\Recettehasingredient;
use App\Providers\View;
use App\Providers\Validator;


class RecettehasingredientController {

    public function index(){
        $recettehasingredient = new Recettehasingredient;
        $select = $recettehasingredient->select();
        //print_r($select);
        //include('views/recettehasingredient/index.php');
        if($select){
            return View::render('recettehasingredient/index', ['recettehasingredients' => $select]);
        }else{
            return View::render('error');
        }    
    }

    public function show($data = []){
        if(isset($data['id']) && $data['id']!=null){
            $recettehasingredient = new Recettehasingredient;
            $selectId = $recettehasingredient->selectId($data['id']);
            if($selectId){
                return View::render('recettehasingredient/show', ['recettehasingredient' => $selectId]);
            }else{
                return View::render('error');
            }
        }else{
            return View::render('error', ['message'=>'Could not find this data']);
        }
    }

    public function create(){
        return View::render('recettehasingredient/create');
    }

    public function store($data){
        
        $validator = new Validator;
        $validator->field('nom', $data['nom'], 'Le nom')->min(2)->max(45);
        $validator->field('ingredient_categorie_id', $data['ingredient_categorie_id'], 'Le ID')->min(1)->max(45);

        if($validator->isSuccess()){
            $recettehasingredient = new Recettehasingredient;
            $insert = $recettehasingredient->insert($data);        
            if($insert){
                return View::redirect('recettehasingredient');
            }else{
                return View::render('error');
            }
        }else{
            $errors = $validator->getErrors();
            //print_r($errors);
            return View::render('recettehasingredient/create', ['errors'=>$errors, 'recettehasingredient' => $data]);
        }
    }

    public function edit($data = []){
        if(isset($data['id']) && $data['id']!=null){
            $recettehasingredient = new Recettehasingredient;
            $selectId = $recettehasingredient->selectId($data['id']);
            if($selectId){
                return View::render('recettehasingredient/edit', ['recettehasingredient' => $selectId]);
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
        $validator->field('ingredient_categorie_id', $data['ingredient_categorie_id'], 'Le ID')->min(1)->max(45);


        if($validator->isSuccess()){
                $recettehasingredient = new Recettehasingredient;
                $update = $recettehasingredient->update($data, $get['id']);

                if($update){
                    return View::redirect('recettehasingredient/show?id='.$get['id']);
                }else{
                    return View::render('error');
                }
        }else{
            $errors = $validator->getErrors();
            //print_r($errors);
            return View::render('recettehasingredient/edit', ['errors'=>$errors, 'recettehasingredient' => $data]);
        }
    }

    public function delete($data){
        $recettehasingredient = new  Recettehasingredient;
        $delete = $recettehasingredient->delete($data['id']);
        if($delete){
            return View::redirect('recettehasingredient');
        }else{
            return View::render('error');
        }
    }
}