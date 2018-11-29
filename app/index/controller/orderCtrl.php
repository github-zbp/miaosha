<?php 
    namespace app\index\controller;
    use app\index\controller\baseCtrl;
	use app\common\model\order as m_order;
    
    class orderCtrl extends baseCtrl
    {
		public $checkAction=["index"=>"needLogin"];
		
        public function index(){
            $m_order=new m_order();
            $orders=$m_order->all(['uid'=>$this->uid]);
			$description=[];
            foreach($orders as $k=>$v){
                $orders[$k]["goods_info"]=array_values(json_decode($v["goods_info"],true));
				
				$description[$k]="";
				
				foreach($orders[$k]["goods_info"] as $key=>$value){
					$description[$k].="<p>".$value["title"]." * ".$value["buy_num"]."</p>";
				}
            }
			
            
            $this->display("index",["orders"=>$orders,"description"=>$description]);
        }
        
		
		
    }
?>