<?php
namespace App\Models;
use App\Models\CRUD;

class Recettehasingredient extends CRUD{
    protected $table = 'recette_has_ingredient';
    protected $primaryKey = 'recette_id'; // Ici juste 1 pour la ligne 14 du CRUD mais faudra 2
    protected $fillable = ['recette_id', 'ingredient_id', 'quantite', 'unite_mesure_id'];
}




