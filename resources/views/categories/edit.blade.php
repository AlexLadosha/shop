
@extends('layouts.layout')

@section('content')


    <h1 class="fw-light">EDIT</h1><br>
    <form method="post" action="/category/edit/">
        @csrf
        <input type="hidden" name="id" value="{{$categories->id}}">
        Name <input name="name" value="{{$categories->name}}"><br><br>
        <input class="btn btn-primary my-2" type="submit" value="Save">
    </form>



@endsection
