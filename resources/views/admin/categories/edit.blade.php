@extends('layouts.admin')


@section('content')

<h1>Create Category</h1>

{!! Form::model($category,['method'=>'PATCH','action'=>['AdminCategoriesController@update',$category->id]]) !!}


{{ csrf_field() }}


    <div class='form-group'>
        {!! Form::label('name','Add:') !!}
        {!! Form::text('name',null,['class'=>'form-control']) !!} 
        
    </div>
    <div class='form-group pull-left'>
        {!! Form::submit('Update Category',['class'=>'btn btn-primary']) !!}
    </div>
        
    
{!! Form::close() !!}


<div class="pull-right">
    {!! Form::open(['method'=>'DELETE','action'=>['AdminCategoriesController@destroy',$category->id]]) !!}

        {!! Form::submit('Delete post',['class'=>'btn btn-danger']) !!}

    {!! Form::close() !!}
    
</div>
    
@include('includes.form_error')


@stop