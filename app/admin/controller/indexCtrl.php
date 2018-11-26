<?php 
    namespace app\admin\controller;
    use core\lib\Controller;
    
    class indexCtrl extends Controller{
        public function index(){
            $this->display("index");
        }
    }
?>