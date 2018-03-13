@extends('layouts.admin')



@section('content')

<h1>Create Post</h1>


{!! Form::open(['method'=>'POST','action'=>'AdminPostsController@store','files'=>true]) !!}


{{ csrf_field() }}


    <div class='form-group'>
        {!! Form::label('Title','Title:') !!}
        {!! Form::text('title',null,['class'=>'form-control']) !!} 
    </div>
    <div class='form-group'>
        {!! Form::label('category_id','Category:') !!}
        {!! Form::select('category_id',array(''=>'choose'),null,['class'=>'form-control']) !!} 
    </div>
    <div class='form-group'>
        {!! Form::label('photo_id','Photo:') !!}
        {!! Form::file('photo_id') !!} 
    </div>
    <div class='form-group'>
        {!! Form::label('body','Destription:') !!}
        {!! Form::textarea('body',null,['class'=>'form-control']) !!} 
    </div>
    <div class='form-group'>
        {!! Form::submit('Create Post',['class'=>'btn btn-primary']) !!}
    </div>
        
    
{!! Form::close() !!}


@include('includes.form_error')

@stop