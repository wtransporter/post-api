<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Http\Request;
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
     * Store given post to database
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'title' => 'required',
            'content' => 'required'
        ]);

        $attributes['user_id'] = $request->user()->id;

        $post = Post::create($attributes);
        
        return response([
            'message' => 'Post successfully saved.',
            'post' => $post
        ], 201);
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @param Post $post
     * @return Response
     */
    public function update(Request $request, Post $post)
    {
        $attributes = $request->only(['title', 'content']);
        $attributes['user_id'] = $request->user()->id;

        $post->update($attributes);

        return response([
            'mesage' => 'Post updated.'
        ], 201);
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
