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

$content = "";

		$query = $DB->query( "SELECT icon, title, url, position, target FROM mkp_mainlinks WHERE type = '2' ORDER BY `position`");
		while( $row = $DB->fetch_row($query) ) {
			$showlink = $this->checklinkperm($row['url']);
			if($showlink) {continue;}
			$target = "";
			$row['icon'] = str_replace("<IMG>","$this->images", $row['icon']);
			$row['url'] = str_replace("<MKURL>","$this->siteurl", $row['url']);
			$row['url'] = str_replace("<MKFURL>","$mkportals->base_url", $row['url']);
			if (stristr($row['title'], '<LNG>')) {
				$titlel = str_replace("<LNG>","", $row['title']); 
				$row['title'] = $this->lang[$titlel];
			}
			if ($row['target'] == 1) {
				$target = "target=\"_blank\"";
			}
			$content .= "
		      		<tr><td width=\"100%\" class=\"tdblock\"><img src=\"{$row['icon']}\" align=\"left\" alt=\"\" />&nbsp;<a class=\"uno\" href=\"{$row['url']}\" $target >{$row['title']}</a></td></tr>
			";
		}
unset($query);
unset($row);

?>
