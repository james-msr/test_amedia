@extends('layout.main')
@section('title')Create Application @endsection
@section('content')
<div class="container">
    <form action="{{ route('application.store') }}" enctype="multipart/form-data" method="post">
        @csrf
        <div class="form-group">
            <input type="text" class="form-control" name="theme" placeholder="Theme of application *" value="" />
        </div>
        <div class="form-group">
            <textarea class="form-control" name="message" placeholder="Message *" value=""></textarea>
        </div>
        <div class="form-group">
            <label for="file">Attach file *</label>
            <input id="file" type="file" class="form-control" name="file" />
        </div>
        <input class="btn btn-primary" type="submit" value="submit">
    </form>
</div>
@endsection
