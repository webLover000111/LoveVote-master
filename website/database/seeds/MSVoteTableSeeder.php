<?php

use App\Models\Academy;
use App\Models\Memtor;
use Illuminate\Database\Seeder;

class MSVoteTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		factory(App\Models\MSVote::class, 200)->create();
		$memtors = Memtor::with('stuVotes')->get();
		foreach ($memtors as $memtor) {
			$memtor->update(['votes_num' => $memtor->stuVotes()->count()]);
		}
		$academies = Academy::with('memtors')->get();
		foreach ($academies as $academy) {
			$academy->update(['votes_num' => $academy->memtors()->sum('votes_num')]);
		}
	}
}
