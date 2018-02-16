$(document).ready(function(){
	var url="/scut/statistic";
	var ourl;
	var order="desc";
	var mode="teacher";
	var locationHref=window.location.search;

	/*
	 获取url参数
	 返回值类似{
		"key":value
	 }
	*/
	function parseQueryString(str) {
    var reg = /(([^?&=]+)(?:=([^?&=]*))*)/g;
    var result = {};
    var match;
    var key;
    var value;
    while (match = reg.exec(str)) {
        key = match[2];
        value = match[3] || '';
        result[key] = decodeURIComponent(value);
    }
    return result;
}
	/*将url参数赋值给order 和 mode*/
	if(locationHref===""){
		order="desc";
		mode="teacher";
	}
	else{
		var oArgu=parseQueryString(locationHref);
		if("order" in oArgu){
			order=oArgu.order;
		}
		else{
			order="desc";
		}
		if("mode" in oArgu){
			mode=oArgu.mode;
		}
		else{
			mode=oArgu.mode;
		}

	}
	/*根据参数给标签加样式*/
	if(mode!="teacher"){
		$("#teacherCount").addClass("noActive").removeClass("active");
		$("#departmentCount").addClass("active").removeClass("noActive");
	}
	else{
		$("#departmentCount").addClass("noActive").removeClass("active");
		$("#teacherCount").addClass("active").removeClass("noActive");
	}
	if(order!="desc"){
		$("#up a").addClass("sortActive").removeClass("sortNoActive");
 		$("#down a").addClass("sortNoActive").removeClass("sortActive");
	}
	else{
		$("#down a").addClass("sortActive").removeClass("sortNoActive");
 		$("#up a").addClass("sortNoActive").removeClass("sortActive");
	}
	/*四个点击事件*/
	$("#teacherCount").click(function(){
		if(mode==="teacher"){
			return;
		}
		else{
			mode="teacher";
			ourl=url+'?order='+order+'&mode='+mode;
	 		window.location.href = ourl;
 		}
	});

	$("#departmentCount").click(function(){
		if(mode==="academy"){
			return;
		}
		else{
			mode="academy";
			ourl=url+'?order='+order+'&mode='+mode;
	 		window.location.href = ourl;
 		}
	});

	$("#down").click(function(){
		if(order==="desc"){
			return;
		}
		else{
			order="desc";
			ourl=url+'?order='+order+'&mode='+mode;
			window.location.href = ourl;
 		}
	});

	$("#up").click(function(){
		if(order==="asc"){
			return;
		}
		else{
			order="asc";
			ourl=url+'?order='+order+'&mode='+mode;
	 		window.location.href = ourl;
 		}
	});
});