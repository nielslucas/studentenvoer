<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use App\Recipe;
use App\User;
use App\Ingredient;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Bug: created_at value is stored in updated_at and the other way around.
        //To show last updated recipe we have to order on created_at.
        $recipes = Recipe::orderBy('created_at', 'desc')->paginate(10);
        return view('index', compact('recipes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('recipe.recipeCreate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //recipe values
        $name = $request->name;

        $createRecipe = new Recipe;

        if ($request->hasFile('recipeImage')) {
            //get file from input field 'recipeImage'
            $file = $request->file('recipeImage');

            //change the name with the id together with the timestamp
            $file_name = Auth::user()->id . "_" . date('j-n-Y_his') . '.jpg';

            //now move the file to path
            $file->move(base_path() . '/public/img/recipe', $file_name);

            //and upload the name into the recipe image
            $createRecipe->image = $file_name;
        }

        $createRecipe->name = $name;
        $createRecipe->save();

        $user = User::find(Auth::user()->id);

        $user->recipes()->attach($createRecipe->id);

        return redirect('/recipe/edit/' . $createRecipe->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //get all user recipes
        $user = User::find(Auth::user()->id);
        $userRecipes = $user->recipes()->pluck('id')->toArray();
        //check if the recipe is connected with the user
        if (in_array($id, $userRecipes)) {
            //if yes, then grand him access
            $access = true;
        } else {
            //else dont grand him acces
            $access = false;
        }

        $recipe = Recipe::find($id);
        $ingredients = $recipe->ingredients()->get();
        return view('recipe.recipeShow', compact('recipe', 'ingredients', 'access'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //get all user recipes
        $user = User::find(Auth::user()->id);
        $userRecipes = $user->recipes()->pluck('id')->toArray();

        //if $id does not contain an id of the user recipes dont show that recipe
        if (!in_array($id, $userRecipes)) {
            return redirect()->back();

            //if it does exists then show the recipe
        } else {
            //get recipe data
            $recipe = Recipe::where('id', $id)->first();
            //get all ingredients of this recipe
            $ingredients = $recipe->ingredients()->get();
            return view('recipe.recipeEdit', compact('recipe', 'ingredients'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $recipe = Recipe::find($id);
        $recipe->name = $request->name;
        $recipe->description = $request->description;
        $recipe->staps = $request->staps;

        if ($request->hasFile('recipeImage')) {
            //get file from input field 'recipeImage'
            $file = $request->file('recipeImage');

            //change the name with the id together with the timestamp
            $file_name = Auth::user()->id . "_" . date('j-n-Y_his') . '.jpg';

            //now move the file to path
            $file->move(base_path() . '/public/img/recipe', $file_name);

            //and upload the name into the recipe image
            $recipe->image = $file_name;
        }
        $recipe->save();
        return redirect('/recipe/show/'.$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function addIngredientToRecipe(Request $request)
    {
        //dd($request);
        $newIngredient = new Ingredient();

        $newIngredient->name = $request->ingredient;
        $newIngredient->waarde = $request->waarde;
        $newIngredient->save();

        $recipe = Recipe::find($request->recipeID);
        $recipe->ingredients()->attach($newIngredient->id);

        return redirect()->back();
    }

    public function removeIngredientFromRecipe($id, $recipeID) {
        $recipe = Recipe::find($recipeID);
        $recipe->ingredients()->detach($id);
        return redirect()->back();
    }
}