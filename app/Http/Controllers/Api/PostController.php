<?php

namespace App\Http\Controllers\Api;

use Validator;
use JWTAuth;
use App\Http\Controllers\Api\JwtAuthController;
use App\Models\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PostController extends Controller
{
    //
    public function post(Request $request)
    {
        // $this->validate($request, [
            // 'token' => 'required'
        // ]);
        
        $validator = Validator::make(
        $request->all(),
        [
            'title' => 'required',
            'content' => 'required',
            'user' => JWTAuth::authenticate($request->token),
        ]
        );
        $input = $request->only('title', 'content');

        $post = new Post();
        $post->title = $request->title;
        $post->content = $request->content;
        $post->user_id = $request->user()->id;
        $post->save();

        return response()->json([
            'success' => true,
            'title' => $input,
            'user' => JWTAuth::authenticate($request->token),
        ]);
    }
}
