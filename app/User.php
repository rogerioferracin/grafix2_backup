<?php namespace Grafix;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;

	//Relations ------------------------------------------------------------------------------
	public function contatos()
	{
		return $this->morphOne('Contato', 'contato_morph');
	}

	//Validação ------------------------------------------------------------------------------
	public static $rules = array(
		'username' => 'required',
		'email' => 'required|email',
		'password' => 'required|confirmed'
	);

    public static $messages = array(
        'password.required' => 'O campo <b>senha</b> deve ser preenchido',
        'password.confirmed' => 'O <b>confirma senha</b> não coincide.'
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
	protected $fillable = ['username', 'email', 'password'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

    /** ***************************************************************************************************************
     * Valida Usuario
     */
    public static function validaUsuario($input) {
        $validator = \Validator::make($input, User::$rules, User::$messages);

        return $validator;
    }

}
