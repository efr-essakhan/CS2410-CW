@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">List of all animals in the system and showing the history of users that requested them and their request statuses/responses.
                        </div>
               
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h4><b>Animal data: </b> </h4>
                    @can('isAdmin')
                            @if(count($animals)>0)
                                 @foreach($animals as $animal)
                                    @php 
                                        $animal_users = $animal->users;
                                    @endphp
                                   

                                    <table class="table table-dark table-hover">
                                            <div class="card" style="width: 18rem;">
                                                    <ul class="list-group list-group-flush">
                                                      <li class="list-group-item"><a href="/Animal/{{$animal->id}}"><b><img style="width:20%" src="/storage/cover_images/{{$animal->cover_image}}"> Animal ID: {{$animal->id}}</b> </a></li>
                                                      
                                                    </ul>
                                                  </div>
                                            <thead>
                                                    <tr>
                                                        <th>Users ID</th>
                                                        <th>Users Email</th>
                                                        <th>Request Status</th>
                                                        
                                                    </tr>
                                            </thead>
                                    @if(count($animal_users)>0)
                                        @foreach($animal_users as $animal_user)

                                        @php    
                                            $status = $animal_user->pivot->status;

                                        @endphp

                                        <tbody>
                                            <tr>
                                                    <td>{{$animal_user->id}}</td>
                                                    <td>{{$animal_user->email}}</td>
                                                    <td>
                                                            @if($status == 'Waiting')
                                                            <p>Waiting for response</p>
                                                            @endif
                                                            @if($status == 'Accepted')
                                                            <p><b>Owns this Animal</b></p>
                                                            @endif
                                                            @if($status == 'Rejected')
                                                            <p>Rejected</p>
                                                            @endif
                
                                                    </td>
                                                    
                                            </tr>
                                        </tbody>

                                        @endforeach
                                        @else
                                        <td>{{$animal_user->id}}</td>
                                         <td>{{$animal_user->email}}</td>
                                        <td><p>No animals owned</p></td>
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
