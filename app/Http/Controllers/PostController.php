<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;

class PostController extends Controller
{
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
       
    }    
    
    public function search(Request $request) {
        $search = $request->input('search');
        if($search){
            $posts = Post::with('usuario')->where('title', 'like', '%'.$search.'%')->orWhere('category', 'like', '%'.$search.'%')->orWhere('description', 'like', '%'.$search.'%')->get();
        }else{
          $posts = Post::all();
        }
        return  response()->json($posts);  
    }

    public function mostrarTodosPost(){
        return response()->json(Post::with('usuario')->orderBy("id", "desc")->get());
    }

    public function cadastrarPost(Request $request){

        $this->validate($request, [
            'title' =>'required|max:100',
            'image' =>'required',
            'category' =>'required',
            'description' =>'required',           
            'reference' =>'required',           
            ]);

        $post = new Post;
        $post->title = $request->title;
        $post->image = $request->image;
        $post->category = $request->category;
        $post->description = $request->description;        
        $post->reference = $request->reference;        
        $post->user_id = $request->user_id;     

        $post->save();
        return response()->json($post);
    }

    public function mostrarUmPost($id){
        return response()->json(Post::find($id));
    }

    public function atualizarPost($id, Request $request){
        $post = Post::find($id);
        $post->title = $request->title;
        $post->image = $request->image;
        $post->category = $request->category;
        $post->description = $request->description;           
        $post->reference = $request->reference;           

        $post->save();

        return response()->json($post);
    }

    public function deletarPost($id){
        $usuario = Post::find($id);
        $usuario->delete();
        return response()->json("deletado com sucesso", 200);
    }
}
