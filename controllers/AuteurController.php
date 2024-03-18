<?php

namespace App\Controllers;

use App\Providers\JournalStore;

use App\Providers\Auth;
use App\Models\Auteur;
use App\Providers\View;
use App\Providers\Validator;


class AuteurController
{

    public function __construct()
    {
        $auteur = new Auteur;
        $arrayAuth = $auteur->isAuth();
        Auth::verifyAcces($arrayAuth);
    }

    public function index()
    {
        $auteur = new Auteur;
        $select = $auteur->select();

        if ($select) {
            return View::render('auteur/index', ['auteurs' => $select]);
        } else {
            return View::render('error');
        }
    }

    public function show($data = [])
    {
        if (isset($data['id']) && $data['id'] != null) {
            $auteur = new Auteur;
            $selectId = $auteur->selectId($data['id']);

            if ($selectId) {
                return View::render('auteur/show', ['auteur' => $selectId]);
            } else {
                return View::render('error');
            }
        } else {
            return View::render('error', ['message' => 'Could not find this data']);
        }
    }

    public function create()
    {
        return View::render('auteur/create');
    }

    public function store($data)
    {
        $validator = new Validator;
        $validator->field('prenom', $data['prenom'], 'Le nom')->min(2)->max(45);
        $validator->field('nom', $data['nom'])->min(2)->max(45);



        if ($validator->isSuccess()) {

            $auteur = new Auteur;
            $insert = $auteur->insert($data);

            if ($insert) {
                return View::redirect('auteur');
            } else {
                return View::render('error');
            }
        } else {
            $errors = $validator->getErrors();

            return View::render('auteur/create', ['errors' => $errors, 'auteur' => $data]);
        }
    }

    public function edit($data = [])
    {
        if (isset($data['id']) && $data['id'] != null) {
            $auteur = new Auteur;
            $selectId = $auteur->selectId($data['id']);
            if ($selectId) {
                return View::render('auteur/edit', ['auteur' => $selectId]);
            } else {
                return View::render('error');
            }
        } else {
            return View::render('error', ['message' => 'Could not find this data']);
        }
    }
    public function update($data, $get)
    {
        // $get['id'];
        $validator = new Validator;
        $validator->field('prenom', $data['prenom'], 'Le nom')->min(2)->max(45);
        $validator->field('nom', $data['nom'])->max(45);


        if ($validator->isSuccess()) {
            $auteur = new Auteur;
            $update = $auteur->update($data, $get['id']);

            if ($update) {
                return View::redirect('auteur/show?id=' . $get['id']);
            } else {
                return View::render('error');
            }
        } else {
            $errors = $validator->getErrors();
            
            return View::render('auteur/edit', ['errors' => $errors, 'auteur' => $data]);
        }
    }

    public function delete($data)
    {
        $auteur = new  Auteur;
        $delete = $auteur->delete($data['id']);
        if ($delete) {
            return View::redirect('auteur');
        } else {
            return View::render('error');
        }
    }
}
