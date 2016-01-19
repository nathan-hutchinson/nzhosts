<?php

use App\Host;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class HostAPITest extends TestCase {

	use DatabaseMigrations;

	/** @test */
	public function it_show_all_hosts()
	{
		$host = factory(Host::class)->create();

		$host2 = factory(Host::class)->create();

		$this->get('/api/host')
			->seeJson([
				'name'    => $host->name,
				'website' => $host->website
			])
			->seeJson([
				'name'    => $host2->name,
				'website' => $host2->website
			]);
	}
}