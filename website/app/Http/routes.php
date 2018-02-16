<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
 */
// 管理员页面的入口:/Admin/manage.html  后台管理部分的页面重定向由前端负责

Route::get('/', function () {
	return redirect('/scut/index');
});
//管理员认证
// Route::get('/admin/login', 'AdminController@getLogin');
Route::post('/admin/login', 'AdminController@login');
Route::get('/admin/logout', 'AdminController@logout');
// 后台管理，需通过认证
//  管理教师信息
Route::get('/memtor', 'MemtorController@index');
// Route::get('/memtor/create', 'MemtorController@create');
Route::post('/memtor/store', 'MemtorController@store');
Route::get('/memtor/{id}/edit', 'MemtorController@edit')
	->where('id', '[0-9]+');
Route::post('/memtor/{id}/update', 'MemtorController@update')
	->where('id', '[0-9]+');
Route::post('/memtor/{id}/delete', 'MemtorController@delete')
	->where('id', '[0-9]+');
//  管理活动信息
Route::get('/activity/create', 'ActivityController@create');
Route::post('/activity/store', 'ActivityController@store');
Route::get('/activity/edit', 'ActivityController@edit');
Route::post('/activity/update', 'ActivityController@update');
//  管理学生留言
Route::get('/comment/index', 'CommentController@index');
Route::post('/comment/delete', 'CommentController@delete');
//  管理背景图片和轮播图片
Route::post('/webimage/pre', 'WebimageController@previewImage');
Route::post('/webimage/bg', 'WebimageController@uploadBackGround');
Route::post('/webimage/tt', 'WebimageController@uploadTakeTurn');
Route::post('/webimage/video', 'WebimageController@uploadVideo');

//学生认证
Route::get('/student/login', 'StudentController@getLogin');
Route::post('/student/login', 'StudentController@login');
Route::get('/student/logout', 'StudentController@logout');
//学生操作，需通过认证
Route::post('/student/vote', 'StudentController@voteAction');
Route::post('/student/comment', 'CommentController@store');

//访客操作，不需认证
Route::get('/scut/index', 'GuestActionController@showMemtors');
Route::get('/scut/teacher/{id}', 'GuestActionController@memtorDetail')
	->where('id', '[0-9]+');
Route::get('/scut/activity', 'ActivityController@index');
Route::get('/scut/comment', 'GuestActionController@studentComment');
Route::get('/scut/statistic', 'GuestActionController@statisticVotes');
Route::get('/scut/result', 'GuestActionController@result');