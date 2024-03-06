<?php

namespace App\Models;

use App\Models\CRUD;

class Recettehasingredient extends CRUD
{
    protected $table = 'recette_has_ingredient';
    protected $primaryKey = 'recette_id'; // Ici juste 1 pour la ligne 14 du CRUD mais faudra 2
    protected $secondaryKey = 'ingredient_id'; 
    protected $fillable = ['recette_id', 'ingredient_id', 'quantite', 'unite_mesure_id'];


    public function delete($value)
    {

        $sql = "DELETE FROM $this->table WHERE $this->primaryKey = :$this->primaryKey";

        $stmt = $this->prepare($sql);
        $stmt->bindValue(":$this->primaryKey", $value);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function uniqueKeys($field1, $value1, $field2, $value2)
    {
        $sql = "SELECT * FROM $this->table WHERE $field1 = :$field1 and $field2 = :$field2 ";
        $stmt = $this->prepare($sql);
        $stmt->bindValue(":$field1", $value1);
        $stmt->bindValue(":$field2", $value2);
        $stmt->execute();
        $count = $stmt->rowCount();

        if ($count == 0) {
            return $stmt->fetch();
        } else {
            return false;
        }
    }

    public function update($data, $id)
    {   
        $data['recette_id'] = $id;
     /*    print_r($data); die(); */
     // C'est le update de l'ingrédient qui fonctionne pas, les autres fonctionnent


        if ($this->selectIdKeys($data['recette_id'], $data['ingredient_id'])) {

            $data_keys = array_fill_keys($this->fillable, '');
            $data = array_intersect_key($data, $data_keys);

            $fieldName = null;
            foreach ($data as $key => $value) {
                $fieldName .= "$key = :$key, ";
            }
            $fieldName = rtrim($fieldName, ', ');

            $sql = "UPDATE $this->table SET $fieldName WHERE $this->primaryKey = :$this->primaryKey AND $this->secondaryKey = :$this->secondaryKey ;";

            $stmt = $this->prepare($sql);
            //$stmt->bindValue(":$this->primaryKey", $id);


            foreach ($data as $key => $value) {
                $stmt->bindValue(":$key", $value);
            }
            $stmt->execute();

            $count = $stmt->rowCount();
            if ($count == 1) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    final public function selectIdKeys($value1, $value2)
    {

        $sql = "SELECT * FROM $this->table WHERE $this->primaryKey = :$this->primaryKey AND $this->secondaryKey = :$this->secondaryKey";
        $stmt = $this->prepare($sql);
/*         $stmt->bindValue(":$this->primaryKey", $value1);
        $stmt->bindValue(":$this->secondaryKey", $value2); */
        $stmt->execute(array(":$this->primaryKey" => $value1, ":$this->secondaryKey" => $value2));
        $count = $stmt->rowCount();

        if ($count == 1) {
            return $stmt->fetch();
        } else {
            return false;
        }
    }
}
