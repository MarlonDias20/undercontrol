@extends('vendedor.layoutVendedor')

@section('conteudo')

<div class="container-fluid text-center">    
			<div class="row content">
				<div class="col-lg-2 sidenav">
				</div>
			
				<div class="col-lg-8 text-left"> 
					<?php
						date_default_timezone_set('America/Sao_Paulo');
						$data = date("Y-m-d");
						$hora = date("H:i:s");
						$novadata = substr($data,8,2) . "/" .substr($data,5,2) . "/" . substr($data,0,4);
						$novahora = substr($hora,0,2) . "h" .substr($hora,3,2) . "min";
					?>

					<h1>Registro de Venda</h1>
					@if(!empty($mensagem))
						<div class="alert alert-success">
							<b>{{ $mensagem }}</b>
						</div>
					@endif

					<hr><br>

					<form class="form-horizontal" action='/vendedor/registroVenda' method='post' enctype="multipart/form-data">
						@csrf
						<div class="form-group">
					  		<label class="control-label col-sm-2" for="nome">CPF do cliente:<i style="color: red;">*</i> </label>
					  		<div class="col-sm-8">
								<input name='cpf' id="cpf" type='text' class="form-control" maxlength="30" required></br>
					  		</div>
						</div>
						
						<div class="form-group">
					  		<label class="control-label col-sm-2" for="login">Produtos:<i style="color: red;">*</i> </label>
					  		<div class="col-sm-8">
								<select class="form-control input-sm" id="produto">
								    <option selected disabled>Selecione</option>
								    @foreach($produtos as $produto)
								    <option value="{{$produto->codProduto}};{{$produto->nomeProduto}};{{$produto->vlrProduto}}">{{ $produto->nomeProduto }}</option>
								    @endforeach
							    </select>
					  		</div>
						</div>

						<div class="form-group">
					  		<label class="control-label col-sm-2" for="nome">Quantidade:<i style="color: red;">*</i> </label>
					  		<div class="col-sm-8">
								<input name='quantidade' id="quantidade" type='text' class="form-control" maxlength="30" required></br>
					  		</div>
						</div>

						<div class="form-group">
					  		<label class="control-label col-sm-2" for="senha">Percentual de Desconto: </label>
					  		<div class="col-sm-8">
								<input name='PercentualDesconto' id="PercentualDesconto" type='text' class="form-control"><br>
					  		</div>
						</div>
						<div class="col-md-12 text-center">
							<button type="button" class="btn btn-primary" id="adicionaProduto">Adicionar Produto</button>
							<br>
							<br>
						</div>

						<div class="form-group">
							<label class="control-label col-sm-2" for="login" >Pedido:<i style="color: red;">*</i> </label>
							<div class="col-sm-8">
								<div class="form-group">
								    <select multiple class="form-control" id="pedido" multiple="multiple" name="pedido[]">
								    </select>
								 </div>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-sm-2" for="login">Total: </label>
							<div class="col-sm-8">
								<input rows="5" type="text" id="total" name="total" readonly="readonly"></input>
							</div>
						</div>
						

						<input name='data' type='hidden' value='<?php echo "$data"; ?>'><input name='hora' type='hidden' value='<?php echo "$hora"; ?>'>

						<input name='data' type='hidden' value='<?php echo "$data"; ?>'><input name='hora' type='hidden' value='<?php echo "$hora"; ?>'>

						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
								<button type="submit" class="btn btn-success">Finalizar</button>
							</div>
						</div>
					</form>

					<br><hr>

					<div style="color: grey;">
						<i>Campos marcados com <i style="color: red;">*</i> são obrigatórios no cadastro.<br>
						<b>Observação</b>: Será inserido no seu cadastro a data atual, bem como a hora atual do cadastro<br>
						Data: <?php echo "$novadata"; ?> - Hora: <?php echo "$novahora" ?> <br><br>
					</div>
				</div>

				<div class="col-lg-2 sidenav">
				</div>
			</div>
		</div>
		<script type="text/javascript">

			document.getElementById("adicionaProduto").addEventListener("click", function(){

				var option = document.getElementById('produto').value;
				var produtos = option.split(';');
				var preco = produtos[2];
				var nomeProduto = produtos[1];
				var idProduto = produtos[0];
				var quantidade = document.getElementById('quantidade').value;
				var totalPedido = 0;
				var percentual = document.getElementById('PercentualDesconto').value;
				var total = document.getElementById('total');


				if(total.value != ""){
					if(percentual != ""){

						var valorDesconto = parseFloat(preco * (percentual/100));
						var precoComDesconto = parseFloat(preco - valorDesconto);

						totalPedido = parseFloat(total.value) + (parseFloat(precoComDesconto) * parseInt(quantidade));

					} else {
						totalPedido = parseFloat(total.value) + (parseFloat(preco) * parseInt(quantidade));
					}
				} else{
					if(percentual != ""){

						var valorDesconto = parseFloat(preco * (percentual/100));
						var precoComDesconto = parseFloat(preco - valorDesconto);

						totalPedido = (parseFloat(precoComDesconto) * parseInt(quantidade));
					} else {
						totalPedido = (parseFloat(preco) * parseInt(quantidade));
					}
				}
				
				total.value = totalPedido;

				var produtos = document.getElementById('pedido');
				var optionSelect = document.createElement('option');

				optionSelect.value = idProduto + '|' + quantidade;
				optionSelect.text = 'Produto: ' + nomeProduto + ' - Quantidade:' + quantidade + ' - Percentual: ' + percentual; 
				
				optionSelect.selected = true;

				produtos.add(optionSelect);

			});
		</script>

@endsection