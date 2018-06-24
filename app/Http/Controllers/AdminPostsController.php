<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PostsCreateRequest;
use App\Post;
use App\Photo;
use App\Role;
use App\Category;

class AdminPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::paginate(5);
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //wybieram sposrod kategorii tylko nazwe i id
        $categories = Category::pluck('name','id')->all();
        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostsCreateRequest $request)
    {

        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        if($file = $request->file('photo_id'))
        {
            $photo = Photo::create(['file' => time() . $file->getClientOriginalName()]);
            $file->move('images',time() . $file->getClientOriginalName());
            $data['photo_id'] = $photo->id;
        }
        else
        {
            $photo = Photo::create(['file' => 'img_placeholder.png']);
            $data['photo_id'] = $photo->id;
        }
        $post = Post::create($data);
        return redirect('admin/posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::pluck('name','id')->all();
        $post = Post::findOrFail($id);
        return view('admin.posts.edit',compact('categories','post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostsCreateRequest $request, $id)
    {
        $data = $request->all();

        if($file = $request->file('photo_id'))
        {
            $photo = Photo::create(['file'=> time() . $file->getClientOriginalName()]);
            $file->move('images',time() . $file->getClientOriginalName());
            $data['photo_id'] = $photo->id;
        }
        // $post = Post::findOrFail($id);
        // $post->update($data);
        //drugi sposob
        $post = Auth::user()->post()->where('id',$id)->first();
        $post->update($data);
        return redirect('admin/posts');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        unlink(public_path() . $post->photo->file);
        $post->delete();
        return redirect('admin/posts');
    }



    public function post($slug)
    {
        $post = Post::findBySlugOrFail($slug);
        $comments = $post->comments()->whereIsActive(1)->get();
        $categories = Category::all();
        return view('post',compact('post','comments','categories'));
    }



    public function deleteMedia(Request $request)
    {   
        $data = $request->all();
        foreach($data['checkboxes'] as $item)
        {
            $post = Post::findOrFail($item);
            unlink(public_path() . $post->photo->file);
            $post->delete();
        }
        return redirect('admin/posts');
    }
}
