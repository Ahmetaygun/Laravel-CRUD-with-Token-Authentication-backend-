<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Validator;
class PostController extends Controller
{

    public function index()
    {
        $posts = Post::all();
        return response()->json($posts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    // public function admin()
    // {
    // return $this->belongsTo(Admin::class);
    // }

    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'name' => 'required',
                'mail' => 'required',
                'explanation' => 'required',
            ]);
            $post = Post::create($data);
    
            return response()->json([
                'message' => 'Gönderi başarıyla oluşturuldu.',
                'data' => $post
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Gönderi oluşturulurken bir hata oluştu: ' . $e->getMessage()
            ], 500);
        }
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);
        return response()->json($post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'mail' => 'required',
            'explanation' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }
    
        try {
            $post = Post::findOrFail($id);
            $post->update($request->all());
    
            return response()->json([
                'message' => 'Post updated successfully',
                'data' => $post
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred during the request'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $post = Post::findOrFail($id);
            $post->delete();
    
            return response()->json([
                'message' => 'Post deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred during the request']);
        }
    }
    
}
