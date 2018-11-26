<?php 
    namespace app\common\model;
    use app\common\model\base;
    
    class user extends base
    {
        public function login($name,$password){
			$sql="select * from `{$this->table}` where name=:name and password=:password";
			$params=["name"=>$name,"password"=>$password];
			$user=$this->db->row($sql,$params);
			
			//将用户信息存入缓存中,不能有密码
			
			
			return $user;
		}
    }
?>