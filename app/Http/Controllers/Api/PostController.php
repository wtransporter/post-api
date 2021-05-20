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
     * Display given post
     *
     * @param Post $post
     * @return Response
     */
    public function show(Post $post)
    {
        return new PostResource($post->load('user'));
    }

    /**
    * Delete the given post.
    *
    * @param Post $post
    * @return \Illuminate\Http\RedirectResponse
    */
    public function destroy(Post $post)
    {
        $deletedPost = $post;
        
        if (!$post->delete()) {
            return response([
                'message' => 'Error deleting post.',
            ], 422);
        }

        return response([
            'message' => 'Post deleted.',
            'post' => $deletedPost
        ]);
    }
}
