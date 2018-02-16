<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Student;
use App\Models\Webimage;
use App\Services\UploadManager;
use Illuminate\Http\Request;
use Validator;

class ActivityController extends Controller {
	public function __construct() {
		$this->middleware('auth', ['except' => ['index']]);
	}
	/**
	 * Display a listing of the activity.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request) {
		$activity = Activity::select('title', 'begin_at', 'video_url', 'introduction')->first();
		// 是否已登录
		$login = false;
		$name = NULL;
		if ($request->session()->has('student_auth')) {
			$login = true;
			$name = Student::where('id', $request->session()->get('student_auth'))->value('name');
		}
		// 背景图片
		$bgimage = Webimage::where('image_type', 'bg')->select('image_url')->first();
		// return response()->json(compact('activity'));
		return view('html.activityIntroduction', compact('activity', 'login', 'name', 'bgimage'));
	}
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		$activity = Activity::first();
		return response()->json(compact('activity'));
	}
	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request, UploadManager $uploader) {
		$validator = Validator::make($request->all(), [
			'begin_at' => 'required', 'end_at' => 'required',
			'file' => 'required', 'introduction' => 'required',
			'title' => 'required']);
		if ($validator->fails()) {
			return response()->json([
				'status' => false,
				'msg' => 'all information is required']);
		}
		$param = $uploader->upload($request, 'upload_video');
		if (!$param['status']) {
			return response()->json([
				'status' => false,
				'msg' => $param['msg']]);
		}
		$input = $request->except('file');
		$input['video_url'] = $param['file_path'];
		$activity = Activity::create($input);
		return response()->json(compact('activity'));
		// return redirect('/activity/create');
	}
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit() {
		$activity = Activity::first();
		return response()->json(compact('activity'));
		// return view('活动编辑页面', compact('activity'));
	}
	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, UploadManager $uploader) {
		$input = $request->except('file');
		if ($request->has('file')) {
			$param = $uploader->upload($request, 'upload_video');
			if (!$param['status']) {
				return response()->json([
					'status' => false,
					'msg' => $param['msg']]);
			}
			$input['video_url'] = $param['file_path'];
		}
		if (!empty($input)) {
			$activity = Activity::first();
			if ($request->has('file')) {
				$uploader->delete($activity->video_url);
			}
			if (Activity::where('id', $activity->id)->update($input)) {
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
}
