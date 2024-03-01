<?php
namespace App\Models;
use App\Models\CRUD;

class RecetteCategorie extends CRUD{
    protected $table = 'recette_categorie';
    protected $primaryKey = 'id';
    protected $fillable = ['nom'];
}


