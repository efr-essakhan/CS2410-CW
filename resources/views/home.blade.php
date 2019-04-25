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
                    <h4>Your adoption requests: </h4>
                    @if(count($animals)>0)
                    @foreach($animals as $animal)
                    <table class="table table-dark table-hover">
                        <thead>
                            <tr>
                                <th>Profile Title</th>
                                <th>Amimal ID</th> 
                                <th>Request submitted at time:</th>
                                <th>Status </th>
                                <th>Actions </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                    <td>{{$animal->nameTitle}}</td>
                                    <td>{{$animal->id}} </td>
                                    <td>{{$animal->pivot->created_at}}</td>
                                    <td>{{$animal->pivot->status}}</td>
                                    <td><a class="btn btn-danger" role="button" href="/animal_user_change_status/{animal_id}/detach">Cancell request</a></td>
                            </tr>
                        </tbody>
                            @endforeach
                        @else
                            <p> You have not requested to adopt any animals.</p>
                        @endif
                    </table>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
