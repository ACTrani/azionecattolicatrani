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

$idx = new mk_ad_nav;
class mk_ad_nav {


	function mk_ad_nav() {
		global $mkportals;
		switch($mkportals->input['op']) {
			case 'menu':
    			$this->menu_show();
    		break;
			case 'edit1':
    			$this->edit1();
    		break;
			case 'update_link':
    			$this->update_link();
    		break;
			case 'delete_link':
    			$this->delete_link();
    		break;
			case 'save_link_bar':
    			$this->save_link_bar();
    		break;
			case 'save_menu_bar':
    			$this->save_menu_bar();
    		break;
			default:
    			$this->link_show();
    		break;
    		}
	}
	function link_show() {
	global $mkportals, $mklib, $Skin, $DB;

		$mainltitle = "";

		if ($mkportals->input['mode'] == "saved") {
		$checksave = "{$mklib->lang['ad_saved']}<br /><br />";
   		}
	 	$content  = "
	<tr>		
	  <td>
	  
	    <script type=\"text/javascript\">

			function makesurelink() {
			if (confirm('{$mklib->lang[ad_dellinkconf]}')) {
			return true;
			} else {
			return false;
			}
			}

	    </script>

	    <table width=\"100%\" border=\"0\">
	      <tr>
		<td>$checksave</td>
	      </tr>
	      <tr>
		<td>
		  <table class=\"moduleborder\" cellspacing=\"1\" cellpadding=\"2\" width=\"98%\" align=\"center\" border=\"0\">
		    <tr>
		      <td colspan=\"5\" class=\"titadmin\">{$mklib->lang['ad_navlbar']}</td>
		    </tr>

		    <tr>
		      <th class=\"modulex\" width=\"1%\" align=\"left\">{$mklib->lang['ad_icon']}</th>
		      <th class=\"modulex\" width=\"39%\" align=\"left\">{$mklib->lang['ad_title']}</th>
		      <th class=\"modulex\" width=\"57%\" align=\"left\">{$mklib->lang['ad_urll']}</th>
		      <th class=\"modulex\" width=\"1%\" align=\"left\">{$mklib->lang['ad_position']}</th>
		      <th class=\"modulex\" width=\"1%\" align=\"left\">{$mklib->lang['ad_edit']}</th>
		      <th class=\"modulex\" width=\"1%\" align=\"left\">{$mklib->lang['ad_delete']}</th>
		    </tr>
    ";
	$query = $DB->query( "SELECT id, icon, title, url, position FROM mkp_mainlinks WHERE type = '1' ORDER BY `position`");
	while( $row = $DB->fetch_row($query) ) {
	$row['icon'] = str_replace("<IMG>","$mklib->images", $row['icon']);
	$row['url'] = str_replace("<MKURL>","$mklib->siteurl", $row['url']);
	$row['url'] = str_replace("<MKFURL>","$mkportals->base_url", $row['url']);
	if (stristr($row['title'], '<LNG>')) {
		$titlel = str_replace("<LNG>","", $row['title']); 
		$row['title'] = $mklib->lang[$titlel];
	}
	$idl = $row['id'];
	$icon = $row['icon'];
	$title = $row['title'];
	$urll = $row['url'];
	$position = $row['position'];
	$content .= "
		    <tr>
		      <td class=\"modulecell\" width=\"1%\" align=\"center\"><img src=\"$icon\" border=\"0\" alt=\"\" /></td>
		      <td class=\"modulecell\" width=\"39%\" align=\"left\">$title</td>
		      <td class=\"modulecell\" width=\"57%\" align=\"left\">$urll</td>
		      <td class=\"modulecell\" width=\"1%\" align=\"left\">$position</td>
		      <td class=\"modulecell\" width=\"1%\" align=\"left\"><a class=\"mktxtcontr2\" href=\"admin.php?ind=ad_nav&amp;op=edit1&amp;idl=$idl\">{$mklib->lang['ad_edit']}</a></td>
		      <td class=\"modulecell\" width=\"1%\" align=\"left\"><a class=\"mktxtcontr\" href=\"admin.php?ind=ad_nav&amp;op=delete_link&amp;idl=$idl\" onclick=\"return makesurelink()\">{$mklib->lang['ad_delete']}</a></td>
		    </tr>
    ";
	}
	$content  .= "
		  </table><br />
		  
		  <form action=\"admin.php?ind=ad_nav&amp;op=save_link_bar\" name=\"ad1\" method=\"post\">
		  <table>	
		    <tr>
		      <td class=\"titadmin\" colspan=\"2\">{$mklib->lang['ad_adlink']}</td>
		    </tr>
		    <tr>
		      <td width=\"10%\">{$mklib->lang['ad_icon']}</td>
		      <td width=\"90%\"><input type=\"text\" name=\"icon\" size=\"52\" class=\"bgselect\" /></td>
		    </tr>
		    <tr>
		      <td width=\"10%\">{$mklib->lang['ad_title']}</td>
		      <td width=\"90%\"><input type=\"text\" name=\"title\" size=\"52\" class=\"bgselect\" /></td>
		    </tr>
		    <tr>
		      <td width=\"10%\">{$mklib->lang['ad_urll']}</td>
		      <td width=\"90%\"><input type=\"text\" name=\"urll\" size=\"52\" class=\"bgselect\" /></td>
		    </tr>
		    <tr>
		    <td colspan=\"2\"><span class=\"mktxtcontr\">{$mklib->lang['ad_targetnew']}</span> <input type=\"checkbox\" name=\"target\" value=\"1\" /></td>
	     	    </tr>
		    <tr>
		      <td colspan=\"2\"><br \><input type=\"submit\" value=\"{$mklib->lang['ad_bladdlink']}\" class=\"bgselect\" /></td>
		    </tr>	
		  </table>
		  </form>
		  
		</td>
	      </tr>
	    </table>
	  </td>
	</tr>
	   ";
		$output = $Skin->view_block("{$mklib->lang['ad_navl']}", "$content");
		$mklib->printpage_admin("{$mklib->lang['ad_titlepage']}", $output);

	}

