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


class mklib {


	var $secret = "I'm luponero";
	var $config = array();
	var $member = array();
	var $forumpath = "";
	var $forumview = "";
	var $portalview = "";
	var $forumcd = "";
	var $forumcs = "";
	var $sitepath = "";
	var $sitename = "";
	var $siteurl = "";
	var $mkurl = "";
	var $template = "";
	var $mklang = "";
	var $lang = "";
	var $images = "";
	var $menucloseds = "";
	var $menucontents = "";
	var $menuclosedr = "";
	var $menucontentr = "";
	var $columnwidth = "";
	var $portalwidth = "";
	var $mkeditor = "";
	var $disablegzip = "";
	var $disablenav = "";
    	var $blocks_are_init = FALSE;
    	var $blocks = array();
	var $stats = array();
	var $charset = "";
	var $loadcolumnright = 1;
	var $loadcolumnleft = 1;
	var $unloadforumright = "";
	var $unloadforumleft = "";



    function logout () {
        global $mkportals;

        header("Location: {$mkportals->base_url}act=Login&CODE=03&return=$this->siteurl");
        exit;

    }
	function header ($title, $left, $right, $board_header="") {
		global $mkportals, $Skin, $DB, $mklib_board, $editorscript;
		$css = "<link href=\"$this->template/style.css\" rel=\"stylesheet\" type=\"text/css\" />";
		$js = "$this->template/mkp.js";
		if($board_header) {
			$title = "";
		} else  {
			$title = "<title>$title</title>";
		}
		if (!array_key_exists('g_access_urlobox', $this->member)) {
			$this->member['g_access_urlobox'] = 0;
		}
		if (!$this->config['mod_urlobox']) {
  			$urlo = $this->retrieve_urlo();
			if(!$mkportals->member['g_access_cp'] && !$this->member['g_access_urlobox']) {
				$urlo[0] = $this->lang['urlo_invis'];
				$urlo[1] = $this->lang['urlo_unauth'];
			}
		}
		if ($left == 0) {
			$this->menucloseds = "";
			$this->menucontents = "display:none";
		}
		if ($right == 0) {
			$this->menuclosedr = "";
			$this->menucontentr = "display:none";
		}
		$mainwidth = $this->portalwidth."px";
		if ($this->portalview == 0) {
			$mainwidth = "100%";
		}
		// editor + popup dei pm
		$pmk_js = "";
		if ($editorscript) {
			$pmk_js = $this->get_editor();
		}
		if ($mkportals->member['show_popup'] && $mkportals->member['id']) {
			$pmk_js .= $mklib_board->popup_pm($this->lang['popm1'], $this->lang['popm2'], $this->lang['popm3'], $this->lang['popm4']);

		}

		$output = $Skin->view_header($title, $css, $js, $pmk_js, $board_header);
		// apre la tabella principale della pagina
		$output .= $Skin->open_main($mainwidth);
		// header di sin
		$output .= $Skin->view_logo();
		// barra dei link
		$row_link = "";
		$query = $DB->query( "SELECT icon, title, url, position, target FROM mkp_mainlinks WHERE type = '1' ORDER BY `position`");
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
			$row_link .= $Skin->row_link("{$row['icon']}", "href='{$row['url']}' $target", $row['title']);
		}
		if ($this->disablenav != 1) {
			$output .= $Skin->view_linkbar($row_link);
		}
		//urlobox
		if (!$this->config['mod_urlobox']) {
			$output .= $Skin->view_urlo($urlo[0], $urlo[1]);
		}
		//separatore header-corpo
		$output .= $Skin->view_separator_h();
		//apre la table del corpo della pagina
		$output .= $Skin->open_body();
		return $output;

	}
//-- mod_less_queries begin (This is By Peter)
    function init_blocks () {
        global $DB;
        
        if ($this->blocks_are_init) return;
        $DB->query("SELECT * FROM mkp_blocks WHERE active='checked' order by progressive");
        while( $row = $DB->fetch_row() ) {
            $this->blocks[] = $row;
        }
        $this->blocks_are_init = TRUE;
    }
    
    function get_column($position = "sinistra") {
		global $mkportals, $DB, $std, $Skin, $mklib_board;
        $this->init_blocks();
        foreach($this->blocks as $row) {
            if ($row['position'] == $position ) {
                $content = "";
		$perms = array();
		$indarr = "blt".$row['id'];
		$titlem = isset($this->lang[$indarr])?$this->lang[$indarr]:$row['title'];
                $active = $row['active'];
    			if ($row['perms']) {
    				$perms =  unserialize($row['perms']);
    			}
			if(!$perms) {
				$perms = array();
			}
    			if ($active == "checked" && !in_array($mkportals->member['mgroup'], $perms)) {
                    switch($row['personal']) {
                        case '1':   if ($row['content'] != "") { // HTML Block
                    					$content = "<tr><td class=\"blocks\">".$row['content']."</td></tr>";
                    					if ($this->mkeditor == "BBCODE") {
                    						$content = $this->decode_bb($content);
                    					}
                                    }
                                    break;
                        case '2':   if ($row['content'] != "") { // Internal Page Links Block
                        				$content = $row['content'];
					                    $content = str_replace ("frec.gif", "$this->images/frec.gif", $content);
                                    }
                                    break;
                        case '3':   $file = $this->sitepath."mkportal/".$row['file']; // PHP Block
                					if (is_file($file)) {
                						@require $file;
                                        if ($content != "") {
                    						$content ="<tr><td class=\"blocks\">".$content."</td></tr>";
                                        }
                					}
                                    break;
                        default:    $file = $this->sitepath."mkportal/blocks/".$row['file']; // Uploaded Block
                                    $content = "";
                                    if (is_file($file)) {
                                        require $file;
                                    }
                                    break;
                    }
                    if ($content != "") {
                        $column .= $Skin->view_block($titlem, $content);
                    }
                }
            }
        }
        return $column;
    }

    function block_left () {
		global $mkportals, $DB, $std, $Skin, $mklib_board;
        
        if (defined("OFF_LINE")) {
            return "";
        }
        if ($blocks = $this->get_column("sinistra")) {
            $output = $Skin->view_column_left($blocks);
            $output .= $Skin->view_separator_v();
        }
        return $output;
    }

    function block_right () {
		global $mkportals, $DB, $std, $Skin, $mklib_board;
        
        if (defined("OFF_LINE")) {
            return "";
        }
        if ($blocks = $this->get_column("destra")) {
            $output .= $Skin->view_separator_v();
            $output .= $Skin->view_column_right($blocks);
        }
        return $output;
    }

    function main_page () {
	global $mkportals, $DB, $std, $Skin, $mklib_board;
        
        $blocks = $this->get_column("centro");
        $title = $this->sitename;
        $this->printpage("1", "1", $title, $blocks);
    }
