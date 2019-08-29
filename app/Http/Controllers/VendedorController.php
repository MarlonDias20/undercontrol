<?php 

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Cliente;
use App\Venda;
use App\itemVenda;
use App\Estoque;
use App\Produto;

class VendedorController extends Controller{


	public function __construct(){
		$this->middleware('auth');
	}

	public function index(){
		return view('vendedor.vendedor');
	}

	public function cadastroCliente(){
		return view('vendedor.cadastroCliente');
	}

	public function storeCliente(Request $request){

		#Busca dados
		$cnpj = $request->cpfCnpj;
		$nome = $request->nome;
		$endereco = $request->endereco;
		$bairro = $request->bairro;
		$cidade = $request->cidade;

		try{

			$cliente = new Cliente();

			$cliente->cpfCliente = $cnpj;
			$cliente->nomeCliente = $nome;
			$cliente->logradouroCliente = $endereco;
			$cliente->bairro = $bairro;
			$cliente->cidade = $cidade;
			$cliente->dtCadastroCliente = now();
			$cliente->usuarioSistema_idUsuarioSistema = 1;

			$insertCliente = $cliente->save();

			if($insertCliente == true){
				$request->session()->flash('mensagem', 'Cliente '.$cliente->nomeCliente.' salvo com sucesso!');
				return redirect('/vendedor/controleCliente');
			}else{
				$request->session()->flash('mensagem', 'Ocorreu um erro ao salvar o cliente '.$cliente->nomeCliente);
				return redirect('/vendedor/controleCliente');
			}

		} catch(Exception $e){

		}
	}

	public function destroyCliente(Request $request){

		Cliente::destroy($request->idCliente);

		$request->session()->flash('mensagem', 'Cliente '.$request->nomeCliente.' excluído com sucesso!');
		return redirect('/vendedor/controleCliente');

	}

	public function controleCliente(){
		$cliente = Cliente::all();
		return view('vendedor.controleCliente', ['clientes' => $cliente]);
	}

	public function editaClientes(Request $request){

		$nome     = $request->nomeCliente;
		$cpfCnpj  = $request->cpfCnpj;
		$endereco = $request->endereco;
		$bairro   = $request->bairro;
		$cidade   = $request->cidade;

		#Busca dados
		$cliente = Cliente::find($request->codCliente);

		#Modifica os dados
		$cliente->nomeCliente       = $nome;
		$cliente->cpfCliente        = $cpfCnpj;
		$cliente->logradouroCliente = $endereco;
		$cliente->bairro            = $bairro;
		$cliente->cidade            = $cidade;
		$cliente->dtCadastroCliente = now();
		$cliente->usuarioSistema_idUsuarioSistema = 1;

		$cliente->save();
	}

	public function registroVenda(){

		$produto = Produto::all();
		return view('vendedor.registroVenda', ['produtos' => $produto]);
	}

	public function storeVenda(Request $request){

		$cpf = $request->cpf;
		$quantidade = $request->quantidade;
		$percentualDesconto = $request->percentualDesconto;
		$pedido = $request->pedido;
		$total = $request->total;
		$dataCadastro = now();

		try{

			foreach($pedido as $assocProdutoQuantidade){

				$dados = explode('|', $assocProdutoQuantidade);

				$produto = DB::select('SELECT * FROM produto WHERE codProduto = :codProduto', ['codProduto' => $dados[0]]);

				$estoque = DB::select('SELECT * FROM estoque WHERE idEstoque = :idEstoque', ['idEstoque' => $produto[0]->Estoque_idEstoque]);

				#Diminu estoque e salva
				$qtdProduto = $estoque[0]->qtdProduto - $quantidade;
				$estoqueAtual = $qtdProduto;

				$removeEstoque = Estoque::where('idEstoque', $produto[0]->Estoque_idEstoque)->update([
						'qtdProduto' => $qtdProduto,
						'estoqueAtual' => $estoqueAtual]);


				#Busca usuario da autenticacao
				$usuarioAutenticado = Auth::user()->idUsuarioSistema;

				$venda = new Venda();
				$itemVenda = new itemVenda();

				#Salva Venda
				$venda->vendedorVenda = $usuarioAutenticado;
				$venda->dtVenda = $dataCadastro;
				$insereVenda = $venda->save();

				define("idVenda", $venda->idVenda);

				$idVenda = idVenda;

				#Salva itemVenda
				$itemVenda->qtdItemVenda = $quantidade;
				$itemVenda->vlItemVenda = $total;
				$itemVenda->produto_codProduto = $produto[0]->codProduto;
				$itemVenda->venda_itemVenda = $idVenda;

				$insereItemVenda = $itemVenda->save();

				if($insereItemVenda == true && $insereVenda == true && $removeEstoque == true){

					$request->session()->flash('mensagem', 'Venda realizada com sucesso!');
					return redirect('/vendedor/registroVenda');

				} else{

				}
			}

		}catch(Exception $e){

		}



	}

	public function logout(Request $request){
		
		Auth::logout();
		$request->session()->flash('mensagem', 'Você saiu do sistema');
		return redirect('/');
	}
}
?>