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
    }
?>