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

$idx = new mk_ad_main;
class mk_ad_main {


	function mk_ad_main() {
		global $mkportals;
		switch($mkportals->input['op']) {
			case 'main_save':
    				$this->main_save();
    			break;
    			default:
    				$this->ad_show();
    			break;
    		}
	}

	function ad_show() {
	global $mkportals, $mklib, $Skin, $MK_BOARD, $MK_TIMEDIFF, $MK_OFFLINE, $MK_EDITOR, $MK_BOARD;

	require "conf_mk.php"; //for mkportal IPB2skin hack
	
	$mode = $mkportals->input['mode'];
	$sitename = $mklib->sitename;
	$siteurl = $mklib->siteurl;
	$template = $MK_TEMPLATE; //for mkportal IPB2skin hack
	$mklang = $mklib->mklang;
	$forumpath = $mklib->forumpath;
	$forumpath = str_replace("/", "", "$forumpath");
	$forumpath = str_replace(".", "", "$forumpath");
	$forumview = $mklib->forumview;
	$portalview = $mklib->portalview;
	$forumcd = $mklib->forumcd;
	$forumcs = $mklib->forumcs;
	$portalwidth = $mklib->portalwidth;
	$columnwidth = $mklib->columnwidth;
	$disablegzip = $mklib->disablegzip;
	$disablenav = $mklib->disablenav;
	$loadrightg = $mklib->loadcolumnright;
	$loadleftg = $mklib->loadcolumnleft;
	$loadrightf = $mklib->unloadforumright;
	$loadleftf = $mklib->unloadforumleft;

	if ($dir = @opendir("templates/")) {
 		 while (($dirt = readdir($dir)) !== false) {
		 if ($MK_BOARD == "OXY" && $dirt == "Forum") {
			continue;
		 }
		 $selected = "";
		 if ($dirt != "." && $dirt != ".." && $dirt != "index.html") {
		 	//$check = $mklib->sitepath."mkportal/templates/$dirt";
			if($template == $dirt) {
				$selected = "selected=\"selected\"";
			}
   		 	$cselect.= "<option value=\"$dirt\" $selected>$dirt</option>\n";
		 }
  		}
  	closedir($dir);
	}
	if ($dir = @opendir("lang/")) {
 		 while (($dirt = readdir($dir)) !== false) {
		 $selected = "";
		 if ($dirt != "." && $dirt != ".." && $dirt != "index.html") {
		 	$check = $mklib->sitepath."mkportal/lang/$dirt";
			if($mklang == "$check") {
				$selected = "selected=\"selected\"";
			}
   		 	$cselect2.= "<option value=\"$dirt\" $selected>$dirt</option>\n";
		 }
  		}
  	closedir($dir);
	}
//time
$curtime = $mklib->create_date(time());
$timediff = $MK_TIMEDIFF;
switch($timediff) {
	case '1':
    	$se1t2="selected=\"selected\"";
    break;
	case '2':
    	$se1t3="selected=\"selected\"";
    break;
	case '-1':
    	$se1t4="selected=\"selected\"";
    break;
	case '-2':
    	$se1t5="selected=\"selected\"";
    break;
    default:
    	$se1t1="selected=\"selected\"";
    break;
}
$cselect4 = "<option value=\"0\" $se1t1>0</option>\n";
$cselect4 .= "<option value=\"1\" $se1t2>+1</option>\n";
$cselect4 .= "<option value=\"2\" $se1t3>+2</option>\n";
$cselect4 .= "<option value=\"-1\" $se1t4>-1</option>\n";
$cselect4 .= "<option value=\"-2\" $se1t5>-2</option>\n";

//Editor

	$mkeditor = $MK_EDITOR;
	$selected1 = "selected=\"selected\"";
	if ($MK_EDITOR == "BBCODE") {
		$selected1 = "";
		$selected2 = "selected=\"selected\"";
	}

	$cselect3 .= "<option value=\"HTML\" $selected1>HTML</option>\n";
	$cselect3 .= "<option value=\"BBCODE\" $selected2>BBcode</option>\n";

	if ($mode == "saved") {
		$checksave = "{$mklib->lang['ad_saved']}<br /><br />";
   	}
	$checkpv2 = "checked=\"checked\"";
	if ($portalview == "1") {
		$checkpv1 = "checked=\"checked\"";
		$checkpv2 = "";
   	}
	$checkfv2 = "checked=\"checked\"";
	if ($forumview == "1") {
		$checkfv1 = "checked=\"checked\"";
		$checkfv2 = "";
   	}
	$checkfcd1 = "checked=\"checked\"";
	if ($forumcd == "1") {
		$checkfcd1 = "";
		$checkfcd2 = "checked=\"checked\"";
   	}
	$checkfcs1 = "checked=\"checked\"";
	if ($forumcs == "1") {
		$checkfcs1 = "";
		$checkfcs2 = "checked=\"checked\"";
   	}
	$checkoff1 = "checked=\"checked\"";
	if ($MK_OFFLINE == "1") {
		$checkoff1 = "";
		$checkoff2 = "checked=\"checked\"";
   	}
	$checkgzipd2 = "checked=\"checked\"";
	if ($disablegzip == "1") {
		$checkgzipd = "checked=\"checked\"";
		$checkgzipd2 = "";
   	}
	$checknav2 = "checked=\"checked\"";
	if ($disablenav == "1") {
		$checknav1 = "checked=\"checked\"";
		$checknav2 = "";
   	}
	$checkrightg1 = "checked=\"checked\"";
	if ($loadrightg == "0") {
		$checkrightg2 = "checked=\"checked\"";
		$checkrightg1 = "";
   	}
	$checkleftg1 = "checked=\"checked\"";
	if ($loadleftg == "0") {
		$checkleftg2 = "checked=\"checked\"";
		$checkleftg1 = "";
   	}

	$checkrightf2 = "checked=\"checked\"";
	if ($loadrightf == "1") {
		$checkrightf1 = "checked=\"checked\"";
		$checkrightf2 = "";
   	}
	$checkleftf2 = "checked=\"checked\"";
	if ($loadleftf == "1") {
		$checkleftf1 = "checked=\"checked\"";
		$checkleftf2 = "";
   	}
	
	//footer config
	$checkfoot_logo1 = "checked=\"checked\"";
	if ($mklib->config['foot_logo'] == 0) {
		$checkfoot_logo2 = "checked=\"checked\"";
		$checkfoot_logo1 = "";
   	}
	$checkfoot_version1 = "checked=\"checked\"";
	if ($mklib->config['foot_version'] == 0) {
		$checkfoot_version2 = "checked=\"checked\"";
		$checkfoot_version1 = "";
	}
	$checkfoot_debug1 = "checked=\"checked\"";
	if ($mklib->config['foot_debug'] == 0) {
		$checkfoot_debug2 = "checked=\"checked\"";
		$checkfoot_debug1 = "";
   	}

	$subtitle = "{$mklib->lang['ad_preferences']}";

	$content = "
	<tr>
	  <td>

	    <form name=\"main1\" method=\"post\" action=\"admin.php?op=main_save\">
	    <table width=\"100%\">
	      <tr>
		<td>
		$checksave
		</td>
	      </tr>
<tr>
<td>
<table width=\"100%\" cellspacing=\"2\" cellpadding=\"5\" class=\"tabmain\">
	      <tr>
		<td width=\"100%\" colspan=\"2\" class=\"sottotitolo\">{$mklib->lang['ad_preferencet1']}</td>
		</tr>
		<tr>
		<td width=\"50%\" height=\"60\" class=\"modulex\">{$mklib->lang['ad_boardname']}</td>
		<td width=\"50%\" class=\"modulex\" align=\"center\"><input class=\"moduleborder\" type=\"text\" name=\"board\" value=\"$MK_BOARD\" size=\"40\" readonly=\"readonly\" /></td>
	      </tr>
	      <tr>
		<td width=\"50%\" height=\"60\" class=\"modulex\">{$mklib->lang['ad_siteurl']}</td>
		<td width=\"50%\" class=\"modulex\" align=\"center\"><input class=\"moduleborder\" type=\"text\" name=\"siteurl\" value=\"$siteurl\" size=\"40\" readonly=\"readonly\" /></td>
	      </tr>
	      <tr>
		<td width=\"50%\" height=\"60\" class=\"modulex\">{$mklib->lang['ad_fpath']}</td>
		<td width=\"50%\" class=\"modulex\" align=\"center\"><input class=\"moduleborder\" type=\"text\" name=\"forumpath\"  value=\"$forumpath\" size=\"40\" readonly=\"readonly\" /></td>
	      </tr>


	      <tr>
		<td width=\"50%\" height=\"60\" class=\"modulex\">{$mklib->lang['sitename']}</td>
	      	<td width=\"50%\" class=\"modulex\" align=\"center\"><input class=\"moduleborder\" type=\"text\" name=\"sitename\" value=\"$sitename\" size=\"40\" /></td>
	      </tr>
	    
</table>
</td>
</tr>
<tr>
<td>
<table width=\"100%\" cellspacing=\"2\" cellpadding=\"5\" class=\"tabmain\">
	      <tr>
		<td width=\"100%\" colspan=\"2\" class=\"sottotitolo\">{$mklib->lang['ad_preferencet2']}</td>
	      </tr>
	      <tr>
		<td width=\"50%\" height=\"60\" class=\"modulex\"><span class=\"mktxtcontr\">{$mklib->lang['putoff']}</span></td>
		<td width=\"50%\" class=\"modulex\" align=\"center\">{$mklib->lang['ad_yes']}&nbsp;<input type=\"radio\" value=\"1\" name=\"offline\" $checkoff2 />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{$mklib->lang['ad_no']}&nbsp;<input type=\"radio\" value=\"0\" name=\"offline\" $checkoff1 /></td>
	      </tr>
	      <tr>
		<td width=\"50%\" height=\"60\" class=\"modulex\">{$mklib->lang['ad_lang']}</td>
		<td width=\"50%\" class=\"modulex\" align=\"center\">
		  <select class=\"moduleborder\" size=\"1\" name=\"mklang\">
		  {$cselect2}
		  </select>
		</td>
	      </tr>
	     <tr>
		<td width=\"50%\" height=\"60\" class=\"modulex\">{$mklib->lang['ad_editor']}</td>
		<td width=\"50%\" class=\"modulex\" align=\"center\">
		<select class=\"moduleborder\" size=\"1\" name=\"mkeditor\">{$cselect3}</select>
		</td>
	     </tr>     
	     <tr>
		<td width=\"50%\" height=\"60\" class=\"modulex\">{$mklib->lang['ad_disablezip']}</td>
		<td width=\"50%\" class=\"modulex\" align=\"center\">{$mklib->lang['ad_yes']}&nbsp;<input type=\"radio\" value=\"1\" name=\"disablegzip\" $checkgzipd />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{$mklib->lang['ad_no']}&nbsp;<input type=\"radio\" value=\"0\" name=\"disablegzip\" $checkgzipd2 /></td>
	      </tr>
	    <tr>
		<td width=\"50%\" height=\"60\" class=\"modulex\"><br />{$mklib->lang['ad_sytime']}<br />{$mklib->lang['ad_curtime']}<br /> $curtime<br /><br /></td>
		<td width=\"50%\" class=\"modulex\" align=\"center\">{$mklib->lang['ad_diftime']}&nbsp;&nbsp;<select class=\"modulex\" size=\"1\" name=\"timediff\">
		  {$cselect4}
		  </select>
		</td>
	    </tr>
</table>
</td>
</tr>
<tr>
<td>
<table width=\"100%\" cellspacing=\"2\" cellpadding=\"5\" class=\"tabmain\">
	      <tr>
		<td width=\"100%\" colspan=\"2\" class=\"sottotitolo\">{$mklib->lang['ad_preferencet3']}</td>
	      </tr>
		<tr>
		<td width=\"50%\" height=\"60\" class=\"modulex\">{$mklib->lang['ad_skin']}</td>
		<td width=\"50%\" class=\"modulex\" align=\"center\">
		  <select class=\"moduleborder\" size=\"1\" name=\"template\">
		  {$cselect}
		  </select>
		</td>
	      </tr>
	      <tr>
		<td width=\"50%\" height=\"60\" class=\"modulex\">{$mklib->lang['ad_mkview']}</td>
		<td width=\"50%\" class=\"modulex\" align=\"center\">{$mklib->lang['ad_mkviewsmall']}&nbsp;<input type=\"radio\" value=\"1\" name=\"portalview\" $checkpv1 />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{$mklib->lang['ad_mkviewlarge']}&nbsp;<input type=\"radio\" value=\"0\" name=\"portalview\" $checkpv2 /></td>
	      </tr>
	      <tr>
		<td width=\"50%\" height=\"60\" class=\"modulex\">{$mklib->lang['ad_powidth']}</td>
		<td width=\"50%\" class=\"modulex\" align=\"center\"><input class=\"moduleborder\" type=\"text\" name=\"portalwidth\"  value=\"$portalwidth\" size=\"5\" /></td>
	      </tr>
	      <tr>
		<td width=\"50%\" height=\"60\" class=\"modulex\">{$mklib->lang['ad_disablenav']}</td>
		<td width=\"50%\" class=\"modulex\" align=\"center\">{$mklib->lang['ad_yes']}&nbsp;<input type=\"radio\" value=\"1\" name=\"shownav\" $checknav1 />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{$mklib->lang['ad_no']}&nbsp;<input type=\"radio\" value=\"0\" name=\"shownav\" $checknav2 /></td>
	      </tr>
	      <tr>
		<td width=\"50%\" height=\"60\" class=\"modulex\">{$mklib->lang['ad_cowidth']}</td>
		<td width=\"50%\" class=\"modulex\" align=\"center\"><input class=\"moduleborder\" type=\"text\" name=\"columnwidth\"  value=\"$columnwidth\" size=\"5\" /></td>
	      </tr>
	      <tr>
		<td width=\"50%\" height=\"60\" class=\"modulex\">{$mklib->lang['ad_load_leftc']}</td>
		<td width=\"50%\" class=\"modulex\" align=\"center\">{$mklib->lang['ad_yes']}&nbsp;<input type=\"radio\" value=\"1\" name=\"loadleftg\" $checkleftg1 />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{$mklib->lang['ad_no']}&nbsp;<input type=\"radio\" value=\"0\" name=\"loadleftg\" $checkleftg2 /></td>
	      </tr>
	      <tr>
		<td width=\"50%\" height=\"60\" class=\"modulex\">{$mklib->lang['ad_load_rightc']}</td>
		<td width=\"50%\" class=\"modulex\" align=\"center\">{$mklib->lang['ad_yes']}&nbsp;<input type=\"radio\" value=\"1\" name=\"loadrightg\" $checkrightg1 />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{$mklib->lang['ad_no']}&nbsp;<input type=\"radio\" value=\"0\" name=\"loadrightg\" $checkrightg2 /></td>
	      </tr>

<!-- footer config -->	      
	      <tr>
		<td width=\"50%\" height=\"60\" class=\"modulex\">{$mklib->lang['ad_foot_logo']}</td>
		<td width=\"50%\" class=\"modulex\" align=\"center\">{$mklib->lang['ad_yes']}&nbsp;<input type=\"radio\" value=\"1\" name=\"foot_logo\" $checkfoot_logo1 />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{$mklib->lang['ad_no']}&nbsp;<input type=\"radio\" value=\"0\" name=\"foot_logo\" $checkfoot_logo2 /></td>
	      </tr>	      

	      <tr>
		<td width=\"50%\" height=\"60\" class=\"modulex\">{$mklib->lang['ad_foot_version']}</td>
		<td width=\"50%\" class=\"modulex\" align=\"center\">{$mklib->lang['ad_yes']}&nbsp;<input type=\"radio\" value=\"1\" name=\"foot_version\" $checkfoot_version1 />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{$mklib->lang['ad_no']}&nbsp;<input type=\"radio\" value=\"0\" name=\"foot_version\" $checkfoot_version2 /></td>
		</tr>

	      <tr>
		<td width=\"50%\" height=\"60\" class=\"modulex\">{$mklib->lang['ad_foot_debug']}</td>
		<td width=\"50%\" class=\"modulex\" align=\"center\">{$mklib->lang['ad_yes']}&nbsp;<input type=\"radio\" value=\"1\" name=\"foot_debug\" $checkfoot_debug1 />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{$mklib->lang['ad_no']}&nbsp;<input type=\"radio\" value=\"0\" name=\"foot_debug\" $checkfoot_debug2 /></td>
	      </tr>
<!-- end footer config -->		      
	      
</table>
</td>
</tr>
<tr>
<td>
<table width=\"100%\" cellspacing=\"2\" cellpadding=\"5\" class=\"tabmain\">
	      <tr>
		<td width=\"100%\" colspan=\"2\" class=\"sottotitolo\">{$mklib->lang['ad_preferencet4']}</td>
	      </tr>
	      <tr>
		<td width=\"50%\" height=\"60\" class=\"modulex\">{$mklib->lang['ad_forumview']}<br />{$mklib->lang['ad_forumin']}</td>
		<td width=\"50%\" class=\"modulex\" align=\"center\">{$mklib->lang['ad_yes']}&nbsp;<input type=\"radio\" value=\"1\" name=\"forumview\" $checkfv1 />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{$mklib->lang['ad_no']}&nbsp;<input type=\"radio\" value=\"0\" name=\"forumview\" $checkfv2 /></td>
	      </tr>
	      <tr>
		<td width=\"50%\" height=\"60\" class=\"modulex\">{$mklib->lang['ad_rightcolumn']}</td>
		<td width=\"50%\" class=\"modulex\" align=\"center\">{$mklib->lang['ad_yes']}&nbsp;<input type=\"radio\" value=\"0\" name=\"forumcd\" $checkfcd1 />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{$mklib->lang['ad_no']}&nbsp;<input type=\"radio\" value=\"1\" name=\"forumcd\" $checkfcd2 /></td>
	      </tr>
	      <tr>
		<td width=\"50%\" height=\"60\" class=\"modulex\">{$mklib->lang['ad_leftcolumn']}</td>
		<td width=\"50%\" class=\"modulex\" align=\"center\">{$mklib->lang['ad_yes']}&nbsp;<input type=\"radio\" value=\"0\" name=\"forumcs\" $checkfcs1 />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{$mklib->lang['ad_no']}&nbsp;<input type=\"radio\" value=\"1\" name=\"forumcs\" $checkfcs2 /></td>
	      </tr>
	      <tr>
		<td width=\"50%\" height=\"60\" class=\"modulex\">{$mklib->lang['ad_uleftcolumn']}</td>
		<td width=\"50%\" class=\"modulex\" align=\"center\">{$mklib->lang['ad_yes']}&nbsp;<input type=\"radio\" value=\"1\" name=\"loadleftf\" $checkleftf1 />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{$mklib->lang['ad_no']}&nbsp;<input type=\"radio\" value=\"0\" name=\"loadleftf\" $checkleftf2 /></td>
	      </tr>
	      <tr>
		<td width=\"50%\" height=\"60\" class=\"modulex\">{$mklib->lang['ad_urightcolumn']}</td>
		<td width=\"50%\" class=\"modulex\" align=\"center\">{$mklib->lang['ad_yes']}&nbsp;<input type=\"radio\" value=\"1\" name=\"loadrightf\" $checkrightf1 />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{$mklib->lang['ad_no']}&nbsp;<input type=\"radio\" value=\"0\" name=\"loadrightf\" $checkrightf2 /></td>
	      </tr>
</table>
</td>
</tr>
		  <tr>
		<td colspan=\"2\" class=\"titadmin\" align = \"center\"><br />
		  <input type=\"submit\" class=\"bgselect\" value=\" {$mklib->lang['ad_save']} \" name=\"B1\" />
		</td>
	      </tr>
	    </table>
	    </form>
	  </td>
	</tr>
	";
	$output = $Skin->view_block("$subtitle", "$content");
	$mklib->printpage_admin("{$mklib->lang['ad_titlepage']}", $output);

	}
	function main_save() {
	global $mkportals, $mklib, $Skin, $DB, $MK_BOARD;

	if (!strstr($_SERVER['HTTP_REFERER'], "$mklib->mkurl/admin.php")) {
		$message = "{$mklib->lang['error_noallow']}";
		$mklib->error_page($message);
		exit;
	}

	$forumpath = $mkportals->input['forumpath'];
	$forumview = $mkportals->input['forumview'];
	$portalview = $mkportals->input['portalview'];
	$forumcd = $mkportals->input['forumcd'];
	$forumcs = $mkportals->input['forumcs'];
	$sitename = $mkportals->input['sitename'];
	$siteurl = $mkportals->input['siteurl'];
	$template = $mkportals->input['template'];
	$mklang = $mkportals->input['mklang'];
	$offline = $mkportals->input['offline'];
	$timediff = $mkportals->input['timediff'];
	$columnwidth = $mkportals->input['columnwidth'];
	$portalwidth = $mkportals->input['portalwidth'];
	$mkeditor = $mkportals->input['mkeditor'];
	$disablegzip = $mkportals->input['disablegzip'];
	$shownav = $mkportals->input['shownav'];
	$loadleftg = $mkportals->input['loadleftg'];
	$loadrightg = $mkportals->input['loadrightg'];
	$loadleftf = $mkportals->input['loadleftf'];
	$loadrightf = $mkportals->input['loadrightf'];

	$foot_logo = $mkportals->input['foot_logo'];
	$foot_version = $mkportals->input['foot_version'];
	$foot_debug = $mkportals->input['foot_debug'];

	$content = "<?php\n\n \$FORUM_PATH = \"$forumpath\"; \n \$FORUM_VIEW = \"$forumview\"; \n \$PORTAL_VIEW = \"$portalview\"; \n \$FORUM_CD = \"$forumcd\"; \n \$FORUM_CS = \"$forumcs\"; \n \$SITE_NAME = \"$sitename\";  \n \$SITE_URL = \"$siteurl\"; \n \$MK_TEMPLATE = \"$template\";\n \$MK_LANG = \"$mklang\";\n \$MK_EDITOR = \"$mkeditor\";\n \$MK_BOARD = \"$MK_BOARD\";\n \$MK_TIMEDIFF = \"$timediff\";\n \$MK_OFFLINE = \"$offline\";\n \$MK_DISABLEGZIP = \"$disablegzip\";\n \$MK_PORTALWIDTH = \"$portalwidth\";\n \$MK_COLUMNWIDTH = \"$columnwidth\";\n \$MK_DISABLENAV = \"$shownav\";\n \$MK_LOADLEFTC = \"$loadleftg\";\n \$MK_LOADRIGHTC = \"$loadrightg\";\n \$MK_UNLOADLEFTF = \"$loadleftf\";\n \$MK_UNLOADRIGHTF = \"$loadrightf\";\n ?>";
		$filename = "conf_mk.php";
   		if (!$handle = fopen($filename, 'w')) {
         	$message = "Non posso aprire il file conf_mk.php assicurati che abbia i permessi impostati in lettura e scrittura.";
			$mklib->error_page($message);
			exit;
   		}
   		if (!fwrite($handle, $content)) {
       		$message = "Non posso aprire il file conf_mk.php assicurati che abbia i permessi impostati in lettura e scrittura.";
			$mklib->error_page($message);
			exit;
   		}
		fclose($handle);
		
		$DB->query("UPDATE mkp_config SET valore ='$foot_logo' where chiave = 'foot_logo'");
		$DB->query("UPDATE mkp_config SET valore ='$foot_version' where chiave = 'foot_version'");
		$DB->query("UPDATE mkp_config SET valore ='$foot_debug' where chiave = 'foot_debug'");
		$DB->close_db();
		Header("Location: admin.php?mode=saved");
		exit;

	}



}

?>
