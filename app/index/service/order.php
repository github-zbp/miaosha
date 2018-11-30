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
			
			//用户防超量购买记录缓存
			self::logUserGoodsNum(json_decode($goods_info,true),$active_id);
            
            if($order_id){
                return true;
            }
		}
		
		public static function logUserGoodsNum($goods_info,$active_id,$type="+"){
			//用户防超量购买记录缓存
			$cache=ds::getCache();
			$key="miaosha_history_".$_COOKIE['uid']."_aid".$active_id;
			$user_goods_num=$cache->get($key)?$cache->get($key):[];
			foreach($goods_info as $k=>$v){
				if(isset($user_goods_num[$v['id']])){
					if($type == "+"){
						$user_goods_num[$v['id']]+=$v["buy_num"];
					}elseif($type == "-" && $user_goods_num[$v['id']]>0){
						$user_goods_num[$v['id']]-=$v["buy_num"];
					}
					
				}else{
					$user_goods_num[$v['id']]=$v["buy_num"];
				}
			}
			$cache->set($key,$user_goods_num);
		}
        
        private static function makeOrderNo($goods_info){
            $json=json_encode($goods_info);
            $alphaArr=["A","B","C","D","E"];
            $alpha=$alphaArr[rand(0,count($alphaArr)-1)];
            
            return $alpha.date("ymd").substr(md5($json),0,6);
        }
	}
?>