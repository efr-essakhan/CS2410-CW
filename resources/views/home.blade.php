@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Welcome!  <a class="float-right" href="/Animal">Click here to view profiles of Animals up for adoption!</a></div>
               
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                   
                    
                    @can('isNormal')
            
                    <h4><b>Your adoption requests: </b> </h4>
                    @if(count($animals)>0)
                    <table class="table table-dark table-hover">
                        <thead>
                            <tr>
                                <th>Profile Title</th>
                                <th>Animal ID</th> 
                                <th>Request submitted at time:</th>
                                <th>Status </th>
                                <th>Actions </th>
                            </tr>
                        </thead>
                        
                        @foreach($animals as $animal)
                        @php
                            $status = $animal->pivot->status;
                        @endphp
                        <tbody>
                            <tr>
                                    <td>{{$animal->nameTitle}}</td>
                                    <td>{{$animal->id}} </td>
                                    <td>{{$animal->pivot->created_at}}</td>
                                    <td>{{$status}}</td>
                                    <td>
                                            @if($status == 'Waiting')
                    
                                                <a class="btn btn-danger" role="button" href="/animal_user_change_status/{{$animal->id}}/detach">Cancell request</a>
                        
                                            @endif
                                            @if($status == 'Accepted')
                                            <p>Your request of adoption for this animal has been accepted! <br> no actions</p>
                                            @endif
                                            @if($status == 'Rejected')
                                            <p>Your request of adoption for this animal has been Rejected. <br> no actions</p>
                                            @endif

                                    </td>
                            </tr>
                        </tbody>
                            @endforeach
                        @else
                            <p> You have not requested to adopt any animals yet.</p>
                        @endif
                    </table>
                    @endcan
                    @can('isAdmin')
                        <h4><b>Manage adoption requests from users: </b> </h4>
                        <table class="table table-dark table-hover">
                                <thead>
                                        <tr>
                                            <th>User ID</th>
                                            <th>Email</th> 
                                            <th>Request submitted at time:</th>
                                            <th>Animal ID</th>
                                            <th>Actions </th>
                                        </tr>
                                </thead>
                            @php
                                //$status = $animal->pivot->status;
                                $users = App\User::all();
                                // if (count($users)>0){
                                //     foreach ($users as $user){
                                //         $user_animals = $user->animals;
                                        // if (count($user_animals)>0){ 
                                        //     foreach ($user_animals as $user_animal){ //
                                        //         if($animal->id == $user_animal->id){
                                        //             $status= $user_animal->pivot->status;
                                        //         }
                                        //     }
                                        // }
                                        // if (count($user_animals)>0){
                                        //     foreach ($user_animals as $user_animal){
                                        //         dd($user_animal->pivot->status);
                                        //     }
                                            
                                        // }
                                    
                                
                            @endphp
                            @if(count($users)>0)
                                 @foreach($users as $user)
                                    @php 
                                        $user_animals = $user->animals;
                                    @endphp
                                    @if((count($user_animals)>0))
                                        @foreach($user_animals as $user_animal)

                                        @php
                                            $status = $user_animal->pivot->status;

                                            //dd($status);
                                        @endphp

                                        <tbody>
                                            <tr>
                                                    <td>{{$user_animal->nameTitle}}</td>
                                                    <td>{{$user_animal->id}}</td>
                                                    <td>{{$user_animal->pivot->created_at}}</td>
                                                    <td>{{$status}}</td>
                                                    <td>
                                                            @if($status == 'Waiting')
                                    
                                                                <a class="btn btn-danger" role="button" href="/animal_user_change_status/{{$user_animal->id}}/detach">Reject</a>
                                                                <a class="btn btn-success" role="button" href="/animal_user_change_status/{{$user_animal->id}}/detach">Accept</a>
                                        
                                                            @endif
                                                            @if($status == 'Accepted')
                                                            <p>The user has been accepted. <br> no actions</p>
                                                            @endif
                                                            @if($status == 'Rejected')
                                                            <p>The user has been rejected. <br> no actions</p>
                                                            @endif
                
                                                    </td>
                                            </tr>
                                        </tbody>

                                        @endforeach
                                   
                                    @endif
                                @endforeach
                            @else
                                <p> You have not requested to adopt any animals yet.</p>
                            @endif
                        </table>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
