<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function host()
	{
		return $this->belongsTo('App\Host');
	}

	public function category()
	{
		return $this->belongsTo('App\Category');
	}
}
