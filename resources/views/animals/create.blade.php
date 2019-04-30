@extends('layouts/app')
@section('title')
AstonAdoptAnimals
@endsection
@section('content')

<h1>Create a new Animal profile for adoption</h1>

<form method="post" enctype="multipart/form-data" action="{{ route('Animal.store') }}">
    <!-- Text input-->
    <div class="form-group">
        @csrf
        <label for="title">* Profile Title <small> 30 word limit</small></label>
        <input maxlength="30" type="text" class="form-control" name="title" placeholder="Title" />
    </div>
    <!-- Text input-->
    <div class="form-group">
        <label for="body">* Profile Description <small> 9999 word limit</small></label>
        <textarea maxlength="9999" class="form-control" name="body" id="article-ckeditor" cols="30" rows="10"
            placeholder="Body Text"></textarea>
    </div>

    <!-- Drop down list-->
    <div class="form-group">
        <label for="body">* Animal Type</label>
        <select id="sadsad" name="animaltype" class="form-control">
            <option value="Bird">Bird</option>
            <option value="Cat">Cat</option>
            <option value="Dog">Dog</option>
            <option value="Fish">Fish</option>
            <option value="Horse">Horse</option>
            <option value="Reptile">Reptile</option>
        </select>
    </div>

    <!-- Multiple Radios FOR GENDER -->
    <div class="form-group">
        <label for="body">* Gender</label>
        <div class="form-group">
            <div class="radio">
                <label for="radios-0">
                    <input type="radio" name="radios" id="radios-0" value="1">
                    Male
                </label>
            </div>
            <div class="radio">
                <label for="radios-1">
                    <input type="radio" name="radios" id="radios-1" value="0">
                    Female
                </label>
            </div>
        </div>
    </div>

    <!-- date of birth picker -->
    @include('partials/dob')

    
    <!-- file explorer -->
    <div class="form-group">
        Cover/main image (png or jpeg):
        <input type="file" name="cover_image" accept="image/png, image/jpeg"">

            </div>

               <!-- file explorer -->
               <div class=" form-group">
        Secondary image (png or jpeg):
        <input type="file" name="second_image" accept="image/png, image/jpeg"">
    
                </div>

            <button type=" submit" class="btn btn-primary">Submit</button>
</form>


@endsection
