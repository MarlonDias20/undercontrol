@extends('admin.layoutAdmin')

@section('conteudo')
	<h1>Relatório de Forcenedores</h1>
	<hr><br>
	<div class="jumbotron">
		<div class="container">
			<form>
				<div class="form-group">
						<div class="col-xs-3">
						  	<div class="input-group input-group-sm">
						  		Código do Fornecedor:
								<input type="text" class="form-control">
							</div>
						</div>

						<div class="col-xs-3">
							Nome do Forcedor: 
							<select class="form-control input-sm" id="fornecedor">
						        <option selected disabled>Selecione</option>
						        <option>...</option>
					      	</select>
				      	</div>
						

			    </div>

			    <div class="form-group">

				      	<div class="col-xs-3">
							Nome do Produto: 
							<select class="form-control input-sm" id="fornecedor">
						        <option selected disabled>Selecione</option>
						        <option>...</option>
					      	</select>
				      	</div>

				      	<div class="col-xs-3">
							Data de Compra: 
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
						<th>Nome do Fornecedor:</th>
						<th>Produto(s):</th>
						<th>Quantidade:</th>
						<th>Valor:</th>
						<th>Data da Compra:</th>
					</tr>
				</thead>
			</table>

			</div>
		<div class="col-lg-2 sidenav"></div>
	</div>


@endsection()