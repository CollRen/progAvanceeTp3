<?php
namespace App\Models;
use App\Models\CRUD;

class Ingredient extends CRUD{
    protected $table = 'ingredient';
    protected $primaryKey = 'id';
    protected $fillable = ['nom', 'ingredient_categorie_id'];
}

	