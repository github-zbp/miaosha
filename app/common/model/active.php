<?php 
    namespace app\common\model;
    use app\common\model\base;
    use app\extra\enum\active as e_active;
    
    class active extends base
    {
        public function getActiveInUse(){
            $sql="select * from `{$this->table}` where sys_status = :sys_status and time_end > :now limit 1";
            
            $params=["sys_status"=>e_active::ONLINE,"now"=>time()];
            
            $res=$this->db->query($sql,$params);
			
			foreach($res as $k=>$v){
				$active[$v["id"]]=$v;
			}
			if(!$res){
				return false;
			}
			
            return $active;
        }
		
		public function getActiveIds($actives){
			foreach($actives as $k=>$v){
				$ids[]=$v['id'];
			}
            
            return $ids;
		}
        
        public function getActiveOnline(){
            $sql="select * from `{$this->table}` where sys_status = :sys_status  limit 1";
            
            $params=["sys_status"=>e_active::ONLINE];
            
            $res=$this->db->row($sql,$params);
			
            return $res;
        }
    }
?>