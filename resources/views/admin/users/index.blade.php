@extends('layouts.admin')

@section('content')

<h1>Users</h1>

<table class='table table-condensed'>
    <thead>
        <tr>
            <th>Id</th>
            <th>Photo</th>
            <th>Username</th>
            <th>Email</th>
            <th>Role</th>
            <th>Status</th>
            <th>Created</th>
            <th>Updated</th>
        </tr>
    </thead>
    <tbody>
        
        @if(count($users) > 0)

            @foreach($users as $user)

                <tr>
                    <td>{{$user->id}}</td>
                    <td><img style="height:50px" src="{{$user->photo ? $user->photo->file : '/images/user-placeholder.jpg'}}" alt=""></td>
                    <td><a href="{{route('users.edit',$user->id)}}">{{$user->name}}</a></td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->role->name}}</td>
                    <td>{{$user->is_active == 1 ? "Active" : "No active"}}</td>
                    <td>{{$user->created_at->diffForHumans()}}</td>
                    <td>{{$user->updated_at->diffForHumans()}}</td>
                </tr>

            @endforeach    

        @endif

    </tbody>
</table>



@stop
