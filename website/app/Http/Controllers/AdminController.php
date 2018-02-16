<?php

namespace App\Http\Controllers;

use App\Admin;
use Auth;
use Illuminate\Http\Request;

class AdminController extends Controller {
	public function getLogin() {
		$location = url("/Admin/index.html");
		// header("Location:$location");
		return redirect($location);
		// return view('test.login');
		// return view('管理员登录界面');
	}
	/**
	 * login authentication.
	 *
	 * @param  Request  $request [$account $password]
	 * @return Response redirect or json
	 */
	public function login(Request $request) {
		$account = $request->input('account');
		$passwd = $request->input('password');
		// 用户名登录认证
		if (Auth::attempt(['name' => $account, 'password' => $passwd])) {
			// return view('test.login');
			// return redirect("管理员首页界面");
			return response()->json([
				'status' => true,
				'msg' => 'succeed',
			]);
		}
		return response()->json([
			'status' => false,
			'msg' => 'account or password invalid',
		]);
	}
	public function logout(Request $request) {
		Auth::logout();
		return response()->json([
			'status' => true,
			'msg' => 'succeed',
		]);
		// return redirect('/admin/login');
	}

	// 以下方法目前的需求不需要用到
	private function store(array $user_data) {
		Admin::create([
			'name' => $user_data['name'],
			'email' => $user_data['email'],
			'password' => bcrypt($user_data['password']),
		]);
	}
	public function create(Request $request) {
		$thist->validate($request, [
			'name' => 'required',
			'email' => 'required',
			'password' => 'required|min:6',
		]);
		$this->store($request->all());
		return response()->json([
			'status' => true,
			'msg' => 'register success',
		]);
	}
	/**
	 * Update the specified resource in storage.
	 *
	 * @param  Request  $request
	 * @return Response
	 */
	public function update(Request $request) {
		// 用户认证
		$user = Auth::user();
		if (!$user) {
			return Response()->json([
				'status ' => false,
				'msg' => 'no login',
			]);
		}

		$this->validate($request, [
			'name' => 'required',
			'email' => 'required',
		]);

		// 更新属性;
		$user->name = $request->input('name');
		$user->email = $request->input('email');
		// 保存更新到数据库
		$user->save();
		return response()->json([
			'status' => true,
			'msg' => 'update success',
		]);
	}
	// 获取当前用户信息，包括用户名和邮箱
	public function fetch(Request $request) {
		$user = Auth::user();
		if ($user) {
			return response()->json([
				'name' => $user->name,
				'email' => $user->email,
			]);
		} else {
			return response()->json([
				'status' => false,
				'msg' => 'auth fails',
			]);
		}

	}

	public function getToken(Request $request) {
		$user = Auth::user();
		if ($user) {
			$access_token = AdminTokenVerify::_createToken($user);
			return response()->json([
				'status' => true,
				'access_token' => $access_token,
				'expires_in' => 3600,
			]);
		}

		return response()->json([
			'status' => false,
			'errmsg' => 'invalid user,please login!',
		]);

	}
}
