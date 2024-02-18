<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;


/**
 * @OA\Info(
 *     title="Documentation My API",
 *     version="1.0"
 * )
 *
 * @OA\SecurityScheme(
 *     type="http",
 *     scheme="bearer",
 *     securityScheme="sanctum",
 * )
 */
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}