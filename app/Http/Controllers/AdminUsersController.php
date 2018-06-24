<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\Photo;
use App\Http\Requests\UsersRequest;
use App\Http\Requests\UsersEditRequest;
use Illuminate\Support\Facades\Session;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name','id')->all();
        return view('admin.users.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersRequest $request)
    {
        $data = $request->all();        
        if($file = $request->file('photo_id'))
        {   
            $photo = Photo::create(['file' => time() . $file->getClientOriginalName()]);
            $file->move('images', time() . $file->getClientOriginalName());  
            $data['photo_id'] = $photo->id;
        }
        $data['password'] = bcrypt(trim($request->password));
        User::create($data);
        Session::flash('created_user','User was created');
        return redirect('admin/users');
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
        $user = User::findOrFail($id);
        $roles = Role::pluck('name','id')->all();
        return view('admin.users.edit', compact(['user','roles']));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UsersEditRequest $request, $id)
    {
        if(empty($request->password))$data = $request->except('password');
        else
        {
            $data = $request->all();
            $data['password'] = bcrypt(trim($request->password));
        }
        $user = User::findOrFail($id);
        if($file = $request->file('photo_id'))
        {   
            $photo = Photo::create(['file' => time() . $file->getClientOriginalName()]);
            $file->move('images', time() . $file->getClientOriginalName());  
            $data['photo_id'] = $photo->id;
        }
        $user->update($data);
        Session::flash('updated_user','User was updated');
        return redirect('admin/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         Session::flash('deleted_user','User was successfuly deleted');
         $user = User::findOrFail($id);
         unlink(public_path() . $user->photo->file);
         $user->delete();
         return redirect('admin/users');
    }
}
