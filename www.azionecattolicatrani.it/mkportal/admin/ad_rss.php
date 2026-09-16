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
|   Module RSS Reader Managament
|   > (c) 2005 by Peter (Peter@ibforen.de)
|
+--------------------------------------------------------------------------
*/

if (!defined("IN_MKP")) {
    die ("Sorry !! You cannot access this file directly.");
}

$idx = new mk_ad_rss;

class mk_ad_rss {

    function mk_ad_rss() {
        global $mkportals, $mklib;
        
        $mklib->load_lang("lang_ad_rss.php");
        switch($mkportals->input['op']) {
            case 'save'     :   $this->save();
                                break;
            case 'del'      :   $this->remove();
                                break;
            case 'preview'  :   $this->preview();
                                break;
            case 'save'     :   $this->save();
                                break;
            default         :   $this->edit();
                                break;
            }
    }

    function remove() {
        global $mkportals, $DB;
        
        if (!isset($mkportals->input['id']) || !is_numeric($mkportals->input['id'])) {
            $this->edit();
            exit();
        }
        $DB->query("DELETE FROM mkp_rss WHERE id='{$mkportals->input['id']}'");
        $this->edit();
    }

    function preview() {
        global $mkportals, $mklib, $Skin, $DB, $mklib_board;
        
        require "blocks/rss.php";
        if ($content != "") {
            $content = "<tr><td>".$content."</td></tr>";
        }
        $css = $mklib_board->import_css();
        $output = "<head>{$css}</head>";
        $output .= $Skin->view_block($mklib->lang['ad_preview'], $content);
        print $output;
        exit();
    }

