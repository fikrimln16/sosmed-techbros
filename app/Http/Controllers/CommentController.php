<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function comment(Post $post){

        $comment = new Comment();
        $comment->post_id = $post->id;
        $comment->user_id = Auth::id();
        $comment->body = request()->get('body');

        $comment->save();

        return redirect()->route('dashboard')->with('success', 'Berhasil menambahkan komentar!');
    }

    public function reply(Request $request, Comment $comment)
    {
        // Validasi request jika diperlukan

        // Buat komentar balasan baru
        $reply = new Comment();
        $reply->user_id = auth()->id(); // Atau sesuaikan dengan cara Anda mendapatkan user ID
        $reply->post_id = $comment->post_id;
        $reply->body = $request->body;
        $reply->parent_comment_id = $comment->id;
        $reply->save();

        // Redirect atau berikan respons sesuai kebutuhan
        return redirect()->back()->with('success', 'Reply berhasil ditambahkan');
    }
}