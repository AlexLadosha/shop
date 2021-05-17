@extends('layouts.layout')

@section('content')

    <form method="post" action="/order/save">
        <table border="2">
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Quantity</th>

            </tr>
            @foreach($products as $product)

                <tr>
                    <td>{{$product->id}}</td>
                    <td>{{$product->name}}</td>
                    <td>{{$product->price}} $</td>
                    <td>{{$product->in_stock}} </td>
                    <td><input name="quantity[{{$product->id}}]"></td>
                    <td></td>

                </tr>

            @endforeach

        </table>
        @csrf
        Ввести промокод <input name="promo_code">
        <input type="submit" class="btn btn-primary my-2" value="Save" />
    </form>

@endsection
