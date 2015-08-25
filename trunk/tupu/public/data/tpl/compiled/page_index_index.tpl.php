<? if(!defined('IN_FANWE')) exit('Access Denied'); ?>

<?php 
$css_list[0]['url'] = './tpl/css/welcome.css';
//$js_list[0] = './tpl/js/welcome.js';
    $js_list[0] = './tpl/js/im_004.js';
 include template('inc/header'); ?><!--dynamic getHotCate--><div id="imloading" class="firstload" style="display:none;"><img src="./tpl/images/loading-footer.gif" /><span>加载中…</span></div>
<div id="firstload" class="firstload" style="display:none;">没有更多分享…</div><? include template('inc/footer'); ?>