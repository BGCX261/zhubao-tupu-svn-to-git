<?php  function fanweC($name) { static $sys_conf = NULL; if($name == 'SITE_URL') return "http://".$_SERVER['HTTP_HOST']; else { if ($sys_conf === NULL) { $sys_conf = D("SysConf")->where("status=1")->getField("name,val"); } return $sys_conf[$name]; } } function addslashesDeep($value) { if (empty($value)) { return $value; } else { return is_array($value) ? array_map('addslashesDeep', $value) : addslashes($value); } } function addslashesDeepObj($obj) { if (is_object($obj) == true) { foreach ($obj AS $key => $val) { $obj->$key = addslashesDeep($val); } } else { $obj = addslashesDeep($obj); } return $obj; } function stripslashesDeep($value) { if (empty($value)) { return $value; } else { return is_array($value) ? array_map('stripslashesDeep', $value) : stripslashes($value); } } function makeSemiangle($str) { $arr = array('０' => '0', '１' => '1', '２' => '2', '３' => '3', '４' => '4', '５' => '5', '６' => '6', '７' => '7', '８' => '8', '９' => '9', 'Ａ' => 'A', 'Ｂ' => 'B', 'Ｃ' => 'C', 'Ｄ' => 'D', 'Ｅ' => 'E', 'Ｆ' => 'F', 'Ｇ' => 'G', 'Ｈ' => 'H', 'Ｉ' => 'I', 'Ｊ' => 'J', 'Ｋ' => 'K', 'Ｌ' => 'L', 'Ｍ' => 'M', 'Ｎ' => 'N', 'Ｏ' => 'O', 'Ｐ' => 'P', 'Ｑ' => 'Q', 'Ｒ' => 'R', 'Ｓ' => 'S', 'Ｔ' => 'T', 'Ｕ' => 'U', 'Ｖ' => 'V', 'Ｗ' => 'W', 'Ｘ' => 'X', 'Ｙ' => 'Y', 'Ｚ' => 'Z', 'ａ' => 'a', 'ｂ' => 'b', 'ｃ' => 'c', 'ｄ' => 'd', 'ｅ' => 'e', 'ｆ' => 'f', 'ｇ' => 'g', 'ｈ' => 'h', 'ｉ' => 'i', 'ｊ' => 'j', 'ｋ' => 'k', 'ｌ' => 'l', 'ｍ' => 'm', 'ｎ' => 'n', 'ｏ' => 'o', 'ｐ' => 'p', 'ｑ' => 'q', 'ｒ' => 'r', 'ｓ' => 's', 'ｔ' => 't', 'ｕ' => 'u', 'ｖ' => 'v', 'ｗ' => 'w', 'ｘ' => 'x', 'ｙ' => 'y', 'ｚ' => 'z', '（' => '(', '）' => ')', '〔' => '[', '〕' => ']', '【' => '[', '】' => ']', '〖' => '[', '〗' => ']', '“' => '[', '”' => ']', '‘' => '[', '’' => ']', '｛' => '{', '｝' => '}', '《' => '<', '》' => '>', '％' => '%', '＋' => '+', '—' => '-', '－' => '-', '～' => '-', '：' => ':', '。' => '.', '、' => ',', '，' => '.', '、' => '.', '；' => ',', '？' => '?', '！' => '!', '…' => '-', '‖' => '|', '”' => '"', '’' => '`', '‘' => '`', '｜' => '|', '〃' => '"', '　' => ' '); return strtr($str, $arr); } function getClientIp() { if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown")) $ip = getenv("HTTP_CLIENT_IP"); else if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown")) $ip = getenv("HTTP_X_FORWARDED_FOR"); else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown")) $ip = getenv("REMOTE_ADDR"); else if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown")) $ip = $_SERVER['REMOTE_ADDR']; else $ip = "unknown"; return($ip); } function msubstr($str, $start=0, $length, $charset="utf-8", $suffix=true) { if(function_exists("mb_substr")) { if ($suffix && strlen($str)>$length) return mb_substr($str, $start, $length, $charset)."..."; else return mb_substr($str, $start, $length, $charset); } elseif(function_exists('iconv_substr')) { if ($suffix && strlen($str)>$length) return iconv_substr($str,$start,$length,$charset)."..."; else return iconv_substr($str,$start,$length,$charset); } $re['utf-8'] = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/"; $re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/"; $re['gbk'] = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/"; $re['big5'] = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/"; preg_match_all($re[$charset], $str, $match); $slice = join("",array_slice($match[0], $start, $length)); if($suffix) return $slice."…"; return $slice; } function gmtTime() { return (time() - date('Z')); } function toDate($time,$format='Y-m-d H:i:s') { if( empty($time)) return ''; $format = str_replace('#',':',$format); $time_zone = intval(fanweC('TIME_ZONE')); $time = $time + $time_zone * 3600; return date($format,$time); } function strZTime($str) { $str = trim($str); if(empty($str)) return 0; $time_zone = intval(fanweC('TIME_ZONE')); $time = strtotime($str) - $time_zone * 3600; return $time; } function getStatusImg($status) { $status = intval($status); return '<img status="'.$status.'" src="'.APP_TMPL_PATH.'Static/Images/status-'.$status.'.gif" />'; } function clearCache() { Dir::delDir(FANWE_ROOT.'./public/data/admin/runtime'); @mkdir(FANWE_ROOT.'./public/data/admin/runtime', 0777); @chmod(FANWE_ROOT.'./public/data/admin/runtime', 0777); } function request($url, $post = '', $timeout = 15) { $context = array(); if(is_array($post)) $post = requestData($post); $context['http'] = array ( 'timeout' => $timeout, 'method' => 'POST', 'header'=>"Content-Type: application/x-www-form-urlencoded\r\n". "Content-Length: ".strlen($post)."\r\n". "Connection: Close\r\n". "Cache-Control: no-cache\r\n", 'content' => $post, ); return file_get_contents($url, false, stream_context_create($context)); } function requestData($arg='') { $s = $sep = ''; foreach($arg as $k => $v) { $k = urlencode($k); if(is_array($v)) { $s2 = $sep2 = ''; foreach($v as $k2 => $v2) { $k2 = urlencode($k2); $s2 .= "$sep2{$k}[$k2]=".urlencode(stripslashesDeep($v2)); $sep2 = '&'; } $s .= $sep.$s2; } else { $s .= "$sep$k=".urlencode(stripslashesDeep($v)); } $sep = '&'; } return $s; } if(!function_exists("mysqlLikeQuote")) { function mysqlLikeQuote($str) { return strtr($str, array("\\\\" => "\\\\\\\\", '_' => '\_', '%' => '\%', "\'" => "\\\\\'")); } } function createIN($item_list, $field_name = '') { if (empty($item_list)) { return $field_name . " IN ('') "; } else { if (! is_array($item_list)) { $item_list = explode(',', $item_list); } $item_list = array_unique($item_list); $item_list_tmp = ''; foreach ($item_list as $item) { if ($item !== '') { $item_list_tmp .= $item_list_tmp ? ",'$item'" : "'$item'"; } } if (empty($item_list_tmp)) { return $field_name . " IN ('') "; } else { return $field_name . ' IN (' . $item_list_tmp . ') '; } } } function getRelateShare($share_id) { $share_data = M("Share")->getByShareId($share_id); if($share_data) return "<a href='".u("Share/edit",array("share_id"=>$share_id))."' target='_blank'>".l("RELATE_SHARE")."</a>"; else return "<span style='text-decoration:line-through;'>".l("SHARE_DELETE")."</span>"; } function getLang($key,$file) { if(!empty($file)) L(include LANG_PATH . FANWE_LANG_SET . '/'.$file.'.php'); return L($key); } function echoFlush($str) { echo str_repeat(' ',4096); echo $str; } function utf8ToUnicodeA($char) { switch(strlen($char)) { case 1: return ord($char); case 2: $n = (ord($char[0]) & 0x3f) << 6; $n += ord($char[1]) & 0x3f; return $n; case 3: $n = (ord($char[0]) & 0x1f) << 12; $n += (ord($char[1]) & 0x3f) << 6; $n += ord($char[2]) & 0x3f; return $n; case 4: $n = (ord($char[0]) & 0x0f) << 18; $n += (ord($char[1]) & 0x3f) << 12; $n += (ord($char[2]) & 0x3f) << 6; $n += ord($char[3]) & 0x3f; return $n; } } function segmentToUnicodeA($str,$pre = '') { $arr = array(); $str_len = mb_strlen($str,'UTF-8'); for($i = 0;$i < $str_len;$i++) { $s = mb_substr($str,$i,1,'UTF-8'); if($s != ' ' && $s != '　') { $arr[] = $pre.'ux'.utf8ToUnicodeA($s); } } $arr = array_unique($arr); return implode(' ',$arr); } function clearSymbolA($str) { static $symbols = NULL; if($symbols === NULL) { $symbols = file_get_contents(FANWE_ROOT.'public/table/symbol.table'); $symbols = explode("\r\n",$symbols); } return str_replace($symbols,"",$str); } function getRefUrl() { $ref_url = $_SERVER['HTTP_REFERER']; $url = $_SERVER['REQUEST_URI']; echo $ref_url.'<br/>'; echo $url.'<br/>'; } return array ( 'app_debug' => false, 'app_domain_deploy' => false, 'app_sub_domain_deploy' => false, 'app_plugin_on' => false, 'app_file_case' => false, 'app_group_depr' => '.', 'app_group_list' => '', 'app_autoload_reg' => false, 'app_autoload_path' => '@.ORG.,Think.Util.', 'app_config_list' => array ( 0 => 'taglibs', 1 => 'routes', 2 => 'tags', 3 => 'htmls', 4 => 'modules', 5 => 'actions', ), 'cookie_expire' => 3600, 'cookie_domain' => '', 'cookie_path' => '/', 'cookie_prefix' => '', 'default_app' => '@', 'default_group' => 'Home', 'default_module' => 'Index', 'default_action' => 'index', 'default_charset' => 'utf-8', 'default_timezone' => 'PRC', 'default_ajax_return' => 'JSON', 'default_theme' => 'Default', 'default_lang' => 'zh-cn', 'db_type' => 'mysql', 'db_host' => 'localhost', 'db_name' => 'zhubao', 'db_user' => 'root', 'db_pwd' => 'zlick', 'db_port' => '3306', 'db_prefix' => 'zhubao_', 'db_suffix' => '', 'db_fieldtype_check' => false, 'db_fields_cache' => true, 'db_charset' => 'utf8', 'db_deploy_type' => 0, 'db_rw_separate' => false, 'data_cache_time' => -1, 'data_cache_compress' => false, 'data_cache_check' => false, 'data_cache_type' => 'File', 'data_cache_path' => 'D:/AppServ/www/zhubao/public/data/admin/runtime/Temp/', 'data_cache_subdir' => false, 'data_path_level' => 1, 'error_message' => '您浏览的页面暂时发生了错误！请稍后再试～', 'error_page' => '', 'html_cache_on' => false, 'html_cache_time' => 60, 'html_read_type' => 0, 'html_file_suffix' => '.shtml', 'lang_switch_on' => false, 'lang_auto_detect' => true, 'log_exception_record' => true, 'log_record' => false, 'log_file_size' => 2097152, 'log_record_level' => array ( 0 => 'EMERG', 1 => 'ALERT', 2 => 'CRIT', 3 => 'ERR', ), 'page_rollpage' => 5, 'page_listrows' => 20, 'session_auto_start' => true, 'show_run_time' => false, 'show_adv_time' => false, 'show_db_times' => false, 'show_cache_times' => false, 'show_use_mem' => false, 'show_page_trace' => false, 'show_error_msg' => true, 'tmpl_engine_type' => 'Think', 'tmpl_detect_theme' => false, 'tmpl_template_suffix' => '.html', 'tmpl_content_type' => 'text/html', 'tmpl_cachfile_suffix' => '.php', 'tmpl_deny_func_list' => 'echo,exit', 'tmpl_parse_string' => '', 'tmpl_l_delim' => '{', 'tmpl_r_delim' => '}', 'tmpl_var_identify' => 'array', 'tmpl_strip_space' => false, 'tmpl_cache_on' => false, 'tmpl_cache_time' => -1, 'tmpl_action_error' => 'Public:error', 'tmpl_action_success' => 'Public:success', 'tmpl_trace_file' => './ThinkPHP/Tpl/PageTrace.tpl.php', 'tmpl_exception_file' => './ThinkPHP/Tpl/ThinkException.tpl.php', 'tmpl_file_depr' => '/', 'taglib_begin' => '<', 'taglib_end' => '>', 'taglib_load' => true, 'taglib_build_in' => 'cx', 'taglib_pre_load' => '', 'tag_nested_level' => 3, 'tag_extend_parse' => '', 'token_on' => false, 'token_name' => '_fanwe_hash__', 'token_type' => 'md5', 'url_case_insensitive' => false, 'url_router_on' => false, 'url_route_rules' => array ( ), 'url_model' => 0, 'url_pathinfo_model' => 2, 'url_pathinfo_depr' => '/', 'url_html_suffix' => '', 'var_group' => 'g', 'var_module' => 'm', 'var_action' => 'a', 'var_router' => 'r', 'var_page' => 'p', 'var_template' => 't', 'var_language' => 'l', 'var_ajax_submit' => 'ajax', 'var_pathinfo' => 's', 'user_auth_on' => true, 'user_auth_type' => 1, 'auth_type' => array ( 0 => 'NODE', 1 => 'MODULE', 2 => 'ACTION', ), 'user_auth_key' => 'fanwe_shop_share', 'admin_auth_key' => 'administrator', 'user_auth_model' => 'Admin', 'auth_pwd_encoder' => 'md5', 'user_auth_gateway' => '?m=Public&a=login', 'not_auth_module' => 'Public,Index', 'require_auth_module' => '', 'not_auth_action' => '', 'require_auth_action' => '', 'guest_auth_on' => false, 'guest_auth_id' => 0, 'rbac_role_table' => 'role', 'rbac_user_table' => 'admin', 'rbac_access_table' => 'role_access', 'rbac_node_table' => 'role_node', 'db_like_fields' => 'title|remark', 'log_app' => array ( 'RoleNode' => array ( 0 => 'insert', 1 => 'update', 2 => 'remove', 3 => 'editfield', 4 => 'togglestatus', ), 'SysConf' => array ( 0 => 'update', ), ), '_taglibs_' => array ( 'fanwe' => '@.TagLib.TagLibFanwe', ), ); ?>