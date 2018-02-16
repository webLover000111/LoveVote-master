<?php

use Illuminate\Database\Seeder;

class ActivityTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		factory(App\Models\Activity::class)->create();
	}
}
