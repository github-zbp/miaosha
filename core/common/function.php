<?php 
	function showMsg($msg,$redirection=""){
		if(!$redirection){
			$redirection=$_SERVER["HTTP_REFERER"];
		}
		if(is_array($msg)){
			$msg_copy=$msg;
			$msg="";
			foreach($msg_copy as $k=>$v){
				$msg.=$k.":".$v." ";
			}
		}
		
		echo "<script>alert('{$msg}');location.href='{$redirection}'</script>";
		
		die;
	}
	
	/*
	* 重定向
	*/
	function redirect($url="/"){
		echo "<script>location.href='{$url}'</script>";
	}
	
	/*
	* 返回数据给ajax响应
	*/
	function return_result($msg){
		if(is_array($msg)){
			echo json_encode($msg);
			die;
		}
		
		echo $msg;
		die;
	}
	
	/*
	* 获取客户端Ip
	*
	*/
	function getClientIp()
	{
		if(getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), 'unknown')) {
			$onlineip = getenv('HTTP_CLIENT_IP');
		} elseif(getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), 'unknown')) {
			$onlineip = getenv('HTTP_X_FORWARDED_FOR');
		} elseif(getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), 'unknown')) {
			$onlineip = getenv('REMOTE_ADDR');
		} elseif(isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], 'unknown')) {
			$onlineip = $_SERVER['REMOTE_ADDR'];
		}
		return $onlineip;
	}
	
?>