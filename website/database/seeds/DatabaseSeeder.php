<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		Model::unguard();
		$this->call(AdminTableSeeder::class);
		$this->call(ActivityTableSeeder::class);
		$this->call(AcademyTableSeeder::class);
		$this->call(MemtorTableSeeder::class);
		$this->call(StudentTableSeeder::class);
		$this->call(MSCommentTableSeeder::class);
		$this->call(MSVoteTableSeeder::class);
		$this->call(WebimageTableSeeder::class);
		Model::reguard();
	}
}
