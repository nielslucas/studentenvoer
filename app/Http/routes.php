<?php
//overview
Route::get('/','RecipeController@index');

//recipes
Route::get('/recipe/show/{id}','RecipeController@show');
Route::get('/recipe/create','RecipeController@create');
Route::post('/recipe/store','RecipeController@store');
Route::get('/recipe/edit/{id}','RecipeController@edit');
Route::post('/recipe/update/{id}','RecipeController@update');
Route::post('/recipe/addingredient/{recipeID}','RecipeController@addIngredientToRecipe');
Route::get('recipe/ingredient/remove/{id}/{recipeID}','RecipeController@removeIngredientFromRecipe');

Route::auth();

Route::get('/home', 'HomeController@index');
