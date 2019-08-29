@extends('vendedor.layoutVendedor')

@section('conteudo')

<h1>Controle de Cliente</h1>

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
						  		CPF/CNPJ:
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
							<th>CPF/CNPJ:</th>
							<th>Endereço:</th>
							<th>Bairro:</th>
							<th>Cidade:</th>
							<th>Hora cadastro:</th>
							<th>Alterar</th>
							<th>Excluir</th>
						</tr>
					</thead>
					<tbody>
						@foreach($clientes as $cliente)
							<tr id="cliente-{{ $cliente->idCliente }}">
								<td scope="row" contenteditable="false" id="nome-{{ $cliente->idCliente }}">{{ $cliente->nomeCliente }}</td>
								<td contenteditable="false" id="cpfCnpj-{{ $cliente->idCliente }}">{{ $cliente->cpfCliente }}</td>
								<td contenteditable="false" id="logradouro-{{ $cliente->idCliente }}">{{ $cliente->logradouroCliente }}</td>
								<td contenteditable="false" id="bairro-{{ $cliente->idCliente }}">{{ $cliente->bairro }}</td>
								<td contenteditable="false" id="cidade-{{ $cliente->idCliente }}">{{ $cliente->cidade }}</td>
								<td>{{ $cliente->dtCadastroCliente }}</td>
								<td>
									@csrf
									<input class="btn btn-primary" type="button" id="alterar-{{ $cliente->idCliente }}" value="Alterar" onclick="editarproduto({{ $cliente->idCliente }})"></input>
									<input class="btn btn-primary" type="hidden" id="salvarEdicao-{{ $cliente->idCliente }}" value="Salvar" onclick="salvarEdicao({{ $cliente->idCliente }})"></input>
								</td>
								<td>
									<form method="post" action="/vendedor/cliente/remover/{{$cliente->idCliente}}" onsubmit="return confirm('Deseja excluir excluir {{addslashes($cliente->nomeCliente) }}?')">
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
	function editarproduto(codCliente){

		var cliente = document.getElementById('cliente-' + codCliente);

		document.getElementById('alterar-' + codCliente).setAttribute("type", "hidden"); 
		document.getElementById('salvarEdicao-' + codCliente).setAttribute("type", "button"); 

		var editable_elements = cliente.querySelectorAll("[contenteditable=false]");
		for(var i=0; i<editable_elements.length; i++){
	    	editable_elements[i].setAttribute("contenteditable", true);
		}

		
	}

	function salvarEdicao(codCliente){

		var formData = new FormData();

		var nomeCliente = document.getElementById('nome-' + codCliente).textContent;
		var cpfCnpj = document.getElementById('cpfCnpj-' + codCliente).textContent;
		var endereco = document.getElementById('logradouro-' + codCliente).textContent;
		var bairro = document.getElementById('bairro-' + codCliente).textContent;
		var cidade = document.getElementById('cidade-' + codCliente).textContent;

		const url = '/vendedor/cliente/url/'+ codCliente +'/alteraCliente';
		const _token = document.querySelector('input[name="_token"').value;

		formData.append('nomeCliente', nomeCliente);
		formData.append('cpfCnpj', cpfCnpj);
		formData.append('endereco', endereco);
		formData.append('bairro', bairro);
		formData.append('cidade', cidade);
		formData.append('_token', _token);

		fetch(url, {
			body: formData,
			method: 'POST'
		});

		document.getElementById('salvarEdicao-' + codCliente).setAttribute("type", "hidden"); 
		document.getElementById('alterar-' + codCliente).setAttribute("type", "button");
		
	}
</script>

@endsection