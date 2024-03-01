<?php
namespace App\Controllers;

use App\Models\Umesure;
use App\Providers\View;
use App\Providers\Validator;


class UmesureController {

    public function index(){
        $umesure = new Umesure;
        $select = $umesure->select();
        //print_r($select);
        //include('views/umesure/index.php');
        if($select){
            return View::render('umesure/index', ['umesures' => $select]);
        }else{
            return View::render('error');
        }    
    }

    public function show($data = []){
        if(isset($data['id']) && $data['id']!=null){
            $umesure = new Umesure;
            $selectId = $umesure->selectId($data['id']);
            if($selectId){
                return View::render('umesure/show', ['umesure' => $selectId]);
            }else{
                return View::render('error');
            }
        }else{
            return View::render('error', ['message'=>'Could not find this data']);
        }
    }

    public function create(){
        return View::render('umesure/create');
    }

    public function store($data){
        
        $validator = new Validator;
        $validator->field('nom', $data['nom'], 'Le nom')->min(2)->max(45);

        if($validator->isSuccess()){
            $umesure = new Umesure;
            $insert = $umesure->insert($data);        
            if($insert){
                return View::redirect('umesure');
            }else{
                return View::render('error');
            }
        }else{
            $errors = $validator->getErrors();
            //print_r($errors);
            return View::render('umesure/create', ['errors'=>$errors, 'umesure' => $data]);
        }
    }

    public function edit($data = []){
        if(isset($data['id']) && $data['id']!=null){
            $umesure = new Umesure;
            $selectId = $umesure->selectId($data['id']);
            if($selectId){
                return View::render('umesure/edit', ['umesure' => $selectId]);
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
                $umesure = new Umesure;
                $update = $umesure->update($data, $get['id']);

                if($update){
                    return View::redirect('umesure/show?id='.$get['id']);
                }else{
                    return View::render('error');
                }
        }else{
            $errors = $validator->getErrors();
            //print_r($errors);
            return View::render('umesure/edit', ['errors'=>$errors, 'umesure' => $data]);
        }
    }

    public function delete($data){
        $umesure = new  Umesure;
        $delete = $umesure->delete($data['id']);
        if($delete){
            return View::redirect('umesure');
        }else{
            return View::render('error');
        }
    }
}