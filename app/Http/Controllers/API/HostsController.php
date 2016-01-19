<?php namespace app\Http\Controllers\API;

use App\Host;
use App\APIObjects\Host as HostAPIObject;
use App\APIObjects\Product as ProductAPIObject;
use App\Http\Controllers\Controller;

class HostsController extends Controller {

	public function index()
	{
		return Host::get()->map(function ($host)
		{
			return new HostAPIObject($host);
		});
	}

	public function show(Host $host)
	{
		return new HostAPIObject($host);
	}

	public function products(Host $host)
	{
		return $host->products()->get()->map(function ($host)
		{
			return new ProductAPIObject($host);
		});
	}
}