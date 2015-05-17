<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateGroupRequest extends Request {

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
			'destination_id' => 'required',
			'date' => 'required|date',
			'tickets' => 'required|integer|min:1|max:10',
		];
	}
}