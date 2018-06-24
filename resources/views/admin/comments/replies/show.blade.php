@extends('layouts.admin')



@section('content')



@if(count($replies) > 0)

<h1>Reply comments</h1>

<table class='table table-condensed'>
    <thead>
        <tr>
            <th>Id</th>
            <th>Author</th>
            <th>Email</th>
            <th>Body</th>
            <th>View more</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        
@foreach($replies as $reply)
        <tr>
            <td>{{$reply->id}}</td>
            <td>{{$reply->author}}</td>
            <td>{{$reply->email}}</td>
            <td>{{$reply->body}}</td>
            <td><a href="{{route('home.post',$reply->comment->post->slug)}}">View more</a></td>

            <td>

                {!! Form::open(['method'=>'PATCH','action'=>['CommentRepliesController@update',$reply->id]]) !!}
                @if($reply->is_active == 1)
                    <input type="hidden" name="is_active" value="0">
                    <div class='form-group'>                       
                        {!! Form::submit('Unapproved',['class'=>'btn btn-info']) !!}
                        {{ csrf_field() }}
                    </div>
                @else
                    <input type="hidden" name="is_active" value="1">
                    <div class='form-group'>                       
                            {!! Form::submit('Approved',['class'=>'btn btn-success']) !!}
                            {{ csrf_field() }}
                    </div>
                @endif
                {!! Form::close() !!}
            </td>

            <td>
                {!! Form::open(['method'=>'DELETE','action'=>['CommentRepliesController@destroy',$reply->id]]) !!}
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

@else

<h1>No reply comments</h1>

@endif


@stop