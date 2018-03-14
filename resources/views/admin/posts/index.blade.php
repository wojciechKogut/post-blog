@extends('layouts.admin')



@section('content')

<h1>Posts</h1>


<table class='table table-condensed'>
    <thead>
        <tr>
            <th>Id</th>
            <th>Photo</th>
            <th>User</th>
            <th>Category</th>
            <th>Title</th>
            <th>Body</th>
            <th>Create</th>
            <th>Update</th>
        </tr>
    </thead>
    <tbody>
        @if(count($posts) > 0)
            @foreach($posts as $post)
                <tr>
                    <td>{{$post->id}}</td>
                    <td><img height="50" src="{{$post->photo->file}}" alt=""></td>
                    <td>{{$post->user->name}}</td>
                    <td>{{$post->category->name}}</td>  
                    <td><a href="{{route('posts.edit',$post->id)}}">{{$post->title}}</a></td>
                    <td>{{$post->body}}</td>
                    <td>{{$post->created_at->diffForHumans()}}</td>
                    <td>{{$post->updated_at->diffForHumans()}}</td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>


@stop