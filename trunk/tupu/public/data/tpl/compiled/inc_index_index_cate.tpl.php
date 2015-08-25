<? if(!defined('IN_FANWE')) exit('Access Denied'); ?>
<div id="content" style=" ">     
<div id="leftLabel" class="rightbox wd206">
    	<div class="pin labels cf">
        	<div class="home_cf cf">
        	<a href="<?php echo FU('index/index',array()); ?>" <? if($category_id == '') { ?>class="current"<? } ?>>全部</a>
            
        <? if(is_array($_FANWE['cache']['albums']['category'])) { foreach($_FANWE['cache']['albums']['category'] as $category) { ?>                   <a href='<?php echo FU('index/index',array("hot"=>$category['id'])); ?>' <? if($category_id == $category['id']) { ?>class="current"<? } ?>><?=$category['name']?></a>
<? } } ?>
            </div>
        </div>
    </div> 
    
    <!--预加载数据-->
    <? if(is_array($list)) { foreach($list as $share) { ?>    <div class="imBoard rightbox" dataid = "<?=$share['share_id']?>">
    	<div class="pin">
        	<div class="modify">
            	<div class="actions" style="display: none; ">
                	<div class="left">
                		<a haref="javascript:;" onclick="$.Relay_Share(<?=$share['share_id']?>)" class="repin btn btn11 wbtn"><strong><em></em>转采</strong>
                        <span></span>
                        </a>
                    </div>
                    <div class="right">
                        <a class="comment clickable btn btn11 wbtn"><strong><em></em>评论</strong><span></span></a>
                        <? if($share['isMe']) { ?>
                            <a href="javascript:;" class="like btn btn11 wbtn" onclick="$.Edit_Share(<?=$share['share_id']?>)"><strong><em></em>编辑</strong><span></span></a>
                        <? } elseif($share['likeStatus']) { ?>
                            <a  parent_id = <?=$share['parent_id']?> share_id = <?=$share['share_id']?> size=32 st='like' class="like btn btn11 wbtn"><strong><em></em>取消喜欢</strong><span></span></a>
                        <? } else { ?>
                            <a  parent_id = <?=$share['parent_id']?> share_id = <?=$share['share_id']?> size=32 st='unlike'  class="like btn btn11 wbtn"><strong><em></em>喜欢</strong><span></span></a>
                        <? } ?>
                    </div>
                    
                </div>
                <div class="show-img" style="height:<?=$share['height']?>px;">
                	<a href="<?=$share['share_url']?>" target="_blank">
                    	<img class="picUrl" height="<?=$share['height']?>" src="<?=$share['share_img']?>" width="190">
<? if($share['is_video']) { ?>
<img src="<?=$_FANWE['site_root']?>tpl/<?=$_FANWE['setting']['site_tmpl']?>/images/play.gif" class='play' style='margin: <?=$share['video_style_top']?>px 0 22px -<?=$share['video_style_right']?>px;' />
<? } ?>
                    </a>
                </div>
                <div class="title-sign">
                	<p class="contentsms"><?=$share['content']?></p>
                    <p class="quantity" style="display:<? if($share['relay_count'] == 0 && $share['comment_count'] == 0 && $share['collect_count'] == 0) { ?> none<? } ?>;">
                    	<span style="display:<? if($share['replay_count'] == 0) { ?>none;<? } else { ?>inline-block;<? } ?>">
                        	<span>转发</span>
                            <span class="reshareNum"><?=$share['replay_count']?></span>
                        </span>&nbsp;
            			<span style="<? if($share['comment_count'] == 0) { ?>display:none;<? } else { ?>display:inline-block;<? } ?>">
                        	<span class="pointsNum">·</span>
                            <span>评论</span>
                            <span class="commentNum"><?=$share['comment_count']?></span>
                        </span>&nbsp;
                        <span style="<? if($share['collect_count'] == 0) { ?>display:none;<? } else { ?>display:inline-block;<? } ?>">
                        	<span class="pointsNum">·</span>
                            <span>喜欢</span>
                            <span class="likeNum"><?=$share['collect_count']?></span>
                        </span>
                    </p>
              	</div>
                <ul class="comentMain">
                	<li class="hover cf">
                    	<div class="uhead" style="height:30px;">
                        	<a href="<?=$share['u_url']?>">
                            	<img src="<?=$share['avt']?>">
                           	</a>
                       	</div>
                        <div class="uinfo">
                        	<p>
                            	<a href="<?=$share['u_url']?>" class="gray1"><?=$share['user_name']?></a> 
                                <? if($share['isOriginal'] == 1) { ?>分享到<? } else { ?>转发到<? } ?> 
                                <a href="<?=$share['album_url']?>" class="gray1"><?=$share['album_title']?></a>
                           	</p>
                        </div>
                    </li>
                    <? if(count($share['comments']) > 0) { ?>
                    <? if(is_array($share['comments'])) { foreach($share['comments'] as $comment) { ?>                        	<li class="cf">
                            	<div class="uhead" style="height:30px;">
                        			<a href="<?=$comment['user_url']?>"><img src="<?=$comment['avt']?>" /></a>
                                </div>
                                <div class="uinfo">
                                	<p>
                                    	<a href="<?=$comment['user_url']?>" class="gray"><?=$comment['user_name']?></a>
                                    </p>
                                    <p class="recoment" commentId="<?=$comment['comment_id']?>">
                                    	<?=$comment['comment']?>&nbsp;<a class="gray">回复</a>
                                    </p>
                                </div>
                            </li>
                        <? } } ?>
                    <? } ?>
                    
                </ul>
                <div class="postcomment" style="display:none;" parent_id="0">
                	<div class="cf title">
                    	<a href="javascript:void(0)" class="x commentClose">关闭</a>
                        添加评论
                    </div>
                    <div class="cf">
                    	<div class="uhead" style="height:30px;">
                        	<a href="<?=$current_user['u_url']?>"><img src="<?=$current_user['avt']?>"></a>
                       	</div>
                        <div class="commentbody">
                        	<span class="innerborder">
                            	<textarea class="commentTextarea" maxlength="140"></textarea>
                            </span>
                            <div class="submit cf">
                            	<span class="floatright count">
                                	<em class="lightblue">0</em>/140
                                </span>
                                <a class="unpincomment" href="javascript:void(0);">提交</a>
                            </div>
                       </div>
                  	</div>
              	</div>
           	</div>
      	</div>
    </div>  
    <? } } ?>
    
    <!--预加载数据结束-->
    
</div>
<script>
jQuery(function($){

$("#content .imBoard").hover(function(){
$(this).find(".modify").addClass("modifyhover");
    $(this).find(".actions").show();
},function(){
$(this).find(".modify").removeClass("modifyhover");
    $(this).find(".actions").hide();
});



var linkUrl = '<?=$link_url?>',jsonUrl = '<?=$json_url?>';
linkUrl = linkUrl +"&v=" +Math.random()*99999999;

autoLayout.init({
contentID:"content",
rightLoad:true,
leftID:"leftLabel",
rightID:[],
linkUrl:linkUrl
});
autoLayout.eachAction(jsonUrl);
});

</script>
