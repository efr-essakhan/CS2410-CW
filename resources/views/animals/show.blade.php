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

            <!--Picture and slides-->

            <div class="col-md-6 mb-4 row justify-content-center">

                <div class="col-md-8 col-sm-8">
                    <img class="mySlides" style="width:100%; border:1px solid black;"
                        src="/storage/cover_images/{{$animal->cover_image}}">


                    @if($animal->second_image != 'noimage.jpg')
                    <img class="mySlides" style="width:100%; border:1px solid black;"
                        src="/storage/cover_images/{{$animal->second_image}}">

                    <button class="w3-button w3-black w3-display-left" onclick="plusDivs(-1)">&#10094;</button>
                    <button class="w3-button w3-black w3-display-right" onclick="plusDivs(1)">&#10095;</button>
                    @endif


                    <script>
                        var slideIndex = 1;
                        showDivs(slideIndex);

                        function plusDivs(n) {
                            showDivs(slideIndex += n);
                        }

                        function showDivs(n) {
                            var i;
                            var x = document.getElementsByClassName("mySlides");
                            if (n > x.length) {
                                slideIndex = 1
                            }
                            if (n < 1) {
                                slideIndex = x.length
                            }
                            for (i = 0; i < x.length; i++) {
                                x[i].style.display = "none";
                            }
                            x[slideIndex - 1].style.display = "block";
                        }

                    </script>
                </div>

            </div>
            <!--Grid column-->

            <!--Grid column-->
            <div class="col-md-6 mb-4">
                @php
                //calculate DOB
                $tz = new DateTimeZone('Europe/Brussels');
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

                <!--Content-->
                <div class="p-4">
                    <ul class="list-group">
                        <li class="list-group-item"><b>Animal profile title:</b> {!!$animal->nameTitle!!}</li>
                        <li class="list-group-item"><b>Age: </b> {{$age}} (dob: {{ $animal->dob}})</li>
                        <li class="list-group-item"><b>Gender: </b> {{$gender}}</li>
                        <li class="list-group-item"><b>Description:</b>
                            <p>{!!$animal->description!!}</p>
                        </li>
                        <li class="list-group-item"><small>Profile created at: {{$animal->created_at}}, <br> Profile
                                last updated at: {{$animal->updated_at}} <br> ID: {!!$animal->id!!} <br> available for
                                adoption: {!!$animal->available!!}</small></li>

                    </ul>


                    <!--Request button: only for normal users-->
                    @can('isNormal')
                    <hr>
                    <form class="d-flex justify-content-left">

                        @php
                        //Logic to check the 'status' comulmn of the pivot table which is used to determine what buttons
                        and data to display on the page for the user.
                        $user_id = auth()->user()->id;

                        $user = App\User::find($user_id);
                        $user_animals = $user->animals;

                        $status = ''; //will hold the 'status' column value of the pivot table
                        if (count($user_animals)>0){
                        foreach ($user_animals as $user_animal){
                        if($animal->id == $user_animal->id){
                        $status= $user_animal->pivot->status;
                        }
                        }
                        }


                        @endphp
                        @if(($status == 'Waiting' || $status == 'Accepted' || $status == 'Rejected'))
                        @if($status == 'Waiting')

                        <p>You have sent a request to adopt this animal. Your request is being reviewed. Keep an eye on
                            your <a href="/home">'Manage Requests Page'</a> to see whether your request has been
                            accepted or rejected. </p>

                        @endif
                        @if($status == 'Accepted')
                        <p>Your request of adoption for this animal has been accepted!</p>
                        @endif
                        @if($status == 'Rejected')
                        <p>Your request of adoption for this animal has been Rejected.</p>
                        @endif
                        @else
                        <!--Attach this animal profile to this user in pivot table-->
                        <a class="btn btn-info" role="button"
                            href="/animal_user_change_status/{{$animal->id}}/attach">Request Adoption</a>
                        @endif


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
