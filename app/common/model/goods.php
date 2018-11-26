<?php 
    namespace app\common\model;
    use app\common\model\base;
    
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
    }
?>