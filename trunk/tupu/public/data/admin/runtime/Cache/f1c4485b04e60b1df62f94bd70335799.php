<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link href="__TMPL__Static/Css/style.css" rel="stylesheet" />
<script type="text/javascript" src="__TMPL__Static/Js/jquery.js"></script>
<script type="text/javascript" src="__TMPL__Static/Js/base.js"></script>
<script type="text/javascript" src="__TMPL__Static/Js/json.js"></script>
<script type="text/javascript" src="__TMPL__Static/Js/jquery.pngFix.js"></script>
<script type="text/javascript">
<!--
//指定当前组模块URL地址 
var URL = '__URL__';
var ROOT_PATH = '__ROOT__';
var APP	 =	 '__APP__';
var STATIC = '__TMPL__Static';
var VAR_MODULE = '<?php echo c('VAR_MODULE');?>';
var VAR_ACTION = '<?php echo c('VAR_ACTION');?>';
var CURR_MODULE = '<?php echo ($module_name); ?>';
var CURR_ACTION = '<?php echo ($action_name); ?>';

//定义JS中使用的语言变量
var CONFIRM_DELETE = '<?php echo L("CONFIRM_DELETE");?>';
var AJAX_LOADING = '<?php echo L("AJAX_LOADING");?>';
var AJAX_ERROR = '<?php echo L("AJAX_ERROR");?>';
var ALREADY_REMOVE = '<?php echo L("ALREADY_REMOVE");?>';
var SEARCH_LOADING = '<?php echo L("SEARCH_LOADING");?>';
var CLICK_EDIT_CONTENT = '<?php echo L("CLICK_EDIT_CONTENT");?>';
//-->
</script>
</head>
<body>
	<div class="fanwe-body">
		<div class="fb-title"><div><p><span><?php echo ($ur_href); ?></span></p></div></div>
		<div class="fb-body">
			<table class="body-table" cellpadding="0" cellspacing="1" border="0">
				<tr>
					<td class="body-table-td">
						<div class="body-table-div">
<script type="text/javascript" src="__TMPL__Static/Js/dataList.js"></script>
<div class="handle-btns">
	<div class="link-button "><p><a id="" name="" href="<?php echo U(MODULE_NAME.'/clear',array('type'=>'custom','file'=>$dir));?>" class=""><?php echo L("CLEAR_ALL");?></a></p></div>
	<?php if($prev != ''): ?><div class="link-button "><p><a id="" name="" href="<?php echo U(MODULE_NAME.'/custom',array('dir'=>$prev));?>" class=""><?php echo L("RETURN_PREV");?></a></p></div><?php endif; ?>
</div>
<table id="checkList" class="table-list list" cellpadding="0" cellspacing="0" border="0">
	<thead>
		<tr>
			<th class="first"><span><?php echo L("FILE_NAME");?></span></th>
			<th width="140"><span><?php echo L("FILE_TYPE");?></span></th>
			<th width="60"><?php echo L("HANDLE");?></th>
		</tr>
	</thead>
	<tbody>
		<?php if(is_array($file_list)): foreach($file_list as $key=>$file_item): ?><tr <?php if($key % 2 == 1): ?>class="even"<?php endif; ?>>
			<td class="first" style="text-align:left; font-size:14px; font-family:Arial;">
				<?php if($file_item['is_dir'] == 1): ?><a href="<?php echo U(MODULE_NAME.'/custom',array('dir'=>$file_item['path']));?>"><img src='__TMPL__Static/Images/dir.png' />&nbsp;<?php echo ($file_item["path"]); ?></a>
				<?php else: ?>
				<img src='__TMPL__Static/Images/file.png' />&nbsp;<?php echo ($file_item["path"]); ?><?php endif; ?>
			</td>
			<td><?php echo L('FILE_TYPE_'.$file_item['is_dir']);?></td>
			<td>
				<a href="<?php echo U(MODULE_NAME.'/clear',array('type'=>'custom','file'=>$file_item['path']));?>"><?php echo L("CLEAR");?></a>
			</td>
		</tr><?php endforeach; endif; ?>
	</tbody>
</table>
						</div>
					</td>
				</tr>
			</table>
		</div>
	</div>
	<div class="ajax-loading"></div>
</body>
<script type="text/javascript">
jQuery(function($){
	updateBodyDivHeight();
	$(window).resize(function(){
		updateBodyDivHeight();
	});
});

function updateBodyDivHeight()
{
	jQuery(".body-table-div").height(jQuery(".fanwe-body").height() - 36);
	if(jQuery(".body-table-div").get(0).scrollHeight > jQuery(".body-table-div").height())
	{
		var width = jQuery(".body-table-div").width() - 16;
		jQuery(".body-table-div > *").each(function(){
			if(!$(this).hasClass('ajax-loading'))
			{
				$(this).width(width)	
			}
		});
	}
}
</script>
</html>