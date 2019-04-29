@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Welcome! <a class="float-right" href="/Animal">Click here to view profiles of
                        Animals up for adoption!</a></div>

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
                                <th>Animal Profile Title</th>
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

                                    <a class="btn btn-danger" role="button"
                                        href="/animal_user_change_status/{{$animal->id}}/{{$animal->pivot->user_id}}/detach">Cancell
                                        request</a>


                                    @endif
                                    @if($status == 'Accepted')
                                    <p>no actions: <br>Your request of adoption for this animal has been
                                        <b>accepted</b>!</p>
                                    @endif
                                    @if($status == 'Rejected')
                                    <p>no actions: <br>Your request of adoption for this animal has been
                                        <b>Rejected.</b></p>
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
                    <h4><b>Respond to adoption requests from users: </b> </h4>
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
                        $users = App\User::all();
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

                        @if($status == 'Waiting')

                        <tbody>
                            <tr>
                                <td>{{$user->id}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user_animal->pivot->created_at}}</td>
                                <td>{{$user_animal->id}}</td>
                                <td>
                                    @if($status == 'Waiting')

                                    <a class="btn btn-danger" role="button"
                                        href="/animal_user_change_status/{{$user_animal->id}}/{{$user->id}}/Reject">Reject</a>
                                    <a class="btn btn-success" role="button"
                                        href="/animal_user_change_status/{{$user_animal->id}}/{{$user->id}}/Accept">Accept</a>

                                    @endif

                                </td>
                            </tr>
                        </tbody>
                        @endif
                        @endforeach

                        @endif
                        @endforeach

                        @else
                        <p> You have not requested to adopt any animals yet.</p>
                        @endif

                    </table>
                    <p>If the above table is empty it means that there are no Requests to respond to.</p>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
