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
                <ul class="list-group">
                  <li class="list-group-item"><b>Animal profile title:</b> {!!$animal->nameTitle!!}</li>
                  <li class="list-group-item"><b>Animal profile ID no:</b> {!!$animal->id!!}</li>
                  <li class="list-group-item"><b>Description:</b>  <p>{!!$animal->description!!}</p></li>
                </ul>

            
                    <!--Request button: only for normal users-->
                @can('isNormal')
                <hr>
                <form class="d-flex justify-content-left">

                <!--Attach this animal profile to this user in pivot table-->
                <a class="btn btn-info" role="button" href="/animal_user_change_status/{{$animal->id}}/attach">Request Adoption</a>
                  
                  
    
                </form>
                @endcan

                  <!-- delete post -->
                   <!--Admin controls-->
                @can('isAdmin')
                <hr>
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



    
      </main>
@endsection