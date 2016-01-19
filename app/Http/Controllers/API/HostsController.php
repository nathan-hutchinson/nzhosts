<?php namespace app\Http\Controllers\API;

use App\Host;
use App\APIObjects\Host as HostAPIObject;
use App\Http\Controllers\Controller;

class HostsController extends Controller {

	public function index()
	{
		return Host::get()->map(function ($host) {
			return new HostAPIObject($host);
		});
	}
}