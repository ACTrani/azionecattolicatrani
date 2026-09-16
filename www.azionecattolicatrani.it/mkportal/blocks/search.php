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

$forumsearch = $mklib_board->forum_link("forumsearch");
$content = "";

// Internal Pages
$query = $DB->query( "SELECT id FROM mkp_pages LIMIT 1");
$row = $DB->fetch_row($query);

if ($row['id']) {				
	$content .= "
				<tr><td class=\"tdblock\"><img src=\"$this->images/frec.gif\" align=\"left\" alt=\"\" />&nbsp;&nbsp;<a class=\"uno\" href=\"$this->siteurl/index.php?ind=search\">{$this->lang['internalpages']}</a></td></tr>";
}
// end Internal Pages

if (!$this->config['mod_gallery']) {				
	$content .= "
				<tr><td class=\"tdblock\"><img src=\"$this->images/frec.gif\" align=\"left\" alt=\"\" />&nbsp;&nbsp;<a class=\"uno\" href=\"$this->siteurl/index.php?ind=gallery&amp;op=search\">{$this->lang['images']}</a></td></tr>";
}				
if (!$this->config['mod_downloads']) {				
	$content .= "				
				<tr><td class=\"tdblock\"><img src=\"$this->images/frec.gif\" align=\"left\" alt=\"\" />&nbsp;&nbsp;<a class=\"uno\" href=\"$this->siteurl/index.php?ind=downloads&amp;op=search\">{$this->lang['download']}</a></td></tr>";
}				
if (!$this->config['mod_reviews']) {				
	$content .= "				
				<tr><td class=\"tdblock\"><img src=\"$this->images/frec.gif\" align=\"left\" alt=\"\" />&nbsp;&nbsp;<a class=\"uno\" href=\"$this->siteurl/index.php?ind=reviews&amp;op=search\">{$this->lang['reviews']}</a></td></tr>";
}				
$content .= "				
				<tr><td class=\"tdblock\"><img src=\"$this->images/frec.gif\" align=\"left\" alt=\"\" />&nbsp;&nbsp;<a class=\"uno\" href=\"$forumsearch\">{$this->lang['forum']}</a></td></tr>

				<tr>
				  <td class=\"tdblock\" align=\"center\">
				    <a href=\"http://www.google.it/\"><img src=\"$this->siteurl/mkportal/modules/search/google_logo.gif\" alt=\"Google\" align=\"top\" /></a><br />

				    <form action=\"http://www.google.com/search\" method=\"get\" target=\"blank\">	    
				    <input size=\"12\" name=\"q\" class=\"mkblkinput\" /><br />
				    <input type=\"hidden\" name=\"hl\" />
				    <input type=\"submit\" name=\"btnG\" value=\"{$this->lang['m_search']}\" />
				    </form>
				  </td>
				</tr>
";

unset ($forumsearch);


?>