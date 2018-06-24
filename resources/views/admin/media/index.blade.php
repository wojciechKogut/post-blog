@extends('layouts.admin')

@section('content')

<h1>Media</h1>

@if($photos)

<table class='table table-condensed'>
    <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Image</th>
            <th>Created</th>
            <th>Updated</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        
        @foreach($photos as $photo)
            <tr>
                <td>{{$photo->id}}</td>
                <td>{{$photo->file}}</td>
                <td><img height="50" src="{{config('app.url').$photo->file}}" alt=""></td>
                <td>{{$photo->created_at ? $photo->created_at : 'no date'}}</td>
                <td>{{$photo->updated_at ? $photo->updated_at : 'no date'}}</td>
                <td>

                    {!! Form::open(['method'=>'DELETE','action'=>['AdminMediasController@destroy',$photo->id]]) !!}
                        <div class='form-group'>
                            {!! Form::submit('Delete',['class'=>'btn btn-danger']) !!}
                            {{ csrf_field() }}
                        </div>
                    {!! Form::close() !!}


                </td>
            </tr>
        @endforeach

    </tbody>
</table>

@endif

@stop