<?php 
    namespace app\admin\controller;
    use app\admin\controller\baseCtrl;
    
    class orderCtrl extends baseCtrl{
        public function index(){
            $this->display("index");
        }
    }
?>