<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PostController extends Controller
{
    /**
     * Returns a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return  response()->json(Post::select('id','title','description')->orderBy('id', 'desc')->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'title'=>'required',
            'description'=>'required',
            'user_id'=>'required|integer'
        ]);

        try{
            Post::create($request->post());

            return response()->json([
                'message'=>'Post Created Successfully.'
            ]);
        }catch(\Exception $e){
            return response()->json([
                'message'=>'Something went wrong while creating a post. \n' . $e->getMessage()
            ],500);
        }
    }

    /**
     * Returns the specified resource.
     *
     * @param Post $post
     * @return JsonResponse
     */
    public function show(Post $post): JsonResponse
    {
        return response()->json([
            'post'=>$post->load('comments'),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Post $post
     * @return void
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Post $post
     * @return void
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Post $post
     * @return void
     */
    public function destroy(Post $post)
    {
        //
    }

    /**
     * Returns a count of all posts.
     *
     * @return int
     */
    public function postsCount(): int
    {
        return Post::all()->count();
    }
}
