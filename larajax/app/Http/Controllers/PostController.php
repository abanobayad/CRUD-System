<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
// use Illuminate\Support\Facades\Request;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('updated_at' , 'desc')->paginate(10);
        return view('Posts.index' , compact('posts'));
    }

    public function add(Request $request)
    {
        if($request->ajax())
        {
            $request->validate(
                [
                    'title' => 'required|string',
                    'desc' => 'required|string',
                ]
            );

            $post = new Post();
            $post->title = $request->title;
            $post->desc = $request->desc;
            $post->user_id = Auth::id();
            $post->save();

            $response['post'] = $post;
            return view('Posts.row')->with($response);

        }

    }

    public function edit($id){
        $data = Post::findOrFail($id);
        return response()->json($data);
    }

    public function update(Request $request)
    {
        if($request->ajax())
        {
            if($request->ajax())
            {
                $request->validate(
                    [
                        'title' => 'required|string',
                        'desc' => 'required|string',
                    ]
                );
            }
            // dd($request->all());
            $post = Post::findOrfail($request->id);
            // dd($post);
            $post->title = $request->title;
            $post->desc = $request->desc;
            $post->updated_at = now();
            $post->save();
        }
        return view('Posts.rowEdit' , compact('post'));
    }

    public function delete($id)
    {
        $post  = Post::findOrFail($id);
        $post->delete();
        return response()->json(["success" => "this row deleted Successfully" , "id" => $id ]);
    }

}
