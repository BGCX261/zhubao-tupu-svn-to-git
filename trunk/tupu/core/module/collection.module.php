<?php
class CollectionModule
{
	public function index()
	{
		global $_FANWE;
		
		if(strpos($_SERVER["HTTP_USER_AGENT"],"MSIE"))
		{
				$browser = "Internet Explorer";
				$tmpl = "page/collection/collection_internet";
		}
		else if(strpos($_SERVER["HTTP_USER_AGENT"],"Firefox")) 
		{
				$browser = "Firefox"; 
				$tmpl = "page/collection/collection_firefox";
		} 	
		else if(strpos($_SERVER["HTTP_USER_AGENT"],"Chrome"))
		{
				$browser = "Google Chrome";
				$tmpl = "page/collection/collection_chrome";
		}      
		else if(strpos($_SERVER["HTTP_USER_AGENT"],"Safari"))
		{
				$browser = "Safari";  
				$tmpl = "page/collection/collection_safari";
		}     
		else if(strpos($_SERVER["HTTP_USER_AGENT"],"Opera"))  
		{
				$browser = "Opera";
				$tmpl = "page/collection/collection_opera";
		}	      
		else
		{
				$browser =  "Other";
				$tmpl = "page/collection/collection_other";
		}
		
		$cache_args = array(
				$browser,
		);
		$cache_file = getTplCache($tmpl,$browser);
		
		if(!@include($cache_file))
		{
				
				include template($tmpl);
		}
		
		display($cache_args);
	}	
	
	
	public function photo()
	{
		global $_FANWE;
		if($_FANWE['uid'] == 0)
		{
			$redir_url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
			fSetCookie('redir_url', $redir_url, time() + 3600);
			require_once fimport('dynamic/user');
			include template('page/user/user_login');
		}
		else
		{
			FanweService::instance()->cache->loadCache('albums');
			$imgs = $_FANWE['request']['imgUrl'];
			$pageUrl = $_FANWE['request']['pageUrl'];
			$img_list = explode(",",$imgs);
			$count_img = count($img_list);
			$videos=$_FANWE['request']['videoUrl'];
			$video_list=explode(",", $videos);
			
			$count_video=count($video_list);
			
			if($_FANWE['request']['showType'] == 1)
				include template("page/collection/collection_photos");
			else
				include template("page/collection/collection_photo");
		}
		display();
	}
	public function success()
	{
		global $_FANWE;
		$cache_file = getTplCache('page/collection/collection_success',$_FANWE['uid']);
		if(!@include($cache_file))
		{
			$go_url = FU('u/index',array("uid"=>$_FANWE['uid']));
			include template('page/collection/collection_success');
		}			
		display($cache_file);
	}
	
}
?>