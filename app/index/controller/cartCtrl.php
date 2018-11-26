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
		
		/*
		* 清空购物车
		*
		*/
		public function clear(){
			$this->cache->set("cart-".$this->uid,[]);
			
			redirect("/index/cart/index");
		}
		
		/*
		* 删除购物车中某一商品
		*
		*/
		public function delete(){
			$gid=$_GET['gid'];
			$cart_goods=$this->cache->get("cart-".$this->uid);
			if($cart_goods && (($index=array_search(strval($gid),$cart_goods))!==false)){
				unset($cart_goods[$index]);
				$this->cache->set("cart-".$this->uid,$cart_goods);
			}
			redirect("/index/cart/index");
		}
		
		/*
		* 批量删除购物车中商品
		*
		*/
		public function deletes(){
			$gids=$_POST["gids"];
			
			if(!$gids){
				return false;
			}
			$cart_goods=$this->cache->get("cart-".$this->uid);
			foreach($gids as $k=>$v){
				$key=array_search($v,$cart_goods);
				// var_dump($key);
				unset($cart_goods[$key]);
				$this->cache->set("cart-".$this->uid,$cart_goods);
			}
			
			return true;
		}
    }
?>