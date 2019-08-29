@extends('estoquista.layoutEstoquista')

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

					<h1>Registro de Compras</h1>
					
					<hr><br>

					<form class="form-horizontal" action='/estoquista/registroCompras' method='post' enctype="multipart/form-data">
						@csrf
						<div class="form-group">
					  		<label class="control-label col-sm-2" for="login">Quantidade:<i style="color: red;">*</i> </label>
					  		<div class="col-sm-8">
								<input name='quantidade' id="quantidade" type='text' class="form-control" maxlength="30" required></br>
					  		</div>
						</div>

						<div class="form-group">
					  		<label class="control-label col-sm-2" for="senha">Preço:<i style="color: red;">*</i> </label>
					  		<div class="col-sm-8">
								<input name='preco' id="preco" type='text' class="form-control" required><br>
					  		</div>
						</div>


						<div class="form-group">
					  		<label class="control-label col-sm-2" for="nome">Nome do Produto:<i style="color: red;">*</i> </label>
					  		<div class="col-sm-8">
								<select class="form-control input-sm" name="produto" id="produto">
								    <option selected disabled>Selecione</option>

										@foreach($assocProdutoFornec as $arrayAssoc)
												<option value="{{$arrayAssoc['produto'][0]}}">{{$arrayAssoc["produto"][1]}}</option>
										@endforeach

							    </select>
					  		</div>
						</div>

						<br>
						<div class="form-group">
					  		<label class="control-label col-sm-2" for="foto">Fornecedor:<i style="color: red;">*</i> </label>
					  		<div class="col-sm-8">
								<select class="form-control input-sm" name="fornecedor" id="fornecedor">
								    <option selected disabled>Selecione</option>
							    </select>
					  		</div>
						</div>

						<input name='data' type='hidden' value='<?php echo "$data"; ?>'><input name='hora' type='hidden' value='<?php echo "$hora"; ?>'>

						<input name='data' type='hidden' value='<?php echo "$data"; ?>'><input name='hora' type='hidden' value='<?php echo "$hora"; ?>'>

						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
								<button type="submit" class="btn btn-success">Cadastrar</button>
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


			var produto = document.getElementById("produto");
			var fornecedor = document.getElementById("fornecedor");

			produto.addEventListener("change", function() {			
				@foreach($assocProdutoFornec as $arrayAssoc)
					if({{$arrayAssoc['produto'][0]}} == produto.value){
						@foreach($arrayAssoc["fornec"] as $fornecedor)

							var option = document.createElement("option");
							option.value = {{$fornecedor[0]}};
							option.text = "{{$fornecedor[1]}}";

							fornecedor.add(option);
						@endforeach
					}
				@endforeach	
			});
		</script>


@endsection()