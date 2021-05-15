
@extends('layouts.layout')

@section('content')


    <h1 class="fw-light">EDIT</h1><br>
    <form method="post" action="/product/edit/">
        @csrf
        <input type="hidden" name="id" value="{{$product->id}}">
        Name <input name="name" value="{{$product->name}}"><br><br>
        Price <input name="price" value="{{$product->price}}"><br><br>
        Description <textarea name="description" cols="40" rows="3" >{{$product->description}}</textarea><br><br>
        Stock <input name="in_stock" value="{{$product->in_stock}}"><br><br>
        Categories
        <select name="category_id">
            @foreach($categories as $category)
                <option value="{{$category->id}}"
                @if($product->category_id == $category->id)
                    selected
                @endif
                >{{$category->name}}</option>
            @endforeach
        </select><br><br>
        <p> <input type='checkbox' value="1" name="is_active" @if($product->is_active == 1) checked @endif >Active</p>
        <input class="btn btn-primary my-2" type="submit" value="Save">
    </form>



@endsection
