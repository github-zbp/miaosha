$(function(){
	var select_btn=$(".select-btn");
	var uselect_btn=$(".unselect-btn");
    var modal_html=$(".modal-content").html();
	var selected_goods=[];
    var selected_goods_num={};
	var patch_delete_url="/index/cart/deletes?_debug=0";
    var cart_order_url="/index/buy/order?_debug=0";
    var question_url="/index/buy/question?_debug=0";
	var params_order={};

	select_btn.click(function(){
			var gid=$(this).attr("gid");
			selected_goods.push(gid);
            var goods_num=$(this).parent().parent().find("select[name=num]").val();
            selected_goods_num[gid]=goods_num;
			$(this).hide();
			$(this).parent().find(".unselect-btn").show();
			if(selected_goods.length > 0){
				$(".patch_delete").show();
			}
			console.log(selected_goods_num);
		});

    $("select[name=num]").change(function(){
       var gid=$(this).attr("gid");
       if(selected_goods_num[gid]){
           selected_goods_num[gid]=$(this).val();
       }
       console.log(selected_goods_num);
    });
    
	uselect_btn.click(function(){
		var gid=$(this).attr("gid");
		index=selected_goods.indexOf(gid);
		if(index>-1){
			selected_goods.splice(index,1);
		}
        delete selected_goods_num[gid];
		$(this).hide();
		$(this).parent().find(".select-btn").show();
		if(selected_goods.length == 0){
				$(".patch_delete").hide();
			}
		console.log(selected_goods_num);
	});

	$(".patch_delete").click(function(){
		console.log(1);
		$.post(patch_delete_url,{gids:selected_goods},function(data){
			// alert(data);
			location.href=location.href;
		});
	});
    
    $(".cart-order").click(function(){
		// console.log(selected_goods_num);
        if($.isEmptyObject(selected_goods_num)){
			var html="<center><h4>请选择商品</h4></center>";
			$(".modal-content").html(html);
			$("#modal").modal();
            return false;
        }
        
        var aid=$(this).attr('aid');
        $.post(question_url,{'aid':aid},function(data){
			// alert(123);
            data=$.parseJSON(data);
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
				// html+="<p><label>购买数量 : <select name='num'>";
				// for(var i=1;i<=max_num;i++){
					// html+="<option value='"+i+"'>"+i+"</option>";
				// }
				// html+="</select></p>";
				$(".modal-content").html(modal_html);
				$(".modal-body").html(html);
				params_order.sign=data.sign;
				params_order.ask=data.ask;
			}
			
			
			$("#modal").modal();
        });
    });
	
	$("#modal").on("click",".submit-order",function(){
		params_order.item=$("#modal").find("input[type=radio]:checked").val();
		params_order.goods=selected_goods_num;
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
});