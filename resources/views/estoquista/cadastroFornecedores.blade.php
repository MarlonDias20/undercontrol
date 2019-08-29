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

					<h1>Cadastro de Fornecedores</h1>
					<hr><br>

					<form class="form-horizontal" action='/estoquista/cadastraFornecedores' method='post' enctype="multipart/form-data">
						@csrf
						<div class="form-group">
					  		<label class="control-label col-sm-2" for="nome">Nome Fantasia:<i style="color: red;">*</i> </label>
					  		<div class="col-sm-8">
								<input name='nome' id="nome" type='text' class="form-control" maxlength="30" required></br>
					  		</div>
						</div>

						<div class="form-group">
					  		<label class="control-label col-sm-2" for="razao">Razão:<i style="color: red;">*</i> </label>
					  		<div class="col-sm-8">
								<input name='razao' id="razao" type='text' class="form-control" maxlength="30" required></br>
					  		</div>
						</div>
						
						<div class="form-group">
					  		<label class="control-label col-sm-2" for="login">CNPJ:<i style="color: red;">*</i> </label>
					  		<div class="col-sm-8">
								<input name='cnpj' id="cnpj" type='text' class="form-control" maxlength="30" required></br>
					  		</div>
						</div>

						<div class="form-group">
					  		<label class="control-label col-sm-2" for="senha">Produto:<i style="color: red;">*</i> </label>
					  		<div class="col-sm-8">
								<select class="form-control input-sm" id="produto" name="produto">
								    <option selected disabled>Selecione</option>
								    @foreach($produtos as $produto)
								    	<option id="optionProduto" value="{{$produto->codProduto}};{{ $produto->nomeProduto }}">{{ $produto->nomeProduto }}</option>
								    @endforeach
							    </select>
					  		</div>
						</div>

						<div class="col-md-12 text-center">
							<button type="button" class="btn btn-primary" id="adicionaProduto">Adicionar Produto</button>
							<br>
							<br>
						</div>

						<div class="form-group">
							<label class="control-label col-sm-2" for="login">Produtos:<i style="color: red;">*</i> </label>
							<div class="col-sm-8">
								<textarea class="form-control" rows="5" id="produtosFornec" name="produtosFornec" readonly></textarea>
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
			document.getElementById("adicionaProduto").addEventListener("click", function(){
				var option = document.getElementById('produto').value;
				var optionProduto = document.getElementById('optionProduto');
				

				var produtosFornec = document.getElementById('produtosFornec');
				produtosFornec.value = produtosFornec.value + option + '\n';

				optionProduto.remove();
			});
		</script>

@endsection()