<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;

class CategoryAPITest extends TestCase {

	use DatabaseMigrations;

	/** @test */
	public function it_shows_all_categories()
	{
		$category = factory(App\Category::class)->create();
		$category2 = factory(App\Category::class)->create();

		$this->get('/api/categories')
			->seeJson([
				'name' => $category->name,
			])
			->seeJson([
				'name' => $category2->name,
			]);

	}
}