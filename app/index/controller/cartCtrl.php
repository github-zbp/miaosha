<?php 
    namespace app\index\controller;
    use app\index\controller\baseCtrl;
    use app\common\model\goods as m_goods;
	
    class cartCtrl extends baseCtrl
    {
		protected $checkAction=["index"=>"needLogin","add"=>"needLoginAjax"];
        public function index(){
			$m_goods=new m_goods();
			$goods_ids=$this->cache->get("cart-".$this->uid);
			
			//根据货物id获取货物信息
			$goods=$goods_ids ? $m_goods->getGoodsInCart($goods_ids) : [];
			
			
            $this->display("index",["goods"=>$goods]);
        }
        
        public function add(){
			//接受商品id和用户id
			$uid=$this->user['id'];
			$gid=$_POST["gid"];
			
			//使用缓存存储购物车,只存商品的id
			$cart_goods=$this->cache->get("cart-".$uid) ? $this->cache->get("cart-".$uid) : [];
			
			$cart_goods[]=$gid;
			$cart_goods=array_unique($cart_goods);
			$this->cache->set("cart-".$uid,$cart_goods);
			
			return_result(true);
		}
		
		// public function test(){
			// $this->cache->delete("cart-1");
		// }
    }
?>