<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateContatosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('contatos', function(Blueprint $table){
			$table->increments('id');
			$table->string('nome');
			$table->string('sobrenome');
			$table->string('cargo');
			$table->string('setor');
			$table->string('telefone');
			$table->string('celular');
			$table->string('email');
			$table->string('skype');
			$table->mediumText('observacoes');
			$table->date('aniversario');
			$table->boolean('lembrar_aniversario')->default(0);
            $table->boolean('contato_principal')->default(0);

			$table->integer('contato_morph_id')->unsigned();
			$table->string('contato_morph_type');

			$table->timestamps();
			$table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('contatos');
	}

}
