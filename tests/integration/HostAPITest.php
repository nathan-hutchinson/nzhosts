<?php

use App\Host;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class HostAPITest extends TestCase {

	use DatabaseMigrations;

	/** @test */
	public function it_shows_all_hosts()
	{
		$host = factory(Host::class)->create();

		$host2 = factory(Host::class)->create();

		$this->get('/api/hosts')
			->seeJson([
				'name'        => $host->name,
				'description' => $host->description,
				'website'     => $host->website
			])
			->seeJson([
				'name'        => $host2->name,
				'description' => $host2->description,
				'website'     => $host2->website
			]);
	}

	/** @test */
	public function it_shows_one_host()
	{
		$host = factory(Host::class)->create();

		$this->get('/api/hosts/' . $host->id)
			->seeJson([
				'name'        => $host->name,
				'description' => $host->description,
				'website'     => $host->website
			]);
	}

	/** @test */
	public function it_shows_products_for_one_host()
	{
		$product = factory(App\Product::class)->create();

		$product2 = factory(App\Product::class)->create(['host_id' => $product->host->id]);

		$this->get('/api/hosts/' . $product->host->id . '/products')
			->seeJson([
				'name'      => $product->name,
				'category'  => $product->category->name,
				'disk'      => $product->disk,
				'memory'    => $product->memory,
				'cpu'       => $product->cpu,
				'bandwidth' => $product->bandwidth,
				'websites'  => $product->websites,
				'managed'   => $product->managed,
				'website'   => $product->website,
			])
			->seeJson([
				'name'      => $product2->name,
				'category'  => $product2->category->name,
				'disk'      => $product2->disk,
				'memory'    => $product2->memory,
				'cpu'       => $product2->cpu,
				'bandwidth' => $product2->bandwidth,
				'websites'  => $product2->websites,
				'managed'   => $product2->managed,
				'website'   => $product2->website,
			]);

	}
}