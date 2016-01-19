<?php namespace App\APIObjects;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;

class Product implements Arrayable, Jsonable {

	/**
	 * @var
	 */
	private $product;

	/**
	 * Host constructor.
	 * @param $product
	 */
	public function __construct($product)
	{
		$this->product = $product;
	}

	public function toJson($options = 0)
	{
		return json_encode($this->toArray());
	}

	public function toArray()
	{
		return [
			'name'      => $this->product->name,
			'category'  => $this->product->category->name,
			'disk'      => (float)$this->product->disk,
			'memory'    => (float)$this->product->memory,
			'cpu'       => (int)$this->product->cpu,
			'bandwidth' => (int)$this->product->bandwidth,
			'websites'  => (int)$this->product->websites,
			'managed'   => (boolean)$this->product->managed,
			'website'   => $this->product->website,
		];
	}
}