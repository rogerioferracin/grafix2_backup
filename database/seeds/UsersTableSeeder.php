<?php

use Grafix\Contato;
use Grafix\Endereco;
use Grafix\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder {

    public function run()
    {
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