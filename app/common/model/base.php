<?php 
    namespace app\common\model;
    use \core\lib\Crud;
    
    class base extends Crud
    {
        protected $prefix="ms_";
        public $table = "";
        protected $pk = "";
        protected $create_time_field="sys_dateline";
        
        public function __construct($table="",$pk="id"){
        parent::__construct();
        if(!$table){
                $arr=explode("\\",get_called_class());
                $table=$arr[count($arr)-1];
            }
            
            $this->table=$this->prefix.$table;
            $this->pk=$pk;
			
			//设置该表的所有字段名存入$this->fields
			$sqlForFields="show columns from `{$this->table}`";
			$res=$this->db->query($sqlForFields,[],\PDO::FETCH_NUM);
			foreach($res as $k => $v){
				$this->fields[]=$v[0];
			}
        }
    }
?>