<?php namespace Grafix;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;


class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;

	//Relations ------------------------------------------------------------------------------
	public function contato()
	{
		return $this->morphOne('Grafix\Models\Contato', 'contato_morph');
	}

    public function endereco()
    {
        return $this->morphOne('Grafix\Models\Endereco', 'endereco_morph');
    }

	//Validação ------------------------------------------------------------------------------
	public static $rules = array(
		'username' => 'required',
		'email' => 'required|email',
		'grupo' => 'required',
		'password' => 'sometimes|required|confirmed'
	);

    public static $messages = array(
        'username.required' => 'O campo <b>nome de usuário</b> deve ser preenchido',
        'password.required' => 'O campo <b>senha</b> deve ser preenchido',
        'password.confirmed' => 'O <b>confirma senha</b> não coincide.',
        'grupo.required' => 'O <b>grupo</b> deve ser selecionado.'
    );

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['username', 'email', 'password', 'dica_senha', 'grupo'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

    /** ***************************************************************************************************************
     * Mutators
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = \Hash::make($value);
    }


    /** ***************************************************************************************************************
     * Valida Usuario
     */
    public static function validar($input) {
        $validator = \Validator::make($input, User::$rules, User::$messages);

        return $validator;
    }

}
