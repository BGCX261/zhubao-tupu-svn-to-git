<? if(!defined('IN_FANWE')) exit('Access Denied'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><? if(!empty($_FANWE['nav_title'])) { ?><?=$_FANWE['nav_title']?> - <? } if(empty($no_site_name)) { ?><?=$_FANWE['setting']['site_title']?><? } ?></title>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<meta name="keywords" content="<?=$_FANWE['seo_keywords']?><?=$_FANWE['setting']['site_keywords']?>" />
<meta name="description" content="<?=$_FANWE['seo_description']?><?=$_FANWE['setting']['site_description']?>" />
<link rel="icon" href="<?=$_FANWE['site_root']?>favicon.ico" type="image/x-icon" />
<?php 
$default_js[] = './public/js/jquery.js';
$default_js[] = './public/js/base.js';
        $default_js[] = './public/js/jquery.easing.js';
$default_js[] = './public/js/jquery.lazyload.js';
        $default_js[] = './public/js/swfobject.js';
 ?>
<script src="<?php echo scriptParse($default_js); ?>" type="text/javascript"></script>
   <script src='ZeroClipboard.js'></script>
   <script language="JavaScript">
var clip = null;
function init_copy() {
clip = new ZeroClipboard.Client();
clip.setHandCursor( true );
clip.glue('ClipBoard');
clip.addEventListener('mouseOver', function (client) {
// update the text on mouse over
clip.setText( document.getElementById('invite_link').value );
});
clip.addEventListener('onMouseUp', function (client) {
alert('复制成功');

});
}

</script>
<?php 
$current_css[] = './tpl/css/reset.css';
$current_css[] = './tpl/css/base.css';
$current_css[] = './tpl/css/globe.css';
$current_css[] = './tpl/css/publishbox.css';
$current_css[] = './tpl/css/lightbox.css';
$current_css[] = './tpl/css/addfav.css';
 ?>


 
<link rel="stylesheet" type="text/css" href="<?php echo cssParse($current_css); ?>" media="all"/>
    <? if(is_array($css_list)) { foreach($css_list as $css) { ?><link rel="stylesheet" type="text/css" href="<?php echo cssParse($css['url']); ?>"<? if(!empty($css['media'])) { ?> media="<?=$css['media']?>"<? } ?> />
<? } } ?>
<script type="text/javascript">
var SITE_PATH = '<?=$_FANWE['site_root']?>';
var SITE_URL = '<?=$_FANWE['site_url']?>';
var TPL_PATH = '<?=TPL_PATH?>';
var PUBLIC_PATH	 = '<?=PUBLIC_PATH?>';
var MODULE_NAME	 = '<?=MODULE_NAME?>';
var ACTION_NAME	 = '<?=ACTION_NAME?>';
var COOKIE_PRE = "<?=$_FANWE['config']['cookie']['cookie_pre']?>";
var TPL_NAME = '<?=$_FANWE["setting"]["site_tmpl"]?>';
</script>
</head>
<body>
<?php 
   if(DIANGAO_JS){
 
   	echo DIANGAO_JS;//添加diangao广告
   }
   
    ?>

<div id="pagewrap">
<!--新头部开始-->
        <div id="header" class="cf">
            <!--newhead-->
            <div id="header-1" class="header-1">
                <div class="topsysmenu cf" id="topsysmenu" <? if($_FANWE['module_name'] == 'Note') { ?> style="width:852px;"<? } ?>>
                    <a href="http://www.zhubao.com" class="mainlogo" <? if($_FANWE['module_name'] == 'Note') { ?>id="head_logo"<? } ?>><img src="<?=$_FANWE['site_root']?><?=$_FANWE['setting']['site_logo']?>" /></a>
                    <div class="menu_bar">
                        <!--dynamic getUserInfo-->                        <div class="topsearch">
                            <div class="searchrelt cf">
                                <form action="<?php echo FU('book/search',array()); ?>" method="post" onsubmit="return false;">
                                    <input type="text" class="inputtext" id="jquery-search" autocomplete="off" placeholder="搜索你喜欢的">
                                    <input type="submit" value=" " class="searchbt" id="fm_hd_btm_shbx_bttn" />
                                    <input type="hidden" name="action" value="search" />
                                </form>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
            <? if($_FANWE['uid'] == 0) { ?>
            <div id="header-3">
            	<div class="toplogin" id="toplogin" <? if($_FANWE['module_name'] == 'Note') { ?> style='width:852px;'<? } ?>>
                	<div id="intro" <? if($_FANWE['module_name'] == 'Note') { ?> style="margin-left: 237px;
margin-top: 15px;"<? } ?>>
                    	<h2><?=$_FANWE['setting']['site_name']?>，采集你喜欢的。</h2>
                        <div class="unauth-btns">
                        	<a href="<?php echo FU('user/register',array()); ?>" class="btn btn18 rbtn">
                            	<strong> 限时开放注册 »</strong>
                                <span></span>
                            </a>
                            <a id="login_btn" href="<?php echo FU('user/login',array()); ?>" class="btn btn18 wbtn">
                            	<strong><em></em> 登录</strong>
                                <span></span>
                            </a>
                        </div>
                        <!--<a id="mv_trigger" href="http://www.zuilv.com" onclick="app.showDialog('mv');return false;" title="观看视频，了解<?=$_FANWE['setting']['site_name']?>" class="mv"></a>-->
                    </div>	
                </div>
            </div>
            <? } ?>
           <? if($_FANWE['module_name'] == 'Index') { ?>
            <div id="header-2" class="header-2" >
                <div class="topchannel" id="topchannel">
                    <div class="channelmenu">
                        <a href="<?php echo FU('index',array("sy"=>"hot")); ?>" <? if($_FANWE['request']['sort'] == 'hot' || $_FANWE['request']['sort'] != 'all') { ?> class="current" <? } ?>>热门采集</a>
                        
                        <a href="<?php echo FU('index',array("sy"=>"all")); ?>" <? if($_FANWE['request']['sort'] == 'all') { ?> class="current" <? } ?>>全部采集</a>
                    </div>
                </div>
            </div>
            <? } ?>
    </div>
    <script>
jQuery(function($){
$("#jquery-search").focus(function(){
  				$(this).css('background-color','white');
});
$("#jquery-search").blur(function(){
  				$(this).css('background-color','#FAF7F7');
});
});
</script>
<div class="clear"></div>
<!--新头部结束-->
<div id="body_wrap">