<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OperadorController extends Controller{
	
	public function __construct(){
		$this->middleware('auth');
	}

	public function index(){
		return view('operador.operador');
	}

	public function fecharVenda(){
		return view('operador.fecharVenda');
	}

	public function logout(Request $request){
		
		Auth::logout();
		$request->session()->flash('mensagem', 'Você saiu do sistema');
		return redirect('/');
	}
}

?>