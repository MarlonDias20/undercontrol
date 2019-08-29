<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class registroVenda extends Model{
	protected $table = "pedidoCompra"
	protected $primarykey = "idPedidoCompra";

	public $timestamps = false;
}

?>