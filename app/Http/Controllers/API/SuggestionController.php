<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Honeypot;
use Mail;

class SuggestionController extends Controller
{
    public function honeypot()
	{
		return [
			'encrypted' => Honeypot::getEncryptedTime()
		];
	}

	public function send(Requests\SuggestionFormRequest $request)
	{
		$name = $request->get('name');
		$email = $request->get('email');
		$website = $request->get('website');

		$message = "Contact name: " . $name . "\n";
		$message .= "Contact email: " . $email . "\n";
		$message .= "Website: " . $website . "\n\n";
		$message .= $request->get('message');

		Mail::raw($message, function($message) use ($email, $name)
		{
			$message->from('nathan@valueweb.co.nz', 'NZ Hosts');

			$message->to('nathan@valueweb.co.nz')->subject('New Suggestion Form Message');

			$message->replyTo($email, $name);
		});

		return ['success' => true];
	}
}
