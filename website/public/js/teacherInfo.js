	$(document).ready(function(){
			var url="/scut/teacher";
			var pageurl=url;
			var page=parseInt($("#page").val());
			var pagesize=6;//这里没有开放用户修改每个页面的评论数量；
			var clickPage=1;
			var count=parseInt($("#count").val());//页面总数
			var oLi=$("#pageNum li");
			var oId=parseInt($("#teacherId").val());
			if(count<5){
				//这里用addClass出问题，有点奇怪
				for(var i=count;i<6;i++){
						oLi[i].style.display='none';
				}

			}
			$("#pageNum li").click(function(){
				clickPage=parseInt($(this).text());
				if(clickPage==page){
					return ;
				}
				else{
					pageurl=url+'/'+oId+'?page='+clickPage+'&pagesize='+pagesize;
					window.location=pageurl;
				}
			});
			//点击上一页
			$("#prev").click(function(){
				var count=parseInt($("#count").val());
				var page=parseInt($("#page").val());
				clickPage=page-1;
				if(clickPage<0||clickPage==0){
					clickPage=1;
				}
				pageurl=url+'/'+oId+'?page='+clickPage+'&pagesize='+pagesize;
				window.location=pageurl;
			});
			//点击下一页
			$("#next").click(function(){
				var count=parseInt($("#count").val());
				var page=parseInt($("#page").val());
				clickPage=page+1;
				if(clickPage==count+1){
					clickPage=count;
				}
				pageurl=url+'/'+oId+'?page='+clickPage+'&pagesize='+pagesize;
				window.location=pageurl;
			});
			//转到第N页
			$("#goBtn").click(function(){
				var count=parseInt($("#count").val());
				var inputNum=parseInt($("#inputNum").val());
				clickPage=inputNum;
				if(clickPage>count||clickPage<1){
					alert("输入错误,请重新输入！");
					return ;//输入错误回到首页
				}
				else{
					pageurl=url+'/'+oId+'?page='+clickPage+'&pagesize='+pagesize;
					window.location=pageurl;
				}
			});
		});
			
