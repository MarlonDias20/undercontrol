<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Estoque;
use App\pedidoCompra;
use App\Produto;
use App\Fornecedor;


class EstoquistaController extends Controller{


	public function __construct(){
		$this->middleware('auth');
	}

	public function index(){
		return view('estoquista.estoquista');
	}

	public function registroCompras(){

		$produtos = DB::select('select * from produto');

		$fornecedores = DB::select('Select * from fornecedor');

		$matrizProdutoFornc = [];
		foreach($fornecedores as $fornecedor){

			$separaProduto = explode(';',$fornecedor->produto_codProduto);
			$produtoFornec = [$separaProduto, $fornecedor->idFornec, $fornecedor->nomeFornec];

			array_push($matrizProdutoFornc, $produtoFornec);
		}

		$assocProdutoFornec = [];

		foreach($produtos as $produto){
			foreach($matrizProdutoFornc as $manipulaDados){


				if($produto->codProduto == $manipulaDados[0][0]){


					if(array_key_exists(0, $assocProdutoFornec)){
						
						if(array_key_exists("produto", $assocProdutoFornec[0])){

							if($assocProdutoFornec[0]["produto"][0] == strval($produto->codProduto)){

								array_push($assocProdutoFornec[0]["fornec"],[$manipulaDados[1], $manipulaDados[2]]);

							} else{
								array_push($assocProdutoFornec,[
			 						'produto' => [$manipulaDados[0][0], $produto->nomeProduto],
			 						'fornec'  => [ [$manipulaDados[1], $manipulaDados[2]] ]
								]);
							}
						}

					} else{
						array_push($assocProdutoFornec,[
	 						'produto' => [$manipulaDados[0][0],$produto->nomeProduto],
	 						'fornec'  => [ [$manipulaDados[1], $manipulaDados[2]] ]
						]);
					}

				}
			}
		}


		return view('estoquista.registroCompras', ['assocProdutoFornec' => $assocProdutoFornec]);
	}

	public function cadastraProdutos(){
		return view('estoquista.cadastraProdutos');
	}

	public function storeProtudos(Request $request){
		#Captura dados
		$nome = $request->nome;
		$descricao = $request->descricao;
		$preco = $request->preco;
		$dataAlteracao = now();

		try{
			
			#Salva Produto
			$produto = new Produto();
			$produto->nomeProduto = $nome;
			$produto->descProduto = $descricao;
			$produto->dtCadastroProduto = now();
			$produto->vlrProduto = $preco;
			$insertProduto = $produto->save();

			if($insertProduto == true){

				$request->session()->flash('mensagem', 'Produto '.$produto->nomeProduto.' salvo com sucesso!');
				return redirect('/estoquista/controleProdutos');

			} else{

				$erro = $insertProduto ;
				$request->session()->flash('Ocorreu um erro ao salvar produto: '.$produto->nomeProduto);
				return redirect('/estoquista/controleProdutos');

			}

		} catch(Exception $e){

		}		

	}

	public function destroyProtudos(Request $request){
		$produto = Produto::find($request->id_produto);

		Produto::destroy($request->id_produto);

		$request->session()->flash('mensagem', 'Produto '.$produto->nomeProduto.' excluído com sucesso!');
		return redirect('/estoquista/controleProdutos');
	}

	public function controleProdutos(Request $request){

		$produtos = Produto::all();

		$mensagem = $request->session()->get('mensagem');

		return view('estoquista.controleProdutos', ['produtos'=>$produtos, 'mensagem'=>$mensagem]);
	}

	public function editaProtudos(Request $request){

		$novoNome = $request->nomeProduto;
		$novoprecoProduto = $request->precoProduto;
		

		#Busca os dados
		$produto = Produto::find($request->codProduto);

		#Modifica os dados
		$produto->nomeProduto = $novoNome;
		$produto->vlrProduto = $novoprecoProduto;

		#Salva os novos dados
		$produto->save();
	}

	public function cadastraFornecedores(){
		$produtos = Produto::all();
		return view('estoquista.cadastroFornecedores', ['produtos' => $produtos]);
	}

	public function controleFornecedores(Request $request){

		// $fornecedores = DB::table('fornecedor')->get();

		$fornecedores = Fornecedor::all();

		$mensagem = $request->session()->get('mensagem');

		return view('estoquista.controleFornecedores', ['fornecedores'=>$fornecedores, 'mensagem'=>$mensagem]);
	}

