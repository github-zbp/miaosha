<?php 
    namespace app\common\model;
    use app\common\model\base;
    
    class question extends base
    {
        public function getQuestionByAid($aid){
			$sql="select * from `{$this->table}` where active_id = :aid";
			$params=["aid"=>$aid];
			$res=$this->db->row($sql,$params);
			
			return $res;
		}
		
		public function getAllQue($limit=[]){
			$limit=implode(",",$limit);
			$sql="select * from `{$this->table}` limit {$limit}";
			$res=$this->db->query($sql);
			
			return $res;
		}
    }
?>