<?php 
    namespace app\admin\controller;
    use app\admin\controller\baseCtrl;
    use app\common\model\active as m_active;
	
    class activeCtrl extends baseCtrl{
		protected $m_active;
		
		public function __construct(){
			parent::__construct();
			$this->m_active=new m_active();
		}
		
        public function index(){
			$actives=$this->m_active->all();
			// var_dump($actives);
            $this->display("index",['actives'=>$actives]);
        }
        
        public function add(){
            $this->display("add");
        }
		
		public function edit(){
			$id=$_GET["id"];
			$active=$this->m_active->get($id);
			
            $this->display("add",["active"=>$active]);
        }
		
		public function doEdit(){
			$_POST["time_begin"]=strtotime(str_replace("T","",$_POST["time_begin"]));
			$_POST["time_end"]=strtotime(str_replace("T","",$_POST["time_end"]));
			foreach($_POST as $k=>$v){
				$this->m_active->$k=$v;
			}
			
			$this->m_active->save();
			redirect("/admin/active");
		}
		
		public function doAdd(){
			$_POST["time_begin"]=strtotime(str_replace("T","",$_POST["time_begin"]));
			$_POST["time_end"]=strtotime(str_replace("T","",$_POST["time_end"]));
			$_POST["sys_ip"]=getClientIp();
			$this->m_active->create($_POST);
			redirect("/admin/active");
		}
		
		public function online(){
			$this->m_active->sys_status=1;
			$this->m_active->save($_GET['id']);
			redirect("/admin/active");
		}
		
		public function delete(){
			$this->m_active->sys_status=2;
			$this->m_active->save($_GET['id']);
			redirect("/admin/active");
		}
    }
?>