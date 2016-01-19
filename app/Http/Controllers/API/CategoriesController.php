<?php

namespace App\Http\Controllers\API;

use App\APIObjects\Category as CategoryAPIObject;
use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests;

class CategoriesController extends Controller {

	public function index()
	{
		return Category::get()->map(function ($category)
		{
			return new CategoryAPIObject($category);
		});
	}
}
