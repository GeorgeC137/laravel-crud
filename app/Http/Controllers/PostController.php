<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function create(Request $request)
    {
        $formInputs = $request->validate([
            'title' => 'required',
            'body' => 'required'
        ]);

        $formInputs['title'] = strip_tags($formInputs['title']);
        $formInputs['body'] = strip_tags($formInputs['body']);
        $formInputs['user_id'] = auth()->user()->id;

        // Save to database
        Post::create($formInputs);

        return redirect('/')->with('message', 'Post created successfully');
    }

    public function showEdit(Post $post)
    {
        if (auth()->user()->id === $post['user_id']) {
            return view('post.edit', ['post' => $post]);
        } else {
            abort(403, 'Unauthorized');
        }
    }

    public function destroy(Post $post)
    {
        if (auth()->user()->id === $post['user_id']) {
            $post->delete();

            return redirect('/')->with('delete', 'Post deleted successfully');
        } else {
            abort(403, 'Unauthorized!!!');
        }
    }

    public function edit(Request $request, Post $post)
    {
        $formInputs = $request->validate([
            'title' => 'required',
            'body' => 'required'
        ]);

        $formInputs['title'] = strip_tags($formInputs['title']);
        $formInputs['body'] = strip_tags($formInputs['body']);

        if (auth()->user()->id === $post['user_id']) {
            $post->update($formInputs);

            return redirect('/')->with('update', 'Post updated successfully');
        } else {
            abort(403, 'Unauthorized!!!');
        }
    }
}
