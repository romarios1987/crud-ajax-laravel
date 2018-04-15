<?php

namespace App\Http\Controllers;
//use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use App\Post;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;



class PostController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $posts = Post::all();
        return view('posts.index', compact('posts'));
    }

    /**
     * Modal to submit new Post
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addPost(Request $request)
    {
        $rules = [
            'title' => 'required',
            'body' => 'required'
        ];

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Response::json(['errors' => $validator->getMessageBag()->toarray()]);
        } else {
            $post = new Post();
            $post->title = $request->title;
            $post->body = $request->body;
            $post->save();

            return response()->json($post);
        }
    }


    public function editPost(Request $request){
        $post = Post::find($request->id);
        $post->title = $request->title;
        $post->body = $request->body;
        $post->save();

        return response()->json($post);
    }
}
