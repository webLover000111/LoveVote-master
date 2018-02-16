<?php

use App\Models\Webimage;
use Illuminate\Database\Seeder;

class WebimageTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		Webimage::create(['image_url' => '/upload/image/bg.jpg', 'image_type' => 'bg', 'tt_order' => 0]);
		Webimage::create(['image_url' => '/upload/image/1.jpg', 'image_type' => 'tt', 'tt_order' => 1]);
		Webimage::create(['image_url' => '/upload/image/2.jpg', 'image_type' => 'tt', 'tt_order' => 2]);
		Webimage::create(['image_url' => '/upload/image/3.jpg', 'image_type' => 'tt', 'tt_order' => 3]);
	}
}
