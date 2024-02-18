<?php

namespace App\Http\Controllers\Api;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Exceptions\ThrottleRequestsException;

class ApiPostController extends Controller
{

    /**
     * Get Posts Data
     * @OA\Get(
     *     path="/api/posts",
     *     tags={"Posts"},
     *     security={{ "sanctum": {} }},
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(
     *              @OA\Property(property="status", type="string", example="success"),
     *              @OA\Property(property="message", type="string", example="Get Posts Data"),
     *              @OA\Property(property="data", type="array",
     *                  @OA\Items(
     *                      @OA\Property(property="id", type="number", example=1),
     *                      @OA\Property(property="user_id", type="number", example=1),
     *                      @OA\Property(property="body", type="string", example="testing komen pakai github"),
     *                      @OA\Property(property="likes", type="number", example=148),
     *                      @OA\Property(property="total_comments", type="number", example=0),
     *                      @OA\Property(property="created_at", type="string", example="2024-02-15T14:29:30.000000Z"),
     *                      @OA\Property(property="updated_at", type="string", example="2024-02-16T10:23:15.000000Z"),
     *                      @OA\Property(property="comments", type="array",
     *                          @OA\Items(
     *                              @OA\Property(property="id", type="number", example=1),
     *                              @OA\Property(property="user_id", type="number", example=1),
     *                              @OA\Property(property="post_id", type="number", example=1),
     *                              @OA\Property(property="body", type="string", example="testing comment"),
     *                              @OA\Property(property="created_at", type="string", example=null),
     *                              @OA\Property(property="updated_at", type="string", example=null)
     *                          )
     *                      )
     *                  )
     *              )
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Unauthenticated.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal server error",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="failed"),
     *             @OA\Property(property="message", type="string", example="Internal server error")
     *         )
     *     )
     * )
     */