	public function storeFornec(Request $request){
		#Captura dados
		$nomeFornec = $request->nome;
		$razao = $request->razao;
		$cnpj = $request->cnpj;
		$textAreaProdutosId = $request->produtosFornec;
		$dataAlteracao = now();

		try{

			$fornecedor = new Fornecedor();
			$fornecedor->nomeFornec = $nomeFornec;
			$fornecedor->razaoSocial = $razao;
			$fornecedor->cnpjFornec = $cnpj;
			$fornecedor->produto_codProduto = $textAreaProdutosId;
			$fornecedor->dtCadastroFornec = $dataAlteracao;

			$insertFornecedor = $fornecedor->save();

			if($insertFornecedor == true){
				$request->session()->flash('mensagem', 'Fornecedor '.$fornecedor->nomeFornec.' salvo com sucesso!');
				return redirect('/estoquista/controleFornecedores');
			} else{
				$request->session()->flash('mensagem', 'Ocorreu um erro ao salvar o fornecedor '.$fornecedor->nomeFornec);
				return redirect('/estoquista/controleFornecedores');
			}


		}catch(Exception $e){

		}
	}

	public function destroyFornec(Request $request){

		Fornecedor::destroy($request->idFornec);

		$request->session()->flash('mensagem', 'Fornecedor '.$request->nomeFornec.' excluído com sucesso!');
		return redirect('/estoquista/controleFornecedores');
	}

	public function editaFornec(Request $request){

		//$codFornecedor = $request->idFornec;
		$nomeFornec = $request->nome;
		$razaoSocial = $request->razaoSocial;
		$produtos = $request->produtos;

		#Busca dados
		$fornecedor = Fornecedor::find($request->idFornec);

		#Modifica os dados
		$fornecedor->nomeFornec = $nomeFornec;
		$fornecedor->razaoSocial = $razaoSocial;
		$fornecedor->produto_codProduto = $produtos;

		$fornecedor->save();

	}

	public function logout(Request $request){
		
		Auth::logout();
		$request->session()->flash('mensagem', 'Você saiu do sistema');
		return redirect('/');
	}

	public function storeRegistroCompra(Request $request){
		#Captura dados
		$quantidade = $request->quantidade;
		$preco = $request->preco;
		$produto = $request->produto;
		$fornecedor = $request->fornecedor;
		$dataCadastro = now();

		try{
			
			$produtos = DB::select('SELECT * FROM produto WHERE codProduto = :produto', ['produto' =>$produto]);
			$produto = Produto::find($produto);
			$estoque = new Estoque();
			$pedidoCompra = new pedidoCompra();


			if($produtos[0]->Estoque_idEstoque == 0){
				$estoque->qtdProduto = $quantidade;
				$estoque->estoqueAtual = $quantidade;
				$estoque->estoqueInicial = $quantidade;
				$estoque->idMovimento = 0;
				$estoque->dataAlteracao = $dataCadastro;
				$insertEstoque = $estoque->save();

				$produto->Estoque_idEstoque = $estoque->idMovimento;
				$insertProduto = $produto->save();

				$pedidoCompra->dtPedido = $dataCadastro;
				$pedidoCompra->vlrPedido = $preco;
				$pedidoCompra->fornecedor_idFornec = $fornecedor;
				$pedidoCompra->save();

			} else{
				$estoqueJaSalvo = DB::select('SELECT * FROM estoque WHERE idEstoque = :idEstoque', ['idEstoque' => $produtos[0]->Estoque_idEstoque]);

				$estoque->qtdProduto = $estoqueJaSalvo[0]->qtdProduto + $quantidade;
				$estoque->estoqueAtual = $estoqueJaSalvo[0]->estoqueAtual + $quantidade;
				$estoque->estoqueInicial = $estoque->estoqueAtual;
				$estoque->idMovimento = 0;
				$estoque->dataAlteracao = $dataCadastro;
				$insertEstoque = $estoque->save();

				$produto->Estoque_idEstoque = $estoque->idMovimento;
				$insertProduto = $produto->save();

			}

			$pedidoCompra->dtPedido = $dataCadastro;
			$pedidoCompra->vlrPedido = $preco;
			$pedidoCompra->fornecedor_idFornec = $fornecedor;
			$pedidoCompra->save();



			if($insertEstoque == true){

				$request->session()->flash('mensagem', 'Compra realizada com sucesso!');
				return redirect('/estoquista/registroCompras');

			} else{

				$request->session()->flash('mensagem', 'Erro ao realizar a compra!');
				return redirect('/estoquista/registroCompras');
			}

		} catch(Exception $e){

		}		

	}
}

?>