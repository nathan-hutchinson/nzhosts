<?php namespace App\APIObjects;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;

class Category implements Arrayable, Jsonable {

	/**
	 * @var
	 */
	private $category;

	/**
	 * Category constructor.
	 * @param $category
	 */
	public function __construct($category)
	{
		$this->category = $category;
	}

	/**
	 * Get the instance as an array.
	 *
	 * @return array
	 */
	public function toArray()
	{
		return [
			'name' => $this->category->name,
		];
	}

	/**
	 * Convert the object to its JSON representation.
	 *
	 * @param  int $options
	 * @return string
	 */
	public function toJson($options = 0)
	{
		return json_encode($this->toArray());
	}
}