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
if (!defined("IN_MKP")) {
    	die ("Sorry !! You cannot access this file directly.");
}

function mkportal_board_out($output) {
	global $DB_site, $vboptions, $_REQUEST, $vbulletin;
	global $mkportals, $DB, $Skin, $MK_PATH, $mklib, $mklib_board, $MK_TIMEDIFF, $FORUM_PATH;
	
	$MK_PATH = "../";
	require $MK_PATH."mkportal/conf_mk.php";
	$CINQ = strstr($_SERVER['REQUEST_URI'], 'articles.php');
	if($FORUM_VIEW == 1 && !$CINQ && $_REQUEST['do'] != "im" && $_REQUEST['do'] != "getsmilies" && THIS_SCRIPT != "newattachment" && THIS_SCRIPT != "arcade" && THIS_SCRIPT != "vbchat") { 
		$boarddir = $MK_PATH.$FORUM_PATH."/";
		$mkportals->base_url = $boarddir."index.php";
		$mkportals->forum_url = $MK_PATH.$FORUM_PATH;
		$mkportals->member['id'] = $vbulletin->userinfo['userid'];
		$mkportals->member['name'] = $vbulletin->userinfo['username'];
		$mkportals->member['last_visit'] = $vbulletin->userinfo['lastvisit'];
		$mkportals->member['user_new_privmsg'] = $vbulletin->userinfo['pmtotal']."/".$vbulletin->userinfo['pmunread'];
		//$mkportals->member['show_popup'] = $vbulletin->userinfo['pmpopup'];
		$mkportals->member['timezone'] = $vbulletin->userinfo['timezoneoffset'];
		$mkportals->member['avatar'] = $user_info['avatar'];
		$mkportals->member['email'] = $vbulletin->userinfo['email'];
		if($vbulletin->userinfo['usergroupid'] == 6) {
			$mkportals->member['g_access_cp'] = 1;
		}
		$mkportals->member['mgroup'] = $vbulletin->userinfo['usergroupid'];
		if(!$mkportals->member['id']) {
			$mkportals->member['mgroup'] = 1;
		}
		$mkportals->member['theme'] = $vbulletin->userinfo['styleid'];
		if ($vbulletin->userinfo['styleid'] == 0) {
			$mkportals->member['theme'] = $vboptions['styleid'];
		}
		$boardlang = $vbulletin->userinfo['languageid'];
		if ($vbulletin->userinfo['languageid'] == 0) {
			$boardlang = $vboptions['languageid'];
		}	
		$query = mysql_query("SELECT title from " . TABLE_PREFIX . "language WHERE languageid = '$boardlang'");
		$row = mysql_fetch_array($query);
		$mkportals->member['mk_lang'] = $row['title'];
		
		require ($MK_PATH."mkportal/include/mk_mySQL.php");

		$DB = new db_driver;
		//$DB->db_connect_id = $vbulletin->db->connection_write;
		$DB->db_connect_id =& $vbulletin->db->connection_master; // >= vB version 3.6

		require_once $MK_PATH."mkportal/include/functions.php";
		require_once $MK_PATH."mkportal/include/VB/vb_board_functions.php";
		require_once "$mklib->template/tpl_main.php";
		if($MK_OFFLINE && !$mkportals->member['g_access_cp'] && !$mklib->member['g_access_cpa']) {
				$message = $mklib->lang['offline'];
				$mklib->off_line_page($message);
				exit;
		}
		$output = preg_replace( "`(\<!-- logo -->(.*?\</table>))`is", "", $output);
		$output = str_replace ("<div style=\"padding:0px 25px 0px 25px\">", "<div style=\"width:100%\">", $output);
		$output = str_replace ("margin: 5px 10px 10px 10px;", "", $output);
		$output = $mklib->printpage_forum("$mklib->forumcs", "$mklib->forumcd", "Forum", $output);
		$pos = strpos($output, "vbulletin_editor.js");
		if ($pos) {
			$output = str_replace ("onload=\"javascript:GetPos()\"", "", $output);
		}
	}
	return $output;

}


?>