	function menu_show() {
	global $mkportals, $mklib, $Skin, $DB;

		$mainltitle = "";

		if ($mkportals->input['mode'] == "saved") {
		$checksave = "{$mklib->lang['ad_saved']}<br /><br />";
   		}
	 	$content  = "
	<tr>		
	  <td>

	    <script type=\"text/javascript\">

			function makesurelink() {
			if (confirm('{$mklib->lang[ad_dellinkconf]}')) {
			return true;
			} else {
			return false;
			}
			}

	    </script>
	   
	    <table width=\"100%\" border=\"0\">
	      <tr>
		<td>$checksave</td>
	      </tr>
	      <tr>
		<td>
		  <table class=\"moduleborder\" cellspacing=\"1\" cellpadding=\"2\" width=\"98%\" align=\"center\" border=\"0\">
		    <tr>
		      <td colspan=\"5\" class=\"titadmin\">{$mklib->lang['ad_navlmenu']}</td>
		    </tr>
		    
		    <tr>
		      <th class=\"modulex\" width=\"1%\" align=\"left\">{$mklib->lang['ad_icon']}</th>
		      <th class=\"modulex\" width=\"39%\" align=\"left\">{$mklib->lang['ad_title']}</th>
		      <th class=\"modulex\" width=\"57%\" align=\"left\">{$mklib->lang['ad_urll']}</th>
		      <th class=\"modulex\" width=\"1%\" align=\"left\">{$mklib->lang['ad_position']}</th>
		      <th class=\"modulex\" width=\"1%\" align=\"left\">{$mklib->lang['ad_edit']}</th>
		      <th class=\"modulex\" width=\"1%\" align=\"left\">{$mklib->lang['ad_delete']}</th>
		    </tr>
    ";
	$query = $DB->query( "SELECT id, icon, title, url, position FROM mkp_mainlinks WHERE type = '2' ORDER BY `position`");
	while( $row = $DB->fetch_row($query) ) {
	$row['icon'] = str_replace("<IMG>","$mklib->images", $row['icon']);
	$row['url'] = str_replace("<MKURL>","$mklib->siteurl", $row['url']);
	$row['url'] = str_replace("<MKFURL>","$mkportals->base_url", $row['url']);
	if (stristr($row['title'], '<LNG>')) {
		$titlel = str_replace("<LNG>","", $row['title']); 
		$row['title'] = $mklib->lang[$titlel];
	}
	$idl = $row['id'];
	$icon = $row['icon'];
	$title = $row['title'];
	$urll = $row['url'];
	$position = $row['position'];
	$content .= "
		    <tr>
		      <td class=\"modulecell\" width=\"1%\" align=\"center\"><img src=\"$icon\" border=\"0\" alt=\"\" /></td>
		      <td class=\"modulecell\" width=\"39%\" align=\"left\">$title</td>
		      <td class=\"modulecell\" width=\"57%\" align=\"left\">$urll</td>
		      <td class=\"modulecell\" width=\"1%\" align=\"left\">$position</td>
		      <td class=\"modulecell\" width=\"1%\" align=\"left\"><a class=\"mktxtcontr2\" href=\"admin.php?ind=ad_nav&amp;op=edit1&amp;idl=$idl&amp;retl=1\">{$mklib->lang['ad_edit']}</a></td>
		      <td class=\"modulecell\" width=\"1%\" align=\"left\"><a class=\"mktxtcontr\" href=\"admin.php?ind=ad_nav&amp;op=delete_link&amp;idl=$idl&amp;retl=1\" onclick=\"return makesurelink()\">{$mklib->lang['ad_delete']}</a></td>
		    </tr>
    ";
	}
	$content  .= "
		  </table><br />
		  
		  <form action=\"admin.php?ind=ad_nav&amp;op=save_menu_bar\" name=\"ad1\" method=\"post\">
		  <table>	
		    <tr>
		      <td class=\"titadmin\" colspan=\"2\">{$mklib->lang['ad_adlink']}</td>
		    </tr>
		    <tr>
		      <td width=\"10%\">{$mklib->lang['ad_icon']}</td>
		      <td width=\"90%\"><input type=\"text\" name=\"icon\" size=\"52\" class=\"bgselect\" /></td>
		    </tr>
		    <tr>
		      <td width=\"10%\">{$mklib->lang['ad_title']}</td>
		      <td width=\"90%\"><input type=\"text\" name=\"title\" size=\"52\" class=\"bgselect\" /></td>
		    </tr>
		    <tr>
		      <td width=\"10%\">{$mklib->lang['ad_urll']}</td>
		      <td width=\"90%\"><input type=\"text\" name=\"urll\" size=\"52\" class=\"bgselect\" /></td>
		    </tr>
		    <tr>
		    <td colspan=\"2\"><span class=\"mktxtcontr\">{$mklib->lang['ad_targetnew']}</span> <input type=\"checkbox\" name=\"target\" value=\"1\" /></td>
	     	    </tr>
		    <tr>
		      <td colspan=\"2\"><br \><input type=\"submit\" value=\"{$mklib->lang['ad_bladdlink']}\" class=\"bgselect\" /></td>
		    </tr>	
		  </table>
		  </form>

		</td>
	      </tr>
	    </table>
	  </td>
	</tr>
	   ";
		$output = $Skin->view_block("{$mklib->lang['ad_navl']}", "$content");
		$mklib->printpage_admin("{$mklib->lang['ad_titlepage']}", $output);

	}

