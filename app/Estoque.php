<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estoque extends Model{
	protected $table = "estoque";
	protected $primaryKey = "idMovimento";
	public $timestamps = false;

}

?>