<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\UsersRequest;
use App\Http\Requests\UsersEditRequest;
use Illuminate\Support\Facades\Session;

use App\User;
use App\Role;
use App\Photo;

class AdminUsersController extends Controller
{
    
    public function index()
    {
        $users = User::all();

        return view('admin.users.index', compact('users'));
    }

    
    public function create()
    {

        $roles = Role::lists('name', 'id')->all();

        return view ('admin.users.create', compact('roles'));
    }

    
    public function store(UsersRequest $request)
    {
        $input = $request->all();

        if ($file = $request->file('photo_id')) {
            
            $name = time() . $file->getClientOriginalName();
            $file->move('images', $name);

            $photo = Photo::create(['path' => $name]);
            $input['photo_id'] = $photo->id;

        }

        $input['password'] = bcrypt($input['password']);

        User::create($input);

        return redirect('/admin/users');
    }

    
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::pluck('name', 'id')->all();

        return view ('admin.users.edit', compact('user', 'roles'));
    }

    
    public function update(UsersEditRequest $request, $id)
    {
        if(trim($request->password == '')){
            $input = $request->except('password');
        } else {
            $input = $request->all();
            $input['password'] = bcrypt($input['password']);
        }

        $user = User::findOrFail($id);

        if ($file = $request->file('photo_id')){
            $name = time() . $file->getClientOriginalName();
            $file->move('images', $name);
            $photo = Photo::create(['path' => $name]);
            $input['photo_id'] = $photo->id;
        }
        
        $user->update($input);

        return redirect ('/admin/users');
    }

    
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        unlink(public_path() .  $user->photo->path);
        $user->delete();
        Session::flash('user_deleted', 'User has been deleted');
        
        return redirect('/admin/users');
    }
}
