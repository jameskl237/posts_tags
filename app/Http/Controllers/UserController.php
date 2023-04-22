<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\User;
use App\models\Post;
use App\models\Tag;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        $tab = User::get();
        return response()->json([
            $tab
        ]);
    }

    public function store(Request $request)
    {
        $validated = validator::make($request->all(),[
            'name'=>'required',
            
        ]);

        if($validated->fails()){
            return response()->json($validated->errors(), 400);
        }

        $user= User::create($request->all());
        return response()->json([
            'new user'=>$user,
            'message'=>'valeur creee avec succes'
        ],201);
    }

    public function update(Request $request,$id){

        $post = User::find($id);
        if (is_null($user)) {
            return response()->json([
                'message'=>'post not found'
            ],404);
        }
        $user -> update($request->all());
        return response()->json([
            'post'=>$user,
            'message'=> 'modification effectuee'
        ],200);
    }

    public function destroy($id){
        
        $user = User::find($id);
        if (is_null($user)) {
            return response()->json([
                'message'=>'post not found'
            ],404);
        }
        $copieuser = $user;
        $user->delete();
        return response()->json([
            'user'=>$copieuser,
            'message'=>'valeur supprimee'
         ]);
  }

  public function show( $id){
    $user = User::find($id);
    return response()->json(
        $user
    ,200);

  }

  public function userAndposts($id){
   $user = User::find($id);
    $user->posts = Post::where('user_id',$id)->get();
    return response()->json([
        $user
    ]);
  }

  public function usersAndPosts(){
    $arr = User::get();
        foreach ($arr as $key => $value) {
            $value->posts = Post::where('user_id',$value->id)->get();
            foreach ($tab as $key => $value->post) {
                
            }
            $value->posts->tags = Tag::where('post_id',$value->posts->id)->get();
        }

        return response()->json([
            $arr
        ]);
  }


}

// $tenants = Tenant::select('tenants.*')
//     ->join('units', 'units.id', '=', 'tenant.unit_id')
//     ->join('blocks', 'blocks.id', '=', 'units.block_id')
//     ->join('buildings', 'buildings.id', '=', 'blocks.building_id')
//     ->where('buildings.id', 123)
//     ->get();

// public function index()
//     {
//         return User::with('posts.comments')->get();
//     }