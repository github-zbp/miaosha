<?php 
    namespace app\admin\controller;
    use app\admin\controller\baseCtrl;
    
    class logCtrl extends baseCtrl{
        public function index(){
            $this->display("index");
        }
    }
?>