@extends('layouts.admin')



@section('content')

<h1>Posts</h1>

<form method="post" action="{{action('AdminPostsController@deleteMedia')}}">
    {{ csrf_field() }}
    <div class="form-group col-md-3">
        <select style="margin-right:1rem; border:1px solid black" class="col-md-6 btn" name="" id="">
            <option value="delete">Delete</option>
        </select>
        <button class="col-md-4 btn btn-primary" type="submit" name="">Submit</button>
    </div>

<table class='table table-condensed'>
    <thead>
        <tr>
            <th><input type="checkbox" name="checkAll" id="checkAll"></th>
            <th>Id</th>
            <th>Photo</th>
            <th>User</th>
            <th>Category</th>
            <th>Title</th>
            <th></th>
            <th></th>
            <th>Create</th>
            <th>Update</th>
        </tr>
    </thead>
    <tbody>
        @if(count($posts) > 0)
            @foreach($posts as $post)
                <tr>
                    <td><input type="checkbox" name="checkboxes[]" class="checkboxes" value="{{$post->id}}"></td>
                    <td>{{$post->id}}</td>
                    <td><img height="50" src="{{$post->photo->file}}" alt=""></td>
                    <td>{{$post->user->name}}</td>
                    <td>{{$post->category->name}}</td>  
                    <td><a href="{{route('posts.edit',$post->id)}}">{{$post->title}}</a></td>
                    <td><a href="{{route('home.post',$post->slug)}}">View post</a></td>
                    <td><a href="{{route('comments.show',$post->id)}}">View comments to post</a></td>
                    <td>{{$post->created_at->diffForHumans()}}</td>
                    <td>{{$post->updated_at->diffForHumans()}}</td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>

</form>

<div class="row">
    <div class="col-md-6 col-md-offset-3">
        {{$posts->render()}}
    </div>
</div>


@stop



@section('scripts')


<script>
   $(document).ready(function() {

   $('#checkAll').on('click', function() {
       if(this.checked) {
           $('.checkboxes').each(function(i) {
               this.checked = true;
           });
       } else {
        $('.checkboxes').each(function(i) {
               this.checked = false;
           });
       }
   });


   });
</script>



@stop