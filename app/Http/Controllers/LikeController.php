<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Mail\PostLiked;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class LikeController extends Controller
{
    public function store(Post $post, Request $request)
    {
        // dd($post->likes()->onlyTrashed()->get());
        if ($post->likedBy(auth()->user())) {
            abort(403, 'Unauthorized');
        }

        $post->likes()->create([
            'user_id' => $request->user()->id
        ]);

        if (!$post->likes()->onlyTrashed()->where('user_id', $request->user()->id)->count()) {
            Mail::to($post->user)->send(new PostLiked(auth()->user(), $post));
        }

        return back();
    }

    public function destroy(Post $post, Request $request)
    {
        $request->user()->likes()->where('post_id', $post->id)->delete();

        return back();
    }
}
