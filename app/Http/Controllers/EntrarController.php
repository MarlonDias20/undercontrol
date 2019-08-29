<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EntrarController extends Controller{
	 
	public function index(){
	 	return view('login');
	}

	public function Entrar(Request $request){
	 	if(Auth::attempt($request->only(['nome', 'password']))){

	 		$perfil = DB::select('SELECT perfil FROM usuariosistema WHERE nome = :nome', ['nome' => $request->nome]);

	 		//dd($perfil[0]->perfil);

	 		switch ($perfil[0]->perfil) {
	 			case '1':
	 				return view('admin.admin');
	 			break;
 				case '2':
 					return view('estoquista.estoquista');
 				break;
 				case '3':
 					return view('vendedor.vendedor');
 				break;
 				case '4':
	 				return view('operador.operador');
	 			break;
	 		}	
	 	} else{
	 		return redirect()->back()->withErrors('Usuário e/ou senha incorretos');
	 	}
	 	
	}

}

?>