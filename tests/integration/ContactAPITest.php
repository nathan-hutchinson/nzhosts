<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;

class ContactAPITest extends TestCase {

	use DatabaseMigrations;

	/** @test */
	public function it_requires_all_fields()
	{
		$fields = [
			'name'    => '',
			'email'   => '',
			'message' => '',
			'my_name' => '',
			'my_time' => Crypt::encrypt(time() - 10),
		];

		$this->post('/api/contact/send', $fields, ['Accept' => 'application/json'])
			->seeJson([
				'name' => ['The name field is required.']
			])
			->seeJson([
				'email' => ['The email field is required.']
			])
			->seeJson([
				'message' => ['The message field is required.']
			]);
	}

	/** @test */
	public function it_stops_bots_from_instantly_sending()
	{
		$fields = [
			'name'    => 'Nathan',
			'email'   => 'test@test.com',
			'message' => 'Hello!',
			'my_name' => '',
			'my_time' => Crypt::encrypt(time()),
		];

		$this->post('/api/contact/send', $fields, ['Accept' => 'application/json'])
			->seeJson([
				'my_time' => ['Please wait until submitting the form again']
			]);
	}

	/** @test */
	public function it_stops_bots_from_sending_spam()
	{
		$fields = [
			'name'    => 'Nathan',
			'email'   => 'test@test.com',
			'message' => 'Hello!',
			'my_name' => 'Test',
			'my_time' => Crypt::encrypt(time() -10),
		];

		$this->post('/api/contact/send', $fields, ['Accept' => 'application/json'])
			->seeJson([
				'my_name' => ['Spam has been detected']
			]);
	}

	/** @test */
	public function it_stops_bots_from_sending_spam_2()
	{
		$fields = [
			'name'    => 'Nathan',
			'email'   => 'test@test.com',
			'message' => 'Hello!',
			'my_name' => 'Blah',
			'my_time' => 'Test',
		];

		$this->post('/api/contact/send', $fields, ['Accept' => 'application/json'])
			->see('The payload is invalid.');
	}

	/** @test */
	public function it_requires_valid_email()
	{
		$fields = [
			'name'    => 'Nathan',
			'email'   => 'test',
			'message' => 'Hello!',
			'my_name' => '',
			'my_time' => Crypt::encrypt(time() - 10),
		];

		$this->post('/api/contact/send', $fields, ['Accept' => 'application/json'])
			->seeJson([
				'email' => ['The email must be a valid email address.']
			]);
	}

	/** @test */
	public function it_sends_successfully()
	{
		$fields = [
			'name'    => 'Nathan',
			'email'   => 'test@test.com',
			'message' => 'Hello!',
			'my_name' => '',
			'my_time' => Crypt::encrypt(time() - 10),
		];

		$this->post('/api/contact/send', $fields, ['Accept' => 'application/json'])
			->seeJson([
				'success' => true
			]);
	}

}