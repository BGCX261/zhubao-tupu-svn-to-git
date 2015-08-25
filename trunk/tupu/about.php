<?php
define('MODULE_NAME', 'About');

$actions = array('index', 'goodies', 'help', 'etiquette');

if (isset($_REQUEST['action'])) {
    $action = strtolower($_REQUEST['action']);
    if (!in_array($action, $actions))
        $action = 'index';
}

define('ACTION_NAME', $action);

require dirname(__FILE__) . '/core/fanwe.php';
$fanwe = &FanweService::instance();
$fanwe->initialize();

require fimport('module/about');

switch (ACTION_NAME) {
    case 'index':
        AboutModule::index();
        break;
    case 'goodies':
        AboutModule::goodies();
        break;
    case 'help':
        AboutModule::help();
        break;
    case 'etiquette':
        AboutModule::etiquette();
        break;
}
?>