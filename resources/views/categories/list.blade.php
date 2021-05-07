@extends('layouts.layout')

@section('content')
    <a href="/category/create" class="btn btn-primary my-0" role="button">CREATE</a>

    <table border="2">
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Delete</th>
        </tr>
        @foreach($categories as $category)

            <tr>
                <td>{{$category->id}}</td>
                <td><a href="/category/edit/{{$category->id}}"> {{$category->name}}</a></td>
                <td><a href="/categoryphp/delete/{{$category->id}}" class="btn btn-primary my-0" role="button">Delete</a></td>
            </tr>

        @endforeach
    </table>
@endsection
