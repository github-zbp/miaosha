<?php 
	namespace app\index\service;
	use core\lib\Datasource as ds;
    use app\common\model\order as m_order;
	class order
	{
		public static function createOrder($active_id,$uid,$goods_info){
			//先实现普通的数据入库逻辑，不考虑使用缓存和高并发的情况先；
            
            //构建order表中的字段
            $order_no=self::makeOrderNo($goods_info);
            
            $num_goods=count($goods_info);
            $num_total=$price_total=$price_discount=0;
            foreach($goods_info as $k=>$v){
                $num_total+=$v["buy_num"];
                $price_total+=$v["price_normal"]*$v["buy_num"];
                $price_discount+=$v["price_discount"]*$v["buy_num"];
            }
            $time_confirm=time();
            $sys_ip=getClientIp();
            $sys_status=1;
            $goods_info=json_encode($goods_info);
            
            $data=compact("active_id","uid","goods_info","sys_ip","sys_status","num_goods","num_total","price_discount","price_total","order_no","time_confirm");
            
            //数据入库
            $m_order=new m_order();
            $order_id=$m_order->create($data);
            
            if($order_id){
                return true;
            }
		}
        
        private static function makeOrderNo($goods_info){
            $json=json_encode($goods_info);
            $alphaArr=["A","B","C","D","E"];
            $alpha=$alphaArr[rand(0,count($alpha)-1)];
            
            return $alpha.date("ymd").substr($json,0,6);
        }
	}
?>