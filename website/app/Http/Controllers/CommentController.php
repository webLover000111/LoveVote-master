<?php

namespace App\Http\Controllers;

use App\Models\MSComment;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Validator;

class CommentController extends Controller {
	public function __construct() {
		$this->middleware('studentauth', ['only' => ['store']]);
		$this->middleware('auth', ['except' => ['store']]);
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @param $page,$pagesize
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request) {
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
			->with('student')
			->skip($offset)->take($pagesize)->get();
		$comments = $comments->map(function ($item, $key) {
			$item->writer = $item->student->name;
			$item->stu_num = $item->student->student_num;
			return $item;
		});
		return response()->json(compact('comments', 'count', 'page'));
		// return view('管理员-学生留言分页显示', compact('comments', 'count', 'page'));
	}

	/**
	 * create comment by student.
	 *
	 * @param  Request  $request [$mid,$is_anonym,$content]
	 * @return Response redirect or json
	 */
	public function store(Request $request) {
		$validator = Validator::make($request->all(), [
			'mid' => 'required', 'is_anonym' => 'required',
			'content' => 'required']);
		if ($validator->fails()) {
			return response()->json([
				'status' => false,
				'msg' => 'all information is required']);
		}
		$stu = Student::find($request->session()->get('student_auth'));
		// 评论
		$memtorId = $request->input('mid');
		$isAnonym = $request->input('is_anonym');
		$content = $request->input('content');
		$stu->memComments()->attach($memtorId,
			['is_anonym' => $isAnonym, 'content' => $content,
				'created_at' => date('Y-m-d H:i:s', time()),
				'updated_at' => date('Y-m-d H:i:s', time())]);
		return redirect('/scut/teacher/' . $memtorId);
	}
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function delete(Request $request) {
		$commentIds = $request->input('id');
		MSComment::destroy(array($commentIds));
		return response()->json([
			'status' => true,
			'msg' => 'succeed',
		]);
		// return redirect('/comment/index');
	}
}
