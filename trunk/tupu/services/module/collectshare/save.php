<?php
	global $_FANWE;
	$_FANWE['request']['uid'] = $_FANWE['uid'];
	
	$result = array();
	if($_FANWE['uid'] == 0)
	{
		$result['status'] = 0;
		$result['message'] = "未登录";
	}
	$result['status'] = 1;
	$pageUrl = $_FANWE['request']['pageUrl'];
	$aid_one = $_FANWE['request']['album_id'];
	$content_one = $_FANWE['request']['content'];
	$imgs = $_FANWE['request']['imgArray'];
	$videos = $_FANWE['request']['videoArray'];
	$title_one = $_FANWE['request']['title'];
	$pub_out_check = $_FANWE['request']['pub_out_check'];
	
	$aid = array();
	$title = array();
	$content = array();
	
	foreach($imgs as $k=> $v)
	{
		$aid[$k] = $aid_one;
		$title[$k] = $title_one;
		$content[$k] = $content_one;
	}
	
	$data = array();
	$data['album_id'] = $aid;
	$data['content'] = $content;
	$data['imgs'] = $imgs;
	$data['videos'] = $videos;
	$data['title'] = $title;
	$data['pageUrl'] = $pageUrl;
	$data['pub_out_check'] = $pub_out_check;
	$share_submit = FS("Collect")->submitList($data);
	$success_url = FU("collection/success");
	$result['success_url'] = $success_url;
	
	
	outputJson($result);
?>