<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function showAdminPage()
    {
        if (auth()->user()->role !== 'admin') {
            return redirect('/');
        }
        return view('admin-page');
    }


    public function deletePost(Post $post)
    {
        if (auth()->user()->id === $post->user_id || auth()->user()->role === 'admin') {
            $post->delete();
        }
        return redirect()->back()->with('success', 'Post deleted successfully');
    }

    public function actuallyUpdatePost(Post $post, Request $request)
    {
        if (auth()->user()->id !== $post->user_id && auth()->user()->role !== 'admin') {
            return redirect('/');
        }

        $incomingFields = $request->validate([
            'title' => 'required',
            'body' => 'required'
        ]);

        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['body'] = strip_tags($incomingFields['body']);

        $post->update($incomingFields);

        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.page')->with('success', 'Post updated successfully');
        }

        return redirect('/')->with('success', 'Post updated successfully');
    }

    public function showEditScreen(Post $post)
    {
        if (auth()->user()->id !== $post->user_id && auth()->user()->role !== 'admin') {
            return redirect('/');
        }
        return view('edit-post', ['post' => $post]);
    }


    public function createPost(Request $request)
    {
        $incomingFields = $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);

        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['body'] = strip_tags($incomingFields['body']);
        $incomingFields['user_id'] = auth()->id();
        Post::create($incomingFields);
        return redirect('/');

    }
}
