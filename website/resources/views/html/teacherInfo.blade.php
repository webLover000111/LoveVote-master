<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!--allow the mobile devices to enlarge in twice on the page-->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="target-densitydpi=device-dpi,width=980,user-scalable=yes,max-scale=2" />
    <title>欢迎登陆最喜爱导师评选网站</title>
    <link rel="stylesheet" href="/lib/normalize.css">
    <link rel="stylesheet" href="/css/style.css">
     <link rel="stylesheet" type="text/css" href="/dist/css/wangEditor.min.css">
    <script src="/lib/jquery-2.1.4.min.js"></script>

</head>
<body>
<!--the picture on the top of the page-->
<div id="top">
    <img src="{{$bgimage->image_url}}" alt="top-pic" id="topPic">

</div>

<!--the navigation of the page-->
<div id="nav">
<input type="hidden" value="{{$login}}" id="clientLogin">
    <ul>
        <li><a href ="/scut/index"><span>投票系统</span></a></li>
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
<div id="mainContent" class="replace">
    <p class="itemTitle">教师信息</p>
    <div id="wrapHeadshot">
    <div id="wrapLeft">
    <input type="hidden" value="{{$memtor->id}}" id="getId">
    <table id="teacherInfo">
        <tr>
            <th>姓名</th>
            <td>{{$memtor->name}}</td>
            <th>学院</th>
            <td>{{$memtor->insititute}}</td>
        </tr>
        <tr>
            <th>性别</th>
            <td>{{$memtor->gender}}</td>
            <th>职位</th>
            <td>{{$memtor->job_title}}</td>
        </tr>
    </table>

    <p class="itemTitle short">导师简介</p>

    <p class="teacherContent">{{$memtor->introduction}}</p>
    <p class="itemTitle short">学生推荐</p>
    <p class="teacherContent">{{$memtor->recommend}}</p>
    </div>
    <div id="teacherHeadshot"><img src="{{$memtor->photo_url}}" alt="headshot"></div>
    <div class="clear"></div>
    </div>
    <p class="itemTitle">一句话点评</p>
    <p class="teacherContentLong">{{$memtor->short_comment}}</p>
    <div>
    <p class="itemTitle" id="leaveMessage"><span>留言区</span>
    @if($login==true)
    <span class="youlog">您已登录，快来留言吧</span>
    @else
    <a href="#login"><span class="youlog">您还没登陆，去登录吧</span></a>
    @endif
    </p><!--判断是否登录，否的话需要出现“您还没登陆，不能留言-->
    <form action="/student/comment" id="textForm" method="POST">
    <!--写留言的输入框-->
    <textarea name="stutext" id="textWrite" ></textarea>
    <input type="button" name="stuMessage" value="提交" id="textBtn">
    <input type="checkbox" name="is_anonym" id="is_anonym"><span id="annoymity">匿名发表</span>
    </form>
    <p class="itemTitle">留言</p>
    <!--留言-->
    <div>
        @foreach($comments as $comments)<!--只添加循环不需要判断匿名与否-->
        <div class="leftPic"><img src="/img/littleheadred.jpg" alt="stuHeadshot"></div>
        <div class="rightText">
            <span>{{$comments->writer}}</span><span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</span><span>{{$comments->stu_num}}</span> <span>{{$comments->created_at}}</span>
            <div class="clear"></div>
            <div class="stuText">{{$comments->content}}</div>

        </div>
        @endforeach
        <div class="clear"></div>
        <div class="redLine"></div>
    </div>
    <!--留言结束-->

        <div id="infopaging">
        <div id="paging">
        <input type="hidden" value="{{$count}}" id="count">
        <input type="hidden" value="{{$page}}" id="page">
        <input type="hidden" value="{{$memtor->id}}" id="teacherId">
        <div id="pageLeft"><a href="#leaveMessage" id="iMes">我要留言</a></div>
        <ul id="pageRight">
            <li id="prev"><a id="prevA">上一页</a></li>
            <li><ul id="pageNum">
                <li value="1"><a >1</a></li>
                <li value="2"><a >2</a></li>
                <li value="3"><a >3</a></li>
                <li value="4"><a >4</a></li>
                <li value="5"><a >5</a></li>
                <li >...</li>

            </ul></li>
            <li id="next"><a>下一页</a></li>
            <!--默认转到最后一页-->
            <li>转到第<input type="text" value="{{$count}}" id="inputNum">页</li>
            <li id="goBtn"><button>GO</button></li>
        </ul>
        <div class="clear"></div>
        <input type="hidden" value="{{$count}}" id="count">
        </div>
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
<script type="text/javascript" src="/dist/js/wangEditor.js"></script>
<script type="text/javascript">
        $(document).ready(function(){
            var editor = new wangEditor('textWrite');//创建留言输入框
            var url="/student/comment";
            editor.create();
            $('#textBtn').click(function () {
            var oInput=$("#is_anonym");
            var login=$("#clientLogin").val();
            var check=$("#is_anonym").prop("checked");
            var is_anonym=0;
            if(check){
                is_anonym=1;
            }
            else{
                is_anonym=0;
            }
            var formatText = editor.$txt.formatText();// 获取格式化后的纯文本
            var id=parseInt($("#getId").val());
                //赋值comment，后面要提交
            var comment={
                "mid":id,
                "is_anonym":is_anonym,
                "content":formatText
            };
            /*csrf防御*/
            $.ajaxSetup({
                 headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
             });
            /*验证是否有写留言*/
            if(!login){
                alert("您还没登陆不可以留言！");
                return ;
            }
            else{
            if(formatText===""){
                alert("您还没输入留言！");
             }
            else{
                $.ajax({
                    url:url,
                    type:"POST",
                    async:false,
                    data:comment,
                    error:function(){
                        alert("服务器出错，留言提交失败！");
                        return;
                    },
                    success:function(data){
                        if(data.status==false){
                            alert(data.msg);
                            window.location.reload();
                        }
                        else{
                            window.location.reload();
                        }

                    }
                });
            }}
        });
});
</script>
    <script src="/js/teacherInfo.js"></script>


</body>
</html>