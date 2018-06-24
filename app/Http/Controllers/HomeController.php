<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::paginate(5);
        $categories = Category::all();
        return view('home', compact('posts','categories'));
    }
    
    public function postCategory($id) 
    {
        $posts = Post::where('category_id',$id)->paginate(5);
        $msg = $posts->count() < 1 ? "No posts available" : "";
        $categories = Category::all();
        return view('post_category', compact('posts','categories','msg'));
    }

    public function search(Request $request)
    {
        $data = $request->all();
        $term = $data['search'];
        $categories = Category::all();
        if(!empty($term)) {
            $posts = Post::where('title','like','%'.$term.'%')->paginate(5);
            if($posts->count() < 1) $msg = "No results for " . $term;
            else $msg = $posts->count() . " results found for term " . $term;
            return view('search', compact('posts', 'msg','term','categories'));
        } else {
            $msg = "No results";
            return view('search', compact('msg','term','categories'));
        } 
    }
}
