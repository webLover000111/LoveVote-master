<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<!--allow the mobile devices to enlarge in twice on the page-->
	<meta name="viewport" content="target-densitydpi=device-dpi,width=980,user-scalable=yes,max-scale=2" />
	<title>欢迎登陆最喜爱导师评选网站</title>
	<link rel="stylesheet" href="/lib/normalize.css">
	<link rel="stylesheet" href="/css/style.css">
	<script src="/lib/jquery-2.1.4.min.js"></script>
</head>
<body>
<!--the picture on the top of the page-->
<div id="top">
	<img src="{{$bgimage->image_url}}" alt="top-pic" id="topPic">

</div>

<!--the navigation of the page-->
<div id="nav">
<input type="hidden" value="0" id="loginVal">
	<ul>
	<!--让url失效-->
		<li><a href ="/scut/index" ><span>投票系统</span></a></li>
		<li><a href="/scut/activity"><span>活动介绍</span></a></li>
		<li><a href="/scut/comment" ><span>学生留言</span></a></li>
		<li><a href="/scut/statistic"><span>投票统计</span></a></li>
		<li><a href="javascript:return false;" class="navActive"><span>评选结果</span></a></li>
		<!--询问是否后台登录，根据登陆与否返回内容,若为未登录点击出现登陆弹窗，否则没有效果-->
		@if($login==false)
		<li id="login" title="登陆后才能投票和留言哦！"><a><span>登&nbsp&nbsp陆</span></a></li>
		@elseif($login==true)
		<li id="unlogin" title="您已登录,点这里登出！"><a><span>你好，{{$name}}!</span></a></li>
		@endif
	</ul>



<script type="text/javascript">
//登出提交
$("#unlogin").click(function(url){
    var myurl="/student/logout";
    window.location.href=myurl;
});
//登陆提交
$("#login").click(function(){
    var myurl="/student/login";
    window.location.href=myurl;
});
</script>



</div>


<!--the content of the page-->


<div class="table">
<div class=" tableRow">
	<div class="tableCell cell1">
		<div class="left aside"></div>
	</div>



<div class="tableCell cell2">
<div class="replace">
<!--这里需要一个接口询问是否到了公布结果日期-->
<p class="itemTitle">投票结果</p>
@if($activity->is_expired==0)

<div id="noResult">投票还在继续中，暂无结果，结果将于{{$activity->end_at}}公示</div>

@else
<div id="hasResult">
		<p id="resualtTitle">“我最爱的导师”评选活动已经结束，现将获奖名单予与公示</p>
		<table id="resultTable">
			<tr>
				<th>导师姓名</th>
				<th>所在单位</th>
			</tr>
			@foreach($memtors as $memtor)
			<tr>
				<td>{{$memtor->name}}</td>
				<td>{{$memtor->institute}}</td>
			</tr>
			@endforeach
		</table>
</div>
@endif
</div>
<div id="dividingLine"></div>
	<!--the footer of the page-->
	<footer>
		<p>主办单位：华南理工大学研究生团委、研究生会</p>
		<p>技术支持：华南理工大学微软俱乐部、百步梯学生创业中心</p>
	</footer>
	</div>


	<div class=" tableCell cell3">
		<div class="right aside"></div>
	</div>

</div>
</div>
<!--分享按钮-->
<div>
<script type="text/javascript" >
var hostUrl=window.location.host;
var shareUrl=hostUrl+'/scut/index';
var jiathis_config={
	siteNum:5,
	sm:"weixin,qzone,cqq,tqq,tsina",
	url:shareUrl,
	summary:"华南理工大学第八届“我最喜爱的导师”活动投票",
	title:"#华工# #投票# #最喜爱导师#",
	boldNum:3,
	showClose:true,
	shortUrl:true,
	hideMore:false
};
</script>
<script type="text/javascript" src="http://v3.jiathis.com/code_mini/jiathis_r.js?btn=r5.gif&move=0" charset="utf-8"></script>
<!-- JiaThis Button END -->
</div>


</body>
</html>