@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <a class="btn btn-info" role="button" href="/Animal/create">View Animal Profile.</a>
                    <h3>Your Animal Adoption requests status.</h3>
                    <table class="table table-striped table-dark">
                        <tr>
                            <th>Title</th>
                            <th>Request ID</th> 
                            <th>Request submitted at time:</th>
                            <th>Status </th>
                            <th>Actions </th>
                        </tr>
                        @if(count($animals)>0)
                            @foreach($animals as $animal)
                            <tr>
                                    <th>{{$animal->nameTitle}}</th>
                                    <th>{{$animal->id}} </th>
                                    <th>{{$animal->pivot->created_at}}</th>
                                    <th>{{$animal->pivot->status}}</th>
                                    <th><a class="btn btn-info" role="button" href="/Animal/{{$animal->id}}/edit">Edit</a></th>
                            </tr>
                            @endforeach
                        @else
                            <p> You have not requested to adopt any animals. </p>

                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