    public function index(Request $request)
    {
        try {
            $datas = Post::with('comments')->orderByDesc('likes')->get();

            return response()->json([
                'status' => 'success',
                'message' => "Get Posts Data",
                'data' => $datas
            ], 200);
            
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Internal server error'
            ], 500);
        }
    }


    /**
     * Get Posts Data sorted by newest created_date
     * @OA\Get (
     *     path="/api/posts/sort-by-newest",
     *     tags={"Posts"},
     *     security={{ "sanctum": {} }},
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(
     *              @OA\Property(property="status", type="string", example="success"),
     *              @OA\Property(property="message", type="string", example="Get Posts Data"),
     *              @OA\Property(property="data", type="array",
     *                  @OA\Items(
     *                      @OA\Property(property="id", type="number", example=1),
     *                      @OA\Property(property="user_id", type="number", example=1),
     *                      @OA\Property(property="body", type="string", example="testing komen pakai github"),
     *                      @OA\Property(property="likes", type="number", example=148),
     *                      @OA\Property(property="total_comments", type="number", example=0),
     *                      @OA\Property(property="created_at", type="string", example="2024-02-15T14:29:30.000000Z"),
     *                      @OA\Property(property="updated_at", type="string", example="2024-02-16T10:23:15.000000Z"),
     *                      @OA\Property(property="comments", type="array",
     *                          @OA\Items(
     *                              @OA\Property(property="id", type="number", example=1),
     *                              @OA\Property(property="user_id", type="number", example=1),
     *                              @OA\Property(property="post_id", type="number", example=1),
     *                              @OA\Property(property="body", type="string", example="testing comment"),
     *                              @OA\Property(property="created_at", type="string", example=null),
     *                              @OA\Property(property="updated_at", type="string", example=null)
     *                          )
     *                      )
     *                  )
     *              )
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal server error",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="failed"),
     *             @OA\Property(property="message", type="string", example="Internal server error")
     *         )
     *     )
     * )
     */
    public function sortByNewest(Request $request)
    {
        try {
            $datas = Post::with('comments')->orderByDesc('created_at')->get();

            return response()->json([
                'status' => 'success',
                'message' => "Get Posts Data",
                'data' => $datas
            ], 200);
            
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Internal server error'
            ], 500);
        }
    }

    /**
     * Get Posts Data sorted by most liked
     * @OA\Get (
     *     path="/api/posts/sort-by-likes",
     *     tags={"Posts"},
     *     security={{ "sanctum": {} }},
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(
     *              @OA\Property(property="status", type="string", example="success"),
     *              @OA\Property(property="message", type="string", example="Get Posts Data"),
     *              @OA\Property(property="data", type="array",
     *                  @OA\Items(
     *                      @OA\Property(property="id", type="number", example=1),
     *                      @OA\Property(property="user_id", type="number", example=1),
     *                      @OA\Property(property="body", type="string", example="testing komen pakai github"),
     *                      @OA\Property(property="likes", type="number", example=148),
     *                      @OA\Property(property="total_comments", type="number", example=0),
     *                      @OA\Property(property="created_at", type="string", example="2024-02-15T14:29:30.000000Z"),
     *                      @OA\Property(property="updated_at", type="string", example="2024-02-16T10:23:15.000000Z"),
     *                      @OA\Property(property="comments", type="array",
     *                          @OA\Items(
     *                              @OA\Property(property="id", type="number", example=1),
     *                              @OA\Property(property="user_id", type="number", example=1),
     *                              @OA\Property(property="post_id", type="number", example=1),
     *                              @OA\Property(property="body", type="string", example="testing comment"),
     *                              @OA\Property(property="created_at", type="string", example=null),
     *                              @OA\Property(property="updated_at", type="string", example=null)
     *                          )
     *                      )
     *                  )
     *              )
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal server error",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="failed"),
     *             @OA\Property(property="message", type="string", example="Internal server error")
     *         )
     *     )
     * )
     */
    public function sortByLikes(Request $request)
    {
        try {
            $datas = Post::with('comments')->orderByDesc('likes')->get();

            return response()->json([
                'status' => 'success',
                'message' => "Get Posts Data",
                'data' => $datas
            ], 200);
            
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Internal server error'
            ], 500);
        }
    }


    /**
     * @OA\Get(
     *     path="/api/posts/{post}",
     *     tags={"Posts"},
     *     security={{ "sanctum": {} }},
     *     summary="Get a specific post",
     *     description="Get a specific post by its ID.",
     *     operationId="getPost",
     *     @OA\Parameter(
     *         name="post",
     *         in="path",
     *         required=true,
     *         description="ID of the post",
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="message", type="string", example="Berhasil mengambil data"),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="user_id", type="integer", example=1),
     *                 @OA\Property(property="body", type="string", example="Lorem ipsum"),
     *                 @OA\Property(property="likes", type="integer", example=10),
     *                 @OA\Property(property="created_at", type="string", format="date-time", example="2024-02-20 12:00:00"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time", example="2024-02-20 12:00:00"),
     *                 @OA\Property(property="comments", type="array",
     *                     @OA\Items(
     *                         @OA\Property(property="id", type="integer", example=1),
     *                         @OA\Property(property="user_id", type="integer", example=1),
     *                         @OA\Property(property="post_id", type="integer", example=1),
     *                         @OA\Property(property="body", type="string", example="Nice post"),
     *                         @OA\Property(property="created_at", type="string", format="date-time", example="2024-02-20 12:01:00"),
     *                         @OA\Property(property="updated_at", type="string", format="date-time", example="2024-02-20 12:01:00")
     *                     )
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Not Found",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="failed"),
     *             @OA\Property(property="message", type="string", example="Post not found.")
     *         )
     *     )
     * )
     */
    public function show(Post $post)
    {

        try {
            $post->load('comments'); 
            return response()->json([
                'status' => 'success',
                'message' => 'Berhasil mengambil data',
                'data' => $post
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Internal server error'
            ], 500);
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *
     * @OA\Post(
     *     path="/api/posts",
     *     tags={"Posts"},
     *     security={{ "sanctum": {} }},
     *     summary="Create a new post for the authenticated user",
     *     description="Create a new post for the authenticated user.",
     *     operationId="storePost",
     *     @OA\RequestBody(
     *         required=true,
     *         description="Post data",
     *         @OA\JsonContent(
     *             required={"body"},
     *             @OA\Property(property="body", type="string", maxLength=480, example="This is a new post.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="message", type="string", example="Post created successfully.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Unauthenticated.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=429,
     *         description="Too Many Requests",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="You have reached the maximum post limit. Please try again later.")
     *         )
     *     )
     * )
     */
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

            return response()->json([
                'status' => 'success', 
                'message' => 'Post created successfully.'
            ], 200);
            
        } catch (\Illuminate\Http\Exceptions\ThrottleRequestsException $e) {
            return response()->json([
                'message' => 'You have reached the maximum post limit. Please try again later.'
            ], 429);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Internal server error'
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     *
     * @OA\Delete(
     *     path="/api/posts/{post}",
     *     tags={"Posts"},
     *     security={{ "sanctum": {} }},
     *     summary="Delete a post",
     *     description="Delete a post by its ID.",
     *     operationId="deletePost",
     *     @OA\Parameter(
     *         name="post",
     *         in="path",
     *         required=true,
     *         description="ID of the post to delete",
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="message", type="string", example="Post deleted successfully.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Post not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="failed"),
     *             @OA\Property(property="message", type="string", example="Post not found.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Unauthenticated.")
     *         )
     *     )
     * )
     */
    public function destroy(Request $request)
    {
        try {
            $postId = $request->input('post_id');
            $post = Post::find($postId);

            if (!$post) {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Post not found.'
                ], 404);
            }

            $post->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Post deleted successfully.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Internal Server Error'
            ], 500);
        }
    }

    
    /**
     * @OA\Put(
     *     path="/api/posts/{id}",
     *     tags={"Posts"},
     *     security={{ "sanctum": {} }},
     *     summary="Update a post by ID",
     *     description="Update a post by its ID.",
     *     operationId="updatePost",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the post to update",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="Post data",
     *         @OA\JsonContent(
     *             required={"body"},
     *             @OA\Property(property="body", type="string", maxLength=480, example="Updated post body")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="message", type="string", example="Post updated successfully."),
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Unauthenticated.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Not Found",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Post not found.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal Server Error",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Internal server error")
     *         )
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
        try {
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

            $post = Post::find($id);

            if (!$post) {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Post not found.'
                ], 404);
            }

            // Validasi bahwa pengguna hanya dapat mengedit postingan mereka sendiri
            if ($post->user_id !== auth()->id()) {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Unauthorized. You can only edit your own posts.'
                ], 403);
            }

            $post->body = $validatedData['body'];
            $post->updated_at = now();
            $post->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Post updated successfully.',
                'data' => $post
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Internal Server Error'
            ], 500);
        }
    }
}