@extends('layouts.layout')

@section('content')


                <h1 class="fw-light">CREATE</h1><br>
                <form method="post" action="/product/create">
                    @csrf
                    Name <input name="name"><br><br>
                    Price <input  name="price"><br><br>
                    Description <textarea name="description" cols="40" rows="3" ></textarea><br><br>
                    Stock <input name="in_stock"><br><br>
                    Categories
                    @foreach($categories as $category)
                        <input class="form-check-input" type="radio" name="category_id"  value="{{$category->id}}">
                        <label class="form-check-label" for="gridRadios1">
                            {{$category->name}}
                        </label>
                            @endforeach <br><br>
                    <p><input type="checkbox" value="1" name="is_active"/> Active</p>
                    <input class="btn btn-primary my-2" type="submit" value="Create">
                </form>


@endsection









