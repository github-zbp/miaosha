<?php 
    namespace app\index\controller;
    use core\lib\Controller;
    use core\lib\Datasource as ds;
    use app\common\model\active as m_active;
    
    class baseCtrl extends Controller{
		protected $cache=null;
		protected $checkAction=[];	//用于检验是否有权限访问某些控制器的方法,里面存储方法名,访问$checkLogin中的方法名必须通过某指定方法的验证才行
		protected $uid;
		protected $user=null;	//存储登陆的用户信息
		protected $active=null; //保存当前上线活动信息
        //核心的Controller类是没有构造函数的
        public function __construct(){
            parent::__construct();
            
            //定义前台栏目
            $nav=[
                "index"=>[
                    "name"=>"首页",
                    "active"=>false
                ],
                "order"=>[
                    "name"=>"我的订单",
                    "active"=>false
                ],
                "cart"=>[
                    "name"=>"购物车",
                    "active"=>false
                ]
            ];
            
            //为当前访问的控制器对应的后台栏目修改active属性,模型控制器和方法都存在控制器中的静态变量里
            if(isset($nav[self::$controller])){
                $nav[self::$controller]["active"]=true;
            }
            
            $this->cache=ds::getCache();
            
            //获取正在上线的活动
            $m_active=new m_active();
            $this->active=$m_active->getActiveOnline();
            $this->assign(["active"=>$this->active]);
            
			//验证用户是否登陆
			if(isset($_COOKIE['uid'])){
				$this->uid=$_COOKIE['uid'];
				if($user=$this->cache->get("user-".$this->uid)){
					$this->user=$user;
					$this->assign(["user"=>$user]);
				}
			}
			// var_dump($_COOKIE['uid']);
			
			//访问方法时验证
			if(isset($this->checkAction["*"])){
				$func=$this->checkAction["*"];
				$this->$func();
			}
			if(isset($this->checkAction[self::$action])){
				$func=$this->checkAction[self::$action];
				$this->$func();
			}
			
            $this->assign(["nav"=>$nav]);
        }
		
		public function needLogin(){
			if(!$this->cache->get("user-".$this->uid)){
				showMsg(['errno'=>102,"errmsg"=>"必须登陆才能访问该方法"],"/index");
			}
		}
		
		public function forbidLogin(){
			if($this->cache->get("user-".$this->uid)){
				showMsg(['errno'=>103,"errmsg"=>"已登陆无法访问该方法"],"/index");
			}
		}
		
		public function needLoginAjax(){
			if(!$this->cache->get("user-".$this->uid)){
				return_result(['errno'=>102,"errmsg"=>"必须登陆才能访问该方法"]);
			}
		}
    }
?>