<?php 
    namespace app\admin\controller;
    use app\admin\controller\baseCtrl;
    use app\common\model\goods as m_goods;
	
    class goodsCtrl extends baseCtrl{
		public function __construct(){
			parent::__construct();
			$this->m_goods=new m_goods();
		}
		
        public function index(){
			$goods=$this->m_goods->all();
            $this->display("index",['goods'=>$goods]);;
        }
        
        public function add(){
            $this->display("add");
        }
		
		public function edit(){
			$goods=$this->m_goods->get($_GET["id"]);
            $this->display("add",["goods"=>$goods]);
        }
		
		public function doAdd(){
			//文件上传
			var_dump($_FILES);
			$file=$_FILES["img"];
			$info=[];
			$_POST['img']=upload(ROOT."/static/images/",$file);
			
			$_POST["sys_ip"]=getClientIp();
			$this->m_goods->create($_POST);
			
			redirect("/admin/goods");
		}
		
		// public function doEdit(){
			// 文件上传
			// $file=$_FILES["file"];
			// $_POST['img']=upload(ROOT."/static/images/",$file);
			
			// $_POST["sys_ip"]=getClientIp();
			// $this->m_goods->create($_POST);
			
			// redirect("/admin/goods");
		// }
    }
?>