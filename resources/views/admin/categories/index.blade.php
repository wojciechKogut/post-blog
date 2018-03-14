@extends('layouts.admin')



@section('content')

<h1>Categories</h1>


<table class='table table-condensed'>
    <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Created</th>
            <th>Updated</th>
        </tr>
    </thead>
    <tbody>

        @if(count($categories) > 0)

            @foreach($categories as $category)
                <tr>
                    <td>{{$category->id}}</td>
                    <td><a href="{{route('categories.edit',$category->id)}}">{{$category->name ? $category->name : "Uncategorized"}}</a></td>
                    <td>{{$category->created_at ? $category->created_at->diffForHumans() : 'No date'}}</td>
                    <td>{{$category->updated_at ? $category->updated_at->diffForHumans() : 'No date'}}</td>
                </tr>
            @endforeach

        @endif
    </tbody>
</table>


@stop