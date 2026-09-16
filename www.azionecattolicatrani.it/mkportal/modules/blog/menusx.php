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

$this->load_lang("lang_blogmenusx.php");
$link_user = $mklib_board->forum_link("profile");
 $menusx = "
				<tr>
				  <td>
				    <script type=\"text/javascript\">
					    function makesure_elblog() {
					    if (confirm('{$this->lang[mb_delbconfirm]}')) {
					    return true;
					    } else {
					    return false;
					    }
					    }
				    </script>
				  </td>
				</tr>
		";

//Main Menu
$content = "";
$file = $this->sitepath."mkportal/blocks/sitenav.php";
@require $file;
$menusx .= $Skin->view_block("{$this->lang['mb_mainm']}", $content);

//Blog Menu
$userlinks = "";
if($mkportals->member['g_access_cp'] || $mklib->member['g_send_blog']) {
	$userlinks = "
		<tr><td width=\"100%\" class=\"tdblock\"><img src=\"$this->images/frec.gif\" align=\"left\" alt=\"\" />&nbsp;<a class=\"uno\" href=\"$this->siteurl/index.php?ind=blog&amp;op=preview_blog\" target=\"_blank\">
		{$this->lang['mb_previewm']}</a></td></tr>
		<tr><td width=\"100%\" class=\"tdblock\"><img src=\"$this->images/frec.gif\" align=\"left\" alt=\"\" />&nbsp;<a class=\"uno\" href=\"$this->siteurl/index.php?ind=blog&amp;op=create\">
		{$this->lang['mb_createm']}</a></td></tr>
		<tr><td width=\"100%\" class=\"tdblock\"><img src=\"$this->images/frec.gif\" align=\"left\" alt=\"\" />&nbsp;<a class=\"uno\" href=\"$this->siteurl/index.php?ind=blog&amp;op=main_edit\">
		{$this->lang['mb_writem']}</a></td></tr>
		<tr><td width=\"100%\" class=\"tdblock\"><img src=\"$this->images/frec.gif\" align=\"left\" alt=\"\" />&nbsp;<a class=\"uno\" href=\"$this->siteurl/index.php?ind=blog&amp;op=edit_blog\">
		{$this->lang['mb_editbm']}</a></td></tr>
		<tr><td width=\"100%\" class=\"tdblock\"><img src=\"$this->images/frec.gif\" align=\"left\" alt=\"\" />&nbsp;<a class=\"uno\" href=\"$this->siteurl/index.php?ind=blog&amp;op=edit_template\">
		{$this->lang['mb_edittm']}</a></td></tr>
		<tr><td width=\"100%\" class=\"tdblock\"><img src=\"$this->images/frec.gif\" align=\"left\" alt=\"\" />&nbsp;<a class=\"uno\" href=\"$this->siteurl/index.php?ind=blog&amp;op=p_gal\">
		{$this->lang['mb_ygall']}</a></td></tr>
		<tr><td width=\"100%\" class=\"tdblock\"><img src=\"$this->images/frec.gif\" align=\"left\" alt=\"\" />&nbsp;<a class=\"uno\" href=\"$this->siteurl/index.php?ind=blog&amp;op=del_blog\" onclick=\"return makesure_elblog()\">
		{$this->lang['mb_deletem']}</a></td></tr>";
}

	$menusx .= $Skin->view_block("{$this->lang['mb_blogm']}", "<tr><td width=\"100%\" class=\"tdblock\"><img src=\"$this->images/frec.gif\" align=\"left\" alt=\"\" />&nbsp;<a href=\"$this->siteurl/index.php?ind=blog&amp;op=chart\" class=\"mktxtcontr\">
		{$this->lang['mb_chartm']}</a></td></tr>$userlinks");

//Personal Menu
$content = "";
	$file = $this->sitepath."mkportal/blocks/login.php";
	@require $file;
	$menusx .= $Skin->view_block("{$this->lang['mb_personalm']}", $content);

	//Last Created Blog
	$contentsx = "";
        $query = mysql_query("select id, autore, titolo from mkp_blog WHERE validate = '1' ORDER BY 'id' DESC LIMIT 20");

	if (mysql_num_rows($query)) {
		while (list ($idb, $autore, $titolo) = mysql_fetch_row ($query)) {
            $contentsx .= "
				<tr>
				  <td class=\"tdblock\">
				  <img src=\"$this->images/frec.gif\" align=\"left\" alt=\"\" />&nbsp;<a href=\"$this->siteurl/index.php?ind=blog&amp;op=home&amp;idu=$idb\">$titolo</a>
				  </td>
				</tr>
				<tr>
				  <td class=\"tdglobal\">
				  {$this->lang['mb_by']}: <a href=\"$link_user=$idb\" class=\"uno\">$autore</a><br />
				  </td>
				</tr>
			";
        	}
	$menusx .= $Skin->view_block("{$this->lang['mb_bloglastm']}", $contentsx);
	}

	//Most Visited
	$contentsx = "";
	$query = mysql_query("select id, titolo, click from mkp_blog WHERE validate = '1' ORDER BY 'click' DESC LIMIT 20");

	if (mysql_num_rows($query)) {
       		 while (list ($idb, $titolo, $click) = mysql_fetch_row ($query)) {
            $contentsx .= "
				<tr>
				  <td class=\"tdblock\">
				  <img src=\"$this->images/frec.gif\" align=\"left\" alt=\"\" />&nbsp;<a href=\"$this->siteurl/index.php?ind=blog&amp;op=home&amp;idu=$idb\">$titolo</a>
				  </td>
				</tr>
				<tr>
				  <td class=\"tdglobal\">
				  <span class=\"mktxtcontr\">$click</span> {$this->lang['mb_clicks']}
				  </td>
				</tr>
			";
        	}
	$menusx .= $Skin->view_block("{$this->lang['mb_bvisitedm']}", $contentsx);
	}

?>
