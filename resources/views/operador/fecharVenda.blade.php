@extends('operador.layoutOperador')

@section('conteudo')

	<h1>Fechar Venda</h1>
	<hr><br>
	<div class="jumbotron">
		<div class="container">
			<form >
				<div class="form-group col-lg-offset-2">
						<div class="col-xs-3">
						  	<div class="input-group input-group-sm">
						  		Vendedor:
								<select class="form-control input-sm" id="fornecedor">
								    <option selected disabled>Selecione</option>
								    <option>...</option>
							    </select>
							</div>
						</div>

						<div class="col-xs-3">
							Código da Venda: 
							<div class='input-group date' id='datetimepicker1'>
			                    <input type='text' class="form-control" />
			                </div>
				      	</div>

						<div class="col-xs-3">
							CPF do Cliente: 
							<div class='input-group date' id='datetimepicker1'>
			                    <input type='text' class="form-control" />
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

	<div class="container-fluid text-center">    
		<div class="row content">
		

				<table class="table table-striped">
					<thead>
						<tr>
							<th></th>
							<th>Código da Venda:</th>
							<th>Cliente:</th>
							<th>Vendedor:</th>
							<th>Quantidade de Produtos:</th>
							<th>Total (R$):</th>
							<th>Fechar Venda</th>
							<th>Cancelar Venda</th>
						</tr>
					</thead>
				</table>

			</div>
			<div class="col-lg-2 sidenav"></div>
		</div>
	</div>
	</div>

@endsection