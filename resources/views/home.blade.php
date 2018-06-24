@extends('layouts.blog-home')

@section('content')
    @foreach($posts as $post)
    <div style="margin-bottom: 50px;">
        <h2>
        <a href="#" style="">{{$post->title}}</a>
        </h2>
        <p class="lead"> by <a href="index.php">{{$post->user->name}}</a></p>
        <span><span class="glyphicon glyphicon-time"> </span> {{$post->created_at->diffForHumans()}}</span>
        <span> | Category: {{$post->category->name}}</span>
        <hr>
        <img class="img-responsive" src="{{config('app.url').$post->photo->file}}" alt="">
            <hr>
        <span>{!! str_limit(strip_tags($post->body),200,' ...') !!}</span>
        <a style="float:right; margin-top:10px;" class="btn btn-primary" href="post/{{$post->slug}}">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
    </div>
    @endforeach
    <?php echo $posts->render(); ?>
@endsection
