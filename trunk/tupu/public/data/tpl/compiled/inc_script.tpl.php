<? if(!defined('IN_FANWE')) exit('Access Denied'); ?>
<script type="text/javascript">
var USER_ID = <?=$_FANWE['uid']?>;
var URL_MODEL = "<?=$_FANWE['setting']['url_model']?>";
var DOMAIN = "<?=$_FANWE['domain']?>";
<?php 
if(!empty($_FANWE['authoritys']))
{
$manages = array_keys($_FANWE['authoritys']);
$manages = implode(',',$manages);
}
 ?>
var MANAGES = "<?=$manages?>";
</script>
<?php 
if(!empty($_FANWE['cookie']['dynamic_script']))
{
echo stripslashes($_FANWE['cookie']['dynamic_script']);
fSetCookie('dynamic_script','');
}
 ?>