<?php 
    namespace app\admin\controller;
    use app\admin\controller\baseCtrl;
    use app\common\model\order as m_order;
	use core\lib\Mysql\Page;
	
    class orderCtrl extends baseCtrl{
		protected $m_order;
		
		public function __construct(){
			parent::__construct();
			$this->m_order=new m_order();
		}
		
        public function index(){
			$pageRows=5;
			
			// $orders=$this->m_order->all();
			$allRows=$this->m_order->count();
			$page=new Page($allRows,$pageRows);
			$limit=$page->limit();
			$links=$page->getLinks();
			
			$orders=$this->m_order->getAllOrders($limit);
			
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
		
		public function online(){
			$this->m_goods->sys_status=1;
			$this->m_goods->save($_GET['id']);
			redirect("/admin/order");
		}
		
		public function delete(){
			$this->m_goods->sys_status=2;
			$this->m_goods->save($_GET['id']);
			redirect("/admin/order");
		}
    }
?>