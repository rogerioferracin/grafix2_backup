<?php namespace Grafix\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    //Fillable -------------------------------------------------------------------------------
    protected $fillable = array('nome', 'sobrenome', 'cargo', 'setor', 'telefone',
        'celular', 'email', 'skype', 'observacoes', 'contato_principal', 'aniversario', 'lembrar_aniversario');


    /** ***************************************************************************************************************
     * Valida contato
     */
    public static function validar($input)
    {
        $validator = \Validator::make($input, Contato::$rules);
        return $validator;
    }

    /**
     * MUTATORS
     */
    public function setAniversarioAttribute($value)
    {
        if($value) {
            $date = \DateTime::createFromFormat('d/m/Y', $value)->getTimestamp();
            $this->attributes['aniversario'] = date('Y-m-d', $date);
        } else {
            $this->attributes['aniversario'] = '';
        }
    }

    public function getAniversarioAttribute()
    {
        if($this->attributes['aniversario'] == '0000-00-00') {
            return '';
        } else {
            return date('d/m/Y', strtotime($this->attributes['aniversario']));
        }
    }

}
