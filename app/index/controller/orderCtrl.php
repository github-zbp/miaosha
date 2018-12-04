<?php 
    namespace app\index\controller;
    use app\index\controller\baseCtrl;
	use app\common\model\order as m_order;
    use app\index\service\order as s_order;
	use core\lib\Mysql\Page;
	
    class orderCtrl extends baseCtrl
    {
		public $checkAction=["index"=>"needLogin","cancel"=>"needLogin"];
		
        public function index(){
			$pageRows=1;
			
			//获取分页链接
			$m_order=new m_order();
			$allRows=$m_order->count("uid = {$this->uid} and sys_status != 5");
			$page=new Page($allRows,$pageRows);
			$limit=$page->limit();var_dump($limit);
			$links=$page->getLinks();
			
			//取数据
			$orders=$m_order->getUserOrders($this->uid,$limit);
			
            // $orders=$m_order->all("uid = {$this->uid} and sys_status != 5");
			
			$description=[];
            foreach($orders as $k=>$v){
                $orders[$k]["goods_info"]=array_values(json_decode($v["goods_info"],true));
				
				$description[$k]="";
				
				foreach($orders[$k]["goods_info"] as $key=>$value){
					$description[$k].="<p>".$value["title"]." * ".$value["buy_num"]."</p>";
				}
            }
			
            
            $this->display("index",["orders"=>$orders,"description"=>$description,"links"=>$links]);
        }
        
		public function cancel(){
			//更改订单状态
			$m_order=new m_order();
			$order=$m_order->get($_GET['id']);
			
			$m_order->time_cancel=time();
			$m_order->sys_status=5;
			$m_order->save($_GET['id']);
			
			//修改用户限量购买缓存
			$goods_info=json_decode($order["goods_info"],true);
			s_order::logUserGoodsNum($goods_info,$order["active_id"],"-");
			
			redirect("/index/order/index");
		}
		
    }
?>