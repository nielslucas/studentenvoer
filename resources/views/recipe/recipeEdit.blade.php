@extends('layouts.app')

@section('content')
    <style>
        img {
            max-width: 50px;
            max-height: 50px;
        }

        textarea {
            box-sizing: border-box;
            resize: none;
        }
    </style>

    <div class="container">
        <div class="row">
            <div class="panel-heading">Welcome</div>

            <form method="post" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="form-group">
                    <img alt="User Pic" id="profilePick" src="/img/recipe/{{$recipe->image}}" class="img-responsive">
                    <label for="exampleInputFile">File input</label>
                    <input type="file" class="form-control-file" name="recipeImage">
                </div>

                <div class="form-group">
                    <label for="text">Recept naam</label>
                    <input type="text" class="form-control" placeholder="Recept naam" name="name"
                           value="{{$recipe->name}}" required>
                </div>

                <div class="form-group">
                    <label for="text">Recept description</label>
                    <input type="text" class="form-control" placeholder="Recept description" name="description"
                           value="{{$recipe->description}}" required>
                </div>

                <div>
                    <div class="form-group">
                        <label for="comment">Stappen plan:</label>
                        <textarea data-autoresize class="form-control" rows="5" name="staps" required>{{$recipe->staps}}</textarea>
                    </div>
                </div>

                <button type="submit" formaction="/recipe/update/{{$recipe->id}}" class="btn btn-primary">Oplslaan</button>
            </form>

            <hr>
            <h4>Ingredienten worden appart opgeslagen, vergeet niet eerst je recept op te slaan voordat je ingredienten aanapast </h4>
            <div>
                <form method="post">
                    {{ csrf_field() }}
                    <div class="form-group row">
                        <div class="col-xs-2">
                            <label for="text">Ingredient naam</label>
                            <input type="text" class="form-control" placeholder="Ingredient" name="ingredient" required>
                        </div>
                        <div class="col-xs-2">
                            <label for="text">Waarde</label>
                            <input type="text" class="form-control" placeholder="Waarde" name="waarde" required>
                        </div>
                    </div>
                    <button type="submit" formaction="/recipe/addingredient/{{$recipe->id}}" class="btn btn-primary">Voeg toe</button>
                </form>
                <br>
                @foreach($ingredients as $ingredient)
                    <div class="row">
                        <div class="col-sm-2">
                            {{$ingredient->name}}
                        </div>
                        <div class="col-sm-2">
                            {{$ingredient->waarde}}
                        </div>
                        <div class="col-sm-2">
                            <a href="/recipe/ingredient/remove/{{$ingredient->id}}/{{$recipe->id}}">Verwijder</a>
                        </div>
                        <hr>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
