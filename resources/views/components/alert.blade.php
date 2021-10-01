@if($errors->any())
    <div class="alert alert-danger" role="alert">
        {{$errors->messages()['message'][0]}}
    </div>
@elseif(Session::has('success'))
    <div class="alert alert-success" role="alert">
        {{Session::get('message')}}
    </div>
@elseif(request()->get('success'))
    <div class="alert alert-success" role="alert">
        {{request()->get('message')}}
    </div>
@endif
