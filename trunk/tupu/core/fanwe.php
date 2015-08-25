<?php
if(!defined('FANWE_ROOT'))
	define('FANWE_ROOT', str_replace('core/fanwe.php', '', str_replace('\\', '/', __FILE__)));
$is_install=0;

//添加点高广告

if(file_exists(FANWE_ROOT."./public/adv_api/DianGao.php")){
	$diangao=@require(FANWE_ROOT."./public/adv_api/DianGao.php");
	define('DIANGAO_JS',$diangao['diangao_js']);
}else{
	define('DIANGAO_JS',FALSE);
}


if(!defined('FANWE_ROOT'))
	define('FANWE_ROOT', str_replace('core/fanwe.php', '', str_replace('\\', '/', __FILE__)));
	require FANWE_ROOT.'core/service/fanwe.service.php';
?>