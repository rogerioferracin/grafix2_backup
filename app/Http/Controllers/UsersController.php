<?php namespace Grafix\Http\Controllers;

use Grafix\User;

class UsersController extends Controller
{

    /**
     * Método construtor
     */
    public function __construct()
    {
        \View::share('className', 'Usuários');
    }


    /**
     * exibe lista de usuarios cadastrados
     * @return $this
     */
    public function getIndex()
    {
        $users = User::all();

        return \View::make('usuarios.index', compact('users'))
            ->with('page_title', 'Lista todos');
    }

    /**
     * Exibe form para cadastro de usuario
     * @return $this
     */
    public function getNovo() {
        return \View::make('usuarios.novo')
            ->with('page_title', 'Novo usuário');
    }

    /**
     * Grava novo usuário no banco
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postNovo()
    {
        $validator = \Validator::make(\Input::all(), User::$rules, User::$messages);

        if($validator->fails()){
            return \Redirect::back()
                ->withErrors($validator)
                ->withInput();
        }

    }
}
