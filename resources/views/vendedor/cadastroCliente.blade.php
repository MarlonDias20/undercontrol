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

					<h1>Cadastro de Cliente</h1>
					<hr><br>

					<form class="form-horizontal" action='/vendedor/cadastroCliente' method='post' enctype="multipart/form-data">
						@csrf
						<div class="form-group">
					  		<label class="control-label col-sm-2" for="nome">CPF/CNPJ:<i style="color: red;">*</i> </label>
					  		<div class="col-sm-8">
								<input name='cpfCnpj' id="cpfCnpj" type='text' class="form-control" maxlength="30" required></br>
					  		</div>
						</div>
						
						<div class="form-group">
					  		<label class="control-label col-sm-2" for="login">Nome/Razao Social:<i style="color: red;">*</i> </label>
					  		<div class="col-sm-8">
								<input name='nome' id="nome" type='text' class="form-control" maxlength="30" required></br>
					  		</div>
						</div>

						<div class="form-group">
					  		<label class="control-label col-sm-2" for="senha">Endereço:<i style="color: red;">*</i> </label>
					  		<div class="col-sm-8">
								<input name='endereco' id="endereco" type='text' class="form-control" maxlength="30" required></br>
					  		</div>
						</div>

						<div class="form-group">
					  		<label class="control-label col-sm-2" for="senha">Bairro:<i style="color: red;">*</i> </label>
					  		<div class="col-sm-8">
								<input name='bairro' id="bairro" type='text' class="form-control" maxlength="30" required></br>
					  		</div>
						</div>

						<div class="form-group">
					  		<label class="control-label col-sm-2" for="foto">Cidade: </label>
					  		<div class="col-sm-8">
								<input name='cidade' id="cidade" type='text' class="form-control" maxlength="30" required></br>
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


@endsection