    function edit($info = "") {
        global $mkportals, $mklib, $Skin, $DB;
        
        $desc_active = $mklib->config['rss_desc']?"checked='checked'":"";
        $marquee = $mklib->config['rss_marquee']?"checked='checked'":"";
        if ($info != "")
            $info = "<br />$info<br />";
        $content .= "
	<tr>
	  <td>
	    <script type=\"text/javascript\">
	    <!--
		function MakeSure() {
		    if (confirm('{$mklib->lang['ad_del_src']}')) {
			return true;
		    } else {
			return false;
		    }
		}
	    //-->
	    </script>
	
	    $info
	    <form action='admin.php?ind=ad_rss&amp;op=save' name='AdminForm' method='post'>
	    <table width=\"100%\" cellspacing=\"1\" cellpadding=\"4\" border=\"0\">
	      <tr><th width=\"20%\"></th><th width=\"30%\"></th><th width=\"20%\"></th><th width=\"30%\"></th></tr>
	      <tr><td colspan=\"4\" class=\"titlemedium\"><b>{$mklib->lang['ad_conf_title']}</b></td></tr>
	      <tr>
		<td class=\"tdblock\">{$mklib->lang['ad_max_items']}</td>
		<td class=\"tdblock\">
		  <input type=\"text\" value=\"{$mklib->config['rss_max_items']}\" name=\"max_items\" size=\"5\" />
		</td>
		<td class=\"tdblock\">{$mklib->lang['ad_cache_time']}</td>
		<td class=\"tdblock\">
		  <input type=\"text\" value=\"{$mklib->config['rss_cache_time']}\" name=\"cache_time\"  size=\"5\" />
		</td>
	      </tr>
	      <tr>
		<td class=\"tdblock\">{$mklib->lang['ad_desc']}</td>
		<td class=\"tdblock\">
		  <input type=\"checkbox\" value=\"1\" name=\"desc\" $desc_active />
		</td>
		<td class=\"tdblock\">{$mklib->lang['ad_desc_length']}</td>
		<td class=\"tdblock\">
		  <input type=\"text\" value=\"{$mklib->config['rss_desc_length']}\" name=\"desc_length\" size=\"5\" />
		</td>
	      </tr>
	      <tr>
		<td class=\"tdblock\">{$mklib->lang['ad_marquee']}</td>
		<td class=\"tdblock\">
		  <input type=\"checkbox\" value=\"1\" name=\"marquee\" $marquee />
		</td>
		<td class=\"tdblock\">{$mklib->lang['ad_marquee_height']}</td>
		<td class=\"tdblock\">
		  <input type=\"text\" value=\"{$mklib->config['rss_marquee_height']}\" name=\"marquee_height\" size=\"5\" />
		</td>
	      </tr>
	    </table>
	    <table width=\"100%\" cellspacing=\"1\" cellpadding=\"4\" border=\"0\">
	      <tr><td colspan=\"6\" class=\"titlemedium\"><b>{$mklib->lang['ad_source_title']}</b></td></tr>
	      <tr>
		<th class=\"tdblock\" width=\"5%\">{$mklib->lang['ad_source_pos']}</th>
		<th class=\"tdblock\" width=\"15%\">{$mklib->lang['ad_source_name']}</th>
		<th class=\"tdblock\" width=\"65%\">{$mklib->lang['ad_source_url']}</th>
		<th class=\"tdblock\" width=\"5%\">&nbsp;</th>
		<th class=\"tdblock\" width=\"5%\">&nbsp;</th>
		<th class=\"tdblock\" width=\"5%\">{$mklib->lang['ad_source_active']}</th>
	      </tr>
        ";
        $DB->query("SELECT * FROM mkp_rss ORDER BY position ASC");
        if ($num = $DB->get_num_rows()) {
            $content .= "<tr><td><input type=\"hidden\" name=\"num\" value=\"$num\" /></td></tr>
                        ";
            while ($r = $DB->fetch_row()) {
                $i++;
                if ($r['position'] == "999")
                    $r['position'] = $i;
                $select = $this->get_select($num, $r['position']);
                $checked = $r['active']?"checked='checked'":"";
                $content .= "	      
	      <tr>
		<td class=\"tdblock\">
		    <input type=\"hidden\" name=\"p{$i}\" value=\"{$r['id']}\" />
		    <select class=\"bgselect\" name=\"pos{$i}\">
		    $select
		    </select>
		</td>
		<td class=\"tdblock\"><input type=\"text\" name=\"name{$i}\" value=\"{$r['name']}\" size=\"25\" /></td>
		<td class=\"tdblock\"><input type=\"text\" name=\"url{$i}\" value=\"{$r['url']}\" size=\"56\" /></td>
		<td class=\"tdblock\"><a href=\"{$r['url']}\" target=\"_blank\">{$mklib->lang['ad_test']}</a></td>
		<td class=\"tdblock\"><a href=\"admin.php?ind=ad_rss&amp;op=del&amp;id={$r['id']}\" onclick=\"return MakeSure()\">{$mklib->lang['ad_delete']}</a></td>
		<td class=\"tdblock\"><input type=\"checkbox\" name=\"active{$i}\" value=\"1\" $checked /></td>
	      </tr>
                            ";
            }
        }
        $content .= "
	      <tr>
		<td class=\"tdblock\"><b>{$mklib->lang['ad_source_new']}</b></td>
		<td class=\"tdblock\">
		  <input type=\"text\" value=\"\" name=\"new_name\" size=\"25\" />
		</td>
		<td class=\"tdblock\">
		  <input type=\"text\" value=\"\" name=\"new_url\" size=\"56\" />
		</td>
		<td colspan=\"4\" class=\"tdblock\">&nbsp;</td>
	      </tr>
	      <tr>
		<td colspan=\"6\" class=\"tdblock\">
		  <br />
		  <input class=\"bgselect\" type=\"submit\" name=\"save\" value=\"{$mklib->lang['ad_save']}\" />&nbsp;
		  <input class=\"bgselect\" type=\"submit\" name=\"clean\" value=\"{$mklib->lang['ad_clean']}\" />&nbsp;
		  <br />
		</td>
	      </tr>
        ";
        $preview .= "
	      <tr>
		<td colspan=\"6\" align='left' height='100%'>
		  <iframe src=\"admin.php?ind=ad_rss&amp;op=preview\" frameborder=\"0\" width=\"600\" height=\"200\" scrolling=\"auto\"></iframe>
		</td>
	      </tr>
	    </table>
	    </form>
	  </td>
	</tr>
        ";
        $content .= $preview;
        $output = $Skin->view_block("{$mklib->lang['ad_title']}", $content);
        $mklib->printpage_admin("{$mklib->lang['ad_titlepage']}", $output);
    }

