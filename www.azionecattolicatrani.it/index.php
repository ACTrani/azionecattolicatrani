<?php
/*
+--------------------------------------------------------------------------
|   MkPortal
|   ========================================
|   by Meo aka Luponero <Amedeo de longis>
|      Don K. Colburn <visiblesoul.net>
|
|   Copyright (c) 2004-2006 mkportal.it
|   http://www.mkportal.it
|   Email: luponero@mclink.it
|
+---------------------------------------------------------------------------
|
|   > MKPortal
|   > Written By Amedeo de longis
|   > Date started: 9.2.2004
|
+--------------------------------------------------------------------------
*/

define ( 'IN_MKP', 1 );

$_SERVER['QUERY_STRING'] = str_replace(array('%3C', '%3E', '<', '>'), array('', '', '', ''), $_SERVER['QUERY_STRING'] );
$_SERVER['PHP_SELF'] = str_replace(array('%3C', '%3E', '<', '>'), array('', '', '', ''), $_SERVER['PHP_SELF'] );

$MK_PATH = "./";
require $MK_PATH."mkportal/conf_mk.php";

switch($MK_BOARD) {
	case 'IPB':
		$driverf = "IPB/ipb_driverf.php";
		$board_functions = "IPB/ipb_board_functions.php";
    break;
	case 'PHPBB':
    	$driverf = "PHPBB/php_driverf.php";
		$board_functions = "PHPBB/php_board_functions.php";
    break;
	case 'VB':
    	$driverf = "VB/vb_driverf.php";
		$board_functions = "VB/vb_board_functions.php";
    break;
	case 'OXY':
    	$driverf = "oxy_driverf.php";
		$board_functions = "oxy_board_functions.php";
    break;
    case 'IPB13':
    		$driverf = "IPB13/ipb13_driverf.php";
		$board_functions = "IPB13/ipb13_board_functions.php";
    break;
	case 'MYBB':
    		$driverf = "MYBB/mybb_driverf.php";
		$board_functions = "MYBB/mybb_board_functions.php";
    break;
	default:
    	$driverf = "SMF/smf_driverf.php";
		$board_functions = "SMF/smf_board_functions.php";
    break;
}

require $MK_PATH."mkportal/include/$driverf";
require $MK_PATH."mkportal/include/functions.php";
require $MK_PATH."mkportal/include/$board_functions";
require "$mklib->template/tpl_main.php";

$mkportals->input = $mklib->mkp_input();

if($MK_OFFLINE && !$mkportals->member['g_access_cp'] && !$mklib->member['g_access_cpa']) {
		$message = $mklib->lang['offline'];
		$mklib->off_line_page($message);
		exit;
}

$switch = array('blog'         =>   "blog",
                'chat'         =>   "chat",
                'contents'     =>   "contents",
                'downloads'    =>   "downloads",
                'gallery'      =>   "gallery",
                'news'         =>   "news",
                'quote'        =>   "quote",
                'reviews'      =>   "reviews",
                'search'       =>   "search",
                'topsite'      =>   "topsite",
                'urlobox'      =>   "urlobox",
		'staff'        =>   "staff",
		'docs'         =>   "docs",
		'xebook'       =>   "xebook"
                );


if (!isset($switch[$mkportals->input['ind']])) {
    $mkportals->input['ind'] = "contents";
}
if (!$mklib->disablegzip && $mkportals->input['ind'] != "downloads") {
	ob_end_clean();
	@ob_start('ob_gzhandler');
}
require "./mkportal/modules/{$switch[$mkportals->input['ind']]}/index.php";


?>
