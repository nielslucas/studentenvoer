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
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Welcome</div>

                    <img alt="User Pic" id="profilePick" src="" class="img-responsive">

                    <form method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="text">Recept naam</label>
                            <input type="text" class="form-control" placeholder="Recept naam" name="name">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputFile">File input</label>
                            <input type="file" id="imgInp" class="form-control-file" name="recipeImage">
                        </div>

                        <button type="submit" formaction="/recipe/store" class="btn btn-primary">Volgende stap</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