    function get_select($max = 0, $position = 0) {
        if (!$max) return;
        for ($i = 1; $i <= $max; $i++) {
            if ($i == $position)
                $selected = "selected=\"selected\"";
            else
                $selected = "";
            $return .= "<option value=\"$i\" $selected>$i</option>\n";
        }
        return $return;
    }

    function save() {
        global $mklib, $DB, $mkportals;
        
        if (!empty($mkportals->input['new_name']) && !empty($mkportals->input['new_url'])) {
            $url = $mkportals->input['new_url'];
            $name = str_replace(" ", "_", $mkportals->input['new_name']);
            $name = preg_replace("`[^a-zA-Z0-9]`", "", $name);
            $DB->query("INSERT INTO mkp_rss (name, url, position, active) VALUES ('$name','$url','999','0')");
        }
        if (isset($mkportals->input['num'])) {
            for ($i = 1; $i <= $mkportals->input['num']; $i++) {
                $id = $mkportals->input["p".$i];
                $active = $mkportals->input["active".$i]?"1":"0";
                $DB->query("UPDATE mkp_rss SET
                            name='".$mkportals->input["name".$i]."',
                            url='".$mkportals->input["url".$i]."',
                            position='".$mkportals->input["pos".$i]."',
                            active='".$active."'
                            WHERE id='$id'");
            }
        }
        if ($mkportals->input['cache_time'] <= 60)
            $mkportals->input['cache_time'] = 60;
        $DB->query("DELETE FROM mkp_config WHERE chiave='rss_max_items'");
        $DB->query("DELETE FROM mkp_config WHERE chiave='rss_cache_time'");
        $DB->query("DELETE FROM mkp_config WHERE chiave='rss_desc'");
        $DB->query("DELETE FROM mkp_config WHERE chiave='rss_desc_length'");
        $DB->query("DELETE FROM mkp_config WHERE chiave='rss_marquee'");
        $DB->query("DELETE FROM mkp_config WHERE chiave='rss_marquee_height'");
        $DB->query("INSERT INTO mkp_config (chiave,valore) VALUES ('rss_max_items','{$mkportals->input['max_items']}')");
        $DB->query("INSERT INTO mkp_config (chiave,valore) VALUES ('rss_cache_time','{$mkportals->input['cache_time']}')");
        $DB->query("INSERT INTO mkp_config (chiave,valore) VALUES ('rss_desc','{$mkportals->input['desc']}')");
        $DB->query("INSERT INTO mkp_config (chiave,valore) VALUES ('rss_desc_length','{$mkportals->input['desc_length']}')");
        $DB->query("INSERT INTO mkp_config (chiave,valore) VALUES ('rss_marquee','{$mkportals->input['marquee']}')");
        $DB->query("INSERT INTO mkp_config (chiave,valore) VALUES ('rss_marquee_height','{$mkportals->input['marquee_height']}')");
        
        $mklib->config = $mklib->read_config();
        if (isset($mkportals->input['clean'])) {
            $path = "cache";
            $dh = opendir($path);
            while (($file = readdir($dh)) !== false) {
                if ($file != "." && $file != ".." && is_file($path."/".$file) && preg_match("`\.rss$`i", $file)) {
                    @unlink($path."/".$file);
                }
            }
            $this->edit($mklib->lang['ad_cleaned']);
        }
        else {
            $this->edit($mklib->lang['ad_saved']);
        }
    }

}

?>
