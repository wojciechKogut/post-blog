@extends('layouts.admin')



@section('content')



@if(count($comments) > 0)

<h1>Post comments</h1>

<table class='table table-condensed'>
    <thead>
        <tr>
            <th>Id</th>
            <th>Author</th>
            <th>Email</th>
            <th>Body</th>
            <th>View more</th>
            <th>View reply</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        
@foreach($comments as $comment)
        <tr>
            <td>{{$comment->id}}</td>
            <td>{{$comment->author}}</td>
            <td>{{$comment->email}}</td>
            <td>{{$comment->body}}</td>
            <td><a href="{{route('home.post',$comment->post->slug)}}">View more</a></td>
            <td><a href="{{route('replies.show',$comment->id)}}">View reply</a></td>

            <td>

                {!! Form::open(['method'=>'PATCH','action'=>['PostCommentsController@update',$comment->id]]) !!}
                @if($comment->is_active == 1)

                
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
                {!! Form::open(['method'=>'DELETE','action'=>['PostCommentsController@destroy',$comment->id]]) !!}
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

<h1><i><b> No comments to posts</b></i></h1>

@endif


@stop