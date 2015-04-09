<?php namespace Grafix;

use Illuminate\Database\Eloquent\Model;

class Contato extends Model {

    //Relations ------------------------------------------------------------------------------
    public function contato_morph()
    {
        return $this->morphTo();
    }

    //Table name -----------------------------------------------------------------------------
    public static $rules = array(
        'nome' => 'required',
        'telefone' => 'required',
    );

    //Table name -----------------------------------------------------------------------------
    protected $table = 'contatos';

    //Softdelete -----------------------------------------------------------------------------
    use \Illuminate\Database\Eloquent\SoftDeletes;
    protected $dates = ['deleted_at'];

    //Fillable -------------------------------------------------------------------------------
    protected $fillable = array('nome', 'sobrenome', 'cargo', 'setor', 'telefone',
        'celular', 'email', 'skype', 'observacoes', 'contato_principal', 'aniversario', 'lembrar_aniversario');


    /** ***************************************************************************************************************
     * Valida contato
     */
    public static function validaContato($input)
    {
        $validator = \Validator::make($input, Contato::$rules);
        return $validator;
    }

}
