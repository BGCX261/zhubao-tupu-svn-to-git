<?php
// +----------------------------------------------------------------------
// | 方维购物分享网站系统 (Build on ThinkPHP)
// +----------------------------------------------------------------------
// | Copyright (c) 2011 http://fanwe.com All rights reserved.
// +----------------------------------------------------------------------
require_once 'userbase.class.php';
require_once FANWE_ROOT.'sdks/taobao/TopClient.php';
require_once FANWE_ROOT."sdks/taobao/taobao.func.php";
class TaobaoUser extends UserBase
{
	public $config;
	private $type = 'taobao';
	private $client;
	
	public function __construct()
	{
		$this->config = $this->getConfig($this->type);
		$this->client = new TopClient;
		$this->client->appkey = $this->config['app_key'];
		$this->client->secretKey = $this->config['app_secret'];
	}
	
	public function loginHandler($parameters,$session)
	{
		global $_FANWE;
		$user = $this->getUserInfo($parameters['visitor_nick'],$session);
		$bind_user = $this->getUserByTypeKeyId($this->type,$user['user_id']);
		
		if($bind_user)
		{
			if($bind_user['status'] == 0)
				showError('登陆失败','该帐户已被管理员锁定',FU('index'));
			$_FANWE['uid'] = $bind_user['uid'];
			$this->bindUser($user,$parameters,$session);
			FS('User')->setSession($bind_user,1209600);
		}
		else
		{
			$data = array();
			$data['type'] = $this->type;
			$data['user_email'] = $user['email'];
			$data['user'] = $user;
			$data['parameters'] = $parameters;
			$data['session'] = $session;
			$this->jumpUserBindReg($data,$parameters['visitor_nick']);
		}
	}
	
	public function bindHandler($parameters,$session)
	{
		global $_FANWE;
		if($_FANWE['uid'] == 0)
			exit;
		
		$user = $this->getUserInfo($parameters['visitor_nick'],$session);
		$bind_user = $this->getUserByTypeKeyId($this->type,$user['user_id']);
		
		if($bind_user && $bind_user['uid'] != $_FANWE['uid'])
		{
			$data = array();
			$data['type'] = $this->type;
			$data['keyid'] = $user['user_id'];
			$data['short_name'] = $this->config['short_name'];
			$data['user'] = $user;
			$data['parameters'] = $parameters;
			$data['session'] = $session;
			fSetCookie('sync_bind_exists',authcode(serialize($data),'ENCODE'));
		}
		else
		{
			$this->bindUser($user,$parameters,$session);
		}
	}
	
	public function buyerHandler($parameters,$session)
	{
		global $_FANWE;	
		if($_FANWE['uid'] > 0)
		{
			$user = $this->getUserInfo($parameters['visitor_nick'],$session);
			$this->bindUser($user,$parameters,$session);
		}
	}
	
	public function bindByData($data)
	{
		$this->bindUser($data['user'],$data['parameters'],$data['session']);
	}
	
	public function bindUser($user,$parameters,$session)
	{
		if($user)
		{
			global $_FANWE;	
			$data = array();
			$data['uid'] = $_FANWE['uid'];
			$data['type'] = $this->type;
			$data['keyid'] = $user['user_id'];
			$info = array();
			$info['session_key'] = $session;
			$info['refresh_token'] = $parameters['refresh_token'];

			$info['user'] = $user;
			$data['info'] = serialize($info);
			if((int)$parameters['expires_in'] > 0)
				$data['refresh_time'] = TIME_UTC + (int)$parameters['expires_in'];
			else
				$data['refresh_time'] = 0;
			
			$update = array();
			$update['buyer_level'] = $user['buyer_credit']['level'];
			$update['seller_level'] = $user['seller_credit']['level'];
			FDB::update('user',$update,'uid = '.$_FANWE['uid']);
			
			$buyer = array();
			$buyer['is_buyer'] = 1;
			if($update['buyer_level'] < 2 || $update['seller_level'] > 6)
				$buyer['is_buyer'] = 0;
			FDB::update('user',$buyer,'uid = '.$_FANWE['uid'].' AND is_buyer > -1');
			
			if(!empty($user['avatar']) && !FS('User')->getIsAvatar($_FANWE['uid']))
			{
				$img = copyFile($user['avatar']);
				if($img !== false)
					FS('User')->saveAvatar($_FANWE['uid'],$img['path']);
			}
			FDB::insert('user_bind',$data,false,true);
		}
	}
	
	public function getUserInfo($nick,$sessionKey)
	{
		require_once FANWE_ROOT."sdks/taobao/request/UserGetRequest.php";
		$req = new UserGetRequest;
		$req->setFields("user_id,uid,nick,sex,buyer_credit,seller_credit,location,birthday,type,status,alipay_no,alipay_account,alipay_account,email,consumer_protection,alipay_bind,avatar");
		$req->setNick($nick);
		$resp = $this->client->execute($req,$sessionKey);
		if(isset($resp->user))
			$user = (array)$resp->user;
		elseif(isset($resp->code))
			exit(print_r($resp,true));
		else
			exit('error');
		
		if(empty($user['email']))
			$user['email'] = '';
		$user['buyer_credit'] = (array)$user['buyer_credit'];
		$user['location'] = (array)$user['location'];
		$user['seller_credit'] = (array)$user['seller_credit'];
		return $user;
	}
	
	public function getFollowers($uid)
	{
		$list = array();
		$uid = (int)$uid;
		if(!$uid)
			return $list;
		$user = FS('User')->getUserBindByType($uid,$this->type);
		//$client = new WeiboClient($this->config['app_key'],$this->config['app_secret'],$user['oauth_token'],$user['oauth_token_secret']);
		//$msg = $client->followers(0,20,$user['keyid']);
		$client = new WeiboClient($this->config['app_key'],$this->config['app_secret'],'2d2b2056e1a40f92d5c283a34298b1ff','8e8da9e53e4c85a2625dab12272e9277');
		$msg = $client->followers(0,20,1085149703);
		print_r($msg);
		exit;
	}
}
?>