<?php
namespace App\Models;
use App\Models\CRUD;

class Umesure extends CRUD{
    protected $table = 'unite_mesure';
    protected $primaryKey = 'id';
    protected $fillable = ['nom'];
}


