<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;

class PostController extends Controller
{
    /**
     * Display list of resources
     *
     * @return Response
     */
    public function index()
    {
        return PostResource::collection(Post::with('user')->get());
    }

    /**
     * Display given model
     *
     * @param Post $post
     * @return Response
     */
    public function show(Post $post)
    {
        return new PostResource($post->load('user'));
    }
}
