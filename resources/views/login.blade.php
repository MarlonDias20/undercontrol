@extends('layout')

@section('conteudo')

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
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form class="form-horizontal jumbotron" method='post'>
                        @csrf
                        <div class="form-group">
                            <label class="control-label col-sm-2 col-sm-offset-2" for="nome">Login:<i style="color: red;">*</i></label>
                            <div class="col-sm-4">
                                <input name='nome' id="nome" type='text' class="form-control" maxlength="30" placeholder="" required><br>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="control-label col-sm-2 col-sm-offset-2" for="codigo">Senha<i style="color: red;">*</i> </label>
                            <div class="col-sm-4">
                                <input name='password' id="password" type='password' class="form-control" placeholder="" required></br>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-8">
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

@endsection