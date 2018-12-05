<?php 
    namespace app\common\model;
    use app\common\model\base;
    
    class order extends base
    {
        public function getUserOrders($uid,$limit=[]){
			$limit=implode(",",$limit);
			$sql="select * from `{$this->table}` where uid=:uid and sys_status !=:status limit {$limit}";
			$params=["uid"=>$uid,"status"=>5];
			$res=$this->db->query($sql,$params);
			
			return $res;
		}
		
		public function getAllOrders($limit=[]){
			$limit=implode(",",$limit);
			$sql="select * from `{$this->table}` limit {$limit}";
			$res=$this->db->query($sql);
			
			return $res;
		}
    }
?>