@extends('estoquista.layoutEstoquista')

@section('conteudo')

<h1>Controle de Produtos</h1>

@if(!empty($mensagem))
<div class="alert alert-success">
	<b>{{ $mensagem }}</b>
</div>
@endif

	<hr><br>
	<div class="jumbotron">
		<div class="container">
			<form >
				<div class="form-group col-md-12 col-md-offset-3">
						<div class="col-xs-3">
						  	<div class="input-group input-group-sm">
						  		Nome:
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
							<th>Nome:</th>
							<th>Preço:</th>
							<th>Hora cadastro:</th>
							<th>Alterar</th>
							<th>Excluir</th>
						</tr>
					</thead>
					<tbody>
						
						@foreach($produtos as $produto)
							<tr id="produto-{{$produto->codProduto}}">


								<td scope="row" contenteditable="false" id="nome-{{$produto->codProduto}}">{{ $produto->nomeProduto }}</td>
								<td contenteditable="false" id="vlrProduto-{{$produto->codProduto}}">{{ $produto->vlrProduto }}</td>
								<td>{{ $produto->dtCadastroProduto }}</td>
								<td>
									@csrf
									<input class="btn btn-primary" type="button" id="alterar-{{$produto->codProduto}}" value="Alterar" onclick="editarproduto({{ $produto->codProduto }})"></input>
									<input class="btn btn-primary" type="hidden" id="salvarEdicao-{{$produto->codProduto}}" value="Salvar" onclick="salvarEdicao({{ $produto->codProduto }})"></input>
								</td>
								<td>
									<form method="post" action="/estoquista/produto/remover/{{$produto->codProduto}}" onsubmit="return confirm('Deseja excluir excluir {{addslashes($produto->nomeProduto) }}?')">
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
	function editarproduto(codProduto){

		var produto = document.getElementById('produto-' + codProduto);

		document.getElementById('alterar-' + codProduto).setAttribute("type", "hidden"); 
		document.getElementById('salvarEdicao-' + codProduto).setAttribute("type", "button"); 

		var editable_elements = produto.querySelectorAll("[contenteditable=false]");
		for(var i=0; i<editable_elements.length; i++){
	    	editable_elements[i].setAttribute("contenteditable", true);
		}

		
	}

	function salvarEdicao(codProduto){

		var formData = new FormData();

		var nomeProduto = document.getElementById('nome-' + codProduto).textContent;
		var precoProduto = document.getElementById('vlrProduto-' + codProduto).textContent;

		const url = '/estoquista/produto/url/'+ codProduto +'/alteraProduto';
		const _token = document.querySelector('input[name="_token"').value;

		formData.append('nomeProduto', nomeProduto);
		formData.append('precoProduto', precoProduto);
		formData.append('_token', _token);

		fetch(url, {
			body: formData,
			method: 'POST'
		});

		document.getElementById('salvarEdicao-' + codProduto).setAttribute("type", "hidden"); 
		document.getElementById('alterar-' + codProduto).setAttribute("type", "button");
		
	}
</script>

@endsection()