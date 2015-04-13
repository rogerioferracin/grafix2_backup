<?php namespace Grafix\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
    //protected ------------------------------------------------------------------------------
    protected $table = 'clientes';

    protected $fillable = array('razao_social', 'nome_fantasia', 'cnpj_cpf', 'ie_rg', 'im', 'ativo', 'observacoes');

    //Softdelete -----------------------------------------------------------------------------
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    //rules ------------------------------------------------------------------------------
    public static $rules = array(
        'razao_social'   => 'required',
        'nome_fantasia'  => 'required',
        'cnpj_cpf'       => 'required'
    );

    //Relations ------------------------------------------------------------------------------
    public function contato()
    {
        return $this->morphMany('Grafix\Models\Contato', 'contato_morph');
    }

    public function endereco()
    {
        return $this->morphOne('Grafix\Models\Endereco', 'endereco_morph');
    }

    public function contatoPrincipal()
    {
        return $this->morphOne('Grafix\Models\Contato', 'contato_morph')
            ->where('contato_principal', '=', 1);
    }

    /** ***************************************************************************************************************
     * Valida Usuario
     */
    public static function validar($input) {
        $validator = \Validator::make($input, Cliente::$rules);

        return $validator;
    }
}