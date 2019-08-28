<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Painel\Usuario;

class LoginController extends Controller
{   

	public function index(){
    	return view('Login.index');
    }

    public function crieja(){
    	return view('Login.crieja');
    }

    public function login(Request $request)
    {
    	$rules = [
            'email'=>'required|min:3|max:100',
            'senha'=>'required|min:3|max:100',
        ];

        $dataForm = $request->all();
        $valida = validator($dataForm, $rules);
      
        if($valida->fails()) 
             return redirect()
                    ->route('login.index')->withErrors(['error'=>$valida->errors()->all()])->withInput();
        else
        {
            $ModelUsuario = new Usuario();
            $email = $dataForm['email'];
          
            $objUsuario = $ModelUsuario->select('id','nome','senha')->where('email',$email)->first();  
          
            if($objUsuario == null )
                return response()->json(['error'=>'Email ou senha incorretos']);
            else
            {
                if($objUsuario->senha == $dataForm['senha'])
                    return redirect()->route('painel.index');
                else
                    return redirect()
                    ->route('login.index')->withErrors(['error'=>'Email ou senha incorretos'])->withInput();
            }
        }
    }
    
    public function criacontasave(Request $request)
    {
    	$rules = [
            'nome'=>'required|min:3|max:100',
            'email'=>'required|min:3|max:100',
            'senha'=>'required|min:3|max:100',
        ];

        $dataForm = $request->all();
        $valida = validator($dataForm, $rules);
      
        if($valida->fails()) 
            return response()->json(['error'=>$valida->errors()->all()]);
        else
        {
            $ModelUsuario = new Usuario();

            $dataForm['datanascimento'] = null;
            $dataForm['status'] = 1;
            $insert = $ModelUsuario->create( $dataForm );

            if($insert)
                return response()->json(['success'=>'Usuário salvo']);
            else
                return response()->json(['error'=>'Não foi possivel salvar o usuário']);
        }
    }



}
