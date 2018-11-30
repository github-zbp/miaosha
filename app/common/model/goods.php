<?php 
    namespace app\common\model;
    use app\common\model\base;
    use app\common\model\active;
    
    class goods extends base
    {
        public function getGoodsInUse($active_ids,$status=-1){
			$active_ids=implode(",",$active_ids);
			$sql="select * from `{$this->table}` where active_id in ({$active_ids}) order by active_id desc";
			$res=$this->db->query($sql);
			return $res;
		}
		
		 public function getGoodsInCart($gids){
			$gids=implode(",",$gids);
			$sql="select * from `{$this->table}` where id in ({$gids}) and sys_status = 1";
			$res=$this->db->query($sql);
			
			return $res;
		}
        
        public function getGoodsForOrder($goods_params){
            $gids=array_keys($goods_params);
            $active=new active();
            $active_table=$active->table;
            $gids=implode(",",$gids);
            $sql="select g.*,`time_begin`,`time_end`,a.`sys_status` `active_status` from `{$this->table}` g join `{$active_table}` a on a.id = g.active_id where g.id in ({$gids})";
            $res=$this->db->query($sql);
            
			foreach($res as $k=>$v){
				$goods[$v['id']]=$v;
                $goods[$v['id']]["buy_num"]=$goods_params[$v['id']];
			}
			
            return $goods;
        }
		
		public function reduceStock($gid,$num){
			$sql="update `{$this->table}` set `num_left`=`num_left` - {$num} where `{$this->pk}`={$gid}";
			$this->db->query($sql);
		}
    }
?>