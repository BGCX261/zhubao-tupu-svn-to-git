<?php
$data['shops'] = array (
  'all' => 
  array (
    1 => 
    array (
      'id' => '1',
      'parent_id' => '0',
      'name' => '高价值类',
      'sort' => '100',
      'url' => '/share/shop.php?action=index&cid=1',
      'childs' => 
      array (
        0 => '6',
      ),
    ),
    2 => 
    array (
      'id' => '2',
      'parent_id' => '0',
      'name' => '低价值类',
      'sort' => '100',
      'url' => '/share/shop.php?action=index&cid=2',
      'childs' => 
      array (
        0 => '11',
      ),
    ),
    6 => 
    array (
      'id' => '6',
      'parent_id' => '1',
      'name' => '挂件 摆件',
      'sort' => '100',
      'url' => '/share/shop.php?action=index&cid=6',
    ),
    11 => 
    array (
      'id' => '11',
      'parent_id' => '2',
      'name' => '手链 脚链',
      'sort' => '100',
      'url' => '/share/shop.php?action=index&cid=11',
    ),
  ),
  'root' => 
  array (
    0 => '1',
    1 => '2',
  ),
);

?>