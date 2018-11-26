<?php 
    namespace app\index\controller;
    use app\index\controller\baseCtrl;
    use app\common\model\user as m_user;
	use core\lib\Datasource as ds;
	
    class userCtrl extends baseCtrl
    {
		public $checkAction=["login"=>"forbidLogin","index"=>"forbidLogin"];
		
        public function index(){
            $this->display("index");
        }
        
        public function login(){
			$name=$_POST["name"];
			$password=$_POST["password"];
			
			$m_user=new m_user();
			$user=$m_user->login($name,$password);
			if(!$user){
				showMsg(["errno"=>101,"msg"=>"账号或密码错误"]);
			}
			
			setcookie("uid",$user['id'],time()+3600*24*30,"/");
			unset($user['password']);
			// var_dump($_COOKIE['uid']);die;
			//存入memcache缓存
			$this->cache->set("user-".$user['id'],$user);
			
			//跳转
			redirect();
		}
		
		public function logout(){
			$uid=$_COOKIE["uid"];
			setcookie("uid","",-1,"/");
			$this->cache->delete("user-".$uid);
			redirect();
		}
    }
?>