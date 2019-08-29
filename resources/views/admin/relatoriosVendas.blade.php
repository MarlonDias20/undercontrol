@extends('admin.layoutAdmin')

@section('conteudo')
	<h1>Relatório de Vendas</h1>
	<hr><br>
	<div class="jumbotron">
		<div class="container">
			<form>
				<div class="form-group">
						<div class="col-xs-3">
						  	<div class="input-group input-group-sm">
						  		Nome do Cliente:
								<select class="form-control input-sm" id="fornecedor">
							        <option selected disabled>Selecione</option>
							        <option>...</option>
						      	</select>
							</div>
						</div>

						<div class="col-xs-3">
							CPF/CNPJ do Cliente: 
							<input type="text" class="form-control">
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
							Data de Venda: 
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
						<th>CPF/CNPJ do Cliente:</th>
						<th>Nome do Cliente:</th>
						<th>Nome do Vendedor:</th>
						<th>Produto(s):</th>
						<th>Quantidade:</th>
						<th>Valor:</th>
						<th>Percentual de Desconto:</th>
						<th>Data da Venda:</th>
					</tr>
				</thead>
			</table>

			</div>
		<div class="col-lg-2 sidenav"></div>
	</div>


@endsection()