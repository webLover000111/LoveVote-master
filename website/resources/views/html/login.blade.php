<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="viewport" content="target-densitydpi=device-dpi,width=980,user-scalable=yes,max-scale=2" />
	<title>欢迎登陆</title>
	<link rel="stylesheet" href="/lib/normalize.css">
	<link rel="stylesheet" type="text/css" href="/css/login.css">
	<script src="/lib/jquery-2.1.4.min.js"></script>
</head>
<div id="loginDiv">
	<div id="formTop"></div>
	<form action="/student/login" method="POST" id="form">
	 	<input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
		<label for="studentId">学号：</label><!--限制输入必须为数字-->
		<input type="text" name="student_num" id="studentId" placeholder="请输入账号" onkeyup="value=value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))" >
		<br>
		<label for="psw">密码：</label>
		<input type="password" name="password" id="psw" placeholder="请输入密码">
		<input type="button" id="btn" value="登&nbsp陆">
	</form>
</div>
<script src="/js/login.js"></script>
</body>
</html>