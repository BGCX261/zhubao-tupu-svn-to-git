<? if(!defined('IN_FANWE')) exit('Access Denied'); if($_FANWE['uid'] > 0) { ?>
<ul id="sysmenus" class="sysmenu">
    	<li><a href="<?php echo FU('index/index',array()); ?>" class="regmenu no-icon">首页</a>
        <li><a href="javascript:void(0)" class="regmenu" onclick="$.User_Share()">添加<span class="plus-icon"></span></a></li>
        <li id="about">
        	<a href="#" class="regmenu" onclick="return false;">关于
        	<span></span></a>
            <ul>
            	<li>
                	<a href="<?php echo FU('about/index',array()); ?>">关于<?=$_FANWE['setting']['site_name']?></a>
                </li>
                <li>
                	<a href="<?php echo FU('about/goodies',array()); ?>">采集工具</a>
                </li>
                <li>
                	<a href="<?php echo FU('about/help',array()); ?>">帮助</a>
                </li>
                <li>
                	<a href="<?php echo FU('about/etiquette',array()); ?>"><?=$_FANWE['setting']['site_name']?>礼仪</a>
                </li>
            </ul>
        </li>
        <li id="user_nav">
        	<a href="<?php echo FU('u/album',array()); ?>" class="regmenu">
            	<img src="<?php echo avatar($_FANWE['uid'],'s',1);?>" width="22" height="22"><?=$_FANWE['user_name']?><span></span>
            </a>
            <ul>
                <li><a href="<?php echo FU('u/album',array()); ?>">杂志社</a></li>
                <li><a href="<?php echo FU('u/talk',array("uid"=>$_FANWE['uid'])); ?>">采集</a></li>
                <li><a href="<?php echo FU('u/fav',array("uid"=>$_FANWE['uid'])); ?>">喜欢</a></li>
                <li><a href="<?php echo FU('u/message',array("uid"=>$_FANWE['uid'])); ?>">私信</a></li>
<li class="divider"><a href="<?php echo FU('u/fans',array("uid"=>$_FANWE['uid'])); ?>">我的粉丝</a></li>
<li><a href="<?php echo FU('u/follow',array("uid"=>$_FANWE['uid'])); ?>">我的关注</a></li>
<li><a href="<?php echo FU('u/friends',array("uid"=>$_FANWE['uid'])); ?>">双向关注</a></li>
<li class="divider"><a href="<?php echo FU('invite/index',array()); ?>">邀请&amp;查找好友</a></li>
                <li class="divider"><a href="<?php echo FU('settings/personal',array()); ?>">帐号设置</a></li>
                <li><a href="<?php echo FU('user/logout',array()); ?>">退出登录</a></li>
        </ul>
        </li>
</ul>
<? } else { ?>
<ul id="sysmenus" class="sysmenu">
    	<li><a href="<?php echo FU('index/index',array()); ?>" class="regmenu no-icon">首页</a>
        <li id="about">
        	<a href="#" class="regmenu">关于
        	<span></span></a>
            <ul>
            	<li>
                	<a href="<?php echo FU('about/index',array()); ?>">关于<?=$_FANWE['setting']['site_name']?></a>
                </li>
                <li>
                	<a href="<?php echo FU('about/goodies',array()); ?>">采集工具</a>
                </li>
                <li>
                	<a href="<?php echo FU('about/help',array()); ?>">帮助</a>
                </li>
                <li>
                	<a href="<?php echo FU('about/etiquette',array()); ?>"><?=$_FANWE['setting']['site_name']?>礼仪</a>
                </li>
            </ul>
        </li>
<li><a href="<?php echo FU('user/login',array()); ?>" class="regmenu no-icon">登陆</a></li>
</ul>
<? } ?>
<script>
jQuery(function($){
$("#about").hover(function(){
$(this).children("ul").show();
},function(){
$(this).children("ul").hide();
});
$("#user_nav").hover(function(){
$(this).children("ul").show();
},function(){
$(this).children("ul").hide();
});
});
</script>
