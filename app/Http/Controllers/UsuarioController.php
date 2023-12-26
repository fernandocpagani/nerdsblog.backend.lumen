<?php

namespace App\Http\Controllers;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;

class UsuarioController extends Controller
{
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
       
    }

 
    public function mostrarTodosUsuarios(){
        return response()->json(Usuario::all());
    }

    public function cadastrarUsuario(Request $request){

        $this->validate($request, [
            'usuario' =>'required|min:5|max:40',
            'email' => 'required|email|unique:usuarios,email',
            'password' => 'required'
            ]);

        $usuario = new Usuario;
        $usuario->email = $request->email;
        $usuario->usuario = $request->usuario;
        $usuario->password = $request->password;
       

        $usuario->save();
        return response()->json($usuario);
    }

    public function mostrarUmUsuario($id){
        return response()->json(Usuario::find($id));
    }

    public function login(Request $request){
        return response()->json(Usuario::where('email', '=', $request->input('email'))->where('password', '=', $request->input('password'))->firstOrFail());
    }

    public function atualizarUsuario($id, Request $request){
        $usuario = Usuario::find($id);
        $usuario->email = $request->email;
        $usuario->usuario = $request->usuario;
        $usuario->password = $request->password;        

        $usuario->save();
        return response()->json($usuario);
    }

    public function deletarUsuario($id){
        $usuario = Usuario::find($id);
        $usuario->delete();
        return response()->json("deletado com sucesso", 200);
    }
}
