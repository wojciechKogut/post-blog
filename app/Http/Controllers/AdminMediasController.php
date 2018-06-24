<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Photo;
use App\Post;

class AdminMediasController extends Controller
{
    public function index()
    {
        $photos = Photo::all();
        return view('admin.media.index',compact('photos'));
    }

    public function create()
    {
        return view('admin.media.create');
    }

    public function store(Request $request)
    {
        $photo = $request->file('file');
        Photo::create(['file'=> time() . $photo->getClientOriginalName()]);
        $photo->move('images', time() . $photo->getClientOriginalName());
        return redirect('admin/media');
    }

    public function destroy($id)
    {
        $photo = Photo::findOrFail($id);
        $posts = Post::where('photo_id',$photo->id)->get();
        //przypisz placeholder dla posta z ktorego usunieto zdjecie
        foreach($posts as $post) {
            $post->photo_id = 21;
            $post->save();
        }
        $photoName = explode('/',$photo->file);
        //jezeli jest placeholder to nie usuwaj tego z folderu
        if(!($photoName[count($photoName)-1] == 'img_placeholder.png')) unlink(public_path(). $photo->file);  
        $photo->delete();
        return redirect('admin/media');
    }
}
