<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Honeypot;
use Mail;

class ContactController extends Controller
{
    public function honeypot()
	{
		return [
			'encrypted' => Honeypot::getEncryptedTime()
		];
	}

	public function send(Requests\ContactFormRequest $request)
	{
		$name = $request->get('name');
		$email = $request->get('email');

		$message = "Contact name: " . $name . "\n";
		$message .= "Contact email: " . $email . "\n\n";
		$message .= $request->get('message');

		Mail::raw($message, function($message) use ($email, $name)
		{
			$message->from('nathan@valueweb.co.nz', 'NZ Hosts');

			$message->to('nathan@valueweb.co.nz')->subject('New Contact Form Message');

			$message->replyTo($email, $name);
		});

		return ['success' => true];
	}
}
