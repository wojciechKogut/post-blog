@extends('layouts.admin')


@section('content')

<h1>Edit User</h1>

<div class="col-sm-3">

    <img style="height:300px" src="{{$user->photo ? $user->photo->file : '/images/user-placeholder.jpg'}}" alt="" class="img-responsive img-rounded">


</div>


<div class="col-sm-9">

    {!! Form::model($user,['method'=>'PATCH','action'=>['AdminUsersController@update',$user->id],'files'=>true]) !!}
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
            {!! Form::select('role_id',$roles,null,['class'=>'form-control']) !!}
        </div>
        <div class='form-group'>
            {!! Form::label('is_active','Status:') !!}
            {!! Form::select('is_active',array(0=>'No Active', 1=>'Active'),null,['class'=>'form-control']) !!}
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
            {!! Form::submit('Edit User',['class'=>'btn btn-primary']) !!}
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

</div>

@stop