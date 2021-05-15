@extends('layouts.layout')

@section('content')
    <a href="/product/create" class="btn btn-primary my-0" role="button">CREATE</a>

    <table border="2">
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Price</th>
            <th>Active</th>
            <th>Stock</th>
            <th>Category</th>
            <th>Delete</th>
        </tr>
        @foreach($products as $product)

            <tr>
                <td>{{$product->id}}</td>
                <td><a href="/product/edit/{{$product->id}}"> {{$product->name}}</a></td>
                <td>{{$product->price}} $</td>
                <td><input type='checkbox' @if($product->is_active == 1) checked @endif ></td>
                <td>{{$product->in_stock}} </td>
                <td>{{$product->category->name}} </td>
                <td><a href="/product/delete/{{$product->id}}" class="btn btn-primary my-0" role="button">Delete</a></td>
            </tr>

        @endforeach
    </table>
@endsection
