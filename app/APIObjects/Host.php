<?php namespace App\APIObjects;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;

class Host implements Arrayable, Jsonable {

	/**
	 * @var Host
	 */
	private $host;

	/**
	 * Host constructor.
	 * @param Host $host
	 */
	public function __construct($host)
	{
		$this->host = $host;
	}

	public function toJson($options = 0)
	{
		return json_encode($this->toArray());
	}

	public function toArray()
	{
		return [
			'id' => $this->host->id,
			'name' => $this->host->name,
			'website' => $this->host->website,
		];
	}
}