	function edit1() {
		global $mkportals, $DB, $mklib, $Skin;

		$idl = $mkportals->input['idl'];
		$retl = $mkportals->input['retl'];

		$query = $DB->query( "SELECT icon, title, url, position, target FROM mkp_mainlinks WHERE id = '$idl'");
		$row = $DB->fetch_row($query);
		$icon = $row['icon'];
		$title = $row['title'];
		$urll = $row['url'];
		$position = $row['position'];
		$target = $row['target'];
		if ($target == 1) {
			$checkactive =  "checked=\"checked\"";
   		}

		$output = "
	<tr>
	  <td><br />
	    <table class=\"moduleborder\" cellspacing=\"1\" cellpadding=\"0\" width=\"100%\" align=\"center\" border=\"0\">
	      <tr>
		<td>
		  <table class=\"modulebg\" cellspacing=\"1\" cellpadding=\"0\" width=\"100%\" border=\"0\">
		    <tr>
		      <td class=\"tdblock\" width=\"100%\" height=\"25\"><img src=\"$mklib->images/arrow.gif\" alt=\"\" />{$mklib->lang['ad_modlink']}</td>
		    </tr>
		    <tr>
		      <td>
			<table class=\"moduleborder\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" border=\"0\">
			  <tr>
			    <td>
			      <table class=\"moduleborder\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" border=\"0\">
				<tr>				 
				  <td class=\"modulex\">
				  
				    <form action=\"admin.php?ind=ad_nav&amp;op=update_link&amp;idl=$idl&amp;retl=$retl\" name=\"e_b\" method=\"post\">
				    <table width=\"100%\" border=\"0\">
				      <tr>
					<td class=\"titadmin\"><br /></td>
				      </tr>
				      <tr>
					<td>{$mklib->lang['ad_icon']}</td>
				      </tr>
				      <tr>
					<td><input type=\"text\" name=\"icon\" value=\"$icon\" size=\"70\" class=\"bgselect\" /></td>
				      </tr>
				      <tr>
					<td>{$mklib->lang['ad_title']}</td>
				      </tr>
				      <tr>
					<td><input type=\"text\" name=\"title\" value=\"$title\" size=\"70\" class=\"bgselect\" /></td>
				      </tr>
				      <tr>
					<td>{$mklib->lang['ad_urll']}</td>
				      </tr>
				      <tr>
					<td><input type=\"text\" name=\"urll\" value=\"$urll\" size=\"70\" class=\"bgselect\" /></td>
				      </tr>
				      <tr>
					<td>{$mklib->lang['ad_position']}</td>
				      </tr>
				      <tr>
					<td><input type=\"text\" name=\"position\" value=\"$position\" size=\"2\" class=\"bgselect\" /></td>
				      </tr>
				      <tr>
					<td><span class=\"mktxtcontr\">{$mklib->lang['ad_targetnew']}</span> <input type=\"checkbox\" name=\"target\" value=\"1\" $checkactive /></td>
	     			      </tr>
				      <tr>
					<td><br /><input type=\"submit\" value=\"{$mklib->lang['ad_save']}\" class=\"bgselect\" /></td>
				      </tr>
				    </table>
				    </form>
				  </td>
				</tr>   		
			      </table>
			    </td>
			  </tr>
			</table>
		      </td>
		    </tr>
		  </table>
		</td>
	      </tr>
	    </table>
	  </td>
	</tr>
	";
		$output = $Skin->view_block("{$mklib->lang['ad_modlink']}", "$output");
		$mklib->printpage_admin("{$mklib->lang['ad_titlepage']}", $output);

	}

