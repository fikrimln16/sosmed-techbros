<?php

namespace App\Http\Controllers\Api;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Exceptions\ThrottleRequestsException;

class ApiUserAuthController extends Controller
{
  /**
   * @OA\Post(
   *     path="/api/login",
   *     tags={"Authentication"},
   *     summary="Register or login user",
   *     description="Register a new user or login if user exists",
   *     operationId="registerUser",
   *     @OA\RequestBody(
   *         required=true,
   *         description="User data",
   *         @OA\JsonContent(
   *             required={"nickname", "name", "email", "id", "avatar"},
   *             @OA\Property(property="id", type="string", example="123456"),
   *             @OA\Property(property="nickname", type="string", example="john_doe"),
   *             @OA\Property(property="name", type="string", example="John Doe"),
   *             @OA\Property(property="email", type="string", format="email", example="john.doe@example.com"),
   *             @OA\Property(property="avatar", type="string", example="https://example.com/avatar.jpg")
   *         )
   *     ),
   *     @OA\Response(
   *         response=200,
   *         description="Success",
   *         @OA\JsonContent(
   *             @OA\Property(property="status", type="string", example="success"),
   *             @OA\Property(property="message", type="string", example="User registered successfully.")
   *         )
   *     ),
   *     @OA\Response(
   *         response=422,
   *         description="Validation error",
   *         @OA\JsonContent(
   *             @OA\Property(property="status", type="string", example="failed"),
   *             @OA\Property(property="message", type="string", example="The given data was invalid."),
   *             @OA\Property(property="errors", type="object",
   *                 @OA\Property(property="email", type="array",
   *                     @OA\Items(type="string", example="The email field is required.")
   *                 )
   *             )
   *         )
   *     )
   * )
   */
  public function login(Request $request)
  {
      // Validasi input request
      $request->validate([
          'nickname' => 'required|string',
          'name' => 'required|string',
          'email' => 'required|email',
          'id' => 'required|string',
          'avatar' => 'required|string',
      ]);

      // Cari pengguna berdasarkan email
      $user = User::where('email', $request->email)->first();

      // Jika pengguna belum terdaftar, daftarkan sebagai pengguna baru
      if (!$user) {
          $user = new User();
          $user->provider_id = $request->id;
          $user->nickname = $request->nickname;
          $user->name = $request->name;
          $user->email = $request->email;
          $user->avatar = $request->avatar;
          $user->email_verified_at = now();
          $user->password = ''; 
          $user->save();
      }

      // Login pengguna dan menyimpan data $user pada Auth
      Auth::login($user);

      // Berikan token akses
      $token = $user->createToken('auth_token')->plainTextToken;

      return response()->json([
          'status' => 'success',
          'message' => 'berhasil login',
          'data' => [
              'token' => $token,
              'user' => $user
          ]
      ]);
  }

}