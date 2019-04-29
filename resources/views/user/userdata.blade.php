@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">History of all adopton requests made by a user and whether they were approved or denied.
                        </div>
               
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <h4><b>User data: </b> </h4>
                    @can('isAdmin')
                            @if(count($users)>0)
                                 @foreach($users as $user)
                                    @php 
                                        $user_animals = $user->animals;
                                    @endphp
                                    <table  class="table table-hover table-dark">
                                            <div style="color:blue" class="card" style="width: 18rem;">
                                                    <ul class="list-group list-group-flush">
                                                      <li class="list-group-item"><b> User ID: </b> {{$user->id}} <br> <b> email:</b> {{$user->email}}</a></li>
                                                    </ul>
                                                  </div>
                               
                                            <thead>
                                                    <tr>
                                                        <th>Animal ID</th>
                                                        <th>Picture</th>
                                                        <th>Request Status</th>
                                                        
                                                    </tr>
                                            </thead>
                                    @if((count($user_animals)>0))
                                        @foreach($user_animals as $user_animal)

                                        @php
                                            $status = $user_animal->pivot->status;

                                            //dd($status);
                                        @endphp

                                        <tbody>
                                            <tr>
                                                    <td><a style="color:yellow" href="/Animal/{{$user_animal->id}}">{{$user_animal->id}}</a></td>
                                                    <td><img style="width:20%" src="/storage/cover_images/{{$user_animal->cover_image}}"></td>
                                                    <td>
                                                            @if($status == 'Waiting')
                                                            <p>Waiting for response</p>
                                                            @endif
                                                            @if($status == 'Accepted')
                                                            <p>Accepted</p>
                                                            @endif
                                                            @if($status == 'Rejected')
                                                            <p>Rejected</p>
                                                            @endif
                
                                                    </td>
                                            </tr>
                                        </tbody>
                                       

                                        @endforeach
                                        @else
                                        <td><p>No animals owned</p></td>
                                        <td><p>-</p></td>
                                        <td><p>-</p></td>
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
