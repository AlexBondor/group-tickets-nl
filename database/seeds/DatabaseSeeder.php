<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$start = Carbon::now();

		Model::unguard();

		$this->command->info('Seeding users table..');
		$this->call('UserTableSeeder');

		$this->command->info('Seeding destinations table..');
		$this->call('DestinationTableSeeder');

		$this->command->info('Seeding groups table..');
		$this->call('GroupTableSeeder');

		$end = Carbon::now();

		$dif = $end->diffForHumans($start);
		$this->command->info('Seeding started ' . $dif . '.');
	}

}
