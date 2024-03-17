<?php
namespace App\Models;
use App\Models\CRUD;

class Recette extends CRUD{
    protected $table = 'recette';
    protected $primaryKey = 'id';
    protected $isAuth = [1, 2, 3, 4];
    protected $fillable = ['titre', 'description', 'temps_preparation', 'temps_cuisson', 'recette_categorie_id', 'auteur_id'];


    /**
     * $value: id da la recette
     * $what: nom de la 2e colonne à comparer
     * $idToFind: id de comparason avec la 2e colonne 
     */
    final public function selectIdWhere($value, $what, $idToFind)
    {
        $sql = "SELECT * FROM $this->table WHERE $this->primaryKey = :$this->primaryKey AND $what = :$what ";
        $stmt = $this->prepare($sql);
        $stmt->bindValue(":$this->primaryKey", $value);
        $stmt->bindValue(":$what", $idToFind);
        $stmt->execute();
        $count = $stmt->rowCount();
        if ($count == 1) {
            return $stmt->fetch();
        } else {
            return false;
        }
    }
}
