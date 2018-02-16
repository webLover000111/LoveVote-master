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
	 <!--Stylesheets-->
        <link rel="stylesheet" href="/css/styles.css">

        <!--jPlayer-->
		<script src="/js/jquery.jplayer.min.js"></script>
        <!--如果是ie9以下就要加载识别html5的文件-->
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
</head>
<body>
<!--the picture on the top of the page-->
<div id="top">
	<img src="{{$bgimage->image_url}}" alt="top-pic" id="topPic">

</div>

<!--the navigation of the page-->
<!--这里不同板块请求不同视图文件，要怎么实现呢？-->
<div id="nav">
<input type="hidden" value="0" id="loginVal">
	<ul>
		<li><a href ="/scut/index" ><span>投票系统</span></a></li>
		<li><a href="javascript:return false;" class="navActive""><span>活动介绍</span></a></li>
		<li><a href="/scut/comment"><span>学生留言</span></a></li>
		<li><a href="/scut/statistic"><span>投票统计</span></a></li>
		<li><a href="/scut/result"><span>评选结果</span></a></li>
		<!--询问是否后台登录，根据登陆与否返回内容-->
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
	<p class="itemTitle">活动介绍</p>
	<p id="activityTitle">{{$activity->title}}</p>
	<p id="uploadTime">发布时间：<a href="/scut/activity"><span>{{$activity->begin_at}}</span></a>&nbsp发布者：研委会</p>
	<div id="videoDiv">
		<!--container for everything-->
	<div id="jp_container_1" class="jp-video jp-video-360p">

		<!--container in which our video will be played-->
		<div id="jquery_jplayer_1" class="jp-jplayer"></div>

		<!--main containers for our controls-->
		<div class="jp-gui">
		    <div class="jp-interface">
		        <div class="jp-controls-holder">

					<!--play and pause buttons-->
				    <a href="javascript:;" class="jp-play" tabindex="1">play</a>
				    <a href="javascript:;" class="jp-pause" tabindex="1">pause</a>
				    <span class="separator sep-1"></span>

					<!--progress bar-->
				    <div class="jp-progress">
				        <div class="jp-seek-bar">
							<div class="jp-play-bar"><span></span></div>
						</div>
				    </div>

				    <!--time notifications-->
				    <div class="jp-current-time"></div>
				    <span class="time-sep">/</span>
				    <div class="jp-duration"></div>
				    <span class="separator sep-2"></span>

				    <!--mute / unmute toggle-->
				    <a href="javascript:;" class="jp-mute" tabindex="1" title="mute">mute</a>
				    <a href="javascript:;" class="jp-unmute" tabindex="1" title="unmute">unmute</a>

				    <!--volume bar-->
				    <div class="jp-volume-bar">
				        <div class="jp-volume-bar-value"><span class="handle"></span></div>
				    </div>
				    <span class="separator sep-2"></span>



		        </div><!--end jp-controls-holder-->
		    </div><!--end jp-interface-->
		</div><!--end jp-gui-->

		<!--unsupported message-->
		<div class="jp-no-solution">
		    <span>Update Required</span>
		    Here's a message which will appear if the video isn't supported. A Flash alternative can be used here if you fancy it.
		</div>

	</div><!--end jp_container_1-->
	</div>

	<p id="activityContent">{{$activity->introduction}}</p>


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
<!--instantiate-->
<!--视频文件，一开始没播放时封面图片,可以添加四种格式的视频,这里需要获取后台资源,这样的方式对吗？-->
	<script type="text/javascript">
	$(document).ready(function(){

	    $("#jquery_jplayer_1").jPlayer({
	        ready: function () {
	            $(this).jPlayer("setMedia", {
	                m4v: "{{$activity->video_url}}",
	                ogv: "{{$activity->video_url}}",
	                webmv: "{{$activity->video_url}}",
	                poster: "{{$activity->video_url}}"
	            });
	        },
	        swfPath: "js",
	        supplied: "webmv, ogv, m4v",
	        size: {
	            width: "600px",
	            height: "338px",
	            cssClass: "jp-video-360p"
	        }
	    });

	});
	</script>

</body>
</html>