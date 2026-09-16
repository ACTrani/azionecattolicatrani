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
$idx = new mk_ad_contents;
class mk_ad_contents {


	function mk_ad_contents() {
		global $mkportals;
		switch($mkportals->input['op']) {
			case 'contents_edit':
    			$this->contents_edit($mkportals->input['idc']);
    		break;
		case 'contents_main_new':
    			$this->contents_main_new();
    		break;
			case 'contents_new':
    			$this->contents_new();
    		break;
		case 'contents_new_php':
    			$this->contents_new_php();
    		break;
			case 'contents_save':
    			$this->contents_save($mkportals->input['idc']);
    		break;
			case 'contents_savenew':
    			$this->contents_savenew();
    		break;
		case 'contents_save_php':
    			$this->contents_save_php();
    		break;
			case 'contents_delete':
    			$this->contents_delete($mkportals->input['idc']);
    		break;
		case 'contents_edit_php':
    			$this->contents_edit_php($mkportals->input['idblock']);
    		break;
		case 'contents_update_php':
    			$this->contents_update_php();
    		break;		
		case 'contents_perms':
    			$this->contents_perms();
    		break;
		case 'psave_perms':
    			$this->psave_perms();
		break;
			default:
    			$this->contents_show();
    		break;
    		}
	}

