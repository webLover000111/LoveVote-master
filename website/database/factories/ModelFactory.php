<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
 */

$factory->define(App\Admin::class, function (Faker\Generator $faker) {
	return [
		'name' => 'MSC_vote',
		'email' => 'chenyqcn@foxmail.com',
		'password' => bcrypt('666#%SCU'),
		'remember_token' => str_random(20),
	];
});

$factory->define(App\Models\Activity::class, function (Faker\Generator $faker) {
	return [
		'title' => str_random(6),
		'begin_at' => date('Y-m-d', strtotime('2016-10-01')),
		'end_at' => date('Y-m-d', strtotime('2016-11-03')),
		'video_url' => "/upload/video/1.avi",
		'introduction' => $faker->sentence(mt_rand(3, 10)),
	];
});

$factory->define(App\Models\Memtor::class, function (Faker\Generator $faker) {
	$gender = array('男', '女');
	return [
		'academy_id' => mt_rand(1, 5),
		'name' => str_random(3),
		'gender' => $gender[mt_rand(0, 1)],
		'job_title' => str_random(8),
		'photo_url' => "/upload/photo/1.jpg",
		'introduction' => $faker->sentence(mt_rand(3, 10)),
		'recommend' => $faker->sentence(mt_rand(3, 10)),
		'short_comment' => $faker->sentence(mt_rand(1, 2)),
	];
});

$factory->define(App\Models\Student::class, function (Faker\Generator $faker) {
	return [
		'student_num' => mt_rand(201200000000, 201699999999),
		'password' => md5('test'),
		'name' => str_random(3),
		'has_voted' => 1,
	];
});

$factory->define(App\Models\MSComment::class, function (Faker\Generator $faker) {
	return [
		'memtor_id' => mt_rand(1, 10),
		'student_id' => mt_rand(1, 25),
		'is_anonym' => mt_rand(0, 1),
		'content' => $faker->sentence(mt_rand(1, 2)),
	];
});

$factory->define(App\Models\MSVote::class, function (Faker\Generator $faker) {
	return [
		'memtor_id' => mt_rand(1, 10),
		'student_id' => mt_rand(1, 25),
	];
});

$factory->define(App\Models\Academy::class, function (Faker\Generator $faker) {
	$academy_names = array('机械与汽车工程学院',
		'建筑学院',
		'土木与交通学院',
		'电子与信息学院',
		'电力学院',
		'计算机科学与工程学院',
		'自动化科学与工程学院',
		'材料科学与工程学院',
		'环境与能源学院',
		'化学与化工学院',
		'轻工科学与工程学院',
		'食品科学与工程学院',
		'数学学院',
		'生物科学与工程学院',
		'物理与光电学院',
		'马克思主义学院',
		'工商管理学院',
		'外国语学院',
		'公共管理学院',
		'软件学院',
		'经济与贸易学院',
		'新闻与传播学院',
		'艺术学院',
		'法学院',
		'设计学院',
		'体育学院',
		'医学院',
		'工商管理学院MBA中心');
	return [
		'name' => $faker->unique()->randomElement($academy_names),
		'votes_num' => 0,
	];
});

$factory->define(App\User::class, function (Faker\Generator $faker) {
	return [
		'name' => $faker->name,
		'email' => $faker->safeEmail,
		'password' => bcrypt(str_random(10)),
		'remember_token' => str_random(10),
	];
});