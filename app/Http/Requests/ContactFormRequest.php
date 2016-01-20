<?php namespace App\Http\Requests;

class ContactFormRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'name'    => 'required',
			'email'   => 'required|email',
			'message' => 'required',
			'my_name' => 'honeypot',
			'my_time' => 'required|honeytime:5',
		];
	}
}