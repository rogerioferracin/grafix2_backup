<?php namespace Grafix\Http\Requests;

use Grafix\Http\Requests\Request;

class ClienteFormRequest extends Request {

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
            'razao_social'   => 'required',
            'nome_fantasia'  => 'required',
            'cnpj_cpf'       => 'required|cnpj_cpf|unique:clientes,cnpj_cpf' . ($id ? ",$id" : '')
		];
	}

}
