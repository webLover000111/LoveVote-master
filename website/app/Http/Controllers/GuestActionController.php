<?php

namespace App\Http\Controllers;

use App\Models\Academy;
use App\Models\Activity;
use App\Models\Memtor;
use App\Models\MSComment;
use App\Models\Student;
use App\Models\Webimage;
use Cache;
use Illuminate\Http\Request;

class GuestActionController extends Controller {

	/**
	 * show all memtors for voting.
	 *
	 * @return $datas,$totalVotes
	 */
	public function showMemtors(Request $request) {
		$datas = Cache::get('vote_memtors_shuffle', NULL);
		if (!count($datas)) {
			$memtors = Memtor::select('id', 'name', 'votes_num', 'photo_url', 'academy_id')->get();
			$datas = $memtors->map(function ($item, $key) {
				$item->inistitute = Academy::where('id', $item->academy_id)->value('name');
				return $item;
			});
			$datas = $datas->shuffle();
			Cache::put('vote_memtors_shuffle', $datas, 30);
		}
		// 活动是否过期
		$msg = "投票火热进行中";
		$activity = Activity::select('is_expired')->first();
		if ($activity->is_expired) {
			$msg = "投票已结束";
		}
		// 是否已登录
		$login = false;
		$name = NULL;
		if ($request->session()->has('student_auth')) {
			$login = true;
			$name = Student::where('id', $request->session()->get('student_auth'))->value('name');
		}
		// 轮播图片
		$ttimage = Webimage::where('image_type', 'tt')->select('image_url')->get();
		// 背景图片
		$bgimage = Webimage::where('image_type', 'bg')->select('image_url')->first();
		// return response()->json(compact('datas', 'msg', 'login', 'name', 'ttimage', 'bgimage'));
		return view('index', compact('datas', 'msg', 'login', 'name', 'ttimage', 'bgimage'));
	}
	/**
	 * show a specified memtor
	 *
	 * @param Request  $request [$id,$page,$pagesize]
	 * @return $data,$totalVotes
	 */
	public function memtorDetail($id, Request $request) {
		$memtor = Memtor::find($id);
		// 一页显示6条评论
		$pagesize = $request->input('pagesize', 6);
		// 第几页
		$page = $request->input('page', 1);
		$page = $page <= 0 ? 1 : $page; //不用担心 上一页
		$count = ceil($memtor->comments()->count() / $pagesize); // 总页数
		$page = $page > $count ? $count : $page; //不用担心 下一页
		// 计算偏移量
		$offset = $pagesize * ($page - 1);
		// 分页获取评论
		$comments = $memtor->comments()
			->with('student')
			->orderBy('created_at', 'desc')
			->skip($offset)->take($pagesize)->get();
		$comments = $comments->map(function ($item, $key) {
			if ($item->is_anonym) {
				$item->writer = '匿名用户';
				$item->stu_num = NULL;
			} else {
				$item->writer = $item->student->name;
				$item->stu_num = $item->student->student_num;
			}
			return $item;
		});
		// 教师信息
		$memtor->insititute = $memtor->academy->name;
		$login = false;
		$name = NULL;
		if ($request->session()->has('student_auth')) {
			$login = true;
			$name = Student::where('id', $request->session()->get('student_auth'))->value('name');
		}
		// 背景图片
		$bgimage = Webimage::where('image_type', 'bg')->select('image_url')->first();
		// return response()->json(compact('comments', 'memtor', 'count', 'page', 'login', 'name', 'bgimage'));
		return view('html.teacherInfo', compact('comments', 'memtor', 'count', 'page', 'login', 'name', 'bgimage'));
	}
	/**
	 * Display a list of comment.
	 *
	 * @param Request  $request [$page,$pagesize]
	 * @return $data,$totalVotes
	 */
	public function studentComment(Request $request) {
		// 一页显示10条评论
		$pagesize = $request->input('pagesize', 10);
		// 第几页
		$page = $request->input('page', 1);
		$page = $page <= 0 ? 1 : $page; //不用担心 上一页
		$count = ceil(MSComment::count() / $pagesize); // 总页数
		$page = $page > $count ? $count : $page; //不用担心 下一页
		// 计算偏移量
		$offset = $pagesize * ($page - 1);
		$comments = MSComment::orderBy('created_at', 'desc')
			->with('memtor', 'student')
			->skip($offset)->take($pagesize)->get();
		$comments = $comments->map(function ($item, $key) {
			if ($item->is_anonym) {
				$item->writer = '匿名';
				$item->stu_num = NULL;
			} else {
				$item->writer = $item->student->name;
				$item->stu_num = $item->student->student_num;
			}
			$item->photo_url = $item->memtor->photo_url;
			$item->mem_name = $item->memtor->name;
			return $item;
		});
		$login = false;
		$name = NULL;
		if ($request->session()->has('student_auth')) {
			$login = true;
			$name = Student::where('id', $request->session()->get('student_auth'))->value('name');
		}
		// 背景图片
		$bgimage = Webimage::where('image_type', 'bg')->select('image_url')->first();
		// return response()->json(compact('comments', 'count', 'page'));
		return view('html.message', compact('comments', 'count', 'page', 'login', 'name', 'bgimage'));
	}
	/**
	 * Display result of votes.
	 *
	 * @param $order[asc/desc],$mode[teacher/academy]
	 * @return $data,$totalVotes
	 */
	public function statisticVotes(Request $request) {
		$totalStuds = 0;
		$totalVotes = 0;
		// avoid repeat find in DB
		if ($request->session()->has('totalVotes')) {
			$totalStuds = $request->session()->get('totalStuds');
			$totalVotes = $request->session()->get('totalVotes');
		} else {
			$totalStuds = Student::count();
			$totalVotes = Memtor::sum('votes_num');
			$request->session()->put('totalVotes', $totalVotes);
			$request->session()->put('totalStuds', $totalStuds);
		}
		$mode = $request->input('mode', 'teacher');
		$order = $request->input('order', 'desc'); //'asc' or 'desc'
		$datas = 0;
		if ($mode == 'teacher') {
			$datas = Memtor::select('name', 'votes_num')->orderBy('votes_num', $order)->get();
		} else {
			$datas = Academy::select('name', 'votes_num')->orderBy('votes_num', $order)->get();
		}
		// 是否已登录
		$login = false;
		$name = NULL;
		if ($request->session()->has('student_auth')) {
			$login = true;
			$name = Student::where('id', $request->session()->get('student_auth'))->value('name');
		}
		// 背景图片
		$bgimage = Webimage::where('image_type', 'bg')->select('image_url')->first();
		// return response()->json(compact('datas', 'totalVotes', 'totalStuds', 'name', 'login', 'bgimage'));
		return view('html.votesCount', compact('datas', 'totalVotes', 'totalStuds', 'name', 'login', 'bgimage'));
	}
	/**
	 * Display result of votes.
	 *
	 * @param $order[asc/desc],$mode[teacher/academy]
	 * @return $data,$totalVotes
	 */
	public function result(Request $request) {
		$bgimage = Webimage::where('image_type', 'bg')->select('image_url')->first();
		// 是否已登录
		$login = false;
		$name = NULL;
		if ($request->session()->has('student_auth')) {
			$login = true;
			$name = Student::where('id', $request->session()->get('student_auth'))->value('name');
		}
		$activity = Activity::select('is_expired', 'end_at')->first();
		if (!$activity->is_expired) {
			return view('html.result', compact('bgimage', 'login', 'name', 'activity'));
		}
		$memtors = Memtor::select('name', 'academy_id')
			->orderBy('votes_num', 'desc')
			->take(3)->get();
		$memtors = $memtors->map(function ($item, $key) {
			$item->institute = Academy::where('id', $item->academy_id)->value('name');
			return $item;
		});
		return view('html.result', compact('bgimage', 'login', 'name', 'memtors', 'activity'));
	}
}
