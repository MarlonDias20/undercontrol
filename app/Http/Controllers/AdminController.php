<?php 

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\UsuarioSistema;

class AdminController extends Controller{
	
	public function __construct(){
        $this->middleware('auth');
    }

	public function index(){
		return view('admin.admin');
	}

	public function create(){
		return view('admin.criarUsuario');
	}

	public function storeUsuario(Request $request){
		$nome = $request->nome;
		$senha = $senha->senha;
		$perfil = $request->perfil;
		$dataCriacao = now();

		try{

			$registraUsuario = User::create([
	            'nome' => $nome,
	            'perfil' => $perfil,
	            'dtCadastroUsuario' => $dataCriacao,
	            'password' => Hash::make($data['password']),
        	]);

        	if($registraUsuario == true){
        		$request->session()->flash('mensagem', 'Usuário '.$nome.' salvo com sucesso!');
        		return redirect('/admin/controleUsuario');
        	}else{
        		$request->session()->flash('mensagem', 'Ocorreu um erro ao salvar o usuário '.$nome);
        		return redirect('/admin/controleUsuario');
        	}
			

		}catch (Expection $e){

		}
	}

	public function destroyUsuario(Request $request){
		$usuario = UsuarioSistema::find($request->idUsuarioSistema);

		UsuarioSistema::destroy($request->idUsuarioSistema);

		$request->session()->flash('mensagem', 'Usuário excluído com sucesso!');
		return redirect('/admin/controleUsuario');
	}

	public function controleUsuario(){

		$usuarios = UsuarioSistema::all();
		return view('admin.controleUsuario', ['usuarios' => $usuarios]);
	}


	#Relatórios
	public function relatoriosEstoque(){
		return view('admin.relatoriosEstoque');
	}

	public function relatoriosFornecedores(){
		return view('admin.relatoriosFornecedores');
	}
	
	public function relatoriosVendas(){
		return view('admin.relatoriosVendas');
	}

	public function logout(Request $request){
		
		Auth::logout();
		$request->session()->flash('mensagem', 'Você saiu do sistema');
		return redirect('/');
	}
}

?>