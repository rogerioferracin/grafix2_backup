<?php namespace Grafix\Http\Requests;

use Grafix\Http\Requests\Request;

class EnderecoFormRequest extends Request {

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
            'logradouro' => 'required',
            'numero' => 'required'
		];
	}

}
