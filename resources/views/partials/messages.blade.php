@if(count($errors) > 0)
    @foreach($errors->all() as $error)
        <div class="alert alert-danger">
            {{$error}}
        </div>
    @endforeach
@endif

@if(session('success'))
    <div class="alert alert-success">
        {{session('success')}}
    </div>
@endif



@if(session('error'))
    <div class="alert alert-success">
        {{session('error')}}
    </div>
@endif

<!-- have 3 things that we are checking: 
    check errors array that is created when we do form validation (in e.g. @postcontrollerstore), if there is an error it is outputted to the user
    check for session values, so session success and session error, and these are going to be flash messages that we create at any point
-->

