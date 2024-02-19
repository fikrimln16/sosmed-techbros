<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Follower;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Exceptions\ThrottleRequestsException;

class DashboardController extends Controller
{
    public function index()
    {
        $datas = Post::with(['comments' => function ($query) {
            $query->with('replies')->orderByDesc('created_at'); // Mengambil replies dan mengurutkannya berdasarkan waktu
        }])
        ->orderByDesc('likes')
        ->paginate(5);

        dd($datas);
        return view('pages.dashboard', compact('datas'));
    }



    public function sortByLike()
    {
        $datas = Post::with('comments')->orderByDesc('likes')->paginate(5);

        return view('pages.dashboard', compact('datas'));
    }


    public function sortByNewest()
    {
        $datas = Post::with(['user', 'comments' => function ($query) {
            $query->with('user', 'replies')->orderByDesc('created_at'); // Mengambil replies dan mengurutkannya berdasarkan waktu
        }])
        ->with('user.followers', 'user.followings') // Menyertakan data followers dan following dari user
        ->orderByDesc('created_at')
        ->paginate(5);
    
        // dd($datas);
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
                'body' => ['required', 'string', 'max:480', function ($attribute, $value, $fail) {
                    $words = explode(' ', $value);
                    foreach ($words as $word) {
                        if (strlen($word) > 30) {
                            $fail("The word '$word' exceeds the maximum length of 100 characters.");
                        }
                    }
                }],
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


    public function like(Request $request, $id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json(['error' => 'Post not found'], 404);
        }

        $like_num = $post->likes;
        $updated_like = $like_num + 1;

        $post->update(['likes' => $updated_like]);

        return response()->json(['likes' => $updated_like]);
    }


    public function follow($id)
    {
        $user = User::find($id);
        $follower = auth()->user(); // Pengguna yang melakukan follow
    
        // Periksa apakah pengguna sudah mengikuti pengguna lain
        if (!$follower->isFollowing($user->id)) {
            // Lakukan follow
            $follower->followings()->create([
                'user_id' => $follower->id,
                'following_id' => $user->id
            ]);
    
            // Tambahkan pengikut pada pengguna yang diikuti (jika diperlukan)
            $user->followers()->create([
                'user_id' => $user->id,
                'follower_id' => $follower->id
            ]);
    
            return redirect()->route('profile-page', ['id' => $user->id]);

        }
    
        return response()->json(['message' => 'User already followed.']);
    }
    



    

}