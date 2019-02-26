<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;
use App\Http\Requests\CommentsRequest;

use App\Comment;
use App\User;
use App\Post;

class PostCommentsController extends Controller
{
   
    public function index()
    {
        $comments = Comment::all();
        return view('admin.comments.index', compact('comments'));
    }


    public function store(CommentsRequest $request)
    {
        $input = $request->all();
        $input['user_id'] = Auth::user()->id;
        $input['is_active'] = 1;
        
        Comment::create($input);

        return redirect()->back();
    }


    public function show($id)
    {
        $comments = Comment::wherePostId($id)->get();
        return view('admin.comments.index', compact('comments'));
    }


    public function edit($id)
    {
        //
    }

    
    public function update(Request $request, $id)
    {
        Comment::findOrFail($id)->update($request->all());
        return redirect()->back();
    }


    public function destroy($id)
    {
        Comment::findOrFail($id)->delete();
        return redirect()->back();
    }
}
