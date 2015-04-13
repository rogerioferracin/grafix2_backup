<?php namespace Grafix\Http\Controllers;

class EnderecosController extends Controller
{
    /** ***************************************************************************************************************
     * Pesquisa endereços e retorna JSON para dataTable
     */
    function getPesquisaEndereco($pesquisa)
    {
        $data = \DB::table('ceps')
            ->where('cep', 'like', '%'.$pesquisa.'%')
            ->orWhere('logradouro', 'like', '%'.$pesquisa.'%')
            ->get();

        if($data) {
            $response = array(
                'success'   => true,
                'data'      => $data
            );
        } else {
            $response = array(
                'fail'   => true,
                'message'   => 'Nenhum resultado encontrado na pesquisa!'
            );
        }
        return \Response::json($response);
    }
}