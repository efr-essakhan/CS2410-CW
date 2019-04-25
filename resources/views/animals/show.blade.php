@extends('layouts/app')

@section('title')
    AstonAdoptAnimals
@endsection
@section('content')

  <!--Main layout-->
  <main class="mt-5 pt-4">
        <div class="container dark-grey-text mt-5">
    
          <!--Grid row-->
          <div class="row wow fadeIn">
    
            <!--Picture-->
            
            <div class="col-md-6 mb-4">
    
              <img src="https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/Products/14.jpg" class="img-fluid" alt="">
    
            </div>
            <!--Grid column-->
    
            <!--Grid column-->
            <div class="col-md-6 mb-4">
    
              <!--Content-->
              <div class="p-4">
                  
                <p class="lead font-weight-bold">Description</p>
    
                <p>{!!$animal->description!!}</p> <!--!! instead of {} to allow html parsing-->
    
                    <!--Request button: only for normal users-->
                @can('isNormal')
                <form class="d-flex justify-content-left">

              
                <a class="btn btn-info" role="button" href="/animal_user_change_status/{{$animal->id}}/attach">Request Adoption</a>
                  <!-- Change status-->
                  
    
                </form>
                @endcan

                  <!-- delete post -->
                   <!--Admin controls-->
                @can('isAdmin')
                <form action="/Animal/{{$animal->id}}" method="POST" class="float-right">
                    {{ method_field('DELETE') }}

                <div class="form-group">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">


                 
                </div>
                    <button type="submit" class="btn btn-danger">Delete</button>
                     <!-- Edit button -->
                  <a class="btn btn-info" role="button" href="/Animal/{{$animal->id}}/edit">Edit Profile</a>
                </form>
                @endcan
    
              </div>
             
              <!--Content-->
    
            </div>
            <!--Grid column-->
    
          </div>

          <!--Footer-->
          <hr>
    
          <!--Grid row-->
          <div class="row d-flex justify-content-center wow fadeIn">
    
            <!--Grid column-->
            <div class="col-md-6 text-center">
    
              <h4 class="my-4 h4">Additional information</h4>
    
              <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus suscipit modi sapiente illo soluta odit
                voluptates,
                quibusdam officia. Neque quibusdam quas a quis porro? Molestias illo neque eum in laborum.</p>
    
            </div>

    
      </main>
@endsection