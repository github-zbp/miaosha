$(function(){
	
	var buy_btn=$(".buy-btn");
	var cart_btn=$(".cart-btn");
	
	
	//添加_debug=0是为了防止响应信息中含有调试信息
	var question_url="/index/buy/question?_debug=0";
	var cart_url="/index/cart/add?_debug=0";
	var cart_order_url="/index/buy/order?_debug=0";
	var params_order={};
	
	buy_btn.click(function(){
		var gid=$(this).attr("gid");
		var aid=$(this).attr("aid");
		var max_num=$(this).attr("max-num");
		
		//拉取问题
		$.post(question_url,{"aid":aid},function(data){
			// alert(123);
			// data=$.parseJSON(data);
			if(data.errno){
				var html="<center><h4>"+data.errmsg+"</h4></center>";
				$(".modal-content").html(html);
			}else{
				var html="<p>"+ data.title +"["+ data.ask +"]</p>";
				$.each(data.items,function(i,v){
					html+="<p><label><input type='radio' name='item' value='"+ v +"'> "+v+" </label></p>";
				});
				// html+="<input name='sign' type='hidden' value='"+ data.sign +"'>";
                // html+="<input name='ask' type='hidden' value='"+ data.ask +"'>";
				// html+="<input name='gid' type='hidden' value='"+ gid +"'>";
				html+="<p><label>购买数量 : <select name='num'>";
				for(var i=1;i<=max_num;i++){
					if(i==1){
						html+="<option value='"+i+"' selected>"+i+"</option>";
					}else{
						html+="<option value='"+i+"'>"+i+"</option>";
					}
					
				}
				html+="</select></p>";
				$(".modal-body").html(html);
				params_order.sign=data.sign;
				params_order.ask=data.ask;
				goods_num=$("#modal select").val();
				params_order.goods={gid:goods_num};
			}
			
			
			$("#modal").modal();
		},"json");
		
	});
	
	$(".submit-order").click(function(){
		params_order.item=$("#modal").find("input[type=radio]:checked").val();
		if(!params_order.item){
			alert("请选择一个选项");
			return false;
		}
		
		console.log(params_order);
		$.post(cart_order_url,params_order,function(data){
			data=$.parseJSON(data);
			if(data.errno){
				alert("errno:"+data.errno+" errmsg:"+data.errmsg);
				location.href=location.href;
			}else{
				location.href="/index/order/index";
			}
		});
	});
	
	cart_btn.click(function(){
		var gid=$(this).attr("gid");
		var aid=$(this).attr("aid");
		
		$.post(cart_url,{"gid":gid},function(data){
			if(data.errno){
				var html="<center><h4>"+data.errmsg+"</h4></center>";
				
			}else{
				var html="<center><h4>加入购物车成功</h4></center>";
			}
			
			$(".modal-content").html(html);
			$("#modal").modal();
		});
	});
	
	
});
