<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'blog_id' => 'required|exists:blogs,id',
            'content' => 'required|string|max:1000',
        ]);

        Comment::create([
            'user_id' => Auth::id(),
            'blog_id' => $request->blog_id,
            'content' => $request->content,
        ]);

        return redirect()->back()->with('success', 'Comment added!');
    }

    public function destroy(Comment $comment)
    {
        if (Auth::user()->is_admin) {
            $comment->delete();
            return back()->with('success', 'Comment deleted.');
        }

        abort(403, 'Only admins can delete comments.');
    }
}
