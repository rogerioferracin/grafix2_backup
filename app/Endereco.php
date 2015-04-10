<?php namespace Grafix;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model {

    //protected ------------------------------------------------------------------------------
    protected $table = 'enderecos';

    protected $fillable = array('logradouro', 'numero', 'complemento', 'bairro', 'cidade', 'uf', 'cep', 'referencia');

    //Relations ------------------------------------------------------------------------------
    public function endereco_morph()
    {
        return $this->morphTo();
    }

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
