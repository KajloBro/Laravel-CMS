<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\CommentsRequest;
use Illuminate\Support\Facades\Auth;

use App\Reply;

class CommentRepliesController extends Controller
{
    
    public function index()
    {
        //
    }

    
    public function create()
    {
        //
    }

    
    public function store(CommentsRequest $request)
    {
        
    }

    
    public function show($id)
    {
        $replies = Reply::whereCommentId($id)->get();
        
        return view('admin.comments.replies.index', compact('replies'));
    }

    
    public function edit($id)
    {
        //
    }

    
    public function update(Request $request, $id)
    {
        Reply::findOrFail($id)->update($request->all());
        
        return redirect()->back();
    }

    
    public function destroy($id)
    {
        Reply::findOrFail($id)->delete();
        
        return redirect()->back();
    }

    public function createReply(CommentsRequest $request) 
    {
        $input = $request->all();
        $input['is_active'] = 1;
        $input['user_id'] = Auth::user()->id;
        
        Reply::create($input);

        return redirect()->back();
    }
}
