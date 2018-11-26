<?php 
	namespace app\index\controller;
	use app\index\controller\baseCtrl;
	use app\common\model\question as m_question;
	use app\index\service\buy as s_buy;
	
	class buyCtrl extends baseCtrl
	{
		protected $checkAction=["question"=>"needLoginAjax"];
		
		/*
		* 用于ajax请求,返回问题
		*/
		public function question(){
			$uid=$this->user['id'];
			
			if(empty($_POST["aid"])){
				echo json_encode(["errno"=>999,"errmsg"=>"活动ID为空"]);
				die;
			}
			$aid=$_POST["aid"];
			
			$question=json_encode(s_buy::getQuestion($uid,$aid));
			
			echo $question;
			
		}
	}
?>