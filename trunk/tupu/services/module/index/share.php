<?php
	global $_FANWE;
	$is_cate = false;
	$today_time = getTodayTime();
	$day7_time = $today_time - 604800;
	$img_width = $_FANWE['request']['width'];
	$cate_id = urldecode($_FANWE['request']['cate']);
	$sort_field = $_FANWE['request']['sort'];
	$page_num = intval($_FANWE['setting']['share_index_page'])?intval($_FANWE['setting']['share_index_page']):30;
	
	$is_cate = false;
	
	if($cate_id)
	{
		$is_cate = true;
	}
	
	if($is_cate)
	{
		
		$condition .= " AND als.cid = ".$cate_id;
		$join_sql = ' LEFT JOIN '.FDB::table('album_share').' AS als ON als.share_id = s.share_id ';
	}
	
	$audit_index=intval($_FANWE['setting']['audit_index']);
			if($audit_index){
				$condition .= " AND s.status =1 ";
				
			}
	
	$page = intval($_REQUEST['p']);
	$limit = (($page - 1)*$page_num).",".$page_num;
	$next_limit = ($page *$page_num).","."1";
	$field = ",(s.create_time > $day7_time) AS time_sort ";
	$sort = " ";
	if($sort_field == 'collect_count')
	{
		$sort = "  ORDER BY s.collect_count DESC ";
	}
	else
	{
		$sort = "  ORDER BY s.share_id DESC ";
	}
	
	
	$sql = 'SELECT DISTINCT(s.share_id),s.uid,s.content,s.collect_count,s.comment_count,s.create_time,s.cache_data ,s.parent_id '.$field.'
			FROM '.FDB::table('share').' AS s  '.$join_sql.' where s.share_data <> '." 'default' ".$condition .$sort.' LIMIT '.$limit;
	
	
	$next_sql = 'SELECT DISTINCT(s.share_id),s.uid,s.content,s.collect_count,s.comment_count,s.create_time,s.cache_data ,s.parent_id '.$field.'
			FROM '.FDB::table('share').' AS s  '.$join_sql.' where s.share_data <> '." 'default' ".$condition .$sort.' LIMIT '.$next_limit;
	$hasNextPage = FDB::fetchAll($next_sql);
	if($hasNextPage)
	{
		$is_next = 1;
	}
	else 
	{
		$is_next = 0;
	}
	
	$share_list = FDB::fetchAll($sql);
	$scale = 1;
	
	if($share_list)
	{
		$share_list = FS('Share')->getShareDetailList($share_list,false,false,false,true,2);
		
		$list = array();
		$current_user = array();
		$current_user['u_url'] = FU('u/index',array('uid'=>$_FANWE['uid']));
		$current_user['avt'] = avatar($_FANWE['uid'], 's', $is_src = 1);
		$i = 0;
		
		foreach($share_list as $k => $v)
		{
		$list[$i] = $v;
		$img = FDB::fetchFirst("select img,img_height,img_width from ".FDB::table("share_photo")." where share_id = ".$v['share_id']." and img <> '' ");
		
		$img_url = getImgName($img['img'],$img_width,999,2,true);
		
		$list[$i]['share_img'] = $img_url;
		
		$list[$i]['height'] = $img['img_height'] * ($img_width / $img['img_width']);
		
		$list[$i]['height'] = round($list[$i]['height'] / $scale);
		
		$list[$i]['width'] = $img_width;
		
		$list[$i]['avt'] = avatar($v['uid'], 's', $is_src = 1);
		
		$parent_id = FDB::resultFirst("select parent_id from ".FDB::table("share")." where share_id = ".$v['share_id']);
		if($parent_id == 0)
		{
			$list[$i]['isOriginal'] = 1;
		}
		else 
		{
			$list[$i]['isOriginal'] = 0;
		}
		$list[$i]['likeStatus'] = FS('Share')->getIsCollectByUid($v['share_id'],$_FANWE['uid'])?1:0;
		
		$list[$i]['isMe'] = $v['uid'] == $_FANWE['uid']?1:0;
		$list[$i]['is_relay'] = $v['is_relay'];
		//分享评论
		$share_comments = FS('Share')->getShareCommentList($v['share_id'],'0,2');
		if($share_comments)
		{
			$share_comments_data = array();
			$idxj = 0;
			foreach($share_comments as $vv)
			{
				$share_comments_data[$idxj]['comment_id'] = $vv['comment_id'];
				$share_comments_data[$idxj]['parent_id'] = $vv['parent_id'];
				$share_comments_data[$idxj]['user_url'] = FU('u/album',array('uid'=>$vv['user']['uid']));
				$share_comments_data[$idxj]['user_name'] = $vv['user']['user_name'];
				$share_comments_data[$idxj]['avt'] = avatar($vv['uid'], 's', $is_src = 1);
				$share_comments_data[$idxj]['comment'] = cutStr($vv['content'],20);
				$idxj++;
			}
			$list[$i]['comments'] = $share_comments_data;
		}
		
		$list[$i]['share_url'] = FU('note/index',array('sid'=>$v['share_id']));
		$list[$i]['u_url'] = FU('u/album',array('uid'=>$v['uid']));
		$list[$i]['relay_count'] = FDB::resultFirst("select relay_count from ".FDB::table("share")." where share_id = ".$v['share_id']);
		$album_sql = "select a.id,a.title from  ".FDB::table('album_share')." as ah left join ".FDB::table('album')." as a on ah.album_id = a.id where ah.share_id = ".$v['share_id'];
		$album = FDB::fetchFirst($album_sql);
		if($album)
		{
			$list[$i]['album_title'] = $album['title'];
			$list[$i]['is_album'] = 1;
			$list[$i]['album_url'] = FU("album/show",array('id'=>$album['id']));
		}
		else {
			$list[$i]['album_title'] = "";
			$list[$i]['is_album'] = 0;
			$list[$i]['album_url'] = "";
		}
		$list[$i]['zf_count'] = 10;
		$list[$i]['xh_count'] = 20;
		
		$list[$i]['user_name'] = FDB::resultFirst("select user_name from ".FDB::table('user')." where uid =".$v['uid']);
		$i++;
		}
		
		//$share['uid'] == $uid
		//outputJson(array('list'=>$list,'status'=>1));
		
		outputJson(array('result'=>$list,'current_user'=>$current_user,'status'=>1,'hasNextPage'=>$is_next));
	}
	else {
		outputJson(array('status'=>0,'hasNextPage'=>$is_next));
	}
	
	
	
	
	
?>