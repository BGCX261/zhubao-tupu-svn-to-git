<? if(!defined('IN_FANWE')) exit('Access Denied'); ?>
	</div>
    
    <div id="footer" <? if(MODULE_NAME == 'Index') { ?>style="display:none;" class="fixedfooter"<? } ?>>
<p id="footer-p"><?=$_FANWE['setting']['footer_html']?>
</p>
    </div>

    <a id="elevator" href="#" onclick="return false;" class="Indicator btn wbtn off"><strong> 回到顶部</strong><span></span></a>
</div> 
</body>
<?php 
    $default_js = array();
$default_js[] = './public/js/lang.js';
$default_js[] = './public/js/setting.js';
$default_js[] = './public/js/jquery.bgiframe.js';
$default_js[] = './public/js/jquery.weebox.js';
$default_js[] = './public/js/ajaxfileupload.js';
$default_js[] = './public/js/jquery.dragsort.js';
 ?>
<script src="<?php echo scriptParse($default_js); ?>" type="text/javascript" defer="true"></script><? if(is_array($js_list)) { foreach($js_list as $js) { ?><script src="<?php echo scriptParse($js); ?>" type="text/javascript"></script>
<? } } ?><!--dynamic getScript--><script type="text/javascript">
jQuery(function($){
$(".lazyload").lazyload({"placeholder":"./tpl/images/lazyload.gif"});
$("#fm_hd_btm_shbx_bttn").click(function(){
var keyword = $("#jquery-search").val();
if(keyword == '搜索你感兴趣的' || keyword == '')
{
return false;
}
$.Head_Search(keyword,'share');
return false;
});

$('#sysmenus li').hover(function(){
$(this).find('.topdmenu').slideDown(200);
$(this).find('.topothermenu').addClass('topmenuover');
$(this).find('.topusername').addClass('topmenuover');
$('#topdmenu1').width($(this).innerWidth()-2);
},function(){
$(this).find('.topdmenu').hide();
$(this).find('.topothermenu').removeClass('topmenuover');
$(this).find('.topusername').removeClass('topmenuover');
});
if($("#unlogin-alterbartop").length==1) {
setTimeout("$('#unlogin-alterbartop').slideDown()",1000);
}
if($("#firstload").length == 1)
{
if($("#firstload").css("display") == "block")
{
setTimeout("$('#firstload').hide();$('#body').show();$('#firstfastbox').hide();",300);

}
}

$(window).scroll(function(){
if ($(document.documentElement).scrollTop() > 0 || $(document.body).scrollTop() > 0) {
            $("#elevator").removeClass('off');
            $("#elevator").die().live("click",
            function() {
                $("body,html").animate({
                    scrollTop: 0
                },
                500)
            })
        } else {
            $("#elevator").addClass('off');
        }
});
});
 
</script>
</html>