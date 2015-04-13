<?php namespace Grafix\Http\Controllers;

use Grafix\User;
use Grafix\Contato;
use Grafix\Endereco;

use Illuminate\Http\Request;

class UsersController extends Controller
{

    /**
     * Método construtor
     */
    public function __construct()
    {
        $this->middleware('auth');

        \View::share('className', 'Usuários');
        $grupos = \DB::table('grupos')->orderBy('grupo', 'asc')->lists('grupo', 'grupo');
        $grupos =  array_merge([null => 'Selecione um grupo...'],  $grupos);
        \View::share('grupos', $grupos);
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

        if($validaUser->fails() || $validaEndereco->fails() || $validaContato->fails()){
            \Toastr::warning('Ocorreu uma falha ao validar o cadastro!', 'Atenção');
            return \Redirect::back()
                ->withErrors(array_merge_recursive(
                    $validaUser->messages()->toArray(),
                    $validaContato->messages()->toArray(),
                    $validaEndereco->messages()->toArray()
                ))
                ->withInput();
        }

        //Cria novas entidades e preenche os atributos
        $user = new User();
        $user->fill(\Input::all());
        $contato = new Contato();
        $contato->fill(\Input::all());
        $endereco = new Endereco();
        $endereco->fill(\Input::all());

        //Abre a transaction
        \DB::beginTransaction();

        try {

            $user->save();
            $user->contato()->save($contato);
            $user->endereco()->save($endereco);

            \DB::commit();

            \Toastr::info('Usuário ' . $contato->nome . ' gravado com sucesso', 'Sucesso');
            return \Redirect::to('usuarios');

        } catch(\Exception $e) {
            //lança erro no log
            \Log::alert('Ocorreu um erro ao salvar a entidade: ['
                . $e->getCode() . '] ->  ' . $e->getMessage());

            //efetua roolback na transaction
            \DB::rollback();

            //redireciona para pagina
            return \Redirect::back();
        }

    }

    /**
     * Exibe form para atualizar usuario
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function getAtualiza($id)
    {
        $user = User::find($id);

        if(!$user) {
            \Toastr::info('Usuário não encontrado, tente novamente', 'Atualiza usuário');
            return redirect('usuarios');
        }

        return view('usuarios.atualiza', ['user'=>$user, 'page_title'=>'Atualiza usuário: ' . $user->contato->nome]);
    }

    /**
     * Atualiza usuario no BD
     * @param $id
     */
    public function putAtualiza($id)
    {
        $validaUser = User::validaUsuario(\Input::all());
        $validaContato = Contato::validaContato(\Input::all());
        $validaEndereco = Endereco::validaEndereco(\Input::all());

        if($validaUser->fails() || $validaEndereco->fails() || $validaContato->fails()){
            \Toastr::warning('Ocorreu uma falha ao validar o cadastro!', 'Atenção');
            return \Redirect::back()
                ->withErrors(array_merge_recursive(
                    $validaUser->messages()->toArray(),
                    $validaContato->messages()->toArray(),
                    $validaEndereco->messages()->toArray()
                ))
                ->withInput();
        }

        //Cria novas entidades e preenche os atributos
        $user = User::find($id);
        $user->fill(\Input::all());
        $user->contato->fill(\Input::all());
        $user->endereco->fill(\Input::all());

        //Abre a transaction
        \DB::beginTransaction();

        try {

            $user->push();

            \DB::commit();

            \Toastr::info('Usuário ' . $user->contato->nome . ' gravado com sucesso', 'Sucesso');
            return \Redirect::to('usuarios');

        } catch(\Exception $e) {
            //lança erro no log
            \Log::alert('Ocorreu um erro ao salvar a entidade: ['
                . $e->getCode() . '] ->  ' . $e->getMessage());

            //efetua roolback na transaction
            \DB::rollback();

            //redireciona para pagina
            return \Redirect::back();
        }
    }

    /**
     * Abre ficha de usuario
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function getFicha($id)
    {
        $user = User::find($id);

        if(!$user) {
            \Toastr::info('Usuário não encontrado, tente novamente', 'Ficha de usuário');
            return redirect('usuarios');
        }
        return view('usuarios.ficha', array('user' => $user, 'page_title'=>'Ficha de usuário nº ' . $user->id));
    }

    /**
     * ALtera senha de usuário
     * @param $id id do usuário
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function putAlteraSenha($id)
    {

        $user = User::find($id);

        if(!$user) {
            $response = array(
                'fail'   => true,
                'mensagem'  => 'Usuário não encontrado. Tente novamente!'
            );
        } else {

            if(!\Hash::check(\Input::get('senha_atual'), $user->password)) {
                $response = array(
                    'fail'   => true,
                    'mensagem'  => 'Senha atual não coincide. Tente novamente!'
                );
            } else {

                $user->password = \Input::get('nova_senha');

                \DB::transaction(function() use ($user) {
                    $user->save();
                });

                $response = array(
                    'success'   => true,
                    'mensagem'  => 'Senha alterada com sucesso. Você será deslogado para logar com a nova senha!'
                );
            }
        }



        return \Response::json($response);
    }

}
