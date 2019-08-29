@extends('admin.layoutAdmin')

@section('conteudo')

	<h1>Controle de Usuário</h1>
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
						  		Login:
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
							<th>Nome/Login:</th>
							<th>Senha:</th>
							<th>Data cadastro:</th>
							<th>Alterar</th>
							<th>Excluir</th>
						</tr>
					</thead>
					<tbody>
						@foreach($usuarios as $usuario)
							<tr id="usuario-{{$usuario->idUsuarioSistema}}">
								<td>{{$usuario->nome}}</td>
								<td>{{$usuario->password}}</td>
								<td>{{$usuario->dtCadastroUsuario}}</td>
								<td>
									@csrf
									<input class="btn btn-primary" type="button" id="alterar" value="Alterar" onclick="editarproduto({{ $usuario->idUsuarioSistema }})"></input>
									<input class="btn btn-primary" type="hidden" id="salvarEdicao" value="Salvar" onclick="salvarEdicao({{ $usuario->idUsuarioSistema }})"></input>
								</td>
								<td>
									<form method="post" action="/admin/usuario/remover/{{$usuario->idUsuarioSistema}}" onsubmit="return confirm('Deseja excluir excluir {{addslashes($usuario->nome) }}?')">
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

@endsection