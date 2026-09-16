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


$MK_PATH = "../";
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

$mklib->load_lang("lang_admin.php");


//controlla che sei loggato e admin

	if(!$mkportals->member['g_access_cp'] && !$mklib->member['g_access_cpa']) {
		$message = "{$mklib->lang['ad_noperms']}";
		$mklib->error_page($message);
		exit;
	}

	if($mkportals->member['name']=="Guest" OR $mkportals->member['name']=="") {
		$message = "{$mklib->lang['ad_noperms']}";
		$mklib->error_page($message);
		exit;
}


$mkportals->input = $mklib->mkp_input();
$ind = $mkportals->input['ind'];

$switch = array(
                'ad_blocks'       =>   "ad_blocks",
                'ad_blog'         =>   "ad_blog",
                'ad_chat'         =>   "ad_chat",
                'ad_contents'     =>   "ad_contents",
                'ad_download'     =>   "ad_download",
                'ad_gallery'      =>   "ad_gallery",
                'ad_main'         =>   "ad_main",
                'ad_news'         =>   "ad_news",
		'ad_boardnews'    =>   "ad_boardnews",
                'ad_perms'        =>   "ad_perms",
                'ad_poll'         =>   "ad_poll",
                'ad_quote'        =>   "ad_quote",
                'ad_review'       =>   "ad_review",
                'ad_topsite'      =>   "ad_topsite",
                'ad_urlo'         =>   "ad_urlo",
		'ad_nav'          =>   "ad_nav",
		'ad_skin'         =>   "ad_skin",
//-- language_management begin
                'ad_langs'        =>   "ad_langs",
//-- language_management end

//-- rss_reader begin
                'ad_rss'          =>   "ad_rss",
//-- rss_reader end
				'ad_approvals'    =>   "ad_approvals"
                );

if (!isset($switch[$ind])) {
    $ind = "ad_main";
}

if (!strstr($_SERVER['HTTP_REFERER'], "$mklib->mkurl/admin.php") && $ind != "ad_main") {
	$message = "{$mklib->lang['error_noallow']}";
	$mklib->error_page($message);
	exit;
}

require "./admin/{$switch[$ind]}.php";



?>
