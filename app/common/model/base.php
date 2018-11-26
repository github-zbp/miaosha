<?php 
    namespace app\common\model;
    use \core\lib\Crud;
    
    class base extends Crud
    {
        protected $prefix="ms_";
        protected $table = "";
        protected $pk = "";
        
        public function __construct($table="",$pk="id"){
        parent::__construct();
        if(!$table){
                $arr=explode("\\",get_called_class());
                $table=$arr[count($arr)-1];
            }
            
            $this->table=$this->prefix.$table;
            $this->pk=$pk;
        }
    }
?>