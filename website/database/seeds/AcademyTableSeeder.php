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
		// 	['name' => '��е����������ѧԺ'],
		// 	['name' => '����ѧԺ'],
		// 	['name' => '��ľ�뽻ͨѧԺ'],
		// 	['name' => '��������ϢѧԺ'],
		// 	['name' => '����ѧԺ'],
		// 	['name' => '�������ѧ�빤��ѧԺ'],
		// 	['name' => '�Զ�����ѧ�빤��ѧԺ'],
		// 	['name' => '���Ͽ�ѧ�빤��ѧԺ'],
		// 	['name' => '��������ԴѧԺ'],
		// 	['name' => '��ѧ�뻯��ѧԺ'],
		// 	['name' => '�Ṥ��ѧ�빤��ѧԺ'],
		// 	['name' => 'ʳƷ��ѧ�빤��ѧԺ'],
		// 	['name' => '��ѧѧԺ'],
		// 	['name' => '�����ѧ�빤��ѧԺ'],
		// 	['name' => '��������ѧԺ'],
		// 	['name' => '���˼����ѧԺ'],
		// 	['name' => '���̹���ѧԺ'],
		// 	['name' => '�����ѧԺ'],
		// 	['name' => '��������ѧԺ'],
		// 	['name' => '���ѧԺ'],
		// 	['name' => '������ó��ѧԺ'],
		// 	['name' => '�����봫��ѧԺ'],
		// 	['name' => '����ѧԺ'],
		// 	['name' => '��ѧԺ'],
		// 	['name' => '���ѧԺ'],
		// 	['name' => '����ѧԺ'],
		// 	['name' => 'ҽѧԺ'],
		// 	['name' => '���̹���ѧԺMBA����'],
		// ]);
		// Academy::create(['name' => '��е����������ѧԺ']);
		// Academy::create(['name' => '����ѧԺ']);
		// Academy::create(['name' => '��ľ�뽻ͨѧԺ']);
		// Academy::create(['name' => '��������ϢѧԺ']);
		// Academy::create(['name' => '����ѧԺ']);
		// Academy::create(['name' => '�������ѧ�빤��ѧԺ']);
		// Academy::create(['name' => '�Զ�����ѧ�빤��ѧԺ']);
		// Academy::create(['name' => '���Ͽ�ѧ�빤��ѧԺ']);
		// Academy::create(['name' => '��������ԴѧԺ']);
		// Academy::create(['name' => '��ѧ�뻯��ѧԺ']);
		// Academy::create(['name' => '�Ṥ��ѧ�빤��ѧԺ']);
		// Academy::create(['name' => 'ʳƷ��ѧ�빤��ѧԺ']);
		// Academy::create(['name' => '��ѧѧԺ']);
		// Academy::create(['name' => '�����ѧ�빤��ѧԺ']);
		// Academy::create(['name' => '��������ѧԺ']);
		// Academy::create(['name' => '���˼����ѧԺ']);
		// Academy::create(['name' => '���̹���ѧԺ']);
		// Academy::create(['name' => '�����ѧԺ']);
		// Academy::create(['name' => '��������ѧԺ']);
		// Academy::create(['name' => '���ѧԺ']);
		// Academy::create(['name' => '������ó��ѧԺ']);
		// Academy::create(['name' => '�����봫��ѧԺ']);
		// Academy::create(['name' => '����ѧԺ']);
		// Academy::create(['name' => '��ѧԺ']);
		// Academy::create(['name' => '���ѧԺ']);
		// Academy::create(['name' => '����ѧԺ']);
		// Academy::create(['name' => 'ҽѧԺ']);
		// Academy::create(['name' => '���̹���ѧԺMBA����']);
	}
}
