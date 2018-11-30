$(function(){
	var pay_url="/index/buy/pay?_debug=0";
	var before_pay_url="/index/buy/prepay?_debug=0";
	var check_url="/index/buy/paid?_debug=0";
	var pay_btn=$(".pay-btn");
	var check_pay_btn=$(".check-pay");
	var order_id;
	
	pay_btn.click(function(){
		order_id=$(this).attr('order_id');
		
		$.post(before_pay_url,{'id':order_id},function(data){
			if(data.errno){
				alert("errno:"+data.errno+" errmsg:"+data.errmsg);
			}else{
				var html="<br/><center><h3>请扫码支付</h3><h4>(仅用于测试 请勿真的在手机上付款)</h4><center><br/>";
				html+="<img src='"+pay_url+"&id="+order_id+"' width='250'/><br/><br/>";
				
				$(".modal-body").html(html);
				$("#modal").modal();
			}
		},"json");
		
		
	});
	
	check_pay_btn.click(function(){
		$.post(check_url,{'id':order_id},function(data){
			// alert(data);
			// data=$.parseJSON(data);
			if(data.errno){
				alert("errno:"+data.errno+" errmsg:"+data.errmsg);
				
			}else{
				alert("支付成功");
				location.href=location.href;
			}
			
		},"json");
	});
});