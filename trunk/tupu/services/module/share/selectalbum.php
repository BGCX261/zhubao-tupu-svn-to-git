<?php
global $_FANWE;

$list = FS("Album")->getAlbumListByUid($_FANWE['uid']);
FanweService::instance()->cache->loadCache('albums');
$args = array(
	'list'=>&$list
);
if($_FANWE['request']['type'] == 'more')//采集页面出现多图分别选择杂志社
{
	$result['html'] = tplFetch('services/share/select_album_list',$args);
}
else
{
	$result['html'] = tplFetch('services/share/select_album',$args);
}
outputJson($result);
?>