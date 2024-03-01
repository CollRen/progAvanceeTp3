<?php
namespace App\Controllers;

use App\Models\RecetteCategorie;
use App\Providers\View;
use App\Providers\Validator;


class RecetteCategorieController {

    public function index(){
        $categorie = new RecetteCategorie;
        $select = $categorie->select();
        //print_r($select);
        //include('views/categorie/index.php');
        if($select){
            return View::render('categorie/index', ['categories' => $select]);
        }else{
            return View::render('error');
        }    
    }

    public function show($data = []){
        if(isset($data['id']) && $data['id']!=null){
            $categorie = new RecetteCategorie;
            $selectId = $categorie->selectId($data['id']);
            if($selectId){
                return View::render('categorie/show', ['categorie' => $selectId]);
            }else{
                return View::render('error');
            }
        }else{
            return View::render('error', ['message'=>'Could not find this data']);
        }
    }

    public function create(){
        return View::render('categorie/create');
    }

    public function store($data){
        
        $validator = new Validator;
        $validator->field('nom', $data['nom'], 'Le nom')->min(2)->max(45);

        if($validator->isSuccess()){
            $categorie = new RecetteCategorie;
            $insert = $categorie->insert($data);        
            if($insert){
                return View::redirect('categorie');
            }else{
                return View::render('error');
            }
        }else{
            $errors = $validator->getErrors();
            //print_r($errors);
            return View::render('categorie/create', ['errors'=>$errors, 'categorie' => $data]);
        }
    }

    public function edit($data = []){
        if(isset($data['id']) && $data['id']!=null){
            $categorie = new RecetteCategorie;
            $selectId = $categorie->selectId($data['id']);
            if($selectId){
                return View::render('categorie/edit', ['categorie' => $selectId]);
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
                $categorie = new RecetteCategorie;
                $update = $categorie->update($data, $get['id']);

                if($update){
                    return View::redirect('categorie/show?id='.$get['id']);
                }else{
                    return View::render('error');
                }
        }else{
            $errors = $validator->getErrors();
            //print_r($errors);
            return View::render('categorie/edit', ['errors'=>$errors, 'categorie' => $data]);
        }
    }

    public function delete($data){
        $categorie = new RecetteCategorie;
        $delete = $categorie->delete($data['id']);
        if($delete){
            return View::redirect('categorie');
        }else{
            return View::render('error');
        }
    }
}