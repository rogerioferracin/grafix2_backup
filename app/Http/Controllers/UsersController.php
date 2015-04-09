<?php namespace Grafix\Http\Controllers;

use Grafix\User;
use Grafix\Contato;
use Grafix\Endereco;

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
        $validaUser = User::validaUsuario(\Input::all());
        $validaContato = Contato::validaContato(\Input::all());
        $validaEndereco = Endereco::validaEndereco(\Input::all());

        if($validaUser->fails() || $validaEndereco->fails() || $validaContato){
            \Toastr::warning('Ocorreu uma falha ao validar o cadastro!', 'Atenção');
            return \Redirect::back()
                ->withErrors(array_merge_recursive(
                    $validaUser->messages()->toArray(),
                    $validaContato->messages()->toArray(),
                    $validaEndereco->messages()->toArray()
                ))
                ->withInput();
        }

        //TODO Terminar cadastro

    }

}
