@extends('layouts.admin')


@section('content')

<h1>Edit User</h1>

<div class="col-sm-3" style="height:300px">

    <img src="{{$post->photo->file}}" alt="" class="img-responsive img-rounded">


</div>


<div class="col-sm-9">

    {!! Form::model($post,['method'=>'PATCH','action'=>['AdminPostsController@update',$post->id],'files'=>true]) !!}
    <div class='form-group'>
            {!! Form::label('Title','Title:') !!}
            {!! Form::text('title',null,['class'=>'form-control']) !!} 
        </div>
        <div class='form-group'>
            {!! Form::label('category_id','Category:') !!}
            {!! Form::select('category_id',$categories,null,['class'=>'form-control']) !!} 
        </div>
        <div class='form-group'>
            {!! Form::label('photo_id','Photo:') !!}
            {!! Form::file('photo_id') !!} 
        </div>
        <div class='form-group'>
            {!! Form::label('body','Destription:') !!}
            {!! Form::textarea('body',null,['class'=>'form-control']) !!} 
        </div>
        <div class='form-group pull-left'>
            {!! Form::submit('Update Post',['class'=>'btn btn-primary']) !!}
        </div>
        {{ csrf_field() }}

    {!! Form::close() !!}

<div class="pull-right">
    {!! Form::open(['method'=>'DELETE','action'=>['AdminPostsController@destroy',$post->id]]) !!}

        {!! Form::submit('Delete post',['class'=>'btn btn-danger']) !!}

    {!! Form::close() !!}

</div>


@include('includes.form_error')

@stop


