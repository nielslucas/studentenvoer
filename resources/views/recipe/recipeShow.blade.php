@extends('layouts.app')

@section('content')
    <style>
        img {
            max-width: 50px;
            max-height: 50px;
        }
    </style>

    <div class="container">
        <div class="row">
            <div class="panel-heading">Welcome</div>
            @if($access === true)
                <a type="submit" href="/recipe/edit/{{$recipe->id}}" class="btn btn-primary">Aanpassen</a>
                <hr>
            @endif

            <form method="post" enctype="multipart/form-data">
                {{ csrf_field() }}

                <img alt="User Pic" id="profilePick" src="/img/recipe/{{$recipe->image}}" class="img-responsive">

                <div class="form-group">
                    <label for="text">Recept naam</label>
                    <p>{{$recipe->name}}</p>
                    <label for="text">Beschrijving</label>
                    <p>{{$recipe->description}}</p>
                </div>
            </form>
            <br>
            <div class="row">
                <div class="col-sm-6" style="background-color:lavender;">
                    <h4>Ingredienten</h4>
                    @foreach($ingredients as $ingredient)
                        <div class="row">
                            <div class="col-sm-2">
                                {{$ingredient->name}}
                            </div>
                            <div class="col-sm-2">
                                {{$ingredient->waarde}}
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="col-sm-6" style="background-color:lavenderblush;">
                    <h4>Stappen plan:</h4>
                    <p style="white-space: pre-line;">{{$recipe->staps}}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
