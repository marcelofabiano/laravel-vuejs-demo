<?php

namespace App\Http\Controllers\Api;

use App\Post;
use Sarala\JsonApiResponse;
use Illuminate\Http\Request;
use App\Filters\PostsFilter;
use App\Http\Controllers\Controller;
use App\Http\Transformers\PostTransformer;

class PostController extends Controller
{
    public function index(Request $request, PostsFilter $filters)
    {
        $data = Post::filter($filters)->paginateOrGet($request);

        return new JsonApiResponse($data, new PostTransformer(), 'posts');
    }

    public function show(Post $post, PostsFilter $filter)
    {
        $data = Post::filter($filter)->find($post->id);

        return new JsonApiResponse($data, new PostTransformer(), 'posts');
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return response('', 204);
    }
}
