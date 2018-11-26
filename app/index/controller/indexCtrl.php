<?php 
    namespace app\index\controller;
    use app\index\controller\baseCtrl;
    use app\common\model\active as m_active;
    use app\common\model\goods as m_goods;
    use app\extra\enum\goods as e_goods;
	
    class indexCtrl extends baseCtrl
    {
        public function index(){
           $m_active=new m_active();
		   $m_goods=new m_goods();
           
           //获取在线活动
           $active=$m_active->getActiveInUse();
           $active_ids=$m_active->getActiveIds($active);
		   
		   //获取上线活动的商品(商品状态没限制)
           $goods=$m_goods->getGoodsInUse($active_ids);
		   
		   $this->display("index",["active"=>$active,"goods"=>$goods,"status"=>["online"=>e_goods::ONLINE,"to_be_online"=>e_goods::TO_BE_ONLINE,"downline"=>e_goods::DOWNLINE]]);
        }
        
        
    }
?>