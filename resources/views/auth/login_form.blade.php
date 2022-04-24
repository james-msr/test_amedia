@extends('layout.auth')
@section('title')Login form @endsection
@section('content')
<div class="container login-container">
    <div class="col-md-6 login-form-1">
        <h3>Login Form</h3>
        <form action="{{ route('login') }}" method="post">
            @csrf()
            <div class="form-group">
                <input type="text" class="form-control" name="email" placeholder="Your Email *" value="" />
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Your Password *" value="" />
            </div>
            <div class="form-group">
                <input type="submit" class="btnSubmit" value="Login" />
            </div>
        </form>
    </div>
</div>
@endsection