//-- mod_less_queries end


	function block_center ($content) {
		global $Skin, $mklib_board;
		$output = $Skin->view_column_center($content);
		return $output;
	}

	function footer () {
		global $Skin, $DB;
		//chiude la table del corpo della pagina
		$output = $Skin->close_body();
		// chiude la tabella principale della pagina
		$output .= $Skin->close_main();
		$ttime = $this->etimer();
		//footer WARNING YOU CANNOT REMOVE OR MODIFY THIS COPYRIGHT CODE. 
		// ATTENZIONE E' VIETATO TOGLIERE O CAMBIARE LA STRINGA DEL COPYRIGHT !!
		$foot_logo = ($this->config['foot_logo'] == 1) ? "<img src=\"{$this->template}/images/loghino.gif\" alt=\"\" /><br />" : '';
		$foot_version = ($this->config['foot_version'] == 1) ? " {$this->config['mk_version']}" : '';
		
		$copy = $foot_logo.'<span style="font-size: 10px;"><a style="text-decoration: none;" href="http://www.mkportal.it/" target="_blank">MKPortal</a>'.$foot_version.' &copy;2003-2006 <a style="text-decoration: none;" href="http://www.mkportal.it/" target="_blank">mkportal.it</a></span>';
		
		//debug
		if ($this->config['foot_debug'] == 1) {
			$copy .= "<br /><span style=\"font-size: 10px;\">".$this->lang['debugout1']." ".$ttime." ".$this->lang['debugout2']." ".$DB->query_count." ".$this->lang['debugout3']."</span>";
		}
		$output .= $Skin->view_footer($copy);
		return $output;
	}
	function footer_admin () {
		global $Skin;
		//chiude la table del corpo della pagina
		$output .= $Skin->close_body();
		// chiude la tabella principale della pagina
		$output .= $Skin->close_main();
		//footer WARNING YOU CANNOT REMOVE OR MODIFY THIS COPYRIGHT CODE.
		//footer pagina ATTENZIONE E' VIETATO TOGLIERE O CAMBIARE LA STRINGA DEL COPYRIGHT !!
		$copy = "<img src=\"$this->template/images/loghino.gif\" alt=\"\" /><br /><span style=\"font-size: 10px;\"><a style=\"text-decoration: none;\" href=\"http://www.mkportal.it/\" target=\"_blank\">MKPortal</a> {$this->config['mk_version']} &copy;2003-2006 <a style=\"text-decoration: none;\" href=\"http://www.mkportal.it/\" target=\"_blank\">mkportal.it</a></span>";
		$output .= $Skin->view_footer($copy);
		return $output;
	}
	function printpage ($left, $right, $title, $content_main, $editor="") {
		global $DB, $Skin, $mklib_board, $mkportals;
		
		// parse content if there is header. Remove header and other duplicates tag
		$board_header = "";
		$pos = strpos($content_main, "<head>");
		$pos2 = strpos($content_main, "</head>");
		if ($pos && $pos2)  {
			$board_header = substr($content_main, ($pos +6), ($pos2 - $pos -6));
			$content_main = substr($content_main, $pos2);
			$content_main = str_replace ("</head>", "", $content_main);
			$content_main = str_replace ("<body>", "", $content_main);
			$content_main = str_replace ("</body>", "", $content_main);
			$content_main = str_replace ("</html>", "", $content_main);
			$content_main = "<tr><td valign=\"top\" align=\"left\">".$content_main."</td></tr>";
		}
		//end parse
		$output = $this->header($title, $left, $right, $board_header);
		if ($this->loadcolumnleft)  {
			$output .= $this->block_left();
		}
		$output .= $this->block_center($content_main);
		if ($this->loadcolumnright)  {
			$output .= $this->block_right();
		}
		$output .= $editor;
		$output .= $this->footer();
		print $output;
		$this->update_counter();
		$DB->close_db();
		exit;
	}
	
	function printpage_forum ($left, $right, $title, $content_main, $editor="") {
		global $DB, $Skin, $mklib_board, $mkportals;
		
		// parse content if there is header. Remove header and other duplicates tag
		$board_header = "";
		$pos = strpos($content_main, "<head>");
		$pos2 = strpos($content_main, "</head>");
		if ($pos && $pos2)  {
			$board_header = substr($content_main, ($pos +6), ($pos2 - $pos -6));
			$content_main = substr($content_main, $pos2);
			$content_main = str_replace ("</head>", "", $content_main);
			$content_main = str_replace ("<body>", "", $content_main);
			$content_main = str_replace ("</body>", "", $content_main);
			$content_main = str_replace ("</html>", "", $content_main);
			$content_main = "<tr><td valign=\"top\" align=\"left\">".$content_main."</td></tr>";
		}

		//end parse
		$output = $this->header($title, $left, $right, $board_header);
		if ($this->unloadforumleft == 0)  {
			$output .= $this->block_left();
		}
		$output .= $this->block_center($content_main);
		if ($this->unloadforumright == 0)  {
			$output .= $this->block_right();
		}
		$output .= $editor;
		$output .= $this->footer();
		$this->update_counter();
		return $output;
		//$DB->close_db();
		//exit;
	}



	function printpage_admin ($title, $content_admin, $editor="") {
		global $Skin, $DB;
		require "admin/ad_menu.php";
		$output = $this->header($title, "1", "0");
		$output .= $Skin->view_column_left($menu);
		$output .= $Skin->view_separator_v();
		$output .= $this->block_center($content_admin);
		$output .= $editor;
		$output .= $this->footer_admin();		
		$DB->close_db();
		print $output;
		exit;
	}

	function printpage_blog ($left, $right, $title, $content_blog, $editor="") {
		global $mkportals, $DB, $Skin, $mklib_board, $mklib;
		require "mkportal/modules/blog/menusx.php";
		require "mkportal/modules/blog/menudx.php";

		$output = $this->header($title, $left, $right);
		if ($this->loadcolumnleft)  {
			$output .= $Skin->view_column_left($menusx);
			$output .= $Skin->view_separator_v();
		}
		$output .= $this->block_center($content_blog);
		if ($this->loadcolumnright)  {
			$output .= $Skin->view_separator_v();
			$output .= $Skin->view_column_right($menudx);
		}
		$output .= $editor;
		$output .= $this->footer();
		$this->update_counter();
		$DB->close_db();
		print $output;
		exit;
	}

	function error_page ($message) {
		global $mkportals, $DB, $Skin;
		$titlem = "";
  		$content ="
			<tr>
			  <td class=\"contents\">
			    <div align=\"center\" class=\"tabmain\"><br />
			      <img src=\"$this->template/images/error.gif\" alt=\"\" /><br />
			      <span class=\"mkerror\">! {$this->lang['error']} !</span><br /><br />
			      <b> {$this->lang['error_pre']}<br />
			      $message</b><br /><br /><br /><br />
				<table>
				  <tr>
				    <td><a href=\"javascript:history.go(-1)\"><img src=\"$this->template/images/f2.gif\" alt=\"\" /></a>
				    </td>
				    <td><a href=\"javascript:history.go(-1)\">{$this->lang['back']}</a>
				    </td>
				  </tr>
				</table>
			    </div>
			  </td>
			</tr>
		";
		$blocks .= $Skin->view_block($titlem, $content);
  		$title = "{$this->lang['error']}";
		$this->printpage("1", "1", $title, $blocks);
	}
	function message_page ($message) {
		global $mkportals, $DB, $Skin;
		$content ="
		<tr>
  		<td>
    		<table class=\"moduleborder\" cellspacing=\"1\" cellpadding=\"0\" width=\"98%\" align=\"center\" border=\"0\">
      		<tr>
 		<td class=\"titadmin\" width=\"100%\" align=\"center\">
		<br /><br />{$message}<br /><br /><br />
		</td>
      		</tr>
      		<tr>
		<td align=\"center\" class=\"modulecell\">
		<br /><br /><div align=\"center\"><span style=\"font-size: 10px;\"><a style=\"text-decoration: none;\" href=\"http://www.mkportal.it/\" target=\"_blank\">MKPortal</a> {$this->config['mk_version']} &copy;2003-2006 <a style=\"text-decoration: none;\" href=\"http://www.mkportal.it/\" target=\"_blank\">mkportal.it</a></span></div>
		</td>
      		</tr>
    		</table>
  		</td>
		</tr>
		";
		$title = "{$this->lang['messaget']}";
		$blocks .= $Skin->view_block($title, $content);
		$this->printpage("1", "1", $title, $blocks);
	}
	function off_line_page ($message) {
		global $mkportals, $DB, $Skin, $mklib_board, $mklib;

		$css = "<link href=\"$this->template/style.css\" rel=\"stylesheet\" type=\"text/css\" />";		

		if ($Skin = "Forum"){
		$css = $mklib_board->import_css();
		}

		$output ="
<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\"
        \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"en\" lang=\"en\">		
<head>
  <meta http-equiv=\"content-type\" content=\"text/html; charset={$mklib->charset}\" />
  <meta name=\"generator\" content=\"MKPortal\" />
  <title>$this->sitename</title>
  {$css}
</head>
<body style=\"margin: 100px;\">
  <div class=\"offlinetxt\" style=\"padding: 10px;\" align=\"center\">
    <img src=\"$this->template/images/error.gif\" alt=\"\" /><br />
    $this->sitename
    <p>{$this->lang['error_pre']}</p>
    $message
  </div>			
</body>
</html>
		";
		print $output;
		//$DB->close_db();
		exit;
	}
	function update_counter () {
		global $DB;
		$counter = $this->config['counter'];
		++$counter;
		$DB->query("UPDATE mkp_config SET valore ='$counter' where chiave = 'counter'");
	}

	function retrieve_urlo() {
 		global $mkportals, $DB;

		$urlodate = $this->create_date($this->stats['urlo_time']);
		$messag = ereg_replace("<br />", " ", $this->stats['urlo_message']);
		$messag = $this->decode_bb($messag);
		$urlo1 = "{$this->lang['urlo_by']} <span class=\"urlocontrast\"><b>{$this->stats['urlo_name']}</b></span> {$this->lang['urlo_time']} $urlodate <br />";
		$urlo2 = "$messag";
		if($this->stats['urlo_time'] == NULL) {
			$urlo1 = "<span class=\"urlocontrast\">({$this->lang['urlo_not']})</span> - <a href=\"$this->siteurl/index.php?ind=urlobox\">{$this->lang['urlo_here']}</a> <br />";
		}
 		return array($urlo1, $urlo2);
 	}

	function convert_savedb($t="")
	{
		$t = str_replace( "&#39;"   , "'", $t );
		$t = str_replace( "&#33;"   , "!", $t );
		$t = str_replace( "&#036;"   , "$", $t );
		$t = str_replace( "&#124;"  , "|", $t );
		$t = str_replace( "&amp;"   , "&", $t );
		$t = str_replace( "&gt;"    , ">", $t );
		$t = str_replace( "&lt;"    , "<", $t );
		$t = str_replace( "&quot;"  , '"', $t );
		$t = preg_replace( "/javascript/i" , "j&#097;v&#097;script", $t );
		$t = preg_replace( "/alert/i"      , "&#097;lert"          , $t );
		$t = preg_replace( "/about:/i"     , "&#097;bout:"         , $t );
		$t = preg_replace( "/onmouseover/i", "&#111;nmouseover"    , $t );
		$t = preg_replace( "/onclick/i"    , "&#111;nclick"        , $t );
		$t = preg_replace( "/onload/i"     , "&#111;nload"         , $t );
		$t = preg_replace( "/onsubmit/i"   , "&#111;nsubmit"       , $t );
		return $t;
	}
	function convert_savedbadmin($t="")
	{
		$t = addslashes($t);
		return $t;
	}

	function build_pages($data)
	{
		$work = array();
		$section = ($data['leave_out'] == "") ? 4 : $data['leave_out'];
		$work['pages']  = 1;
		if ( ($data['TOTAL_POSS'] % $data['PER_PAGE']) == 0 )
		{
			$work['pages'] = $data['TOTAL_POSS'] / $data['PER_PAGE'];
		}
		else
		{
			$number = ($data['TOTAL_POSS'] / $data['PER_PAGE']);
			$work['pages'] = ceil( $number);
		}
		$work['total_page']   = $work['pages'];
		$work['current_page'] = $data['CUR_ST_VAL'] > 0 ? ($data['CUR_ST_VAL'] / $data['PER_PAGE']) + 1 : 1;
		if ($work['pages'] > 1)
		{
			$work['first_page'] = "<span class=\"mkpagelink\">{$work['pages']} {$this->lang['pages']}</span>";

			for( $i = 0; $i <= $work['pages'] - 1; ++$i )
			{
				$RealNo = $i * $data['PER_PAGE'];
				$PageNo = $i+1;

				if ($RealNo == $data['CUR_ST_VAL'])
				{
					$work['page_span'] .= "&nbsp;<span class=\"mkpagecurrent\">{$PageNo}</span>";
				}
				else
				{
					if ($PageNo < ($work['current_page'] - $section))
					{
						$work['st_dots'] = "<span class=\"mkpagelinklast\"><a href=\"{$data['BASE_URL']}&amp;st=0\" title=\"{$this->lang['page']} 1\">&laquo; {$this->lang['page_first']}</a></span>&nbsp;...";
						continue;
					}

					if ($PageNo > ($work['current_page'] + $section))
					{
						$work['end_dots'] = "...&nbsp;<span class=\"mkpagelinklast\"><a href=\"{$data['BASE_URL']}&amp;st=".($work['pages']-1) * $data['PER_PAGE']."\" title=\"{$this->lang['page']} {$work['pages']}\">{$this->lang['page_last']} &raquo;</a></span>";
						break;
					}

					$work['page_span'] .= "&nbsp;<span class=\"mkpagelink\"><a href=\"{$data['BASE_URL']}&amp;st={$RealNo}\">{$PageNo}</a></span>";
				}
			}

			$work['return']    = $work['first_page'].$work['st_dots'].$work['page_span'].'&nbsp;'.$work['end_dots'];
		}
		else
		{
			$work['return']    = $data['L_SINGLE'];
		}

		return $work['return'];
	}
	function read_config() {
 		global $DB;

		$myquery = mysql_query("SELECT * FROM mkp_config");
		while( $row = $DB->fetch_row($myquery) ) {
			$chiave = $row['chiave'];
			$valore = $row['valore'];
			$config[$chiave] = $valore;
		}
 		return $config;
 	}
	
	function read_stat() {
 		global $DB;

		$myquery = mysql_query("SELECT * FROM mkp_stat");
		while( $row = $DB->fetch_row($myquery) ) {
			$chiave = $row['chiave'];
			$valore = $row['valore'];
			$stat[$chiave] = $valore;
		}
 		return $stat;
 	}
	
	function read_member() {
 		global $DB, $mkportals;
		$group = $mkportals->member['mgroup'];
		$myquery = mysql_query( "SELECT * FROM mkp_pgroups where g_id = '$group'");
		while( $row = $DB->fetch_row($myquery) ) {
			$this->member['g_send_news'] = 		$row['g_send_news'];
			$this->member['g_mod_news'] = 		$row['g_mod_news'];
			$this->member['g_access_download'] = 	$row['g_access_download'];
			$this->member['g_send_download'] = 	$row['g_send_download'];
			$this->member['g_mod_download'] = 	$row['g_mod_download'];
			$this->member['g_access_gallery'] = 	$row['g_access_gallery'];
			$this->member['g_send_gallery'] = 	$row['g_send_gallery'];
			$this->member['g_mod_gallery'] = 		$row['g_mod_gallery'];
			$this->member['g_access_urlobox'] = 	$row['g_access_urlobox'];
			$this->member['g_send_urlobox'] = 	$row['g_send_urlobox'];
			$this->member['g_mod_urlobox'] = 		$row['g_mod_urlobox'];
			$this->member['g_access_chat'] = 		$row['g_access_chat'];
			$this->member['g_access_cpa'] = 		$row['g_access_cpa'];
			$this->member['g_access_blog'] = 		$row['g_access_blog'];
			$this->member['g_send_blog'] = 		$row['g_send_blog'];
			$this->member['g_access_topsite'] = 	$row['g_access_topsite'];
			$this->member['g_send_topsite'] = 	$row['g_send_topsite'];
			$this->member['g_send_ecard'] = 		$row['g_send_ecard'];
			$this->member['g_send_quote'] = 		$row['g_send_quote'];
			$this->member['g_send_comments'] = 	$row['g_send_comments'];
			$this->member['g_access_reviews'] = 	$row['g_access_reviews'];
			$this->member['g_send_reviews'] = 	$row['g_send_reviews'];
			$this->member['g_mod_reviews'] = 		$row['g_mod_reviews'];
		}

		return $this->member;
 	}

	function mkp_input()
    {
        global $HTTP_GET_VARS, $HTTP_POST_VARS;

		if (!isset($HTTP_POST_VARS) && isset($_POST))
		{
			$HTTP_POST_VARS = $_POST;
			$HTTP_GET_VARS = $_GET;
		}

		$result = array();

        if(is_array($HTTP_GET_VARS)) {
            while(list($k, $v) = each($HTTP_GET_VARS)) {
                if(is_array($HTTP_GET_VARS[$k])) {
                    while( list($k2, $v2) = each($HTTP_GET_VARS[$k])) {
						$k2 = preg_replace( "/\.\./"           , ""  , $k2 );
        				$k2 = preg_replace( "/\_\_(.+?)\_\_/"  , ""  , $k2 );
       					$k2 = preg_replace( "/^([\w\.\-\_]+)$/", "$1", $k2 );
						$v2 = str_replace( "&"            , "&amp;"         , $v2 );
        				$v2 = str_replace( "<!--"         , "&#60;&#33;--"  , $v2 );
        				$v2 = str_replace( "-->"          , "--&#62;"       , $v2 );
        				$v2 = preg_replace( "/<script/i"  , "&#60;script"   , $v2 );
       					$v2 = str_replace( ">"            , "&gt;"          , $v2 );
        				$v2 = str_replace( "<"            , "&lt;"          , $v2 );
        				$v2 = str_replace( "\""           , "&quot;"        , $v2 );
        				$v2 = preg_replace( "/\n/"        , "<br />"        , $v2 );
        				$v2 = preg_replace( "/\\\$/"      , "&#036;"        , $v2 );
        				$v2 = preg_replace( "/\r/"        , ""              , $v2 );
        				$v2 = str_replace( "!"            , "&#33;"         , $v2 );
					$v2 = str_replace( "'"            , "&#39;"         , $v2 );
					$v2 = trim($v2, "\\");

						$result[$k][$k2] = $v2;
                    }
                } else {
					$v = str_replace( "&"            , "&amp;"         , $v );
        			$v = str_replace( "<!--"         , "&#60;&#33;--"  , $v );
        			$v = str_replace( "-->"          , "--&#62;"       , $v );
        			$v = preg_replace( "/<script/i"  , "&#60;script"   , $v );
       				$v = str_replace( ">"            , "&gt;"          , $v );
        			$v = str_replace( "<"            , "&lt;"          , $v );
        			$v = str_replace( "\""           , "&quot;"        , $v );
        			$v = preg_replace( "/\n/"        , "<br />"        , $v );
        			$v = preg_replace( "/\\\$/"      , "&#036;"        , $v );
        			$v = preg_replace( "/\r/"        , ""              , $v );
        			$v = str_replace( "!"            , "&#33;"         , $v );
				$v = str_replace( "'"            , "&#39;"         , $v );
				$v = trim($v, "\\");
					$result[$k] = $v;
                }
            }
        }
        if( is_array($HTTP_POST_VARS)) {
            while(list($k, $v) = each($HTTP_POST_VARS)) {
                if (is_array($HTTP_POST_VARS[$k]) ) {
                    while(list($k2, $v2) = each($HTTP_POST_VARS[$k])) {
						$k2 = preg_replace( "/\.\./"           , ""  , $k2 );
        				$k2 = preg_replace( "/\_\_(.+?)\_\_/"  , ""  , $k2 );
       					$k2 = preg_replace( "/^([\w\.\-\_]+)$/", "$1", $k2 );
						$v2 = str_replace( "&"            , "&amp;"         , $v2 );
        				$v2 = str_replace( "<!--"         , "&#60;&#33;--"  , $v2 );
        				$v2 = str_replace( "-->"          , "--&#62;"       , $v2 );
        				$v2 = preg_replace( "/<script/i"  , "&#60;script"   , $v2 );
       					$v2 = str_replace( ">"            , "&gt;"          , $v2 );
        				$v2 = str_replace( "<"            , "&lt;"          , $v2 );
        				$v2 = str_replace( "\""           , "&quot;"        , $v2 );
        				$v2 = preg_replace( "/\n/"        , "<br />"        , $v2 );
        				$v2 = preg_replace( "/\\\$/"      , "&#036;"        , $v2 );
        				$v2 = preg_replace( "/\r/"        , ""              , $v2 );
        				$v2 = str_replace( "!"            , "&#33;"         , $v2 );
					$v2 = str_replace( "'"            , "&#39;"         , $v2 );
					$v2 = trim($v2, "\\");
						$result[$k][$k2] = $v2;
                    }
                } else {
					$v = str_replace( "&"            , "&amp;"         , $v );
        			$v = str_replace( "<!--"         , "&#60;&#33;--"  , $v );
        			$v = str_replace( "-->"          , "--&#62;"       , $v );
        			$v = preg_replace( "/<script/i"  , "&#60;script"   , $v );
       				$v = str_replace( ">"            , "&gt;"          , $v );
        			$v = str_replace( "<"            , "&lt;"          , $v );
        			$v = str_replace( "\""           , "&quot;"        , $v );
        			$v = preg_replace( "/\n/"        , "<br />"        , $v );
        			$v = preg_replace( "/\\\$/"      , "&#036;"        , $v );
        			$v = preg_replace( "/\r/"        , ""              , $v );
        			$v = str_replace( "!"            , "&#33;"         , $v );
				$v = str_replace( "'"            , "&#39;"         , $v );
				$v = trim($v, "\\");
					$result[$k] = $v;
                }
            }
        }

        return $result;
    }

	function create_date($now, $form="")
	{
 		global $mkportals, $MK_TIMEDIFF;

 		switch($form) {
  			case 'short':
      			$format = "d M Y";
     		break;
  			case 'time':
      			$format = "H:i";
     		break;
  			case 'small':
      			$format = "F Y";
     		break;
  			case 'normal':
      			$format= "l, d F Y";
     		break;
  			default:
   				$format = "l, d F Y H:i";
     		break;
 		}

 		if ( empty($translate) && $this->mklang != 'English' ) {
  			@reset($this->lang);
  			while ( list($match, $replace) = @each($this->lang) )
  			{
   				$translate[$match] = $replace;
  			}
 		}
 		$diff = $mkportals->member['timezone'];
 		if (substr($mkportals->member['timezone'], 0, 1) == '-') {
  			$diff = str_replace("-", "", $diff);
  			$now = $now - (3600 * $diff);
 		} else {
  			$now = $now + (3600 * $diff);
 		}
		$diff = $MK_TIMEDIFF;
 		if (substr($mkportals->member['timezone'], 0, 1) == '-') {
  			$diff = str_replace("-", "", $diff);
  			$now = $now - (3600 * $diff);
 		} else {
  			$now = $now + (3600 * $diff);
 		}

 		return ( !empty($translate) ) ? strtr(@gmdate($format, $now), $translate) : @gmdate($format, $now);
	}


	//Funzione interna che crea la preview
		function CreateImage($size,$source,$dest,$border=0) {

			static $gd_version_number = null;
   			if ($gd_version_number === null) {
       			ob_start();
       			phpinfo(8);
       			$module_info = ob_get_contents();
       			ob_end_clean();
       			if (preg_match("/\bgd\s+version\b[^\d\n\r]+?([\d\.]+)/i", $module_info,$matches)) {
           			$gd_version_number = $matches[1];
				}
   			}
			if ($gd_version_number) {
				$sourcedate = 0;
				$destdate = 0;
				if (file_exists($dest)) {
					clearstatcache();
					$sourceinfo = stat($source);
					$destinfo = stat($dest);
					$sourcedate = $sourceinfo[10];
					$destdate = $destinfo[10];
				}
	 			if (!file_exists("$dest") or ($sourcedate > $destdate)) {
					$imgsize = GetImageSize($source);
					$width = $imgsize[0];
					$height = $imgsize[1];
					$new_width = $size;
					$new_height = ceil($size * $height / $width);
					$im = @ImageCreateFromJPEG($source);

					if ($im && $gd_version_number >= 2) {
						$new_im=@ImageCreateTrueColor($new_width,$new_height);
					}
					if ($im && $gd_version_number < 2) {
   						$new_im = @ImageCreate($new_width,$new_height);
					}
					if ($new_im) {
						ImageCopyResized($new_im,$im,0,0,0,0,$new_width,$new_height,ImageSX($im),ImageSY($im));
						ImageJPEG($new_im,$dest,90);
						ImageDestroy($new_im);
					}

	 			}
			}
		}

		function ResizeImage($max_width, $im) {
			
			if (!$im) {return array();}
			$image_details = @getimagesize("$im");
			if (!$image_details) {return array();}
			$imagesize_x = $image_details[0];
			$imagesize_y = $image_details[1];
			$thumb_width=$max_width;
			
			$thumb_height = ceil($max_width * $imagesize_y / $imagesize_x);
			if ($imagesize_x < $max_width) {
				$thumb_width = $imagesize_x;
				$thumb_height = $imagesize_y;
			}
			return array ($thumb_width, $thumb_height);
		}

		function check_attach($file_type = "", $file_ext = "") {
    		if ($file_type == "" AND $file_ext == "") {
        		return FALSE;
    		}
    		$com_types = array('com' => 1, 'exe' => 1, 'bat' => 1, 'scr' => 1, 'pif' => 1, 'asp' => 1, 'cgi' => 1, 'pl' => 1, 'php' => 1 );
    		$mime = file("$this->sitepath/mkportal/include/mime_types.php");
			reset($mime);
			while (list($key, $val) = each($mime)) {
				$mime[$key] = trim($val);
			}
			if (in_array($file_type, $mime)) {
        		if (isset($com_types[strtolower($file_ext)])) {
            		return FALSE;
        		}
        		return TRUE;
    		}
		}


		function get_editor() {
		global $MK_LANG, $MK_EDITOR;
			$langedit =  strtolower($MK_LANG);
			$langedit = substr($langedit, 0, 2);
			if (!is_file($this->sitepath."mkportal/editor/jscripts/tiny_mce/langs/{$langedit}.js")) {
        		$langedit = "en";
        	}
			$editorpath = $this->sitepath."mkportal/editor/jscripts/tiny_mce/tiny_mce.js";
			$out = "
			<!-- tinyMCE -->
			<script language=\"javascript\" type=\"text/javascript\" src=\"$editorpath\"></script>
 			<script language=\"javascript\" type=\"text/javascript\">
			tinyMCE.init({
			relative_urls: \"false\", 
			mode : \"specific_textareas\",
			force_p_newlines : \"false\",
			theme : \"advanced\",
			plugins : \"table,save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,zoom,flash,searchreplace,print,paste,directionality,fullscreen,noneditable,contextmenu\",
		
		theme_advanced_buttons1_add : \"fontselect,fontsizeselect\",
		theme_advanced_buttons2_add : \"separator,insertdate,inserttime,preview,zoom,separator,forecolor,backcolor\",
		theme_advanced_buttons2_add_before: \"cut,copy,paste,pastetext,pasteword,separator,search,replace,separator\",
		theme_advanced_buttons3_add_before : \"tablecontrols,separator\",
		theme_advanced_buttons3_add : \"emotions,iespell,flash,advhr,separator,print,separator,ltr,rtl,separator,fullscreen\",
		theme_advanced_toolbar_location : \"top\",
		theme_advanced_toolbar_align : \"left\",
		theme_advanced_statusbar_location : \"bottom\",
	    plugin_insertdate_dateFormat : \"%Y-%m-%d\",
	    plugin_insertdate_timeFormat : \"%H:%M:%S\",
		extended_valid_elements : \"hr[class|width|size|noshade]\",
		
		paste_use_dialog : false,
		language : \"$langedit\",
		theme_advanced_resizing : true,
		theme_advanced_resize_horizontal : false,
		theme_advanced_link_targets : \"_something=My somthing;_something2=My somthing2;_something3=My somthing3;\"
			});
		
			</script>
			<!-- /tinyMCE -->";
			return $out;
		}

		function get_bbeditor($nosmile="") {
		global $mklib_board;
		//$smile = "<iframe align=\"top\" src=\"index.php?ind=urlobox&amp;op=show_emoticons\" frameborder=\"0\" width=\"22%\" align=\"middle\" height=\"212\" scrolling=\"auto\"></iframe>";
		$smile = "<iframe src=\"$this->sitepath/index.php?ind=urlobox&amp;op=show_emoticons\" frameborder=\"0\" width=\"22%\" align=\"left\" height=\"212\" scrolling=\"auto\"></iframe>";
		if ($nosmile) {
			$smile = "";
		}
		return "
        <script type=\"text/javascript\">
        <!--
            var text_enter_url      = \"{$this->lang['editor_url_info']}\";
            var text_enter_url_name = \"{$this->lang['editor_url_name']}\";
            var text_enter_image    = \"{$this->lang['editor_image_info']}\";
            var text_enter_email    = \"{$this->lang['editor_email_info']}\";
            var error_no_url        = \"{$this->lang['editor_error_no_url']}\";
            var error_no_title      = \"{$this->lang['editor_error_no_title']}\";
            var error_no_email      = \"{$this->lang['editor_error_no_email']}\";
            var list_prompt         = \"{$this->lang['editor_list_info']}\";
        //-->
        </script>
       <input type=\"button\" accesskey=\"b\" value=\" B \" onclick='simpletag(\"B\")' class=\"mkbutton\" name=\"B\" style=\"font-weight:bold\"  />
       <input type=\"button\" accesskey=\"i\" value=\" I \" onclick='simpletag(\"I\")' class=\"mkbutton\" name=\"I\" style=\"font-style:italic\"  />
       <input type=\"button\" accesskey=\"u\" value=\" U \" onclick='simpletag(\"U\")' class=\"mkbutton\" name=\"U\" style=\"text-decoration:underline\" />
       
       <select name=\"ffont\" class=\"mkbutton\" onchange=\"alterfont(this.options[this.selectedIndex].value, 'FONT')\" >
       <option value=\"0\">Font</option>
       <option value=\"Arial\" style=\"font-family:Arial\">Arial</option>
       <option value=\"Times\" style=\"font-family:Times\">Times</option>
       <option value=\"Courier\" style=\"font-family:Courier\">Courier</option>
       <option value=\"Impact\" style=\"font-family:Impact\">Impact</option>
       <option value=\"Geneva\" style=\"font-family:Geneva\">Geneva</option>
       <option value=\"Optima\" style=\"font-family:Optima\">Optima</option>
       </select><select name=\"fsize\" class=\"mkbutton\" onchange=\"alterfont(this.options[this.selectedIndex].value, 'SIZE')\" >
       <option value=\"0\">Size</option>
       <option value=\"1\">1</option>
       <option value=\"7\">7</option>
       <option value=\"14\">14</option>
       </select><select name=\"fcolor\" class=\"mkbutton\" onchange=\"alterfont(this.options[this.selectedIndex].value, 'COLOR')\" >
       <option value=\"0\">Color</option>
       <option value=\"blue\" style=\"color:blue\">Blue</option>
       <option value=\"red\" style=\"color:red\">Red</option>
       <option value=\"purple\" style=\"color:purple\">Purple</option>
       <option value=\"orange\" style=\"color:orange\">Orange</option>
       <option value=\"yellow\" style=\"color:yellow\">Yellow</option>
       <option value=\"gray\" style=\"color:gray\">Grey</option>
       <option value=\"green\" style=\"color:green\">Green</option>
       </select>
       <br />
       <input type=\"button\" accesskey=\"h\" value=\" http:// \" onclick='tag_url()' class=\"mkbutton\" name=\"url\"  />
       <input type=\"button\" accesskey=\"g\" value=\" IMG \" onclick='tag_image()' class=\"mkbutton\" name=\"img\"  />
       <input type=\"button\" accesskey=\"e\" value=\"  @  \" onclick='tag_email()' class=\"mkbutton\" name=\"email\"  />
       <input type=\"button\" accesskey=\"q\" value=\" QUOTE \" onclick='simpletag(\"QUOTE\")' class=\"mkbutton\" name=\"QUOTE\"  />
		&nbsp; <a href=\"javascript:closeall();\" >{$this->lang['editor_close_all']}</a>
	   <br />
	   <br />
		$smile
	   ";
		}

		function decode_bb($txt)
		{
			global $Skin;
			$pos = "";
			$mk_sub = "";
			$content = "";
			$author = "";
			//$txt = nl2br($txt);
			while ( preg_match( "#\[size=([^\]]+)\](.+?)\[/size\]#ies", $txt ) ) {
				$txt = preg_replace( "#\[size=([^\]]+)\](.+?)\[/size\]#ies"    , "\$this->parse_bbfont(array('s'=>'size','1'=>'\\1','2'=>'\\2'))", $txt );
			}
			while ( preg_match( "#\[font=([^\]]+)\](.*?)\[/font\]#ies", $txt ) ) {
				$txt = preg_replace( "#\[font=([^\]]+)\](.*?)\[/font\]#ies"    , "\$this->parse_bbfont(array('s'=>'font','1'=>'\\1','2'=>'\\2'))", $txt );
			}
			while( preg_match( "#\[color=([^\]]+)\](.+?)\[/color\]#ies", $txt ) ) {
				$txt = preg_replace( "#\[color=([^\]]+)\](.+?)\[/color\]#ies"  , "\$this->parse_bbfont(array('s'=>'col' ,'1'=>'\\1','2'=>'\\2'))", $txt );
			}
			$txt = preg_replace( "#\[b\](.+?)\[/b\]#is", "<b>\\1</b>", $txt );
			$txt = preg_replace( "#\[i\](.+?)\[/i\]#is", "<i>\\1</i>", $txt );
			$txt = preg_replace( "#\[u\](.+?)\[/u\]#is", "<u>\\1</u>", $txt );
			$txt = preg_replace( "#\[s\](.+?)\[/s\]#is", "<s>\\1</s>", $txt );
			$txt = preg_replace( "#\[email\](\S+?)\[/email\]#i"                                                                , "<a href=\"mailto:\\1\">\\1</a>", $txt );
			$txt = preg_replace( "#\[email\s*=\s*\&quot\;([\.\w\-]+\@[\.\w\-]+\.[\.\w\-]+)\s*\&quot\;\s*\](.*?)\[\/email\]#i"  , "<a href=\"mailto:\\1\">\\2</a>", $txt );
			$txt = preg_replace( "#\[email\s*=\s*([\.\w\-]+\@[\.\w\-]+\.[\w\-]+)\s*\](.*?)\[\/email\]#i"                       , "<a href=\"mailto:\\1\">\\2</a>", $txt );
			//$txt = preg_replace( "#\[url=(.+?)\](.+)\[\/url\]#i",'<a href="\\1" target="_blank">\\2</a>',$txt);
			//$txt = preg_replace('/\[URL\](.+?)\[\/URL\]/','<a href="\\1">\\1</a>',$txt);
			$txt = preg_replace( "#\[url\](\S+?)\[/url\]#ie", "\$this->bb_build_url(array('1' => '\\1', '2' => '\\1'))", $txt );
			$txt = preg_replace( "#\[url\s*=\s*\&quot\;\s*(\S+?)\s*\&quot\;\s*\](.*?)\[\/url\]#ie", "\$this->bb_build_url(array('1' => '\\1', '2' => '\\2'))", $txt );
			$txt = preg_replace( "#\[url\s*=\s*(\S+?)\s*\](.*?)\[\/url\]#ie", "\$this->bb_build_url(array('1' => '\\1', '2' => '\\2'))", $txt );

			$txt = preg_replace('/\[img\](.+?)\[\/img\]/is','<img src="\\1" border="0" alt="" />',$txt);
			//quote without author
			$pos = strpos(strtolower($txt), "[quote]");
			if ($pos !== FALSE) {
				$pos2 = strpos(strtolower($txt), "[/quote]", $pos);
				$content = substr($txt, ($pos +7), ($pos2 - ($pos +7)));
				$mk_sub = $Skin->view_quote($content, $author);
				$txt = preg_replace('/\[quote\](.+?)\[\/quote\]/is',$mk_sub,$txt);
			}
			//quote with author
			$pos = strpos(strtolower($txt), "[quote=" );
			if ($pos !== FALSE) {
				$pos = $pos + 7;
				$pos2 = strpos($txt, "]", $pos);
				$author = substr($txt, $pos, ($pos2 - $pos));
				$pos = $pos2;
				$pos2 = strpos(strtolower($txt), "[/quote]", $pos);
				$content = substr($txt, ($pos +1), ($pos2 - ($pos +1)));
				$mk_sub = $Skin->view_quote($content, $author);
				$txt = preg_replace('/\[quote=(.+?)\[\/quote\]/is',$mk_sub,$txt);
			}
			
			return stripslashes($txt);
		}
		function bb_build_url($url=array()) {
			return "<a href=\"".$url['1']."\" target=\"_blank\">".$url['2']."</a>";
		}
		function parse_bbfont($fattrbb) {
			if (!is_array($fattrbb)) return "";
			if ( preg_match( "/;/", $fattrbb['1'] ) ) {
				$attr = explode( ";", $fattrbb['1'] );
				$fattrbb['1'] = $attr[0];
			}
			$fattrbb['1'] = preg_replace( "/[&\(\)\.\%]/", "", $fattrbb['1'] );
			if ($fattrbb['s'] == 'size') {
				$fattrbb['1'] = ($fattrbb['1'] <= 14) ? ($fattrbb['1'] + 7) : 1;
				return "<span style=\"font-size:".$fattrbb['1']."pt;line-height:100%\">".$fattrbb['2']."</span>";
			}
			else if ($fattrbb['s'] == 'col') {
			return "<span style=\"color:".$fattrbb['1']."\">".$fattrbb['2']."</span>";
			}
			else if ($fattrbb['s'] == 'font') {
			return "<span style=\"font-family:".$fattrbb['1']."\">".$fattrbb['2']."</span>";
			}
		}

	function load_lang($file_lang) {
		global $mkportals;
		$mlang = $this->mklang;
		if ($mkportals->member['mk_lang']) {	
			$dir = @opendir($this->sitepath."mkportal/lang/");
			while (($dirt = readdir($dir)) !== false) {
				$mkl = strtolower (substr($dirt, 0, 3));		
				$bol = strtolower (substr($mkportals->member['mk_lang'], 0, 3));
				if ($mkl == $bol && $dirt != "index.html" && $dirt != "English_Reference") {
					$mlang = $this->sitepath."mkportal/lang/".$dirt;
				}	
			}	
			closedir($dir);
		}

		require "$mlang/$file_lang";
		foreach ($langmk as $k => $v) {
        		$this->lang[$k] = stripslashes($v);
        	}
	}
	
	function watermark($filename, $filedest="") {
		
		$POSITION = $this->config['watermark_pos'];
		$LEVEL = $this->config['watermark_level'];
		if (!$filedest) {
			$filedest = $filename;
		} 
		$watermarkimage = $this->sitepath."mkportal/modules/gallery/wt.png";
		if (!function_exists('imagecopymerge') || !file_exists($watermarkimage)) {
			return;
		}
		$lst=GetImageSize($filename);
 		$image_width=$lst[0];
 		$image_height=$lst[1];
 		$image_format=$lst[2];

 		if ($image_format==2) {
  			$old_image=imagecreatefromjpeg($filename);
 		} elseif ($image_format==3) {
  			$old_image=imagecreatefrompng($filename);
 		} else {
   			return;
 		}


 		$lst2=GetImageSize($watermarkimage);
 		$image2_width=$lst2[0];
 		$image2_height=$lst2[1];
 		$image2_format=$lst2[2];

		 if ($image2_format==2 && function_exists('imagecreatefromjpeg')) {
  			$wt_image=imagecreatefromjpeg($watermarkimage);
 		} elseif ($image2_format==3 && function_exists('imagecreatefrompng')) {
  			$wt_image=imagecreatefrompng($watermarkimage);
 		}

  		if (!$wt_image) {
  			return;
  		}

   		$wt_y= "10";
   		$wt_x=$image_width-$image2_width-10;
		
		if ($POSITION == 1) {
			$wt_y=(int)($image_height/2-$image2_height/2);
			$wt_x=(int)($image_width/2-$image2_width/2);
		}
		if ($POSITION == 2) {
			$wt_y=$image_height-$image2_height-10;
			$wt_x=$image_width-$image2_width-10;
		}
		
   		imagecopymerge($old_image, $wt_image, $wt_x, $wt_y, 0, 0, $image2_width, $image2_height, $LEVEL);
  


 		if ($image_format==2) {
  			//Header("Content-Type: image/jpeg");
  			imageJpeg($old_image, $filedest);
 		}
 		if ($image_format==3) {
  			imagePng($old_image, $filedest);
 		}
		# cleaning cache
		imageDestroy($old_image);
		imageDestroy($wt_image);

	}
	function checklinkperm($url) {
		global $mkportals;
		$perm = 0;
		if (stristr($url, 'ind=blog')) {
			if ($this->config['mod_blog']) {return TRUE;}
			if(!$mkportals->member['g_access_cp'] && !$this->member['g_access_blog']) {return TRUE;}
			
		}
		if (stristr($url, 'ind=gallery')) {
			if ($this->config['mod_gallery']) {return TRUE;}
			if(!$mkportals->member['g_access_cp'] && !$this->member['g_access_gallery']) {return TRUE;}
			
		}
		if (stristr($url, 'ind=urlobox')) {
			if ($this->config['mod_urlobox']) {return TRUE;}
			if(!$mkportals->member['g_access_cp'] && !$this->member['g_access_urlobox']) {return TRUE;}
			
		}
		if (stristr($url, 'ind=downloads')) {
			if ($this->config['mod_downloads']) {return TRUE;}
			if(!$mkportals->member['g_access_cp'] && !$this->member['g_access_download']) {return TRUE;}
			
		}
		if (stristr($url, 'ind=news')) {
			if ($this->config['mod_news']) {return TRUE;}	
		}
		if (stristr($url, 'ind=topsite')) {
			if ($this->config['mod_topsite']) {return TRUE;}
			if(!$mkportals->member['g_access_cp'] && !$this->member['g_access_topsite']) {return TRUE;}
			
		}
		if (stristr($url, 'ind=reviews')) {
			if ($this->config['mod_reviews']) {return TRUE;}
			if(!$mkportals->member['g_access_cp'] && !$this->member['g_access_reviews']) {return TRUE;}
			
		}
		if (stristr($url, 'ind=chat')) {
			if ($this->config['mod_chat']) {return TRUE;}
			if(!$mkportals->member['g_access_cp'] && !$this->member['g_access_chat']) {return TRUE;}
			
		}
		if (stristr($url, 'ind=quote')) {
			if ($this->config['mod_quote']) {return TRUE;}
			
		}
		
		return FALSE;
	}
	
	
	function post_htmlspecialchars($text = "") {
        	$text = preg_replace("/&(?!#[0-9]+;)/s", '&amp;', $text);
        	$text = str_replace( "<", "&lt;"  , $text);
        	$text = str_replace( ">", "&gt;"  , $text);
        	$text = str_replace( '"', "&quot;", $text);
        	$text = str_replace( "'", "&#039;", $text);
        	return $text;
    	}
	function stimer() {
        	global $Stime;
        	$mtime = explode (' ', microtime ());
        	$Stime = $mtime[1] + $mtime[0];
    	}
	function etimer() {
        global $Stime;
        $mtime = explode (' ', microtime ());
        $endtime = $mtime[1] + $mtime[0];
        $ttime = round (($endtime - $Stime), 5);
        return $ttime;
    }
	
}
	$mklib = new mklib;
	$mklib->stimer();

	$mklib->siteurl = $SITE_URL;
	$mklib->forumpath = $FORUM_PATH;
	$mklib->forumview = $FORUM_VIEW;
	$mklib->portalview = $PORTAL_VIEW;
	$mklib->forumcd = $FORUM_CD;
	$mklib->forumcs = $FORUM_CS;
	$mklib->sitepath = $MK_PATH;
    	$mklib->sitename = stripslashes($SITE_NAME);
	$mklib->mkurl = $SITE_URL."/mkportal";
	$mklib->template = $MK_PATH."mkportal/templates/".$MK_TEMPLATE;
	$mklib->images = $MK_PATH."mkportal/templates/".$MK_TEMPLATE."/images";
	$mklib->mklang = $MK_PATH."mkportal/lang/".$MK_LANG;
	$mklib->menucloseds = "display:none";
	$mklib->menucontents = "";
	$mklib->menuclosedr = "display:none";
	$mklib->menucontentr = "";
	$mklib->mkeditor = $MK_EDITOR;
	$mklib->config = $mklib->read_config();
	$mklib->member = $mklib->read_member();
	$mklib->stats = $mklib->read_stat();
	$mklib->portalwidth = $MK_PORTALWIDTH;
	$mklib->columnwidth = $MK_COLUMNWIDTH;	
	$mklib->disablegzip = $MK_DISABLEGZIP;
	$mklib->disablenav = $MK_DISABLENAV;
	$mklib->loadcolumnright = $MK_LOADRIGHTC;
	$mklib->loadcolumnleft = $MK_LOADLEFTC;
	$mklib->unloadforumright = $MK_UNLOADRIGHTF;
	$mklib->unloadforumleft = $MK_UNLOADLEFTF;
	
	$mklib->load_lang("lang_global.php");
	$mklib->load_lang("lang_blocktitle.php");
	$mklib->charset = $mklib->lang['charset'];
	if (!$mklib->charset) {
        	$mklib->charset = "iso-8859-1";
    	}

	//be sure portal dimensions
	if ($mklib->portalwidth < 780) {
        		$mklib->portalwidth = 780;
     }
	 if ($mklib->portalwidth > 1660) {
        		$mklib->portalwidth = 1600;
     }
	 if ($mklib->columnwidth < 120) {
        		$mklib->columnwidth = 140;
     }
	 if ($mklib->columnwidth > 280) {
        		$mklib->columnwidth = 280;
     }


?>
