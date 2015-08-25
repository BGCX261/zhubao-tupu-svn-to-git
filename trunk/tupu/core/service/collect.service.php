<?php
// +----------------------------------------------------------------------
// | 方维购物分享网站系统 (Build on ThinkPHP)
// +----------------------------------------------------------------------
// | Copyright (c) 2011 http://fanwe.com All rights reserved.
// +----------------------------------------------------------------------

/**
 * collect.service.php
 *
 * 分享服务类
 *
 * @package service
 * @author fishsword <fishsword@qq.com>
 */
class CollectService
{
	/**
	 * 通过的分享提交表单的数据处理
	 * @param mix $_POST 为标准分享表单 $_POST['type'] default:默认,bar:主题,ershou:二手,ask:问答
	 * $_POST['share_data'] = photo 有图 goods 有产品 goods_photo:有图有商品 default:都没有
	 * 	* 返回
	 *  array(
	 *   'status' => xxx  状态  bool
	 *   'share_id' => share_id
	 *   'error_code' => '错误代码'
	 *   'error_msg' => 错误描述
	 * )
	 */
	public function submitList($post_data,$is_album = FALSE,$is_score = FALSE,$is_check = TRUE,$type = 'ablum')
	{
		//创建分享数据
		global $_FANWE;
		$result = true;
		
		foreach($post_data['album_id'] as $k => $v)
		{
			$share_content = htmlspecialchars(trim($post_data['content'][$k]));
			$share_data = array();
			$share_data['content'] = $share_content;
			$share_data['uid'] = intval($_FANWE['uid']);
			$share_data['parent_id'] = 0; //分享的转发
			$share_data['rec_id'] = 0; //关联的编号
			$share_data['base_id'] = 0;
			$share_data['refer_url'] = $post_data['pageUrl'];
			$share_data['is_refer'] = 1;
			$share_data['albumid'] = intval($post_data['album_id'][$k]);
			if($is_check)
			{
				$check_result = FS("share")->checkWord($share_data['content'],'content');
				if($check_result['error_code'] == 1)
				{
					$check_result['status'] = false;
					return $check_result;
				}
			}
			$share_data['type'] = $type;
			$share_data['title'] = isset($post_data['title'][$k]) ? htmlspecialchars(trim($post_data['title'][$k])) : '';
			if(!empty($share_data['title']) && $is_check)
			{
				$check_result = FS("share")->checkWord($share_data['title'],'title');
				if($check_result['error_code'] == 1)
				{
					$check_result['status'] = false;
					return $check_result;
				}
			}
			$data = array();
			$data['share'] = $share_data;
			
			//创建图库数据
			$share_photos_data = array();
			
			
			$c_data = array();
			$c_data['img'] = $post_data['imgs'][$k];	
				
			if(empty($type) || !in_array($type,array('default', 'dapei', 'look')))
					$type = 'default';
			$c_data['type'] = $type;
			if( (!empty($post_data['videos'][$k])&&($post_data['videos'][$k]!='undefined'))){
				$c_data['video']=$post_data['videos'][$k];
				
			}
			
			$c_data['sort'] = 10;
			array_push($share_photos_data,$c_data);
					
			$data['share_photo'] = $share_photos_data;
			
			if($share_data['albumid'] > 0 && count($share_photos_data) == 0 )
				exit;
	
			$data['pub_out_check'] = intval($post_data['pub_out_check']);  //发送到外部微博
			
			$submit_result = FS("share")->save($data,$is_score,$is_album);
			
			if(!$submit_result)
			{
				$result = false;
				break;
			}
		}
		return $result;
	}
}
?>