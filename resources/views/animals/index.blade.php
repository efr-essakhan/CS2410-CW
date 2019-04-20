@extends('layouts/master')

@section('title')
    AstonAdoptAnimals
@endsection
@section('content')

<div class="album py-5 bg-light">
    <div class="container">
        
        <div class= "row">
                <div class="row"> <!-- Rows of thumbnails -->
                @if(count($animals) > 0)
                    @foreach ($animals as $animal)
                                <div class="col-md-4"> <!-- copy from here -->
                                    <div class="card mb-4 shadow-sm">
                                        <img src="http://ecx.images-amazon.com/images/I/51ZU%2BCvkTyL.jpg" alt="..." class="img-responsive">
                                        <div class="card-body">
                                            <h3>{{$animal->nameTitle}}</h3>  <!-- Name -->
                                            <p class="card-text">This is a wider cardr</p> <!-- Description -->
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="btn-group">
                                                    <a href="/Animal/{{$animal->animal_id}}" class="btn btn-success pull-right" role="button">View profile</a>
                                                </div>
                                                <small class="text-muted">9 mins</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                    @endforeach
                @endif
            </div> 
        </div>
    </div>
</div>

@endsection