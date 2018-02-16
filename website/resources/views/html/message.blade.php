<!DOCTYPE html>
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
<input type="hidden" value="{{$count}}" id="count">
<input type="hidden" value="{{$page}}" id="page">
	<ul>
	<!--让url失效-->
		<li><a href ="/scut/index" ><span>投票系统</span></a></li>
		<li><a href="/scut/activity"><span>活动介绍</span></a></li>
		<li><a href="javascript:return false;" class="navActive"><span>学生留言</span></a></li>
		<li><a href="/scut/statistic"><span>投票统计</span></a></li>
		<li><a href="/scut/result"><span>评选结果</span></a></li>
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
	<p class="itemTitle">留言区</p>
	<div>
	@foreach($comments as $comment)
		<div class="messagePic">
		<img src="{{$comment->photo_url}}" alt="">
		<p class="teacherName">{{$comment->mem_name}}</p>
		</div>
		<div class="messageText">
			<p><span><img src="/img/littlehead.jpg" alt="littlehead">&nbsp &nbsp &nbsp &nbsp </span><span>
			<!--如果是匿名就显示writer即匿名否则显示学号-->
			@if($comment->is_anonym==1)
			{{$comment->writer}}
			@else
			{{$comment->stu_num}}
			@endif
			</span>&nbsp &nbsp &nbsp &nbsp <span>{{$comment->created_at}}</span><div class="clear"></div></p>

			<div class="messageStuText"><p>{{$comment->content}}</p>
			</div>
			</div>
		@endforeach



		<div class="clear"></div>
		<div class="dashLine"></div>
		<div id="paging">
		<div id="pageLeft">共有{{$count}}页，每页10条</div>
		<ul id="pageRight">
			<li id="prev"><a>上一页</a></li>
			<li><ul id="pageNum">
				<li value="1"><a>1</a></li>
				<li value="2"><a>2</a></li>
				<li value="3"><a>3</a></li>
				<li value="4"><a>4</a></li>
				<li value="5"><a>5</a></li>
				<li >...</li>

			</ul></li>
			<li id="next"><a>下一页</a></li>
			<!--默认转到最后一页-->
			<li>转到第<input type="text" name="" value="{{$count}}" id="inputNum">页</li>
			<li id="goBtn"><button>GO</button></li>
		</ul>
		<div class="clear"></div>
		</div>


	</div>



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

	<script src="/js/paging.js"></script>
</body>
</html>