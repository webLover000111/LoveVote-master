<?php

use Illuminate\Database\Seeder;

class StudentTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		factory(App\Models\Student::class, 25)->create();
	}
}
