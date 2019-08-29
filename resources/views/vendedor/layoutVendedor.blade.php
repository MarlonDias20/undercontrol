<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <title>Under Control</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
    <style>
      .row.content {height: 800px}
    </style>
  </head>
  <body>
  <nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="/vendedor/index"><i class="fas fa-car"></i></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="/vendedor/index">Inicio</a></li>
        <li><a href="/vendedor/registroVenda">Registrar Venda</a></li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Clientes <span class="caret"></span></a></a>
          
            <ul class="dropdown-menu">
              <li><a href="/vendedor/cadastroCliente">Cadastrar Clientes</a></li>
              <li><a href="/vendedor/controleCliente">Controle de Clientes</a></li>
            </ul>
        </li>
      </ul>
        <ul class="nav navbar-nav navbar-right">
         <li>
          <form method='post'>
            @csrf
            <a href="/vendedor/logout" class="btn btn-default navbar-btn">Sair</a>
          </form>
        </li>
      </ul>
    </div>
  </div>
</nav>
<div class="container-fluid text-center">
  <div class="row content">  
    <div class="col-lg-2 sidenav"></div>
    <div class="col-lg-8 text-left">

  @yield('conteudo')
    </div>
  </div>
</div>
  <footer class="container-fluid text-center">
    <p>Copyright &copy; 2019 - Marlon Dias.</p>
    <p>Todos os direitos reservados.</p>
  </footer>

  </body>
</html>