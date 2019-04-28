@extends('layouts/app')

@section('title')
    AstonAdoptAnimals
@endsection
@section('content')
<h1>Animal profiles:</h1>
@if(count($animals) > 0)
    @foreach($animals as $animal)
        <div class="card card-body bg-light">
            <div class="float-left">
                <div class="col-md-4 col-sm-4">
                    <!--img style="width:100%" src="/storage/cover_images/{$post->cover_image}}"-->
                </div>
                <div class="col-md-8 col-sm-8">
                    <h3>{{$animal->nameTitle}}</h3>
                    <p class="card-text">{!!$animal->description!!}</p>
               
                </div>
                <div class="d-flex justify-content-between align-items-center">
                        <div class="btn-group">
                            <a href="/Animal/{{$animal->id}}" class="btn btn-success pull-right" role="button">View profile</a>
                        </div>
                        <small class="text-muted">(id:{{$animal->id}})</small>
                </div>
            </div>
        </div>
    @endforeach
    {{$animals->links()}}
@else
    <p>No Animal Profiles Available</p>
@endif


@endsection