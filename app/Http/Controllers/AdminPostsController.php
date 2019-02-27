<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\PostsRequest;
use App\Post;
use App\Photo;
use App\Category;
use App\Comment;
use Illuminate\Support\Facades\Auth;

class AdminPostsController extends Controller
{
    
    public function index()
    {
        $posts = Post::paginate(5);

        return view('admin.posts.index', compact('posts'));
    }

    
    public function create()
    {
        $categories = Category::pluck('name', 'id')->all();

        return view('admin.posts.create', compact('categories'));
    }

    
    public function store(PostsRequest $request)
    {
        $input = $request->all();
        
        $user = Auth::user()->id;
        $input['user_id'] = $user;

        if ($file = $request->file('photo_id')) {
            
            $name = time() . $file->getClientOriginalName();
            $file->move('images', $name);

            $photo = Photo::create(['path' => $name]);
            $input['photo_id'] = $photo->id;

        }

        Post::create($input);

        return redirect('/admin/posts');
    }

    
    public function show($id)
    {
        
    }

    
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::pluck('name', 'id')->all();

        return view('admin.posts.edit', compact('post', 'categories'));
    }

    
    public function update(Request $request, $id)
    {
        $updated = $request->all();

        if ($file = $request->file('photo_id')) {
            
            $name = time() . $file->getClientOriginalName();
            $file->move('images', $name);

            $photo = Photo::create(['path' => $name]);
            $updated['photo_id'] = $photo->id;

        }

        $post = Post::findOrFail($id);
        $post->update($updated);

        return redirect('/admin/posts/');
    }

    
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        unlink(public_path() .  $post->photo->path);
        $post->delete();

        return redirect('/admin/posts');
    }

    public function post($slug) {

        $post = Post::findBySlugOrFail($slug);
        $comments = Comment::wherePostId($post->id)->whereIsActive('1')->get();
        $categories = Category::all();

        return view('post', compact('post', 'comments', 'categories'));
    }
}
