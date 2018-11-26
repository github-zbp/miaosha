<?php 
    namespace app\common\model;
    use app\common\model\base;
    
    class cart extends base
    {
        public function getGoodsInCart($gids){
			$gids=implode(",",$gids);
			$sql="select * from `{$this->table}` where id in ({$gids}) and sys_status = 1";
			$res=$this->db->query($sql);
			
			return $res;
		}
    }
?>