<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Webimage;
use App\Services\UploadManager;
use Illuminate\Http\Request;
use Validator;

class WebimageController extends Controller {
	public function __construct() {
		$this->middleware('auth');
	}
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		return view('管理员首页-更改样式页面');
	}
	/**
	 * 预览图片接口
	 * @param  Request       $request  [description]
	 * @param  UploadManager $uploader [description]
	 * @return [type]                  [description]
	 */
	public function previewImage(Request $request, UploadManager $uploader) {
		$validator = Validator::make($request->all(), ['file' => 'required']);
		if ($validator->fails()) {
			return response()->json([
				'status' => false,
				'msg' => 'file is required']);
		}
		$param = $uploader->upload($request, 'upload_image', true);
		if (!$param['status']) {
			return response()->json([
				'status' => false,
				'msg' => $param['msg']]);
		}
		return response()->json([
			'status' => true,
			'path' => url($param['file_path'])]);
	}
	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function uploadBackGround(Request $request, UploadManager $uploader) {
		$validator = Validator::make($request->all(), [
			'file' => 'required']);
		if ($validator->fails()) {
			return response()->json([
				'status' => false,
				'msg' => 'file is required']);
		}
		$param = $uploader->upload($request, 'upload_image');
		if (!$param['status']) {
			return response()->json([
				'status' => false,
				'msg' => $param['msg']]);
		}
		$webimage = Webimage::where('image_type', 'bg')->first();
		if (count($background)) {
			// 如果存在，要删除原有的
			$uploader->delete($webimage->image_url);
			// 更新文件路径
			$webimage->image_url = $param['file_path'];
			$webimage->save();
			// $webimage->update(['image_url' => $param['file_path']]);
		} else {
			// 如果不存在，创建
			Webimage::create([
				'image_url' => $param['file_path'],
				'image_type' => 'bg']);
		}
		return response()->json([
			'status' => true,
			'msg' => 'succeed']);

	}
	public function uploadTakeTurn(Request $request, UploadManager $uploader) {
		$validator = Validator::make($request->all(), [
			'file' => 'required', 'order' => 'required']);
		if ($validator->fails()) {
			return response()->json([
				'status' => false,
				'msg' => 'file and order is required']);
		}
		// order must be 1,2,3
		$order = $request->input('order');
		if ($order != 1 && $order != 2 && $order != 3) {
			return response()->json([
				'status' => false,
				'msg' => 'order must be 1 or 2 or 3']);
		}
		$param = $uploader->upload($request, 'upload_image');
		if (!$param['status']) {
			return response()->json([
				'status' => false,
				'msg' => $param['msg']]);
		}
		$webimage = Webimage::where('image_type', 'tt')->where('tt_order', $order)->first();
		if (count($webimage)) {
			// 如果存在，要删除原有的
			$uploader->delete($webimage->image_url);
			// 更新文件路径
			$webimage->image_url = $param['file_path'];
			$webimage->save();
			// $webimage->update(['image_url' => $param['file_path']]);
		} else {
			// 如果不存在，创建
			Webimage::create([
				'image_url' => $param['file_path'],
				'image_type' => 'tt',
				'tt_order' => $order]);
		}
		return response()->json([
			'status' => true,
			'msg' => 'succeed']);
	}
	public function uploadVideo(Request $request, UploadManager $uploader) {
		$validator = Validator::make($request->all(), [
			'file' => 'required']);
		if ($validator->fails()) {
			return response()->json([
				'status' => false,
				'msg' => 'file is required']);
		}
		$activity = Activity::select('video_url')->first();
		if (!count($activity)) {
			return response()->json([
				'status' => false,
				'msg' => '请先创建活动']);
		}
		$param = $uploader->upload($request, 'upload_video');
		if (!$param['status']) {
			return response()->json([
				'status' => false,
				'msg' => $param['msg']]);
		}

		$uploader->delete($activity->video_url);
		// 更新文件路径
		$activity->video_url = $param['file_path'];
		$webimage->save();
		// $webimage->update(['image_url' => $param['file_path']]);
		return response()->json([
			'status' => true,
			'msg' => 'succeed']);

	}
}
