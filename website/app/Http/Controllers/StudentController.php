<?php

namespace App\Http\Controllers;

use App\Models\Academy;
use App\Models\Activity;
use App\Models\Memtor;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller {
	public function __construct() {
		$this->middleware('studentauth', ['only' => ['voteAction']]);
	}
	public function getLogin() {
		$activity = Activity::select('is_expired')->first();
		if ($activity->is_expired) {
			return redirect('/scut/result');
		}
		return view('html.login');
	}
	/**
	 * login authentication.
	 *
	 * @param  Request  $request [$student_num $password]
	 * @return Response redirect or json
	 */
	public function login(Request $request) {
		$student_num = $request->input('student_num');
		$password = $request->input('password');
		$stu = Student::where('student_num', $student_num)->first();
		if ($stu) {
			if ($stu->password == md5($password)) {
				$request->session()->put('student_auth', $stu->id);
				return response()->json([
					"status" => true,
					"locate_url" => url('/scut/index'),
				]);
				// return redirect('/scut/index');
			}
		}
		// else {
		// 	// 此处调用API，判断账号密码是否正确
		// 	if ('正确') {
		// 		$stu = Student::create([
		// 			'student_num' => $student_num,
		// 			'password' => md5($password),
		// 			'name' => $name,
		// 		]);
		// 		$request->session()->put('student_auth', $stu->id);
		// 		// return redirect('/scut/index');
		// 		return response()->json([
		// 			"status" => true,
		// 			"locate_url" => url('/scut/index'),
		// 		]);
		// 	}
		// }
		return response()->json([
			"status" => false,
			"msg" => "account or password invalid",
		]);
	}
	public function logout(Request $request) {
		$request->session()->forget('student_auth');
		return redirect('/scut/statistic');
	}
	/**
	 * vote by student.
	 *
	 * @param  Request  $request [$account $password]
	 * @return Response redirect or json
	 */
	public function voteAction(Request $request) {
		$stu = Student::find($request->session()->get('student_auth'));
		if ($stu->has_voted) {
			return response()->json([
				"status" => false,
				"msg" => "您已投过票，请勿重复投票",
			]);
		} else {
			// 投票
			$mids = $request->input('ids');
			foreach ($mids as $mid) {
				$stu->memVotes()->attach($mid,
					['created_at' => date('Y-m-d H:i:s', time()),
						'updated_at' => date('Y-m-d H:i:s', time())]);
			}

			// 更新教师票数
			Memtor::whereIn('id', $mids)->increment('votes_num');
			// 更新学院票数
			$memtors = Memtor::whereIn('id', $mids)->get();
			foreach ($memtors as $memtor) {
				$academy = Academy::find($memtor->academy_id);
				$votesNum = $academy->memtors()->sum('votes_num');
				$academy->update(['votes_num' => $votesNum]);
			}
			$stu->update(['has_voted' => 1]); //标记
		}
		return response()->json([
			"status" => true,
			"locate_url" => url('/scut/statistic'),
		]);
		// return redirect('/scut/statistic');
	}

}
