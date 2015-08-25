<?php
$data['navs'] = array (
  'all' => 
  array (
    1 => 
    array (
      'id' => '1',
      'parent_id' => '0',
      'name' => '主导航',
      'sort' => '100',
      'status' => '1',
      'is_fix' => '1',
    ),
    2 => 
    array (
      'id' => '2',
      'parent_id' => '0',
      'name' => '底部导航',
      'sort' => '100',
      'status' => '1',
      'is_fix' => '1',
      'childs' => 
      array (
        0 => '4',
        1 => '5',
        2 => '6',
      ),
    ),
    3 => 
    array (
      'id' => '3',
      'parent_id' => '0',
      'name' => '固定链接',
      'sort' => '100',
      'status' => '1',
      'is_fix' => '1',
      'navs' => 
      array (
        0 => '1',
      ),
    ),
    4 => 
    array (
      'id' => '4',
      'parent_id' => '2',
      'name' => '网站',
      'sort' => '100',
      'status' => '1',
      'is_fix' => '0',
      'navs' => 
      array (
        0 => '2',
        1 => '3',
        2 => '4',
      ),
    ),
    5 => 
    array (
      'id' => '5',
      'parent_id' => '2',
      'name' => '团队',
      'sort' => '100',
      'status' => '1',
      'is_fix' => '0',
      'navs' => 
      array (
        0 => '5',
        1 => '6',
      ),
    ),
    6 => 
    array (
      'id' => '6',
      'parent_id' => '2',
      'name' => '帮助',
      'sort' => '100',
      'status' => '1',
      'is_fix' => '0',
      'navs' => 
      array (
        0 => '7',
        1 => '8',
        2 => '9',
      ),
    ),
  ),
  'root' => 
  array (
    0 => '1',
    1 => '2',
    2 => '3',
  ),
  'navs' => 
  array (
    1 => 
    array (
      'id' => '1',
      'name' => '申请达人贴子',
      'cid' => '3',
      'url' => '/daren.php?action=apply',
      'sort' => '100',
      'status' => '1',
      'is_fix' => '1',
      'target' => '1',
    ),
    2 => 
    array (
      'id' => '2',
      'name' => '购物分享',
      'cid' => '4',
      'url' => '/book.php?action=shopping',
      'sort' => '100',
      'status' => '1',
      'is_fix' => '0',
      'target' => '0',
    ),
    3 => 
    array (
      'id' => '3',
      'name' => '主题Club',
      'cid' => '4',
      'url' => '/club.php?action=index',
      'sort' => '100',
      'status' => '1',
      'is_fix' => '0',
      'target' => '0',
    ),
    4 => 
    array (
      'id' => '4',
      'name' => '达人秀',
      'cid' => '4',
      'url' => '/daren.php?action=index',
      'sort' => '100',
      'status' => '1',
      'is_fix' => '0',
      'target' => '0',
    ),
    5 => 
    array (
      'id' => '5',
      'name' => '招聘信息',
      'cid' => '5',
      'url' => '/club.php?action=detail&tid=1',
      'sort' => '100',
      'status' => '1',
      'is_fix' => '0',
      'target' => '0',
    ),
    6 => 
    array (
      'id' => '6',
      'name' => '联系我们',
      'cid' => '5',
      'url' => '/club.php?action=detail&tid=2',
      'sort' => '100',
      'status' => '1',
      'is_fix' => '0',
      'target' => '0',
    ),
    7 => 
    array (
      'id' => '7',
      'name' => '新手指南',
      'cid' => '6',
      'url' => '/club.php?action=detail&tid=3',
      'sort' => '100',
      'status' => '1',
      'is_fix' => '0',
      'target' => '0',
    ),
    8 => 
    array (
      'id' => '8',
      'name' => '意见簿',
      'cid' => '6',
      'url' => '/club.php?action=detail&tid=4',
      'sort' => '100',
      'status' => '1',
      'is_fix' => '0',
      'target' => '0',
    ),
    9 => 
    array (
      'id' => '9',
      'name' => '商家服务',
      'cid' => '6',
      'url' => 'mailto:service@fanwe.com',
      'sort' => '100',
      'status' => '1',
      'is_fix' => '0',
      'target' => '1',
    ),
  ),
);

?>