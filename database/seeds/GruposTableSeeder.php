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

    }

}