<?php 
    namespace app\admin\controller;
    use app\admin\controller\baseCtrl;
    use app\common\model\question as m_question;
	use core\lib\Mysql\Page;
	
    class questionCtrl extends baseCtrl{
		protected $m_order;
		
		public function __construct(){
			parent::__construct();
			$this->m_question=new m_question();
		}
		
        public function index(){
			$pageRows=5;
			
			$allRows=$this->m_question->count();
			$page=new Page($allRows,$pageRows);
			$limit=$page->limit();
			$links=$page->getLinks();
			
			$questions=$this->m_question->getAllQue($limit);
			
            $this->display("index",["questions"=>$questions,"links"=>$links]);
        }
        
		public function add(){
            $this->display("add");
        }
		
		public function edit(){
			$question=$this->m_question->get($_GET['id']);
			
			$this->display("add",["question"=>$question]);
		}
		
		public function doEdit(){
			foreach($_POST as $k=>$v){
				$this->m_question->$k=$v;
			}
			
			$this->m_question->save();
			redirect("/admin/question");
		}
		
		public function doAdd(){
			$_POST["sys_ip"]=getClientIp();
			$this->m_question->create($_POST);
			redirect("/admin/question");
		}
		
		public function delete(){
			$this->m_question->sys_status=1;
			$this->m_question->save($_GET['id']);
			redirect("/admin/question");
		}
    }
?>