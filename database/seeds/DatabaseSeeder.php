<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use database\seeds\GruposTableSeeder;
use Grafix\database\seedsUsersTableSeeder;


class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		 $this->call('GruposTableSeeder');
//		 $this->call('UsersTableSeeder');
	}

}
