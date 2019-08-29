<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<title>Under Control</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="func.js"></script>
		<link rel="stylesheet" type="text/css" href="estilo.css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
		<style>
			.row.content {height: 650px}
		</style>

	</head>

	<body>
		<div class="container-fluid text-center">    
			<div class="row content">
				<div class="col-lg-2 sidenav">
				</div>

				<div class="col-lg-8 text-center"> 
					<?php
						date_default_timezone_set('America/Sao_Paulo');
						$data = date("Y-m-d");
						$hora = date("H:i:s");
						$novadata = substr($data,8,2) . "/" .substr($data,5,2) . "/" . substr($data,0,4);
						$novahora = substr($hora,0,2) . "h" .substr($hora,3,2) . "min";
					?>

					<h1>Efetuar Login</h1>
					<hr><br>
					<form class="form-horizontal" action='login.php' method='post' >
						<div class="form-group">
							<label class="control-label col-sm-2 col-sm-offset-2" for="nome">Login:<i style="color: red;">*</i></label>
					  		<div class="col-sm-4">
								<input name='login' id="login" type='text' class="form-control" maxlength="30" placeholder="" required><br>
					  		</div>
						</div>
						
						<div class="form-group">
					  		<label class="control-label col-sm-2 col-sm-offset-2" for="codigo">Senha<i style="color: red;">*</i> </label>
					  		<div class="col-sm-2">
								<input name='senha' id="senha" type='password' class="form-control" placeholder="" required></br>
					  		</div>
						</div>

						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
								<button type="submit" class="btn btn-success">Entrar</button>
							</div>
						</div>
					</form>

					<br><hr>

					<div style="color: grey;">
						Data: <?php echo "$novadata"; ?> - Hora: <?php echo "$novahora" ?> <br><br>
					</div>
				</div>

				<div class="col-lg-2 sidenav">
				</div>
			</div>
		</div>

		<footer class="container-fluid text-center">
			<p>Copyright &copy; 2018 - Marlon Dias.</p>
			<p>Todos os direitos reservados.</p>
		</footer>
	</body>
</html>
