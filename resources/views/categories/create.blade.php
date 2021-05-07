@extends('layouts.layout')

@section('content')


                <h1 class="fw-light">CREATE</h1><br>
                <form method="post" action="/category/create">
                    @csrf
                    Name <input name="name"><br><br>
                    <input class="btn btn-primary my-2" type="submit" value="Create">
                </form>



@endsection









