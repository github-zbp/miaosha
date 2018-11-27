<?php 
	namespace app\index\service;
	use app\common\model\question as m_question;
	use core\lib\Datasource as ds;
    use app\common\model\goods as m_goods;
    
	class buy
	{
		private static $uid=null;
		private static $aid=null;
		// private static $answer_items=null;
		// private static $question_title=null;
		
		//获取问题,$num是选项个数
		public static function getQuestion($uid,$aid){
			self::$uid=$uid;
			self::$aid=$aid;
			
			$m_question=new m_question();
			$question=$m_question->getQuestionByAid($aid);
			// var_dump($question);
			if(!$question){
				echo json_encode(["errno"=>205,"errmsg"=>"商品对应的活动未设置问题"]);
				die;
			}
			
			//获取问题信息
			$question_info=self::makeQuestion($question);
			
			//制作问题的签名
			$sign=self::signQuestion($question_info);
			
			//返回前端页面所需的问题信息
			return [
				"ask"=>$question_info["ask"],
				"sign"=>$sign,
				"items"=>$question_info["answer_items"],
				"title"=>$question_info["title"]
			];
		}
		
		/*
		* $question是数组,是获取到的一条问题数据
		*
		*
		*/
		private static function makeQuestion($question,$num=4){
			//获取所有问题和答案
			foreach($question as $k=>$v){
				if(strpos($k,"ask") !== false){
					$ask_list[]=$v;
				}elseif(strpos($k,"answer") !== false){
					$answer_list[]=$v;
				}
			}
			
			//随机抽取其中4个答案作为选项
			$total_num=count($answer_list);
			$rand_list=[];
			while(count($rand_list)<$num){
				$rand_list[]=rand(0,$total_num-1);
				$rand_list=array_unique($rand_list);
			}
			
			foreach($rand_list as $k=>$v){
				$answer_items[]=$answer_list[$v];
			}
			
			//从上面4个答案选1个作为正确答案
			$answer_key=rand(0,$num-1);
			$answer=$answer_items[$answer_key];
			$ask=$ask_list[$rand_list[$answer_key]];
			
			$ip=getClientIp();
			$now=time();
			
			$question_info=[
				"id"=>$question["id"],
				'uid'=>self::$uid,
				"aid"=>self::$aid,
				"ip"=>$ip,
				"now"=>$now,
				"title"=>$question['title'],
				"ask"=>$ask,
				"answer"=>md5($answer),
				"answer_items"=>$answer_items
			];
            
            //将该问题存入缓存以方便以后验证
            $cache=ds::getCache();
            $cache->set("question-".self::$uid,$question_info);
			
			return $question_info;
		}
		
		/*
		* 问题签名
		*/
		private static function signQuestion($question_info){
			$question_info=json_encode($question_info);
			$sign=base64_encode(base64_encode($question_info));
			
			return $sign;
		}
        
        /*
        * 问题签名解密
        *
        */
        private static function unsignQuestion($sign){
            $sign=base64_decode(base64_decode($sign));
            $question_info=json_decode($sign,true);
            
            return $question_info;
        }
        
        /*
        * 验证问题正确性
        * $sign 问题签名
        * $item 问题答案
        */
        public static function checkQuestion(){
            //获取传参
            try{
                $sign=$_POST['sign'];
                $ask=$_POST['ask'];
                $item=md5($_POST['item']);
            }catch(\Exception $e){
                showMsg(["errno"=>999,"errmsg"=>"问题参数接收失败"]);
            }
            
            //先验证时间、ip、用户
            $que_info=self::unsignQuestion($sign,true);
            $current_uid=$_COOKIE["uid"];
            if($current_uid != $que_info['uid']){
                showMsg(["errno"=>'105',"errmsg"=>"用户发生错误"]);
            }
            
            //判断他传过来的$que_info是不是用户自己编的
            $cache=ds::getCache();
            $que_cache=$cache->get("question-".$current_uid);
            if(!$que_cache || $que_cache['id'] != $que_info['id'] || $que_cache['now'] != $que_info['now']){
                showMsg(['errno'=>'502',"errmsg"=>"用户提交了一个错误的问题签名"]);
            }
            
            $current_ip=getClientIp();
            if($current_ip != $que_info['ip']){
                showMsg(["errno"=>'106',"errmsg"=>"用户ip发生更换"]);
            }
            
            if($que_info["now"]+300 < time()){
                showMsg(['errno'=>'501','errmsg'=>"答题超时"]);
            }
            
            //验证问题正确性
            if($item != $que_info['answer']){
                showMsg(['errno'=>"503","errmsg"=>"答案错误"]);
            }
            
            return true;
        }
        
        public static function checkGoods(){
            try{
                $gids=isset($_POST['gid'])?[$_POST['gid']]:$_POST["gids"];
                $num=$_POST['num'];
            }catch(\Exception $e){
                showMsg(["errno"=>999,"errmsg"=>"商品参数接收失败"]);
            }
            
            //验证商品状态和上下线时间
            $m_goods=new m_goods();
            $goods=$m_goods->getGoodsForOrder($gids);
            foreach($goods as $k=>$v){
                if($v["sys_status"] != 1
                ){
                    showMsg(["errno"=>301,"errmsg"=>"商品{$v['title']}未上线或已下线"]);
                }
                if($v["time_end"]<time()
                || $v["time_begin"]>time()
                || $v["active_status"] != 1){
                    showMsg("errno"=>201,"errmsg"=>"商品{$v['title']}对应的活动未上线或已下线");
                }
            }
            
            return $goods;
        }
        
        
	}
?>