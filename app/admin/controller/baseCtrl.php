<?php 
    namespace app\admin\controller;
    use core\lib\Controller;
    
    class baseCtrl extends Controller{
        //核心的Controller类是没有构造函数的
        public function __construct(){
            parent::__construct();
            
            //定义后台栏目
            $nav=[
                "active"=>[
                    "name"=>"活动",
                    "active"=>false
                ],
                "order"=>[
                    "name"=>"订单",
                    "active"=>false
                ],
                "goods"=>[
                    "name"=>"商品",
                    "active"=>false
                ],
                "question"=>[
                    "name"=>"问答",
                    "active"=>false
                ],
                "log"=>[
                    "name"=>"日志",
                    "active"=>false
                ]
            ];
            
            //为当前访问的控制器对应的后台栏目修改active属性,模型控制器和方法都存在控制器中的静态变量里
            $nav[self::$controller]["active"]=true;
            
            $this->assign(["nav"=>$nav]);
        }
    }
?>