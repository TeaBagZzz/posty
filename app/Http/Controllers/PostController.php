<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth'])->only(['store', 'destroy']);
    }
    public function index()
    {
        $posts = Post::latest()->with(['user', 'likes'])->paginate(7);//"Collection" of the posts to be sent to the index page.

        return view('posts.index', [
            'posts' => $posts
        ]);
    }

    public function show(Post $post)
    {
        return view('posts.show', [
            'posts' => $post
        ]);
    }

    public function store(Request $request)
    {
       //dd('yes');
        //Validation
        $this->validate($request, [
            'body' => 'required',
            
        ]);

        /*$request->user()->posts()->create([
            'body' => $request->body
        ]);*/
        $request->user()->posts()->create($request->only('body'));


        
        return back();
    }

    public function destroy(Post $post)
    {
        //dd($post);

        $this->authorize('delete', $post);

        $post->delete();

        return back();
    }
}
