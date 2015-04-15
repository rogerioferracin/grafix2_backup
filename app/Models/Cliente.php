<?php namespace Grafix\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
    //protected ------------------------------------------------------------------------------
    protected $table = 'clientes';

    protected $fillable = ['razao_social', 'nome_fantasia', 'cnpj_cpf', 'ie_rg', 'im', 'ativo', 'observacoes'];

    //Softdelete -----------------------------------------------------------------------------
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    //validation ------------------------------------------------------------------------------
    public static function rules($id) {
        return array(
            'razao_social'   => 'required',
            'nome_fantasia'  => 'required',
            'cnpj_cpf'       => 'required|cnpj_cpf|uniqueCnpjCpf:clientes,cnpj_cpf' . ($id ? ",$id" : ''),
        );
    }


    public static $messages = array(
        'cnpj_cpf'                      => '<b>CNPJ/CPF</b> é inválido.',
        'cnpj_cpf.unique_cnpj_cpf'      => '<b>CNPJ/CPF</b> já consta no banco de dados.'
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
     * Valida Cliente
     * @param $input
     * @param null $id
     * @return \Illuminate\Validation\Validator
     */
    public static function validar($input, $id = null) {
        $validator = \Validator::make($input, Cliente::rules($id), Cliente::$messages);

        return $validator;
    }

    //Mutators ------------------------------------------------------------------------------
    public function setCnpjCpfAttribute($value){
        $value = preg_replace('/\D/', '', $value);

        $this->attributes['cnpj_cpf'] = $value;
    }

    public function getCnpjCpfAttribute()
    {
        $value = $this->attributes['cnpj_cpf'];

        if(strlen($value) === 11) {
            $value = substr($value, 0, 3) . '.';
            return $value;
        } elseif(strlen($value) === 14) {
            $value = substr($value, 0, 2) . '.' .
                    substr($value, 2, 3) . '.' .
                    substr($value, 5, 3) . '/' .
                    substr($value, 8, 4) . '-' .
                    substr($value, 12, 2);

            return $value;
        } elseif(strlen($value) === 6) {
            $value = substr($value, 0, 3) . '.' . substr($value, 3, 3);
            return $value;
        } else {
            return '';
        }
    }

}