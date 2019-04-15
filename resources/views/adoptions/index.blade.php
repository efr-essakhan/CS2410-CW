@extends('layouts/master')

@section('title')
    AstonAdoptAnimal
@endsection
@section('content')

<div class="album py-5 bg-light">
    <div class="container">
        <div class= "row">
                <div class="row"> <!-- Rows of thumbnails -->
                        <div class="col-md-4"> <!-- copy from here -->
                            <div class="card mb-4 shadow-sm">
                                <img src="http://ecx.images-amazon.com/images/I/51ZU%2BCvkTyL.jpg" alt="..." class="img-responsive" style="max-height: 150px">
                                <div class="card-body">
                                    <h3>Cat</h3>
                                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                            <a href="#" class="btn btn-success pull-right" role="button">Request Adoption</a>
                                            <a href="#" class="btn btn-success pull-right" role="button">View profile</a>
                                        </div>
                                        <small class="text-muted">9 mins</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>        
        </div>
    </div>
</div>

@endsection