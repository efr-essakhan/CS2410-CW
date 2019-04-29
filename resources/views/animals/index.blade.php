@extends('layouts/app')

@section('title')
    AstonAdoptAnimals
@endsection
@section('content')
<h1>Animal profiles up for adoption:</h1>
@if(count($animals) > 0)
    @foreach($animals as $animal)
    <div class="card card-body bg-light">
            <div class="row">
                <div class="col-md-4 col-sm-4">
                    <img  class="img-thumbnail" style="width:75%; border:1px solid black;" src="/storage/cover_images/{{$animal->cover_image}}">
                </div>
                <div class="col-md-8 col-sm-8">
                    <h3><a href="/Animal/{{$animal->id}}">{{$animal->nameTitle}}</a></h3>
                    <p><b>Type: </b> {{$animal->animaltype}}</p>
                    @php    
                    //calculate DOB
                    $tz  = new DateTimeZone('Europe/Brussels');
                    $age = DateTime::createFromFormat('Y-m-d', $animal->dob, $tz)
                    ->diff(new DateTime('now', $tz))
                    ->y;

                         //workout gender
                         $gender = '-';
                        if($animal->gender == 1){
                            $gender = 'Male';
                        }
                        else{
                            $gender = 'female';
                        }

                    @endphp
                    <p><b>Age: </b> {{$age}}</p>
                    <p><b>Gender: </b> {{$gender}}</p>
                    <small>Available since: {{$animal->created_at}}</small>
                    <small class="text-muted float-right">(id:{{$animal->id}})</small>
                </div>
            </div>
        </div>
       
  
    @endforeach
    {{$animals->links()}}
@else
    <p>No Animal Profiles Available</p>
@endif


@endsection