<?php

namespace App\Http\Controllers;

use App\Models\Academy;
use App\Models\Memtor;
use App\Services\UploadManager;
use Illuminate\Http\Request;
use Validator;

class MemtorController extends Controller {
	public function __construct() {
		$this->middleware('auth');
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
		$count = ceil(Memtor::count() / $pagesize); // 总页数
		$page = $page > $count ? $count : $page; //不用担心 下一页
		// 计算偏移量
		$offset = $pagesize * ($page - 1);
		$memtors = Memtor::orderBy('created_at', 'desc')
			->select('id', 'name', 'photo_url', 'academy_id')
			->skip($offset)->take($pagesize)->get();
		$memtors = $memtors->map(function ($item, $key) {
			$item->institute = Academy::where('id', $item->academy_id)->value('name');
			return $item;
		});
		return response()->json(compact('memtors', 'count', 'page'));
		// return view('管理员首页-导师分页显示', compact('memtors', 'count', 'page'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		return view('管理员首页-添加导师');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request, UploadManager $uploader) {
		$validator = Validator::make($request->all(), [
			'name' => 'required', 'gender' => 'required',
			'job_title' => 'required', 'introduction' => 'required',
			'recommend' => 'required', 'short_comment' => 'required',
			'insititute' => 'required', 'file' => 'required']);

		if ($validator->fails()) {
			return response()->json([
				'status' => false,
				'msg' => $request->all()]);
		}
		$param = $uploader->upload($request, 'upload_photo');
		if (!$param['status']) {
			return response()->json([
				'status' => false,
				'msg' => $param['msg']]);
		}
		$academy = Academy::where('name', $request->input('insititute'))->select('id')->first();

		$input = $request->except('insititute', 'file');
		$input['academy_id'] = $academy->id;
		$input['photo_url'] = $param['file_path'];
		Memtor::create($input);
		return response()->json([
			'status' => true,
			'msg' => 'succeed',
		]);
		// return redirect('/memtor');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		$memtor = Memtor::find($id);
		$memtor->institute = $memtor->academy->name;
		return response()->json(compact('memtor'));
		// return view('导师信息编辑页面', compact('memtor'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id, UploadManager $uploader) {
		$id = $request->input('id');
		$input = $request->except('file', 'academy_name', 'id');
		if ($request->has('file') && $request->hasFile('file')) {
			$param = $uploader->upload($request, 'upload_photo');
			if (!$param['status']) {
				return response()->json([
					'status' => false,
					'msg' => $param['msg']]);
			}
			$input['photo_url'] = $param['file_path'];
		}
		if ($request->has('academy_name')) {
			$academy = Academy::where('name', $request->input('academy_name'))->select('id')->first();
			$input['academy_id'] = $academy->id;
		}
		if (!empty($input)) {
			if ($request->has('file') && $request->hasFile('file')) {
				$memtor = Memtor::find($id);
				$uploader->delete($memtor->photo_url);
			}
			if (Memtor::where('id', $id)->update($input)) {
				return response()->json([
					'status' => true,
					'msg' => 'update succeed']);
			} else {
				return response()->json([
					'status' => false,
					'msg' => 'update fail']);
			}
		}
		return response()->json([
			'status' => false,
			'msg' => 'nothing to update']);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function delete($id, UploadManager $uploader) {
		// $memtor = Memtor::where('id', $id)->first();
		$memtor = Memtor::find($id);
		if (!count($memtor)) {
			return response()->json([
				'status' => false,
				'msg' => 'can not find the mentor.',
			]);
		}

		$academy = Academy::find($memtor->academy_id);

		//delete mentor
		$uploader->delete($memtor->photo_url);
		Memtor::destroy($id); //foreign key  will delete MSVote

		//update Academy votes_num
		$votesNum = $academy->memtors()->sum('votes_num');
		$academy->update(['votes_num' => $votesNum]);
		return response()->json([
			'status' => true,
			'msg' => 'succeed',
		]);
		// return redirect('/memtor');
	}
}
