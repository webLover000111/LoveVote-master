$(document).ready(function(){
	var maxNum=15;
	var count=0;
	var voteLeave;
	var url="/scut/teacher";//后台提供的url
	var page=1;
	var pagesize=6;
	var login=$("#clientLogin").val();//判断是否登录来判断是否可以投票
	voteLeave=maxNum-count;
	$("#currentnum").text(count);
	$("#voteLeave").text(voteLeave);
	if(count===0){
		$("#voteNum").addClass("noSee");
	}
	else
		$("#voteNum").removeClass("noSee");
	$(function(){
		$("#more").click(function(){
			$("#attention li").css("display","block");
			$("#attention span").empty();
		});});
	$("[type='checkbox']").click(function(){
		 var name=$(this).val();
		 var judgment=this.checked;
		 var id=this.id;
		 if(login==false){
		 	alert("您还没登陆不可以投票！");
		 	if(judgment){
		 		this.checked=false;
		 	}
		 	return ;
		 }
		 else{
		 if(judgment){
			var selectedItem = "<li class=" + id + " title=点击删除>" + name + "<a>删除</a></li>";
			if(voteLeave===0){
				this.checked=false;
				alert("您已经投完15票了！");
				return;
			}
			else{
				$("#listChoose").append(selectedItem);
				count++;
				voteLeave=maxNum-count;
				$("#currentnum").text(count);
				$("#voteLeave").text(voteLeave);
		}

		if(count===0){
			$("#voteNum").addClass("noSee");
		}
		else{
			$("#voteNum").removeClass("noSee");
		}
		}//单引号和双引号效果是不一样的
		else{
			$("li[class=" + id + "]").remove();
			count--;
			voteLeave=maxNum-count;
			$("#currentnum").text(count);
			$("#voteLeave").text(voteLeave);
			if(count===0){
			$("#voteNum").addClass("noSee");
		}
		else
			$("#voteNum").removeClass("noSee");
		}
	}
	});

  /* 已选导师列表点击事件 */
    $(document).on('click', '#listChoose li', function () {
        $(this).remove();
        $('#' + $(this).attr('class')).removeAttr("checked");
        count--;
        voteLeave=maxNum-count;
        $("#currentnum").text(count);
		$("#voteLeave").text(voteLeave);
        if(count===0){
		$("#voteNum").addClass("noSee");
	}
	else
		$("#voteNum").removeClass("noSee");
    });
    /*点击图片功能*/
$("#container img").click(function(){
	var id= $(this).attr('class');
	ourl=url+'/'+id+'?page='+page+'&pagesize='+pagesize;
	window.location.href = ourl;
});
/*提交按钮功能*/
$("#postBtn").click(function(){
	 /*csrf防御*/
    $.ajaxSetup({
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
     });
	var ids=[];
	var oli=$("#listChoose li");
	for(var i=0;i<oli.length;i++){
		ids.push(parseInt($(oli[i]).attr("class")));
	}
	var upData={
		"ids":ids
	};
	if(ids.length!=15){
		alert("需要投够15票才能提交！");
		return;
	}
	else{
		$.ajax({
			type:"POST",
			async:true,
			//dataType:"json",
			url:"/student/vote",
			data:upData,
			error:function(){
				alert("提交数据失败！");
			},
			success:function(data){
				if(data.status==false){
					alert(data.msg);
					window.location.reload();
				}
				else if(data.status==true){
					alert('投票成功!将为您跳转到新页面！');
					window.location=data.locate_url;
				}
				else{
					alert("服务器出错！");
				}
			}
		});
	}
});
});




window.onload = function()
  {
	  var oBox = document.getElementById('box');
	  var oPrev = getByClass(oBox,'prev')[0];
	  var oNext = getByClass(oBox,'next')[0];
	  var oBigUl = getByClass(oBox,'bigUl')[0];
	  var aLiBig = oBigUl.getElementsByTagName('li');
	  var oNumUl = getByClass(oBox,'numberUl')[0];
	  var aLiNumber = oNumUl.getElementsByTagName('li');
	  var nowZindex = 1;
	  var now = 0;
	  function tab()
	  {
		   for(var i=0; i<aLiNumber.length; i++)
			  {
				  aLiNumber[i].className = '';
			  }
			  aLiNumber[now].className = 'night';
			  
		  aLiBig[now].style.zIndex = nowZindex++;
		  aLiBig[now].style.opacity = 0;
		  startMove(aLiBig[now],'opacity',100);
		  
	  }
	  
	  for(var i=0; i<aLiNumber.length; i++)
	  {
		  aLiNumber[i].index = i;
		  aLiNumber[i].onclick = function(){
			 
			  if(this.index==now)return;
			  now = this.index;
			 
			  tab();
		  }
	  }
	  oNext.onmouseover = oPrev.onmouseover = oBigUl.onmouseover = function()
	  {
		  startMove(oPrev,'opacity',100);
		   startMove(oNext,'opacity',100)
	  }
	   oNext.onmouseout = oPrev.onmouseout = oBigUl.onmouseout = function()
	  {
		  startMove(oPrev,'opacity',0);
		  startMove(oNext,'opacity',0)
	  }
	  oPrev.onclick = function()
	  {
		  now--
		  if(now==-1)
		  {
			  now=aLiNumber.length-1;
		  }
		  tab();
	  }
	  
	    oNext.onclick = function()
	  {
		  now++
		  if(now==aLiNumber.length)
		  {
			  now=0;
		  }
		  tab();
	  }
	  
	  var timer = setInterval(oNext.onclick,3000)
	  oBox.onmouseover = function()
	  {
		  clearInterval(timer)
	  }
	  oBox.onmouseout = function()
	  {
		  timer = setInterval(oNext.onclick,3000)//3秒更换一次图片
	  }
  };