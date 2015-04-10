<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Grafix\User;
use Grafix\Contato;
use Grafix\Endereco;

class GruposTableSeeder extends Seeder {

    public function run()
    {
        //delete old data
        DB::table('grupos')->delete();

        DB::table('grupos')->insert(array(
            array('grupo' => 'Administrador', 'detalhes' => 'Administrador do sistema'),
            array('grupo' => 'Financeiro', 'detalhes' => 'Responsável por faturamento, contas a pagar e receber'),
            array('grupo' => 'Produção', 'detalhes' => 'Usuário comum do sistema'),
            array('grupo' => 'Pré-impressão', 'detalhes' => 'Responsável por diagramação e área de pré impressão'),
            array('grupo' => 'Comercial', 'detalhes' => 'Responsável pelo atendimento ao cliente e vendas.'),
        ));

        //delete old data
        DB::table('users')->delete();

        $user = new User();
        $user->username = 'administrador';
        $user->grupo = 'Administrador';
        $user->password = 'admin';
        $user->email = 'admin@email.com';

        $contato = new Contato();
        $contato->nome = 'Administrador';
        $contato->telefone = '(12) 3322-8158';

        $endereco = new Endereco();
        $endereco->logradouro = 'Rua Dom Pedro II';
        $endereco->numero = '76';

        DB::transaction(function() use($user, $contato, $endereco) {
            $user->save();
            $user->contato()->save($contato);
            $user->endereco()->save($endereco);
        });

    }

}