<?php 
    namespace app\index\controller;
    use app\index\controller\baseCtrl;
	use app\common\model\order as m_order;
    
    class orderCtrl extends baseCtrl
    {
		public $checkAction=["index"=>"needLogin"];
		
        public function index(){
            $m_order=new m_order();
            $orders=$m_order->all();
            foreach($orders as $k=>$v){
                $orders[$k]["goods_info"]=array_values(json_decode($v["goods_info"],true));
            }
            
            $this->display("index",["orders"=>$orders]);
        }
        
    }
?>