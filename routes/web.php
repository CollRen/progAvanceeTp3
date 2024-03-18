<?php
use App\Controllers;
use App\Routes\Route;

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@home');

Route::get('/user/create', 'UserController@create');
Route::post('/user/create', 'UserController@store');



Route::get('/recette', 'RecetteController@index');
Route::get('/recette/show', 'RecetteController@show');

Route::get('/recette/create', 'RecetteController@create');
Route::post('/recette/create', 'RecetteController@store');

Route::get('/recette/pdf', 'RecetteController@pdf');
Route::get('/recette/edit', 'RecetteController@edit');
Route::post('/recette/edit', 'RecetteController@update');
Route::post('/recette/delete', 'RecetteController@delete');



Route::get('/auteur', 'AuteurController@index');
Route::get('/auteur/show', 'AuteurController@show');

Route::get('/auteur/create', 'AuteurController@create');
Route::post('/auteur/create', 'AuteurController@store');

Route::get('/auteur/edit', 'AuteurController@edit');
Route::post('/auteur/edit', 'AuteurController@update');
Route::post('/auteur/delete', 'AuteurController@delete');



Route::get('/categorie', 'RecetteCategorieController@index');
Route::get('/categorie/show', 'RecetteCategorieController@show');

Route::get('/categorie/create', 'RecetteCategorieController@create');
Route::post('/categorie/create', 'RecetteCategorieController@store');

Route::get('/categorie/edit', 'RecetteCategorieController@edit');
Route::post('/categorie/edit', 'RecetteCategorieController@update');
Route::post('/categorie/delete', 'RecetteCategorieController@delete');


Route::get('/umesure', 'UmesureController@index');
Route::get('/umesure/show', 'UmesureController@show');

Route::get('/umesure/create', 'UmesureController@create');
Route::post('/umesure/create', 'UmesureController@store');

Route::get('/umesure/edit', 'UmesureController@edit');
Route::post('/umesure/edit', 'UmesureController@update');
Route::post('/umesure/delete', 'UmesureController@delete');



Route::get('/ingredientCat', 'IngredientCatController@index');
Route::get('/ingredientCat/show', 'IngredientCatController@show');

Route::get('/ingredientCat/create', 'IngredientCatController@create');
Route::post('/ingredientCat/create', 'IngredientCatController@store');

Route::get('/ingredientCat/edit', 'IngredientCatController@edit');
Route::post('/ingredientCat/edit', 'IngredientCatController@update');
Route::post('/ingredientCat/delete', 'IngredientCatController@delete');



Route::get('/ingredient', 'IngredientController@index');
Route::get('/ingredient/show', 'IngredientController@show');

Route::get('/ingredient/create', 'IngredientController@create');
Route::post('/ingredient/create', 'IngredientController@store');

Route::get('/ingredient/edit', 'IngredientController@edit');
Route::post('/ingredient/edit', 'IngredientController@update');
Route::post('/ingredient/delete', 'IngredientController@delete');



Route::get('/recettehasingredient', 'RecettehasingredientController@index');
Route::get('/recettehasingredient/show', 'RecettehasingredientController@show');

Route::get('/recettehasingredient/create', 'RecettehasingredientController@create');
Route::post('/recettehasingredient/create', 'RecettehasingredientController@store');

Route::get('/recettehasingredient/edit', 'RecettehasingredientController@edit');
Route::post('/recettehasingredient/edit', 'RecettehasingredientController@update');
Route::post('/recettehasingredient/update', 'RecetteController@show');
Route::post('/recettehasingredient/delete', 'RecettehasingredientController@delete');


Route::get('/journal', 'JournalController@index');


Route::get('/login', 'AuthController@index');
Route::post('/login', 'AuthController@store');
Route::get('/logout', 'AuthController@delete');



Route::dispatch();
?>