	function contents_show() {
	global $mkportals, $mklib, $Skin, $DB;
	$myquery = $DB->query("SELECT id, title FROM mkp_pages order by title");
	  $content = "
	  <tr>
	    <td>
	      <table width=\"100%\" cellspacing=\"3\">
		<tr>
		  <td width=\"30%\" class=\"tdblock\">{$mklib->lang['ad_title']}</td>
		  <td width=\"50%\" class=\"tdblock\">{$mklib->lang['ad_addresspage']}</td>
		  <td width=\"20%\" colspan=\"3\" class=\"tdblock\">{$mklib->lang['ad_actions']}</td>
		</tr>
		";

		$content .= "
		<tr>
		  <td>
			<script type=\"text/javascript\">

			function makesure() {
			if (confirm('{$mklib->lang[ad_delpageconfirm]}')) {
			return true;
			} else {
			return false;
			}
			}

			</script>
		  </td>
		</tr>
		";
	  $clastr = "tdglobal";
	  while( $row = $DB->fetch_row($myquery) ) {
		$titlep = stripslashes($row['title']);
		$content .= "
		<tr class=\"$clastr\">
		  <td width=\"30%\">
		    <img src=\"$mklib->images/frec.gif\" align=\"left\" alt=\"\" />
		    &nbsp;<a href=\"admin.php?ind=ad_contents&amp;op=contents_edit&amp;idc={$row['id']}\">$titlep</a>
		  </td>
		  <td width=\"54%\">
		    <a href=\"$mklib->siteurl/index.php?pid={$row['id']}\">$mklib->siteurl/index.php?pid={$row['id']}</a>
		  </td>
		  <td width=\"6%\" align=\"center\" nowrap=\"nowrap\">
		    [<a href=\"admin.php?ind=ad_contents&amp;op=contents_perms&amp;idc={$row['id']}\">{$mklib->lang['ad_mperm']}</a>]
		  </td>
		  <td width=\"5%\" align=\"center\" nowrap=\"nowrap\">
		    [<a href=\"admin.php?ind=ad_contents&amp;op=contents_edit&amp;idc={$row['id']}\">{$mklib->lang['ad_edit']}</a>]
		  </td>
		  <td width=\"5%\"align=\"center\" nowrap=\"nowrap\">
		    [<a href=\"admin.php?ind=ad_contents&amp;op=contents_delete&amp;idc={$row['id']}\" onclick=\"return makesure()\">{$mklib->lang['ad_delete']}</a>]
		  </td>
		</tr>
		";
		if ($clastr == "tdglobal") {
			$clastr = "modulex";
		 } else {
			$clastr = "tdglobal";
		 } 
	  }
	$content .= "
	      </table>
	    </td>
	  </tr>
	  ";
	$output = $Skin->view_block("{$mklib->lang['ad_contentslist']}", "$content");
	$mklib->printpage_admin("{$mklib->lang['ad_titlepage']}", $output);

	}
	
	function contents_main_new() {
	global $mkportals, $mklib, $Skin, $DB;
	   $content .= "		
		  <tr align=\"center\">
		    <td><br /><a href=\"admin.php?ind=ad_contents&amp;op=contents_new\"><img src=\"admin/images/block.gif\" border=\"0\" alt=\"\" /></a><br />
		    </td>
		  </tr>
		  <tr align=\"center\">
		    <td>{$mklib->lang['ad_pagenewh']}<br /><br /><br /><br /></td>
		  </tr>
		  <tr align=\"center\">
		    <td><a href=\"admin.php?ind=ad_contents&amp;op=contents_new_php\"><img src=\"admin/images/block3.gif\" border=\"0\" alt=\"\" /></a><br /></td>
		  </tr>
		  <tr align=\"center\">
		    <td>{$mklib->lang['ad_pagenewp']}<br /><br /><br /><br /></td>
		  </tr>
	";
	$output = $Skin->view_block("{$mklib->lang['ad_contentsnew']}", "$content");
	$mklib->printpage_admin("{$mklib->lang['ad_titlepage']}", $output);
	}
	
	function contents_edit($id) {
	global $mkportals, $mklib, $Skin, $DB, $editorscript;
		$editorscript = 1;
		$textarepar = "mce_editable=\"true\"";
		$textarew = "100%";
		$bbeditor= "";
		if ($mklib->mkeditor == "BBCODE") {
			$editorscript = "";
			$textarepar = "";
			$textarew = "75%";
			$bbeditor= $mklib->get_bbeditor();
		}
		$myquery = $DB->query("SELECT title, content, file FROM mkp_pages WHERE id='$id'");
		$row = $DB->fetch_row($myquery);
		// if is php page
		if ($row['file']) {
			$DB->close_db();
			Header("Location: admin.php?ind=ad_contents&op=contents_edit_php&idblock=$id");
			exit;
		}
		$titlep = $row['title'];
		$testo = $row['content'];
		$titlep = stripslashes($titlep);
		$testo = stripslashes($testo);
		$testo = str_replace("</textarea>", "[/textarea]", $testo);
	   $content = "
		<tr>
		  <td>
		  
		    <form action=\"admin.php?ind=ad_contents&amp;op=contents_save&amp;idc=$id\" method=\"post\" id=\"editor\" name=\"editor\">
		    <table width=\"100%\">
		      <tr>
			<td class=\"tdblock\">
			  {$mklib->lang['ad_title']}:	<input type=\"text\" name=\"titlepage\" value=\"$titlep\" size=\"40\" />
			</td>
		      </tr>
		      <tr>
			<td class=\"tdblock\">
			$bbeditor
 			<textarea id=\"ta\" name=\"ta\" $textarepar style=\"width: $textarew\" rows=\"14\" cols=\"40\">$testo</textarea>
			</td>
		      </tr>
		      <tr>
			<td>
			  <div align=\"center\"><input type=\"submit\" name=\"ok\" value=\"  {$mklib->lang['ad_save']}  \" /></div>		
			</td>
		      </tr>
		    </table>
		    </form>
		    
		  </td>
		</tr>

	";
	$output = $Skin->view_block("{$mklib->lang['ad_contentsedit']}", "$content");
	$mklib->printpage_admin("{$mklib->lang['ad_titlepage']}", $output);
	}
	function contents_new() {
	global $mkportals, $mklib, $Skin, $DB, $editorscript;
	   $editorscript = 1;
		$textarepar = "mce_editable=\"true\"";
		$textarew = "100%";
		$bbeditor= "";
		if ($mklib->mkeditor == "BBCODE") {
			$editorscript = "";
			$textarepar = "";
			$textarew = "75%";
			$bbeditor= $mklib->get_bbeditor();
		}
	   $content = "
		<tr>
		  <td>
		    <form action=\"admin.php?ind=ad_contents&amp;op=contents_savenew\" method=\"post\" id=\"editor\" name=\"editor\">
		    <table width=\"100%\">
		      <tr>
			<td class=\"tdblock\" valign=\"top\">
			{$mklib->lang['ad_title']}:	<input type=\"text\" name=\"titlepage\"  size=\"40\" />
			</td>
		      </tr>
		      <tr>
			<td class=\"tdblock\">
			$bbeditor
 			<textarea id=\"ta\" name=\"ta\" $textarepar style=\"width: $textarew\" rows=\"14\" cols=\"40\"></textarea>
			</td>
		      </tr>
		      <tr>
			<td>
			  <div align=\"center\"><input type=\"submit\" name=\"ok\" value=\"  {$mklib->lang['ad_save']}  \" /></div>		
			</td>
		      </tr>
		    </table>
		    </form>
		  </td>
		</tr>
	";
	$output = $Skin->view_block("{$mklib->lang['ad_contentsnew']}", "$content");
	$mklib->printpage_admin("{$mklib->lang['ad_titlepage']}", $output);
	}
	function contents_save($id) {
	global $mkportals, $mklib, $Skin,  $DB;
		$content = $mklib->convert_savedbadmin($_POST['ta']);
		$titlepage = $mklib->convert_savedbadmin($_POST['titlepage']);
		$content = str_replace ("[/textarea]", "</textarea>", $content);
		$DB->query("UPDATE mkp_pages SET content ='$content', title='$titlepage' WHERE id='$id'");
		$DB->close_db();
		Header("Location: admin.php?ind=ad_contents");
		exit;
	}
	function contents_savenew() {
	global $mkportals, $mklib, $Skin, $DB, $_POST;
		$content = $mklib->convert_savedbadmin($_POST['ta']);
		$titlepage = $mklib->convert_savedbadmin($_POST['titlepage']);
		$content = str_replace ("[/textarea]", "</textarea>", $content);
		$DB->query("INSERT INTO mkp_pages (content, title) VALUES ('$content', '$titlepage')");
		$DB->close_db();
		Header("Location: admin.php?ind=ad_contents");
		exit;
	}
	function contents_delete($id) {
	global $mkportals, $mklib, $Skin,  $DB;
		$DB->query("SELECT file FROM mkp_pages WHERE id =  '$id'");
		$row = $DB->fetch_row();
		if ($row['file']) {
			$filename = $row['file'];
			@unlink("$filename");
		}
		$DB->query("DELETE FROM mkp_pages WHERE id='$id'");
		$DB->close_db();
		Header("Location: admin.php?ind=ad_contents");
		exit;

	}
	
	function contents_new_php() {
	global $mkportals, $mklib, $Skin, $DB;
		$titleblock = $mkportals->input['titleblock'];
		$titleblock = stripslashes($titleblock);
		$testo = $_POST['ta'];
		$magic = get_magic_quotes_gpc();		
		if ($magic) {
			$testo = stripslashes($testo);
		}
		if (!$titleblock) {
			$titleblock = "{$mklib->lang['ad_title']}??";
   		}
		$testo =  trim ($testo);
		if (!$testo) {
		  $testo = $mklib->lang['ad_blphpcode'];
	 	}
		
		$filename = "cache/tmp_block.php";
		$css = "$mklib->template/style.css";
 		$filetext = "<head>\n<link href=\"{$css}\" rel=\"stylesheet\" type=\"text/css\">\n</head>\n";
		$filetext .= $testo;
		if (!$handle = fopen($filename, 'w')) {
         	$message = "";
			$mklib->error_page($message);
			exit;
   		}
   		if (!fwrite($handle, $filetext)) {
       		$message = "{$mklib->lang['ad_blnofile']}";
			$mklib->error_page($message);
			exit;
   		}
		fclose($handle);

	   $content .= "
		<tr>
		  <td>
		  
		    <form action=\"admin.php?ind=ad_contents&amp;op=contents_new_php\" method=\"post\" id=\"editor\" name=\"editor\">
		    <table width=\"300\">
		      <tr>
			<td class=\"tdblock\">
			  {$mklib->lang['ad_title']}:
			  <input type=\"text\" value=\"$titleblock\" name=\"titleblock\" size=\"40\" />
			</td>
		      </tr>
		      <tr>
			<td class=\"tdblock\">
			  <textarea id=\"ta\" name=\"ta\"  rows=\"20\" cols=\"75\">$testo</textarea>
			  <input type=\"submit\" name=\"ok\" value=\"  {$mklib->lang['ad_pgpreview']}  \" />
			</td>
		      </tr>
		    </table>
		    </form>

		  </td>
		</tr>		    		    
		<tr>
		  <td align=\"left\" height=\"100%\">
		    <table width=\"100%\">
		      <tr>
			<td>
			  <iframe src=\"admin.php?ind=ad_blocks&amp;op=show_code&amp;titleblock=$titleblock\" frameborder=\"0\"  width=\"100%\" align=\"middle\" height=\"200\" scrolling=\"auto\"></iframe>
			</td>
		      </tr>
		    </table>
		  </td>
		</tr>		
		<tr align=\"left\">
		  <td>		    
		    <form action=\"admin.php?ind=ad_contents&amp;op=contents_save_php\" method=\"post\" name=\"s_block\">
		      <input type=\"hidden\" value=\"$titleblock\" name=\"titleblock\" />
		      <input type=\"submit\" name=\"oks\" value=\"  {$mklib->lang['ad_save']}  \" />		
		    </form>
		  </td>
		</tr>
	";

	$output = $Skin->view_block("{$mklib->lang['ad_pagenewp']}", "$content");
	$mklib->printpage_admin("{$mklib->lang['ad_titlepage']}", $output);
	}
	function contents_save_php() {
	global $mkportals, $mklib, $Skin,  $DB;
		$titlepage = $_POST['titleblock'];
		$titlepage = stripslashes($titlepage);
		$titlepage = $mklib->convert_savedbadmin($titlepage);  
		if (!$titlepage) {
			$titlepage = "{$mklib->lang['ad_title']}??";
   		}
		$filename = "cache/tmp_block.php";
		$query = $DB->query("SELECT id FROM mkp_pages order by 'id' DESC LIMIT 1");
		$row = $DB->fetch_row($query);
		$filename2 = "cache/ppage_";
		$filename2 .= ++$row['id'];
		$filename2 .= ".php";
		copy($filename, $filename2);

		$handle = fopen($filename, "r");
		$testo = fread($handle, filesize($filename));
		fclose($handle);
		$start = strpos($testo, "<?php");
		$testo = substr($testo, $start);

		if (!$handle = fopen($filename2, 'w')) {
         	$message = "{$mklib->lang['ad_blnofile']}";
			$mklib->error_page($message);
			exit;
   		}
   		if (!fwrite($handle,$testo)) {
       		$message = "{$mklib->lang['ad_blnofile']}";
			$mklib->error_page($message);
			exit;
   		}
		fclose($handle);
		$DB->query("INSERT INTO mkp_pages (file, title) VALUES ('$filename2', '$titlepage')");
		$DB->close_db();
		Header("Location: admin.php?ind=ad_contents");
		exit;
	}
	function contents_update_php() {
	global $mkportals, $mklib, $Skin, $DB;
		$idblock = $mkportals->input['idblock'];
		$titleblock = $_GET['titleblock'];
		$titleblock = stripslashes($titleblock);
		$titleblock = $mklib->convert_savedbadmin($titleblock);
		if (!$titleblock) {
			$titleblock = "{$mklib->lang['ad_title']}??";
   		}
		$filename = "cache/tmp_block.php";
		$handle = fopen($filename, "r");
		$testo = fread($handle, filesize($filename));
		fclose($handle);
		$start = strpos($testo, "<?php");
		$testo = substr($testo, $start);
		$query = $DB->query("SELECT file FROM mkp_pages WHERE id = '$idblock'");
		$row = $DB->fetch_row($query);
		$filename2 = $row['file'];
		copy($filename, $filename2);

		if (!$handle = fopen($filename2, 'w')) {
         	$message = "{$mklib->lang['ad_blnofile']}";
			$mklib->error_page($message);
			exit;
   		}
   		if (!fwrite($handle,$testo)) {
       		$message = "{$mklib->lang['ad_blnofile']}";
			$mklib->error_page($message);
			exit;
   		}
		fclose($handle);

		$DB->query("UPDATE mkp_pages SET title='$titleblock' WHERE id='$idblock'");
		$DB->close_db();
		Header("Location: admin.php?ind=ad_contents");
		exit;
	}
	function contents_edit_php($idblock, $check="") {
	global $mkportals, $mklib, $Skin, $DB;
		$titleblock = $mkportals->input['titleblock'];
		$titleblock = stripslashes($titleblock);
		$testo = $_POST['ta'];
		$query = $DB->query("SELECT file, title FROM mkp_pages WHERE id = '$idblock'");
		$row = $DB->fetch_row($query);
		if (!$titleblock) {
			$titleblock = $row['title'];
		}
		$magic = get_magic_quotes_gpc();
		if ($magic) {
			$testo = stripslashes($testo);
		}
		if (!$testo) {
			$filename = $row['file'];
			$handle = fopen($filename, "r");
			$testo = fread($handle, filesize($filename));
			fclose($handle);
		}
		$testo =  trim ($testo);
		if (!$testo) {
		  $testo = $mklib->lang['ad_blphpcode'];
	 	}

		$filename = "cache/tmp_block.php";
		$css = "$mklib->template/style.css";
 		$filetext = "<head>\n<link href=\"{$css}\" rel=\"stylesheet\" type=\"text/css\">\n</head>\n";
		$filetext .= $testo;
		if (!$handle = fopen($filename, 'w')) {
         	$message = "{$mklib->lang['ad_blnofile']}";
			$mklib->error_page($message);
			exit;
   		}
   		if (!fwrite($handle, $filetext)) {
       		$message = "{$mklib->lang['ad_blnofile']}";
			$mklib->error_page($message);
			exit;
   		}
		fclose($handle);

	   $content .= "
		<tr>
		  <td>
		    <form action=\"admin.php?ind=ad_contents&amp;op=contents_edit_php&amp;idblock=$idblock\" method=\"post\" id=\"editor\" name=\"editor\">
		    <table width=\"300\">
		      <tr>
			<td class=\"tdblock\">
			  {$mklib->lang['ad_title']}:
			  <input type=\"text\" value = \"$titleblock\" name=\"titleblock\"  size=\"40\" />
			</td>
		      </tr>
		      <tr>
			<td class=\"tdblock\">
			  <textarea id=\"ta\" name=\"ta\"  rows=\"20\" cols=\"75\">$testo</textarea>
			  <input type=\"submit\" name=\"ok\" value=\"  {$mklib->lang['ad_pgpreview']}  \" />
			</td>
		      </tr>
		    </table>
		    </form>
		  </td>
		</tr>		
		<tr>
		  <td align=\"left\" height=\"100%\">
		    <table width=\"100%\">
		      <tr>
			<td>
			  <iframe src=\"admin.php?ind=ad_blocks&amp;op=show_code&amp;titleblock=$titleblock\" frameborder=\"0\"  width=\"100%\" align=\"middle\" height=\"200\" scrolling=\"auto\"></iframe>
			</td>
		      </tr>
		    </table>
		  </td>
		</tr>
		<tr>
		  <td>
		    <form action=\"admin.php?ind=ad_contents&amp;op=contents_update_php&amp;idblock=$idblock&amp;titleblock=$titleblock\" method=\"post\" name=\"s_block\">
		      <input type=\"submit\" name=\"oks\" value=\"  {$mklib->lang['ad_save']}  \" />
		    </form>
		  </td>
		</tr>	
	";

	$output = $Skin->view_block("{$mklib->lang['ad_contentsedit']}", "$content");
	$mklib->printpage_admin("{$mklib->lang['ad_titlepage']}", $output);
	}
	
	
	function contents_perms() {
	global $mkportals, $mklib, $Skin, $DB, $mklib_board;
	$idc = $mkportals->input['idc'];
	$DB->query("SELECT id, title, perms FROM mkp_pages WHERE id =  '$idc'");
	$row = $DB->fetch_row();
	$groups = $mklib_board->build_grouplist2();
	$perms = array();
	if ($row['perms']) {
		$perms =  unserialize($row['perms']);
	}
	$content = "
	<tr>
	  <td>
	    <form name=\"main1\" method=\"post\" action=\"admin.php?ind=ad_contents&amp;op=psave_perms&amp;idc=$idc\">
		<tr>
		<td class=\"titadmin\"><br \> {$mklib->lang['ad_groupsallow']} {$row['title']}</td>
	      </tr>
	      
	";
	$clastr = "tdglobal";
	foreach ($groups as $value) {
   		//echo "id: $value[id] title: $value[title]<br />\n";
		$checkactive = "checked=\"checked\"";
		if (in_array($value[id], $perms)) {
			$checkactive ="";
   		}
		$name = "group".$value[id];
		$content .= "
		<tr class=\"$clastr\">
		<td><br \>&nbsp;&nbsp;<input type=\"checkbox\" name=\"$name\" value=\"1\" $checkactive />&nbsp;&nbsp; $value[title]</td>
	      </tr>
		";
		if ($clastr == "tdglobal") {
			$clastr = "modulex";
		 } else {
			$clastr = "tdglobal";
		 }
	}
	$content .= "
		
		<tr>
		<td><br \>
		&nbsp;&nbsp;<input type=\"submit\" value=\"{$mklib->lang['ad_save']}\" name=\"B1\" /><br \>
		<br \>
		</td>
	      </tr>
	    </form>
	  </td>
	</tr>
	";
	$output = $Skin->view_block("{$mklib->lang['ad_mperm']}", "$content");
	$mklib->printpage_admin("{$mklib->lang['ad_titlepage']}", $output);

	}
	function psave_perms() {
		global $mkportals, $mklib, $Skin, $DB, $mklib_board;
		$permissions = array();
		$idpage = $mkportals->input['idc'];
		$groups = $mklib_board->build_grouplist2();
		foreach ($groups as $value) {
			$idgroup = $value[id];
			$groupperm = "group".$idgroup;
			$groupperm = $mkportals->input[$groupperm];
			//echo "idblock: $idblock idgroup: $idgroup title: $value[title] permission: $groupperm<br />\n";
			if (empty($groupperm)) {
				$permissions[] = $idgroup;
			}
		}
		$permissions = serialize($permissions);
		$DB->query("UPDATE mkp_pages SET perms ='$permissions' WHERE id='$idpage'");
		$DB->close_db();
		Header("Location: admin.php?ind=ad_contents");
		exit;
	}
	
}

?>
