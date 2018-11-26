$(function(){
	var select_btn=$(".select-btn");
	var uselect_btn=$(".unselect-btn");
	var selected_goods=[];
	var patch_delete_url="/index/cart/deletes?_debug=0";

	select_btn.click(function(){
			var gid=$(this).attr("gid");
			selected_goods.push(gid);
			$(this).hide();
			$(this).parent().find(".unselect-btn").show();
			if(selected_goods.length > 0){
				$(".patch_delete").show();
			}
			console.log(selected_goods);
		});


	uselect_btn.click(function(){
		var gid=$(this).attr("gid");
		index=selected_goods.indexOf(gid);
		if(index>-1){
			selected_goods.splice(index,1);
		}
		$(this).hide();
		$(this).parent().find(".select-btn").show();
		if(selected_goods.length == 0){
				$(".patch_delete").hide();
			}
		console.log(selected_goods);
	});

	$(".patch_delete").click(function(){
		console.log(1);
		$.post(patch_delete_url,{gids:selected_goods},function(data){
			// alert(data);
			location.href=location.href;
		});
	});
});