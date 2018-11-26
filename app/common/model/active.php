<?php 
    namespace app\common\model;
    use app\common\model\base;
    use app\extra\enum\active as e_active;
    
    class active extends base
    {
        public function getActiveInUse(){
            $sql="select * from `{$this->table}` where sys_status = :sys_status and time_end > :now order by `{$this->pk}` desc";
            
            $params=["sys_status"=>e_active::ONLINE,"now"=>time()];
            
            $res=$this->db->query($sql,$params);
			
			foreach($res as $k=>$v){
				$active[$v["id"]]=$v;
			}
			
            return $active;
        }
		
		public function getActiveIds($actives){
			foreach($actives as $k=>$v){
				$ids[]=$v['id'];
			}
            
            return $ids;
		}
    }
?>