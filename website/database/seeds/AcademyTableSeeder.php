<?php

use App\Models\Academy;
// use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class AcademyTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		factory(App\Models\Academy::class, 28)->create();
		// DB::table('academies')->insert([
		// 	['name' => '机械与汽车工程学院'],
		// 	['name' => '建筑学院'],
		// 	['name' => '土木与交通学院'],
		// 	['name' => '电子与信息学院'],
		// 	['name' => '电力学院'],
		// 	['name' => '计算机科学与工程学院'],
		// 	['name' => '自动化科学与工程学院'],
		// 	['name' => '材料科学与工程学院'],
		// 	['name' => '环境与能源学院'],
		// 	['name' => '化学与化工学院'],
		// 	['name' => '轻工科学与工程学院'],
		// 	['name' => '食品科学与工程学院'],
		// 	['name' => '数学学院'],
		// 	['name' => '生物科学与工程学院'],
		// 	['name' => '物理与光电学院'],
		// 	['name' => '马克思主义学院'],
		// 	['name' => '工商管理学院'],
		// 	['name' => '外国语学院'],
		// 	['name' => '公共管理学院'],
		// 	['name' => '软件学院'],
		// 	['name' => '经济与贸易学院'],
		// 	['name' => '新闻与传播学院'],
		// 	['name' => '艺术学院'],
		// 	['name' => '法学院'],
		// 	['name' => '设计学院'],
		// 	['name' => '体育学院'],
		// 	['name' => '医学院'],
		// 	['name' => '工商管理学院MBA中心'],
		// ]);
		// Academy::create(['name' => '机械与汽车工程学院']);
		// Academy::create(['name' => '建筑学院']);
		// Academy::create(['name' => '土木与交通学院']);
		// Academy::create(['name' => '电子与信息学院']);
		// Academy::create(['name' => '电力学院']);
		// Academy::create(['name' => '计算机科学与工程学院']);
		// Academy::create(['name' => '自动化科学与工程学院']);
		// Academy::create(['name' => '材料科学与工程学院']);
		// Academy::create(['name' => '环境与能源学院']);
		// Academy::create(['name' => '化学与化工学院']);
		// Academy::create(['name' => '轻工科学与工程学院']);
		// Academy::create(['name' => '食品科学与工程学院']);
		// Academy::create(['name' => '数学学院']);
		// Academy::create(['name' => '生物科学与工程学院']);
		// Academy::create(['name' => '物理与光电学院']);
		// Academy::create(['name' => '马克思主义学院']);
		// Academy::create(['name' => '工商管理学院']);
		// Academy::create(['name' => '外国语学院']);
		// Academy::create(['name' => '公共管理学院']);
		// Academy::create(['name' => '软件学院']);
		// Academy::create(['name' => '经济与贸易学院']);
		// Academy::create(['name' => '新闻与传播学院']);
		// Academy::create(['name' => '艺术学院']);
		// Academy::create(['name' => '法学院']);
		// Academy::create(['name' => '设计学院']);
		// Academy::create(['name' => '体育学院']);
		// Academy::create(['name' => '医学院']);
		// Academy::create(['name' => '工商管理学院MBA中心']);
	}
}
