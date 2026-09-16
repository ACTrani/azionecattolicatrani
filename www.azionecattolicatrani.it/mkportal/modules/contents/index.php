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

$idx = new mk_content;
class mk_content {

	function mk_content() {
		global $mkportals, $DB, $mklib, $Skin, $mklib_board;
		$testo = "";	
		
		if (isset($mkportals->input['skinid']) &&  $mkportals->member['id']) {
			$mklib_board->update_skin($mkportals->input['skinid']);
		}
		if (isset($mkportals->input['langid']) &&  $mkportals->member['id']) {
			$mklib_board->update_lang($mkportals->input['langid']);
		}

		//location
		$mklib_board->store_location("portale");

		$content = "";
		$pid = $mkportals->input['pid'];
		if ($pid) {
			$myquery = $DB->query("SELECT title, content, file, perms FROM mkp_pages WHERE id='$pid'");
			$row = $DB->fetch_row($myquery);
			$title_page = stripslashes($row['title']);
			$testo = stripslashes($row['content']);
			if ($mklib->mkeditor == "BBCODE") {
				$testo = $mklib->decode_bb($testo);
				$testo = $mklib_board->decode_smilies($testo);
			}
		}
		$perms = array();
		if ($row['perms']) {
			$perms =  unserialize($row['perms']);
		}
		if (in_array($mkportals->member['mgroup'], $perms)) {
		$message = "{$mklib->lang['unauth_page']}";
			$mklib->error_page($message);
			exit;
		}
		// php page
		if ($row['file']) {
		$file = $mklib->sitepath."mkportal/".$row['file'];
			if (is_file($file)) {
				@require $file;
				$testo ="<tr><td class=\"blocks\">".$content."</td></tr>";
			}
		}
		if ($testo) {
			$content = "
				<tr>
				  <td class=\"contents\">
				  ";
			$content .= $testo;
			$content .= "
				  </td>
				</tr>
				    ";
			$blocks .= $Skin->view_block($title_page, $content);
			$mklib->printpage("1", "1", $mklib->sitename, $blocks);
		} else {
			$mklib->main_page();
		}
	}
}
?>
