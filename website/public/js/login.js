$(document).ready(function(){
	var stuName=$("#studentId");
	var psw=$("#psw");
	$.ajaxSetup({
    	headers: {
        	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    	}
	});
	$("#btn").click(function(){
		var login={
			"student_num":stuName.val(),
			"password":psw.val()
		};
		$.ajax({
			url:"/student/login",
			type:"POST",
			data:login,
			//dataType:"json",
			async:false,
			error:function(){
				alert("数据传输出错！");
				return;
			},
			success:function(data){  
				if(data.status==false){
					alert("登录失败，请检查您的的账号和密码！");
					return ;
				}
				else if(data.status==true){
					alert("登陆成功！将为您跳转到新页面！");
						window.location.href=data.locate_url;
				}
				else{
					alert("数据传输错误！");
				}
			}

		});
});
});