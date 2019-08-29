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

					<h1>Cadastro de produto</h1>
					<hr><br>

					<form class="form-horizontal" action='/estoquista/cadastraProdutos' method='post' enctype="multipart/form-data">
						@csrf
						<div class="form-group">
					  		<label class="control-label col-sm-2" for="nome">Nome:<i style="color: red;">*</i> </label>
					  		<div class="col-sm-8">
								<input name='nome' id="nome" type='text' class="form-control" maxlength="30" required></br>
					  		</div>
						</div>
						
						<div class="form-group">
					  		<label class="control-label col-sm-2" for="login">Preço:<i style="color: red;">*</i> </label>
					  		<div class="col-sm-8">
								<input name='preco' id="preco" type='text' class="form-control" maxlength="30" required></br>
					  		</div>
						</div>

						<div class="form-group">
					  		<label class="control-label col-sm-2" for="login">Descrição:<i style="color: red;">*</i> </label>
					  		<div class="col-sm-8">
								<textarea class="form-control" rows="5" name="descricao" id="descricao"></textarea>
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