@extends('layouts.admin')


@section('content')

<h1>Create User</h1>

    {!! Form::open(['method'=>'POST','action'=>'AdminUsersController@store','files'=>true]) !!}
        <div class='form-group'>
            {!! Form::label('name','Name:') !!}
            {!! Form::text('name',null,['class'=>'form-control mb-4']) !!}  
        </div>
        <div class='form-group'>
            {!! Form::label('email','Email:') !!}
            {!! Form::text('email',null,['class'=>'form-control']) !!}
        </div>
        <div class='form-group'>
            {!! Form::label('role_id','Role:') !!}
            {!! Form::select('role_id',array(''=>'Choose option') + $roles,null,['class'=>'form-control']) !!}
        </div>
        <div class='form-group'>
            {!! Form::label('is_active','Status:') !!}
            {!! Form::select('is_active',array(0=>'No Active', 1=>'Active'),0,['class'=>'form-control']) !!}
        </div>
        <div class='form-group'>
            {!! Form::label('password','Password:') !!}
            {!! Form::password('password',['class'=>'form-control']) !!}
        </div>
        <div class='form-group'>
            {!! Form::label('photo_id','Photo:') !!}
            {!! Form::file('photo_id',['class'=>'']) !!}
        </div>
        <div class='form-group'>
            {!! Form::submit('Create User',['class'=>'btn btn-primary']) !!}
        </div>

        {{ csrf_field() }}

    {!! Form::close() !!}


    @if(count($errors) > 0)

        <div class="alert alert-danger">

            @foreach($errors->all() as $error)

            <li>{{$error}}</li>

            @endforeach

        </div>

    @endif


@stop