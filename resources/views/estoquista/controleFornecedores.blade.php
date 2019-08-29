@extends('estoquista.layoutEstoquista')

@section('conteudo')

<h1>Controle de Fornecedores</h1>

@if(!empty($mensagem))
	<div class="alert alert-success">
		<b>{{ $mensagem }}</b>
	</div>
@endif

	<hr><br>
	<div class="jumbotron">
		<div class="container">
			<form >
				<div class="form-group col-lg-offset-4">
						<div class="col-xs-3">
						  	<div class="input-group input-group-sm">
						  		CNPJ:
								<input type="text" class="form-control">
							</div>
						</div>

						<div class="col-xs-3">
							Data de Cadastro: 
							<div class='input-group date' id='datetimepicker1'>
			                    <input type='text' class="form-control" />
			                    <span class="input-group-addon">
			                        <span class="glyphicon glyphicon-calendar"></span>
			                    </span>
			                </div>
				      	</div>
			    </div>

		      	<div class="col-md-12 text-center">
		      		<br>
		      		<button type="submit" class="btn btn-primary">Buscar</button>
		      	</div>
		    </form>
	  	</div>
	</div>

	<div class="">    
		<div class="">
		

				<table class="table table-striped">
					<thead>
						<tr>
							<th>CNPJ:</th>
							<th>Nome:</th>
							<th>Razão Social:</th>
							<th>Produto(s):</th>
							<th>Hora cadastro:</th>
							<th>Alterar</th>
							<th>Excluir</th>
						</tr>
					</thead>
					<tbody>
						@foreach($fornecedores as $fornecedor)
							<tr id="fornecedor-{{ $fornecedor->idFornec }}">
								<td scope="row" id="cnpj-{{ $fornecedor->idFornec }}">{{ $fornecedor->cnpjFornec }}</td>
								<td contenteditable="false" id="nome-{{ $fornecedor->idFornec }}">{{ $fornecedor->nomeFornec }}</td>
								<td contenteditable="false" id="razao-{{ $fornecedor->idFornec }}">{{ $fornecedor->razaoSocial }}</td>
								<td contenteditable="false" id="produtos-{{ $fornecedor->idFornec }}">{{ $fornecedor->produto_codProduto }}</td>
								<td>{{ $fornecedor->dtCadastroFornec }}</td>
								<td>
									@csrf
									<input class="btn btn-primary" type="button" id="alterar-{{ $fornecedor->idFornec }}" value="Alterar" onclick="editarproduto({{ $fornecedor->idFornec }})"></input>
									<input class="btn btn-primary" type="hidden" id="salvarEdicao-{{ $fornecedor->idFornec }}" value="Salvar" onclick="salvarEdicao({{ $fornecedor->idFornec }})"></input>
								</td>
								<td>
									<form method="post" action="/estoquista/fornecedor/remover/{{$fornecedor->idFornec}}" onsubmit="return confirm('Deseja excluir excluir {{addslashes($fornecedor->nomeFornec) }}?')">
										@csrf
										@method('DELETE')
										<button class="btn btn-danger">Excluir</button>
									</form>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>

			</div>
			<div class="col-lg-2 sidenav"></div>
		</div>
	</div>
	</div>

	<script type="text/javascript">
		function editarproduto(codFornecedor){

			var fornecedor = document.getElementById('fornecedor-' + codFornecedor);

			document.getElementById('alterar-' + codFornecedor).setAttribute("type", "hidden"); 
			document.getElementById('salvarEdicao-' + codFornecedor).setAttribute("type", "button"); 

			var editable_elements = fornecedor.querySelectorAll("[contenteditable=false]");
			for(var i=0; i<editable_elements.length; i++){
		    	editable_elements[i].setAttribute("contenteditable", true);
			}

			
		}

		function salvarEdicao(codFornecedor){

			var formData = new FormData();

			var nome = document.getElementById('nome-' + codFornecedor).textContent;
			var razao = document.getElementById('razao-' + codFornecedor).textContent;
			var produtos = document.getElementById('produtos-' + codFornecedor).textContent;

			const url = '/estoquista/fornecedor/url/'+ codFornecedor +'/alterafornecedor';

			const _token = document.querySelector('input[name="_token"').value;

			formData.append('nome', nome);
			formData.append('razaoSocial', razao);
			formData.append('produtos', produtos);
			formData.append('_token', _token);

			fetch(url, {
				body: formData,
				method: 'POST'
			});

			document.getElementById('salvarEdicao-' + codFornecedor).setAttribute("type", "hidden"); 
			document.getElementById('alterar-' + codFornecedor).setAttribute("type", "button");
			
		}

	</script>

@endsection()