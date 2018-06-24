@extends('layouts.blog-home')
@section('content')
@if(empty($term))
    <h1>{{$msg}}</h1>
@else
    <h3>{{$msg}}</h3>
    <hr>
    @foreach($posts as $post)
    <div style="margin-bottom: 50px;">
        <span>{{$post->title}}</span>
        <span class=""> by {{$post->user->name}}</span>
        <span><span class="glyphicon glyphicon-time"> </span> {{$post->created_at->diffForHumans()}}</span>
        <span> | Category: {{$post->category->name}}</span>
        {{-- <img class="img-responsive" src="{{config('app.url').$post->photo->file}}" alt=""> --}}
        <p style="margin-top:10px;">{!! str_limit(strip_tags($post->body),200,' ...') !!}</p>
        <a style="float:right;" class="btn btn-primary" href="{{url('post/')."/".$post->slug}}">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
    </div>
    @endforeach
    <?php echo $posts->render(); ?>
@endif
@endsection
