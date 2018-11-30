<?php 
	namespace app\index\controller;
	use app\index\controller\baseCtrl;
	use app\common\model\question as m_question;
	use app\index\service\buy as s_buy;
	use app\index\service\order as s_order;
	use app\common\model\order as m_order;
	
	class buyCtrl extends baseCtrl
	{
		protected $checkAction=[
        "question"=>"needLoginAjax",
        "order"=>"needLogin"
        ];
		
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
        
        /*
        * 处理下单请求
        * 传参有：sign gid/gids num item(问题答案)
        */
        public function order(){
            //验证问题回答正确否
            s_buy::checkQuestion();
            
            //验证商品
            $goods=s_buy::checkGoods($this->active);
			
			//生成订单
			s_order::createOrder($this->active['id'],$this->uid,$goods);
            
			//去除购物车缓存
			$this->cache->set("cart-".$this->uid,[]);
			
            echo true;

        }
		
		public function prepay(){
			//先检查库存是否充足
			$m_order=new m_order();
			$order=$m_order->get($_POST['id']);
			$goods_params=s_buy::getGoodsParams($order);
			s_buy::checkGoodsStock($goods_params);
			
			return_result($order);
		}
		
		/*
		*  微信支付 生成二维码
		*
		*/
		public function pay(){
			$m_order=new m_order();
			$order=$m_order->get($_GET['id']);
			
			//生成并返回二维码
			s_buy::returnQrcode($order);
			
		}
		
		public function paid(){
			if(!isset($_POST['id'])){
				echo false;
				die;
			}
			
			//完成订单
			s_buy::paidOrder($_POST['id']);
			
			echo true;
		}
	}
?>