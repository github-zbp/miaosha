<?php 
    namespace app\admin\controller;
    use app\admin\controller\baseCtrl;
    
    class activeCtrl extends baseCtrl{
        public function index(){
            $this->display("index");
        }
        
        public function add(){
            $this->display("add");
        }
    }
?>