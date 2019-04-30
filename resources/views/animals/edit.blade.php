@extends('layouts/app')

@section('title')
AstonAdoptAnimals
@endsection
@section('content')

<h1>Edit profile page</h1>
<h5>Edit Animal profile with title: {{$animal->nameTitle}}</h5>

<form action="/Animal/{{ $animal->id }}" enctype="multipart/form-data" method="POST">
    <!-- Text input-->
    @method('PUT')
    @csrf

    <div class="form-group">
        <label for="title">Post Title</label>
        <input maxlength="30" type="text" class="form-control" name="title" id="title" placeholder="title"
            value="{{$animal->nameTitle}}">
    </div>

    <div class="form-group">
        <label for="body">Post Body</label>
        <textarea  maxlength="9999"class="form-control" id="article-ckeditor" name="body" cols="30" rows="10"
            value="{{$animal->description}}">{{$animal->description}}</textarea>
    </div>


    <!-- Drop down list-->
    <div class="form-group">
        <label for="body">Animal Type</label>
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
        <label for="body">Gender</label>
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
