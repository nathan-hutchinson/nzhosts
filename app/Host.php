<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Host extends Model {

	public function products()
	{
		return $this->hasMany('App\Product');
	}
}
