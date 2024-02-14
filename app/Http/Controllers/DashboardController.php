<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    public function index()
    {
        $datas = Post::with('comments')->orderByDesc('created_at')->paginate(5);
    
        return view('pages.dashboard', [
            'datas' => $datas
        ]);
    }

    public function show(Post $post){
        
        return view('pages.post',[
            'data' => $post
        ]);
    }

    public function store(Request $request){
        // Menggunakan auth() helper untuk mendapatkan user yang sedang login
        $user = auth()->user();
    
        $validatedData = $request->validate([
            'body' => 'required|string|max:480'
        ]);
        
        // Create a new post instance
        $post = new Post();
        $post->body = $validatedData['body'];
        $post->user_id = Auth::id();
        $post->save();
    
        return redirect()->route('dashboard')->with('success', 'Post created!');
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