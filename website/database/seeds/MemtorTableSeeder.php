<?php

use Illuminate\Database\Seeder;

class MemtorTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		factory(App\Models\Memtor::class, 20)->create();
	}
}
