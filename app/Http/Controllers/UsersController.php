<?php namespace Grafix\Http\Controllers;

class UsersController extends Controller
{

    /**
     * Método construtor
     */
    public function __construct()
    {
        \View::share('className', 'Usuarios');
    }


    /**
     * exibe lista de usuarios cadastrados
     * @return $this
     */
    public function getIndex()
    {
        $users = \Grafix\User::all();

        return \View::make('usuarios.index', compact('users'))
            ->with('page_title', 'Lista todos');
    }
}
