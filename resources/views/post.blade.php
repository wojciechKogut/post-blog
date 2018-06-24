@extends('layouts.blog-post')
@section('content')
 <!-- Blog Post -->
        <!-- Title -->
<h1>{{$post->title}}</h1>
        <!-- Author -->
        <p class="lead">by <a href="#">{{$post->user->name}}</a></p>
        <hr>
        <!-- Date/Time -->
    <p><span class="glyphicon glyphicon-time"></span> Posted {{$post->created_at->diffForHumans()}} | Category: {{$post->category->name}}</p>
        <hr>
        <!-- Preview Image -->
        <img class="img-responsive" src="{{config('app.url').$post->photo->file}}" alt="">
        <hr>
        <!-- Post Content -->
        <p class="lead mb-5">{!! $post->body !!}</p>
        <!-- Blog Comments -->
        @if(Auth::check())
        <!-- Comments Form -->
        <div class="well mt-5" style="margin-top: 70px;">
            <h4>Leave a Comment:</h4>
            {!! Form::open(['method'=>'POST','action'=>'PostCommentsController@store']) !!}
                <input type="hidden" name="post_id" value="{{$post->id}}">
                <div class='form-group'>
                    {!! Form::label('body','Text:') !!}
                    {!! Form::textarea('body',null,['class'=>'form-control','rows'=>3]) !!}  
                </div>
                <div class="form-group">
                    {!! Form::submit('Comment',['class'=>'btn btn-primary']) !!}
                </div>
                {{ csrf_field() }}
            {!! Form::close() !!}
        </div>
        @endif
        <hr>
        <!-- Posted Comments -->
        <!-- Comment -->
        @if(count($comments) > 0)
        @foreach($comments as $comment)
            <div class="media">
                {{-- <a class="pull-left" href="#"><img style="height:6.4rem; width:6.4rem" class="media-object img-responsive img-circle" src="{{$comment->photo}}" alt=""></a> --}}
                <div class="media-body">
                    <h4 class="media-heading">{{$comment->author}}<small>{{$comment->created_at->diffForHumans()}}</small></h4>
                    {{$comment->body}}
                    {{-- @if(count($comment->replies) > 0) --}}
                        @foreach($comment->replies as $reply)
                            @if($reply->is_active == 1)
                                <div class="media"  style="margin-bottom:1rem; padding-left:25px;">
                                    {{-- <a class="pull-left" href="#"> <img class="media-object img-circle" style="height:6.4rem; width:7rem" src="{{Auth::user()->photo->file}}" alt=""></a> --}}
                                    <div class="media-body">
                                        <h4 class="media-heading">{{$reply->author}}<small>{{$reply->created_at->diffForHumans()}}</small></h4>
                                        {{$reply->body}}
                                    </div>
                                </div>
                            @endif
                        @endforeach   
                        <div class="comment-reply-conteiner">
                            <button style="margin-bottom:1rem" class="toggle-reply btn btn-primary pull-right">Reply</button>
                                <div class="comment-reply" style="display:none">
                                    {!! Form::open(['method'=>'POST','action'=>'CommentRepliesController@createReply']) !!}
                                        <div class='form-group'>
                                            <input type="hidden" name="comment_id" value="{{$comment->id}}">
                                            {!! Form::label('body','Body:') !!}
                                            {!! Form::text('body',null,['class'=>'form-control','rows'=>1]) !!} 
                                        </div>
                                        <div class='form-group'>
                                            {!! Form::submit('submit',['class'=>'btn btn-primary']) !!}
                                            {{ csrf_field() }}
                                        </div>
                                    {!! Form::close() !!}   
                                </div>
                        </div>   
                    {{-- @endif --}}
            </div>
        </div>
        @endforeach
        @endif
        <!-- Comment -->
@stop
@section('scripts')
<script>
    $('.comment-reply-conteiner .toggle-reply').click('on', function() {
        $(this).next().toggle();
    });
</script>
@stop