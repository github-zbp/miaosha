<?php 
	namespace app\index\service;
	use app\common\model\question as m_question;
	
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
			// var_dump($answer,$ask,$answer_items);
			
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
				"answer"=>$answer,
				"answer_items"=>$answer_items
			];
			
			return $question_info;
		}
		
		/*
		* 问题签名
		*/
		private static function signQuestion($question_info){
			// var_dump($question_info);
			$question_info=json_encode($question_info);
			$sign=base64_encode(base64_encode($question_info));
			// $sign=base64_decode(base64_decode($sign));
			
			return $sign;
		}
	}
?>