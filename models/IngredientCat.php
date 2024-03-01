<?php
namespace App\Models;
use App\Models\CRUD;

class IngredientCat extends CRUD{
    protected $table = 'ingredient_categorie';
    protected $primaryKey = 'id';
    protected $fillable = ['nom'];
}


