<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function index()
    {
        $arr = Post::get();
        return response()->json([
            $arr
        ]);
    }

    public function store(Request $request)
    {
        $validated = validator::make($request->all(),[
            'title'=>'required',
            
        ]);

        if($validated->fails()){
            return response()->json($validated->errors(), 400);
        }

        $post= Post::create($request->all());
        return response()->json([
            'new post'=>$post,
            'message'=>'valeur creee avec succes'
        ],201);
    }

    public function update(Request $request,$id){

        $post = Post::find($id);
        if (is_null($post)) {
            return response()->json([
                'message'=>'post not found'
            ],404);
        }
        $post -> update($request->all());
        return response()->json([
            'post'=>$post,
            'message'=> 'modification effectuee'
        ],200);
    }

    public function destroy($id){
        
        $post = Post::find($id);
        if (is_null($post)) {
            return response()->json([
                'message'=>'post not found'
            ],404);
        }
        $copiepost = $post;
        $post->delete();
        return response()->json([
            'post'=>$copiepost,
            'message'=>'valeur supprimee'
         ]);
  }

  public function show( $id){
    $post = Post::find($id);
    return response()->json(
        $post
    ,200);

  }

  public function postAndTag($id){
   $post = Post::find($id);
    $Post->tags = Tag::where('post_id',$id)->get();
    return response()->json([
        $post
    ]);
  }

  public function post_AndTag(){
    $arr = Post::get();
        foreach ($arr as $key => $value) {
            $value->tags = Tag::where('post_id',$value->id)->get();
        }

        return response()->json([
            $arr
        ]);
  }

}
