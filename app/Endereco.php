<?php namespace Grafix;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model {

	//
    public static $rules = array(
        'logradouro' => 'required',
        'numero' => 'required',
    );

    /** ***************************************************************************************************************
     * Valida Endereco
     */
    public static function validaEndereco($input)
    {
        $validator = \Validator::make($input, Endereco::$rules);
        return $validator;
    }

}
