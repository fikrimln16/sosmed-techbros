<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Exceptions\ThrottleRequestsException;


class DashboardController extends Controller
{
    public function index()
    {
        $datas = Post::with('comments')->orderByDesc('likes')->paginate(5);
    
        return view('pages.dashboard', [
            'datas' => $datas
        ]);
    }

    public function sortByLike()
    {
        $datas = Post::with('comments')->orderByDesc('likes')->paginate(5);

        return view('pages.dashboard', compact('datas'));
    }

    public function sortByNewest()
    {
        $datas = Post::with('comments')->orderByDesc('created_at')->paginate(5);

        return view('pages.dashboard', compact('datas'));
    }


    public function show(Post $post){
        
        return view('pages.post',[
            'data' => $post
        ]);
    }

    public function store(Request $request)
    {
        try {
            $user = auth()->user();

            $validatedData = $request->validate([
                'body' => 'required|string|max:480'
            ]);

            $post = new Post();
            $post->body = $validatedData['body'];
            $post->user_id = auth()->id();
            $post->save();

            return redirect()->route('dashboard')->with('success', 'Post created!');
        } catch (\Illuminate\Http\Exceptions\ThrottleRequestsException $e) {
            return redirect()->route('dashboard')->with('error', 'You have reached the maximum post limit. Please try again later.');
        }
    }


    public function like($id){
        $datas = Post::find($id);
        // dd($datas->likes);
        if ($datas){
            $like_num = $datas->likes;
            $updated_like = $like_num + 1;
            
            $datas->update(['likes' => $updated_like]);
            
            return redirect()->route('dashboard');
        }
    }

    public function show_comments(){
        
        return 0;
    }

}