<?php namespace Grafix\Http\Controllers;

use Grafix\Models\Cliente;
use Grafix\Models\Endereco;
use Grafix\Models\Contato;

class ClientesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        \View::share('className', 'Clientes');
    }

    /** **************************************************************************************************************
     * Exibe clientes cadastrados ativos
     * @return \Illuminate\View\View
     */
    public function getIndex()
    {
        $clientes = Cliente::where('ativo', '=', 1)->get();

        return view('clientes.index', array(
            'page_title'=>'Lista clientes',
            'clientes'  => $clientes
            ));
    }

    /** **************************************************************************************************************
     * Exibe form de cadastro de cliente
     * @return \Illuminate\View\View
     */
    public function getNovo()
    {
        return view('clientes.novo', array('page_title'=>'Novo cliente'));
    }

    /** **************************************************************************************************************
     * Cadastra nov cliente no banco
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function postNovo()
    {

        //TODO validar CPF e CNPJ
        $validaCliente = Cliente::validar(\Input::all());
        $validaContato = Contato::validar(\Input::all());
        $validaEndereco = Endereco::validar(\Input::all());

        if($validaCliente->fails() || $validaContato->fails() || $validaEndereco->fails())
        {
            \Toastr::warning('Ocorreu uma falha ao validar o cadastro!', 'Atenção');
            return back()
                ->withErrors(array_merge_recursive(
                    $validaCliente->messages()->toArray(),
                    $validaContato->messages()->toArray(),
                    $validaEndereco->messages()->toArray()
                ))->withInput();
        }

        //Cria novas entidades e preenche os atributos
        $cliente = new Cliente();
        $cliente->fill(\Input::all());
//        dd($cliente->toArray());
        $contato = new Contato();
        $contato->fill(\Input::all());
        $contato->contato_principal = 1;
        $endereco = new Endereco();
        $endereco->fill(\Input::all());

        //Abre a transaction
        \DB::beginTransaction();

        try {

            $cliente->save();
            $cliente->contato()->save($contato);
            $cliente->endereco()->save($endereco);

            \DB::commit();

            \Toastr::info('Cliente ' . $cliente->nome_fantasia . ' gravado com sucesso', 'Sucesso');
            return \Redirect::to('clientes');

        } catch(\Exception $e) {
            //lança erro no log
            \Log::alert('Ocorreu um erro ao salvar a entidade: ['
                . $e->getCode() . '] ->  ' . $e->getMessage());

            //efetua roolback na transaction
            \DB::rollback();

            //redireciona para pagina
            \Toastr::error('Ocorreu um erro ao salvar a entidade', 'Erro');
            return \Redirect::to('clientes');
        }
    }
}
