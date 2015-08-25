<?php
class NoteModule
{
	public function index()
	{
		NoteModule::show();
	}

	public function goods()
	{
		NoteModule::show('bao');
	}

	public function photo()
	{
		NoteModule::show('photo');
	}

	private function show($current_type = '')
	{
		global $_FANWE;
		$share_id = intval($_FANWE['request']['sid']);
		$id = intval($_FANWE['request']['id']);
		$share_detail = FS('Share')->getShareDetail($share_id);
		
		include fimport('dynamic/u');
		if($share_detail === false)
			fHeader("location: ".FU('index'));
		$page_title = preg_replace("/\[[^\]]+\]/i","",$share_detail['content']);
		$_FANWE['nav_title'] = $page_title.' - '.lang('common','share');
        $_FANWE['seo_description'] = $page_title;
        $_FANWE['setting']['site_description'] = '';
		$current_img = FDB::resultFirst("select img from ".FDB::table("share_photo")." where share_id = ".$share_id." and img <> '' ");
		if($current_img['img_width']>468){
			$current_img['img_width']=468;
		}
		$current_img_arr = FDB::fetchFirst("select * from ".FDB::table("share_photo")." where share_id = ".$share_id." and img <> '' ");
		//var_dump($current_img_arr);
		FDB::query('UPDATE '.FDB::table('share').' SET click_count = click_count + 1 WHERE share_id = '.$share_id);

		//上一个，下一个分享
		$pns = FS('Share')->getSameAlbumNextShares($share_detail['uid'],$share_id);
		$other_album_share = FS('share')->getSameAlbumShares($share_id);
		$current_location = $other_album_share['location'];
		unset($other_album_share['location']);
		$same_album_count = $other_album_share['count'];
		unset($other_album_share['count']);
		
		$aid = FDB::resultFirst("select album_id from ".FDB::table('album_share')." where share_id = ".$share_id);
		$album_sql = 'select al.id as id,al.title as title from '.FDB::table('album').' as al 
					 left join '.FDB::table('album_share').' as als on al.id = als.album_id 
					 where als.share_id = '.$share_id;
		$album_data = FDB::fetchFirst($album_sql);
		$is_follow_album = FS('album')->getIsFollow($aid,$_FANWE['uid']);
		
		//发布分享的会员
		$share_user = FS('User')->getUserById($share_detail['uid']);
		
		//喜欢分享的会员
		$share_detail['collects'] = FS('Share')->getShareCollectUser($share_id);
		if(!isset($share_detail['collects'][$_FANWE['uid']]))
		{
			if(FS('Share')->getIsCollectByUid($share_id,$_FANWE['uid']))
				$share_detail['collects'][$_FANWE['uid']] = $_FANWE['uid'];
		}

		//会员显示名称
		$user_show_name = FS('User')->getUserShowName($share_detail['uid']);
		
		//会员勋章
		$user_medals = FS('User')->getUserMedal($share_detail['uid']);

		//分享标签
		$share_tags = $share_detail['cache_data']['tags']['user'];
		FS('Share')->tagsFormat($share_tags);

        foreach($share_tags as $seo_tag)
        {
            $_FANWE['seo_keywords'] .= $seo_tag['tag_name'].',';
        }
		//是否可编辑标签
		$is_eidt_tag = FS('Share')->getIsEditTag($share_detail);

		//喜欢分享的会员还喜欢
		$fav_user_fav_share = FS('Share')->getCollectShareByShare($share_id);

		//发布分享的会员喜欢的分享
		$user_collect_share = FS('Share')->getCollectShareByUser($share_user['uid']);

		//是否可删除标签
		$is_remove_comment = FS('Share')->getIsRemoveComment($share_detail);

		//分享评论
		$share_detail['comments'] = FS('Share')->getShareCommentList($share_id,'0,10');

		//分享评论分页
		$pager = buildPage('',array(),$share_detail['comment_count'],$_FANWE['page'],10);
		unset($share_detail['cache_data']);
			
		$current_obj = NULL;
		if($current_type == '' || $id == 0)
		{
			if(!empty($share_detail['imgs']))
			{
				$current_obj = current($share_detail['imgs']);
				if($current_obj['type'] == 'g')
					$current_type = 'bao';
				else
					$current_type = 'photo';
			}
		}
		else
		{
			switch($current_type)
			{
				case 'bao':
					foreach($share_detail['imgs'] as $img)
					{
						$current_obj = $img;
						if($img['type'] == 'g' && $img['id'] == $id)
							break;
					}
				break;

				case 'photo':
					foreach($share_detail['imgs'] as $img)
					{
						$current_obj = $img;
						if($img['type'] == 'm' && $img['id'] == $id)
							break;
					}
				break;
			}
		}

		if(!empty($current_obj['name']))
			$_FANWE['nav_title'] = $current_obj['name'].' - '.lang('common','share');

		
		$current_img_id = FDB::resultFirst("select photo_id from ".FDB::table("share_photo")." where share_id = ".$share_id);
		//会员最被喜欢的照片
		$best_photo_share = FS('Share')->getBestCollectPhotoShareByUser($share_user['uid']);
		
		$current_type = FDB::resultFirst("select type from ".FDB::table("share_photo")." where share_id = ".$share_id);
		if($current_type=='video'){
			$current_video = FDB::resultFirst("select video from ".FDB::table("share_photo")." where share_id = ".$share_id);
		}
		//会员喜欢的照片
		$user_fav_photo = FS('Share')->getUserFavPhotoShare($share_user['uid']);
				
		$is_follow = FS('Share')->getIsCollectByUid($share_id,$_FANWE['uid']);
		
		include template('page/note/note_index');
		display();
	}
}
?>