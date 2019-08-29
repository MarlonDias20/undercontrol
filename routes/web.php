<?php

#Rotas Login
	Route::get('/', 'EntrarController@index');
	Route::post('/', 'EntrarController@Entrar');
#End Login

#Rotas Operador
	
	Route::get('/operador/index','OperadorController@index');
	Route::get('/operador/fecharVenda','OperadorController@fecharVenda');

	Route::get('/operador/logout','OperadorController@logout');
#End rotas



#Rotas Vendedor
	
	Route::get('/vendedor/index','VendedorController@index');

	Route::get('/vendedor/cadastroCliente','VendedorController@cadastroCliente');
	Route::post('/vendedor/cadastroCliente','VendedorController@storeCliente');
	Route::delete('/vendedor/cliente/remover/{idCliente}', 'VendedorController@destroyCliente');
	Route::post('/vendedor/cliente/url/{codCliente}/alteraCliente','VendedorController@editaClientes');

	Route::get('/vendedor/logout','VendedorController@logout');


	Route::get('/vendedor/controleCliente','VendedorController@controleCliente');
	Route::get('/vendedor/registroVenda','VendedorController@registroVenda');
#End vendedor



#Rotas Estoquista

	
	Route::get('/estoquista/index','EstoquistaController@index');
	Route::get('/estoquista/registroCompras','EstoquistaController@registroCompras');
	Route::post('/estoquista/registroCompras','EstoquistaController@storeRegistroCompra');



	#Fornecedores
	Route::get('/estoquista/cadastraFornecedores','EstoquistaController@cadastraFornecedores');
	Route::post('/estoquista/cadastraFornecedores','EstoquistaController@storeFornec');
	Route::delete('/estoquista/fornecedor/remover/{idFornec}', 'EstoquistaController@destroyFornec');
	Route::post('/estoquista/fornecedor/url/{idFornec}/alterafornecedor','EstoquistaController@editaFornec');

	Route::get('/estoquista/controleFornecedores','EstoquistaController@controleFornecedores');

	#Produtos
	Route::get('/estoquista/cadastraProdutos','EstoquistaController@cadastraProdutos');
	Route::post('/estoquista/cadastraProdutos','EstoquistaController@storeProtudos');
	Route::delete('/estoquista/produto/remover/{id_produto}','EstoquistaController@destroyProtudos');
	Route::post('/estoquista/produto/url/{codProduto}/alteraProduto','EstoquistaController@editaProtudos');

	Route::get('/estoquista/logout','EstoquistaController@logout');

	Route::get('/estoquista/controleProdutos','EstoquistaController@controleProdutos');

#End Estoquista



#Rotas Admin
	
	Route::get('/admin/index','AdminController@index');
	Route::get('/admin/relatoriosEstoque','AdminController@relatoriosEstoque');
	Route::get('/admin/relatoriosFornecedores','AdminController@relatoriosFornecedores');
	Route::get('/admin/relatoriosVendas','AdminController@relatoriosVendas');

	Route::get('/admin/cadastroUsuario','AdminController@create');
	Route::get('/admin/cadastroUsuario','AdminController@storeUsuario');
	Route::delete('/admin/usuario/remover/{idUsuarioSistema}','AdminController@destroyUsuario');

	Route::get('/admin/logout','AdminController@logout');

	Route::post('/admin/controleUsuario','AdminController@controleUsuario');
#End Admin

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
