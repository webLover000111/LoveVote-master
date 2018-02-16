<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="target-densitydpi=device-dpi,width=980,user-scalable=yes,max-scale=2" />
    <title>欢迎登陆最喜爱导师评选网站</title>
    <link rel="stylesheet" href="/lib/normalize.css">
    <link rel="stylesheet" href="/css/style.css">
    <script src="/lib/jquery-2.1.4.min.js"></script>
    <script type="text/javascript" src="/js/jqPic.js"></script>
</head>
<body>
<!--the picture on the top of the page-->
<div id="top">
<!--顶端的图片-->
<!--这里需要接口显示顶端图片-->
    <img src="{{$bgimage->image_url}}" alt="top-pic" id="topPic">

</div>

<!--the navigation of the page-->
<div id="nav">
    <ul>
    <!--让url失效-->
        <li><a href ="javascript:return false;" class="navActive"><span>投票系统</span></a></li>
        <li><a href="/scut/activity"><span>活动介绍</span></a></li>
        <li><a href="/scut/comment"><span>学生留言</span></a></li>
        <li><a href="/scut/statistic"><span>投票统计</span></a></li>
        <li><a href="/scut/result"><span>评选结果</span></a></li>
        <!--询问是否后台登录，根据登陆与否返回内容,若为未登录点击出现登陆弹窗，否则没有效果-->
        @if($login==false)
        <li id="login" title="登陆后才能投票和留言哦！"><a><span>登&nbsp&nbsp陆</span></a></li>
        @elseif($login==true)
        <li id="unlogin" title="您已登录,点这里登出！"><a><span>你好，{{$name}}!</span></a></li>
        @endif
    </ul>
    <input type="hidden" id="clientLogin" value="{{$login}}">
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
<!--轮播图-->
    <div id="picPlay">
    <div id="box">
    <div class="prev"></div>
    <div class="next"></div>
    <ul class="bigUl">
       <li style="z-index:1"><a href="#"><img src="{{$ttimage[0]->image_url}}" alt="pic1" /></a></li>
       <li><a href="#"><img src="{{$ttimage[1]->image_url}}" alt="pic2" /></a></li>
       <li><a href="#"><img src="{{$ttimage[2]->image_url}}" alt="pic3" /></a></li>
       <!--差接口-->
    </ul>
    <ul class="numberUl">
      <li class="night"><a href="javascript:;">1</a></li>
      <li><a href="javascript:;">2</a></li>
      <li><a href="javascript:;">3</a></li>

    </ul>
 </div>

    </div>





    <div>
    <div>
        <p class="itemTitle">活动流程</p>
        <ul id="process">
            <li>
                <p>1.学院提名</p>
                <p class="timeText">5.10-5.30</p>
            </li>
            <li>
                <p>2.网络投票阶段</p>
                <p class="timeText">6.21-7.1</p>
            </li>
            <li>
                <p>3.结果公示</p>
                <p class="timeText">7.2-7.6</p>
            </li>
            <li>
                <p>4.获选导师资料收集</p>
                <p class="timeText">7.7-7.20</p>
            </li>
            <li>
                <p>5.颁奖晚会</p>
                <p class="timeText">2016.9</p>
            </li>
        </ul>
    </div>
    <div>
        <p class="itemTitle">关于投票</p>
        <h4>为确保网络投票公平公正，维护各研究生同学的投票权益，本投票系统采用实名制投票方式。</h4>
        <ul id="attention">
            <li>1.仅限本校研究生，博士生参与投票；</li>
            <li>2.每个同学只能投票一次，每次必须选出15位导师，方为有效；<a><span id="more">更多>></span></a></li>
            <li>3.候选导师随机排序，不定时随机更新；</li>
            <li>4.系统将记录各位同学的投票情况</li>
            <li>5.为方便您的阅读，建议使用Chrome，火狐，IE9+浏览器访问本网站，如有显示错误，请尝试更换浏览器进行访问（搜狗请使用高速模式）。</li>
        </ul>
    </div>
    <div>
        <p class="itemTitle">候选老师投票</p>

            <div id="container">
            @foreach($datas as $data)
            <div class="teacherPic"><img src="{{$data->photo_url}}" alt="teacherPic" class="{{$data->id}}">
            <p id="info"><input id="{{$data->id}}" type="checkbox" name="ids[{{$data->id}}]" value="{{$data->name}}"><label for="">{{$data->name}}</label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<span id="voteQualities">{{$data->votes_num}}票</span></p>
            <p id="department" >{{$data->inistitute}}</p>
            </div>
            @endforeach
            <div class="clear"></div>
            </div>



    </div>
    </div>
    <!--需要和后台交互-->
    <div id="bottomText"><p>{{$msg}}</p></div>


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

<!--旁栏投票结果栏-->
<div id="voteNum" class="noSee">
                <ul id="voteTop">
                <li>已投</li>
                <li><input type="button" name="postResult" value="提交" id="postBtn"></li>
                <div class="clear"></div>
            </ul>
            <ul id="listChoose">
            </ul>
            <p id="voteText">已投<a href=""><span id="currentnum"></span></a>票，还剩<a href=""><span id="voteLeave"></span></a>票</p>

    </div>

<!--分享按钮-->
<div>
<!-- JiaThis Button BEGIN -->
<!--这里添加链接-->
<!--这里是添加内容简介-->
<!--这里添加话题内容，出现于微博之中-->
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
<script src="/js/index.js"></script>
</body>
</html>