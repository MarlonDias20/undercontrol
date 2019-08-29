<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fornecedor extends Model{
	protected $table = "fornecedor";
	protected $primaryKey = "idFornec";
	public $timestamps = false;

}

?>