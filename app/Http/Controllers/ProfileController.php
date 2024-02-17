<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;

class ProfileController extends Controller
{
    public function profile($id)
    {
        $posts = Post::where('user_id', $id)->orderBy('created_at', 'desc')->paginate(3);
        $profile = User::findOrFail($id);
        $latest_post = Post::where('user_id', $id)
                            ->orderBy('created_at', 'desc')
                            ->select('created_at')
                            ->first();

        return view('pages.profile', [
            'datas' => $posts,
            'profile' => $profile,
            'latest_post' => $latest_post
        ]);
    }

    #api
    public function api_profile($id)
    {
        $posts = Post::where('user_id', $id)->orderBy('created_at', 'desc')->get();
        $profile = User::findOrFail($id);
        $latest_post = Post::where('user_id', $id)
                            ->orderBy('created_at', 'desc')
                            ->select('created_at')
                            ->first();
    
        return response()->json([
            'posts' => $posts,
            'profile' => $profile,
            'latest_post' => $latest_post
        ]);
    }
    

}