	function update_link() {
    	global $mkportals, $DB, $mklib;

		$idl = $mkportals->input['idl'];
		$retl = $mkportals->input['retl'];
		$icon = $_POST['icon'];
		$title = $_POST['title'];
		$urll = $_POST['urll'];
		$position = $mkportals->input['position'];
		$target = ( !empty($mkportals->input['target']) ) ? $mkportals->input['target'] : "0";
		if (!$title || !$urll) {
			$message = "{$mklib->lang['ad_all_rows']}";
			$mklib->error_page($message);
			exit;
		}
		$DB->query("UPDATE mkp_mainlinks set icon = '$icon', title = '$title', url = '$urll', position = '$position', target = '$target' where id = '$idl'");
		$DB->close_db();
		$loc = "admin.php?ind=ad_nav&mode=saved";
		if ($retl) {
			$loc = "admin.php?ind=ad_nav&op=menu&mode=saved";
		}
		Header("Location: $loc");
		exit;
  	}
	function delete_link() {
    	global $mkportals, $DB, $mklib;

		$idl = $mkportals->input['idl'];
		$retl = $mkportals->input['retl'];
		$DB->query("DELETE FROM mkp_mainlinks WHERE id = $idl");
		$DB->close_db();
		$loc = "admin.php?ind=ad_nav&mode=saved";
		if ($retl) {
			$loc = "admin.php?ind=ad_nav&op=menu&mode=saved";
		}
		Header("Location: $loc");
		exit;
  	}
	function save_link_bar() {
    	global $mkportals, $DB, $mklib;
		$icon = $_POST['icon'];
		$title = $_POST['title'];
		$urll = $_POST['urll'];
		$target = ( !empty($mkportals->input['target']) ) ? $mkportals->input['target'] : "0";
		if (!$title || !$urll) {
			$message = "{$mklib->lang['ad_all_rows']}";
			$mklib->error_page($message);
			exit;
		}
		$DB->query("INSERT INTO mkp_mainlinks (icon, title, url, type, target) VALUES ('$icon', '$title', '$urll', '1', '$target')");
		$DB->close_db();
		Header("Location: admin.php?ind=ad_nav&mode=saved");
		exit;
  	}
	function save_menu_bar() {
    	global $mkportals, $DB, $mklib;
		$icon = $_POST['icon'];
		$title = $_POST['title'];
		$urll = $_POST['urll'];
		$target = ( !empty($mkportals->input['target']) ) ? $mkportals->input['target'] : "0";
		if (!$title || !$urll) {
			$message = "{$mklib->lang['ad_all_rows']}";
			$mklib->error_page($message);
			exit;
		}
		$DB->query("INSERT INTO mkp_mainlinks (icon, title, url, type, target) VALUES ('$icon', '$title', '$urll', '2', '$target')");
		$DB->close_db();
		Header("Location: admin.php?ind=ad_nav&op=menu&mode=saved");
		exit;
  	}



}

?>
