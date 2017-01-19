@extends('layouts.app')

@section('content')
    <style>
        img {
            max-width: 150px;
            max-height: 150px;
        }

        a {
            color: black;
        }
    </style>

    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Welcome</div>
                    <div class="panel-body">
                        <div class="column">
                            {{$recipes->links()}}
                            <div>
                                @foreach($recipes as $recipe)
                                    <a href="/recipe/show/{{$recipe->id}}" class="row">
                                            <img src="/img/recipe/{{$recipe->image}}" class="col-md-10">
                                            <div class="col-md-10">
                                                <b>{{$recipe->name}}</b>
                                                <p>{{$recipe->description}}</p>
                                            </div>
                                    </a>
                                    <hr>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
