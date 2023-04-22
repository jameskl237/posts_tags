<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Tag;
use Illuminate\Support\Facades\Validator;

class TagController extends Controller
{
    public function index (){
        $tab = Tag::get();
        return response()->json([
            $tab
        ]);
    }

    public function store (){
        $valid = validator::make($request->all(),[
            'tag'=>'required',
            'id'=>'required'
        ]);
        if($valid->fails()){
            return response()->json($valid->errors(),400);
        }
        $tag = Tag::create($request->all());
        return response()->json([
           'new tag'=> $tag,
            'message'=>'new tag insert'
        ]);
    }

    public function update (Request $request,$id){
        $tag = Tag::find($id);
        if (is_null($tag)) {
            return response()->json([
                'message'=>'tag not found'
            ],404);
        }
        $tag->update($request->all());
        return response()->json([
            'tag'=>$tag,
            'message'=>'tag update succesfully'
        ]);
    } 

    public function destroy ($id){
        $tag = Tag::find($id);
        if (is_null($tag)) {
            return response()->json([
                'message'=>'tag not found'
            ],404);
        }
        $tag2 = $tag;
        $tag->delete();
        return response()->json([
            'tag'=>$tag2,
            'message'=>'valeur supprimee'
         ]);
    }

    public function show ($id){
        $user = User::find($id);
    return response()->json(
        $tag
    ,200);
    }

    
}
