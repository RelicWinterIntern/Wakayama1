<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Like;
use App\Models\Total_like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('updated_at', 'desc')->get();
        return view('post.index', compact('posts'));
    }

    public function create()
    {
        return view('post.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        $post = new Post();
        $post->title = $validatedData['title'];
        $post->body = $validatedData['body'];
        $post->user_id = Auth::id();
        $post->save();
        // like
        $like = new Total_like();
        $like->id = $post->id;
        $like->user_id = Auth::id();
        $like->save();
        

        return redirect()->route('post.index')->with('success', '投稿が作成されました');
    }

    public function likebutton($postid)
    {
        $totallike = Like::where('post_id', $postid)->where('user_id', Auth::id())->first();

        if (!$totallike) {
            $like = new Like();
            $like->post_id = $postid;
            $like->user_id = Auth::id();
            $data = $like->save();
        }
        else {
            
        }

        $this->totallikeUpdate($postid);

        return redirect()->route('post.index');
    }

    public function totallikeUpdate($postid):void
    {
        
        $total = Total_like::where('id', $postid)->first();
        $total->likes_count = Like::where('post_id', $postid)->count();
        $total->save();
    }

    public function myPosts()
    {
        $posts = Post::where('user_id', Auth::id())->orderBy('updated_at', 'desc')->get();
        return view('my-posts', compact('posts'));
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('post.edit', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        $post = Post::findOrFail($id);
        $post->title = $validatedData['title'];
        $post->body = $validatedData['body'];
        $post->save();

        return redirect()->route('myposts')->with('success', '投稿が更新されました');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return redirect()->route('myposts')->with('success', '投稿が削除されました');
    }
}

