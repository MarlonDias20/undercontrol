@extends('vendedor.layoutVendedor')

@section('conteudo')
<div class="col-lg-2 sidenav">
    </div>
    <div class="col-lg-8 text-left"> 
      <h1>Bem-vindo ao Under Control!</h1>
      <p>O Under Control é um sistema de gerenciamento de vendas para peças automotivas, o mesmo tem a intenção de facilitar a vida das lojas que trabalham com este tipo de venda, fazendo assim a gestão de vendas, controle de estoque e fornecedores da empresa. Além disso, o Under Control também gera relatórios sobre todas as informações geradas por ele, pois assim os supervisores sempre poderão ter uma visão geral de como o processo de vendas da empresa se encontra.</p>
      <hr>
      <h3>Como utilizar?</h3>
      <p>Na barra de navegação acima é possível visualizar alguns menus disponíveis, nestes menus será possivel realizar todas as ações necessárias. Isto inclui: Cadastro de clientes, cadastro de produtos e muito mais!
      </p>
      <div class="center">

		<img class="img-responsive center-block" src="{{ asset('imagens/escritorio.png') }}" style="width:60%">
      </div>
    </div>
    <div class="col-lg-2 sidenav">
    </div>
    </div>
@endsection