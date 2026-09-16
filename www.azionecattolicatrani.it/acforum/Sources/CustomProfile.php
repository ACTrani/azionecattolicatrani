<?php

if (!defined('SMF'))
	die('Hacking attempt...');

function EditFields()
{
	global $context, $modSettings;
	$i = 1;
	while (isset($modSettings['enable_CP' . $i . '']))
	{
		if ($modSettings['enable_CP' . $i . ''])
		{
			if ($modSettings['CP' . $i . '_edit'] && !$context['user']['is_admin'])
			{
				$i++;
				continue;
			}
			if ($modSettings['CP' . $i . '_hr'] == 'edit' || $modSettings['CP' . $i . '_hr'] == 'summary_edit')
			{
				echo '
									<tr>
										<td colspan="2"><hr width="100%" size="1" class="hrcolor" /></td>
									</tr>';
			}
			if ($modSettings['CP' . $i . '_type']=='text')
			{
				echo '
									<tr>
										<td><b>' . $modSettings['CP' . $i . '_name'] . ': </b>' , !empty($modSettings['CP' . $i . '_desc']) ? '<div class="smalltext">' . $modSettings['CP' . $i . '_desc'] . '</div>' : '' , '</td><td><input type="text" name="default_options[' . $modSettings['CP' . $i . '_id'] . ']" size="50" value="', @$context['member']['options'][$modSettings['CP' . $i . '_id']], '" /></td>
									</tr>';
			}
			if ($modSettings['CP' . $i . '_type']=='textarea')
			{
				echo '
									<tr>
										<td><b>' . $modSettings['CP' . $i . '_name'] . ': </b>' , !empty($modSettings['CP' . $i . '_desc']) ? '<div class="smalltext">' . $modSettings['CP' . $i . '_desc'] . '</div>' : '' , '</td><td><textarea name="default_options[' . $modSettings['CP' . $i . '_id'] . ']" rows="4" cols="80" class="editor">', @$context['member']['options'][$modSettings['CP' . $i . '_id']], '</textarea></td>
									</tr>';
			}
			if ($modSettings['CP' . $i . '_type']=='select')
			{
				echo '
									<tr>
										<td><b>' . $modSettings['CP' . $i . '_name'] . ': </b>' , !empty($modSettings['CP' . $i . '_desc']) ? '<div class="smalltext">' . $modSettings['CP' . $i . '_desc'] . '</div>' : '' , '</td>
										<td><select name="default_options[' . $modSettings['CP' . $i . '_id'] . ']">';
				$r = 1;
				while (isset($modSettings['CP' . $i . '_data' . $r . '']) && !empty($modSettings['CP' . $i . '_data' . $r . '']))
				{
					if (isset($context['member']['options'][$modSettings['CP' . $i . '_id']]) && $context['member']['options'][$modSettings['CP' . $i . '_id']] == $modSettings['CP' . $i . '_data' . $r . ''])
					{
						echo '
											<option selected="selected">' . $modSettings['CP' . $i . '_data' . $r . ''] . '</option>';
					}
					else
					{
						echo '
											<option>' . $modSettings['CP' . $i . '_data' . $r . ''] . '</option>';
					}
					$r++;
				}
				echo '
										</select></td>';
			}
			if ($modSettings['CP' . $i . '_type']=='check')
			{
				echo '
									<tr>
										<td><b>' . $modSettings['CP' . $i . '_name'] . ': </b>' , !empty($modSettings['CP' . $i . '_desc']) ? '<div class="smalltext">' . $modSettings['CP' . $i . '_desc'] . '</div>' : '' , '</td><td><input type="hidden" name="default_options[' . $modSettings['CP' . $i . '_id'] . ']" value="0" /><input type="checkbox" name="default_options[' . $modSettings['CP' . $i . '_id'] . ']" value="1"', @$context['member']['options'][$modSettings['CP' . $i . '_id']] ? ' checked="checked"' : '', ' class="check" /></td>
									</tr>';
			}
		}
		$i++;
	}
}

function RegistrationFields()
{
	global $context, $modSettings;
	$i = 1;
	while (isset($modSettings['enable_CP' . $i . '']))
	{
		if ($modSettings['enable_CP' . $i . ''] && $modSettings['CP' . $i . '_reg'])
		{
			if ($modSettings['CP' . $i . '_type']=='text')
			{
				echo '
									<tr>
										<td><b>' . $modSettings['CP' . $i . '_name'] . ': </b>' , !empty($modSettings['CP' . $i . '_desc']) ? '<div class="smalltext">' . $modSettings['CP' . $i . '_desc'] . '</div>' : '' , '</td><td><input type="text" name="default_options[' . $modSettings['CP' . $i . '_id'] . ']" size="50" value="', @$context['member']['options'][$modSettings['CP' . $i . '_id']], '" /></td>
									</tr>';
			}
			if ($modSettings['CP' . $i . '_type']=='textarea')
			{
				echo '
									<tr>
										<td><b>' . $modSettings['CP' . $i . '_name'] . ': </b>' , !empty($modSettings['CP' . $i . '_desc']) ? '<div class="smalltext">' . $modSettings['CP' . $i . '_desc'] . '</div>' : '' , '</td><td><textarea name="default_options[' . $modSettings['CP' . $i . '_id'] . ']" rows="4" cols="80" class="editor">', @$context['member']['options'][$modSettings['CP' . $i . '_id']], '</textarea></td>
									</tr>';
			}
			if ($modSettings['CP' . $i . '_type']=='select')
			{
				echo '
									<tr>
										<td><b>' . $modSettings['CP' . $i . '_name'] . ': </b>' , !empty($modSettings['CP' . $i . '_desc']) ? '<div class="smalltext">' . $modSettings['CP' . $i . '_desc'] . '</div>' : '' , '</td>
										<td><select name="default_options[' . $modSettings['CP' . $i . '_id'] . ']">';
				$r = 1;
				while (isset($modSettings['CP' . $i . '_data' . $r . '']) && !empty($modSettings['CP' . $i . '_data' . $r . '']))
				{
					if (isset($context['member']['options'][$modSettings['CP' . $i . '_id']]) && $context['member']['options'][$modSettings['CP' . $i . '_id']] == $modSettings['CP' . $i . '_data' . $r . ''])
					{
						echo '
											<option selected="selected">' . $modSettings['CP' . $i . '_data' . $r . ''] . '</option>';
					}
					else
					{
						echo '
											<option>' . $modSettings['CP' . $i . '_data' . $r . ''] . '</option>';
					}
					$r++;
				}
				echo '
										</select></td>';
			}
			if ($modSettings['CP' . $i . '_type']=='check')
			{
				echo '
									<tr>
										<td><b>' . $modSettings['CP' . $i . '_name'] . ': </b>' , !empty($modSettings['CP' . $i . '_desc']) ? '<div class="smalltext">' . $modSettings['CP' . $i . '_desc'] . '</div>' : '' , '</td><td><input type="hidden" name="default_options[' . $modSettings['CP' . $i . '_id'] . ']" value="0" /><input type="checkbox" name="default_options[' . $modSettings['CP' . $i . '_id'] . ']" value="1"', @$context['member']['options'][$modSettings['CP' . $i . '_id']] ? ' checked="checked"' : '', ' class="check" /></td>
									</tr>';
			}
		}
		$i++;
	}
}

function CheckFieldInput()
{
	global $modSettings, $txt;
	$i = 1;
	while (isset($modSettings['enable_CP' . $i . '']))
	{
		if ($modSettings['enable_CP' . $i . ''] && $modSettings['CP' . $i . '_reg']=='force' && empty($_POST['default_options'][$modSettings['CP' . $i . '_id']]))
		{
			loadLanguage('CustomProfile');
			$txt['cp_regerror'] = preg_replace('/FIELDNAME/', $modSettings['CP' . $i . '_name'], $txt['cp_regerror']);
			fatal_lang_error('cp_regerror', false);
		}
		$i++;
	}
}

function DisplayFieldPosts()
{
	global $context, $modSettings, $messagevars;
	$i = 1;
	while (isset($modSettings['enable_CP' . $i . '']))
	{
		if ($modSettings['enable_CP' . $i . ''] && isset($messagevars['member']['options'][$modSettings['CP' . $i . '_id']]) && !empty($messagevars['member']['options'][$modSettings['CP' . $i . '_id']]) && $modSettings['CP' . $i . '_post'])
		{
			if ($modSettings['CP' . $i . '_view'] && !$context['user']['is_admin'])
			{
				$i++;
				continue;
			}
			if ($modSettings['CP' . $i . '_type']=='text' || $modSettings['CP' . $i . '_type']=='textarea')
			{
				if ($modSettings['CP' . $i . '_post']!='text')
				{
					$i++;
					continue;
				}
				$before = preg_replace('/%1/', $messagevars['member']['options'][$modSettings['CP' . $i . '_id']], $modSettings['CP' . $i . '_data1']);
				$after = preg_replace('/%1/', $messagevars['member']['options'][$modSettings['CP' . $i . '_id']], $modSettings['CP' . $i . '_data2']);
				if ($modSettings['CP' . $i . '_bbc'])
				{
					$field = parse_bbc($before . $messagevars['member']['options'][$modSettings['CP' . $i . '_id']] . $after);
				}
				else
				{
					$field = $before . $messagevars['member']['options'][$modSettings['CP' . $i . '_id']] . $after;
				}
				echo '
						' . $modSettings['CP' . $i . '_name'] . ': ' . $field . '<br />';
			}
			if ($modSettings['CP' . $i . '_type']=='select')
			{
				if ($modSettings['CP' . $i . '_bbc'])
				{
					$field = parse_bbc($messagevars['member']['options'][$modSettings['CP' . $i . '_id']]);
				}
				else
				{
					$field = $messagevars['member']['options'][$modSettings['CP' . $i . '_id']];
				}
				echo '
						' . $modSettings['CP' . $i . '_name'] . ': ' . $field . '<br />';
			}
			if ($modSettings['CP' . $i . '_type']=='check')
			{
				if ($modSettings['CP' . $i . '_bbc'])
				{
					$modSettings['CP' . $i . '_data1'] = parse_bbc($modSettings['CP' . $i . '_data1']);
					$modSettings['CP' . $i . '_data2'] = parse_bbc($modSettings['CP' . $i . '_data2']);
				}
				if ($messagevars['member']['options'][$modSettings['CP' . $i . '_id']])
				{
					echo '
						' . $modSettings['CP' . $i . '_name'] . ': ' . $modSettings['CP' . $i . '_data1'] . '<br />';
				}
				else
				{
					echo '
						' . $modSettings['CP' . $i . '_name'] . ': ' . $modSettings['CP' . $i . '_data2'] . '<br />';
				}
			}
		}
		$i++;
	}
}

function DisplayFieldPostsPictures()
{
	global $context, $modSettings, $messagevars;
	$i = 1;
	while (isset($modSettings['enable_CP' . $i . '']))
	{
		if ($modSettings['enable_CP' . $i . ''] && isset($messagevars['member']['options'][$modSettings['CP' . $i . '_id']]) && !empty($messagevars['member']['options'][$modSettings['CP' . $i . '_id']]) && $modSettings['CP' . $i . '_post'])
		{
			if ($modSettings['CP' . $i . '_view'] && !$context['user']['is_admin'])
			{
				$i++;
				continue;
			}
			if ($modSettings['CP' . $i . '_type']=='text' || $modSettings['CP' . $i . '_type']=='textarea')
			{
				if ($modSettings['CP' . $i . '_post']!='image')
				{
					$i++;
					continue;
				}
				$before = preg_replace('/%1/', $messagevars['member']['options'][$modSettings['CP' . $i . '_id']], $modSettings['CP' . $i . '_data1']);
				$after = preg_replace('/%1/', $messagevars['member']['options'][$modSettings['CP' . $i . '_id']], $modSettings['CP' . $i . '_data2']);
				if ($modSettings['CP' . $i . '_bbc'])
				{
					$field = parse_bbc($before . $messagevars['member']['options'][$modSettings['CP' . $i . '_id']] . $after);
				}
				else
				{
					$field = $before . $messagevars['member']['options'][$modSettings['CP' . $i . '_id']] . $after;
				}
				echo $field;
			}
		}
		$i++;
	}
}

function DisplayFieldsProfile()
{
	global $context, $modSettings;
	$i = 1;
	while (isset($modSettings['enable_CP' . $i . '']))
	{
		if ($modSettings['enable_CP' . $i . ''] && isset($context['member']['options'][$modSettings['CP' . $i . '_id']]) && !empty($context['member']['options'][$modSettings['CP' . $i . '_id']]) && $modSettings['CP' . $i . '_profile'])
		{
			if ($modSettings['CP' . $i . '_view'] && !$context['user']['is_admin'])
			{
				$i++;
				continue;
			}
			if ($modSettings['CP' . $i . '_hr'] == 'edit' || $modSettings['CP' . $i . '_hr'] == 'summary_edit')
			{
				echo '
							<tr>
								<td colspan="2"><hr width="100%" size="1" class="hrcolor" /></td>
							</tr>';
			}
			if ($modSettings['CP' . $i . '_type']=='text' || $modSettings['CP' . $i . '_type']=='textarea')
			{
				$before = preg_replace('/%1/', $context['member']['options'][$modSettings['CP' . $i . '_id']], $modSettings['CP' . $i . '_data1']);
				$after = preg_replace('/%1/', $context['member']['options'][$modSettings['CP' . $i . '_id']], $modSettings['CP' . $i . '_data2']);
				if ($modSettings['CP' . $i . '_bbc'])
				{
					$context['member']['options'][$modSettings['CP' . $i . '_id']] = parse_bbc($before . $context['member']['options'][$modSettings['CP' . $i . '_id']] . $after);
				}
				else
				{
					$context['member']['options'][$modSettings['CP' . $i . '_id']] = $before . $context['member']['options'][$modSettings['CP' . $i . '_id']] . $after;
				}
				echo '
							</tr><tr>
							<td><b>' . $modSettings['CP' . $i . '_name'] . ': </b></td>
							<td>' . $context['member']['options'][$modSettings['CP' . $i . '_id']] . '</td>';
			}
			if ($modSettings['CP' . $i . '_type']=='select')
				{
				if ($modSettings['CP' . $i . '_bbc'])
				{
					$field = parse_bbc($context['member']['options'][$modSettings['CP' . $i . '_id']]);
				}
				else
				{
					$field = $context['member']['options'][$modSettings['CP' . $i . '_id']];
				}
				echo '
							</tr><tr>
							<td><b>' . $modSettings['CP' . $i . '_name'] . ': </b></td>
							<td>' . $field . '</td>';
			}
			if ($modSettings['CP' . $i . '_type']=='check')
			{
				if ($modSettings['CP' . $i . '_bbc'])
				{
					$modSettings['CP' . $i . '_data1'] = parse_bbc($modSettings['CP' . $i . '_data1']);
					$modSettings['CP' . $i . '_data2'] = parse_bbc($modSettings['CP' . $i . '_data2']);
				}
				if ($context['member']['options'][$modSettings['CP' . $i . '_id']])
				{
					echo '
							</tr><tr>
							<td><b>' . $modSettings['CP' . $i . '_name'] . ': </b></td>
							<td>' . $modSettings['CP' . $i . '_data1'] . '</td>';
				}
				else
				{
					echo '
							</tr><tr>
							<td><b>' . $modSettings['CP' . $i . '_name'] . ': </b></td>
							<td>' . $modSettings['CP' . $i . '_data2'] . '</td>';
				}
			}
		}
		$i++;
	}
}

function CustomFieldSettings()
{
	global $txt, $scripturl, $context, $settings, $sc, $modSettings, $txt;
	loadLanguage('CustomProfile');

	if (isset($_GET['cp']))
	{
		if ($modSettings['CP' . $_GET['cp'] . '_type']=='text' || $modSettings['CP' . $_GET['cp'] . '_type']=='textarea')
		{
			$cp = $_GET['cp'];
			$config_vars = array(
					array('text', 'CP' . $cp . '_name', null, $txt['cp_name']),
					array('text', 'CP' . $cp . '_desc', null, $txt['cp_desc']),
					array('check', 'CP' . $cp . '_profile', null, $txt['cp_profileshow']),
					array('select', 'CP' . $cp . '_post', array('0' => $txt['cp_dontshow'], 'text' => $txt['cp_underpostcount'], 'image' => $txt['cp_underimages'],), $txt['cp_showposts']),
					array('check', 'CP' . $cp . '_bbc', null, $txt['cp_parsebbc']),
					array('text', 'CP' . $cp . '_data1', null, $txt['cp_before']),
					array('text', 'CP' . $cp . '_data2', null, $txt['cp_after']),
					array('text', 'CP' . $cp . '_id', null, $txt['cp_fieldid']),
					array('select', 'CP' . $cp . '_hr', array('no' => $txt['cp_dontshow'], 'summary' => $txt['cp_hrsummary'], 'edit' => $txt['cp_hredit'], 'summary_edit' => $txt['cp_onboth'],), $txt['cp_hrule']),
					array('select', 'CP' . $cp . '_reg', array('0' => $txt['cp_dontshow'], 'opt' => $txt['co_optinput'], 'force' => $txt['cp_forceinput'],), $txt['cp_showreg']),
					array('check', 'CP' . $cp . '_edit', null, $txt['cp_adminedit']),
					array('check', 'CP' . $cp . '_view', null, $txt['cp_adminview']),
				'<a href="' . $scripturl . '?action=featuresettings;sa=profile;addfield=' . $cp . ';sesc=' . $sc . '">' . $txt['cp_recreate'] . '</a>',
			);
		}
		elseif ($modSettings['CP' . $_GET['cp'] . '_type']=='check')
		{
			$cp = $_GET['cp'];
			$config_vars = array(
					array('text', 'CP' . $cp . '_name', null, $txt['cp_name']),
					array('text', 'CP' . $cp . '_desc', null, $txt['cp_desc']),
					array('check', 'CP' . $cp . '_profile', null, $txt['cp_profileshow']),
					array('check', 'CP' . $cp . '_post', null, $txt['cp_showposts']),
					array('text', 'CP' . $cp . '_data1', null, $txt['cp_checked']),
					array('text', 'CP' . $cp . '_data2', null, $txt['cp_notchecked']),
					array('check', 'CP' . $cp . '_bbc', null, $txt['cp_parsebbc']),
					array('text', 'CP' . $cp . '_id', null, $txt['cp_fieldid']),
					array('select', 'CP' . $cp . '_hr', array('no' => $txt['cp_dontshow'], 'summary' => $txt['cp_hrsummary'], 'edit' => $txt['cp_hredit'], 'summary_edit' => $txt['cp_onboth'],), $txt['cp_hrule']),
					array('select', 'CP' . $cp . '_reg', array('0' => $txt['cp_dontshow'], 'opt' => $txt['cp_show'],), $txt['cp_showreg']),
					array('check', 'CP' . $cp . '_edit', null, $txt['cp_adminedit']),
					array('check', 'CP' . $cp . '_view', null, $txt['cp_adminview']),
				'<a href="' . $scripturl . '?action=featuresettings;sa=profile;addfield=' . $cp . ';sesc=' . $sc . '">' . $txt['cp_recreate'] . '</a>',
			);
		}
		elseif ($modSettings['CP' . $_GET['cp'] . '_type']=='select')
		{
			$cp = $_GET['cp'];
			$config_vars = array(
					array('text', 'CP' . $cp . '_name', null, $txt['cp_name']),
					array('text', 'CP' . $cp . '_desc', null, $txt['cp_desc']),
					array('check', 'CP' . $cp . '_profile', null, $txt['cp_profileshow']),
					array('check', 'CP' . $cp . '_post', null, $txt['cp_showposts']),
					array('check', 'CP' . $cp . '_bbc', null, $txt['cp_parsebbc']),
					array('text', 'CP' . $cp . '_id', null, $txt['cp_fieldid']),
					array('select', 'CP' . $cp . '_hr', array('no' => $txt['cp_dontshow'], 'summary' => $txt['cp_hrsummary'], 'edit' => $txt['cp_hredit'], 'summary_edit' => $txt['cp_onboth'],), $txt['cp_hrule']),
					array('select', 'CP' . $cp . '_reg', array('0' => $txt['cp_dontshow'], 'opt' => $txt['cp_show'],), $txt['cp_showreg']),
					array('check', 'CP' . $cp . '_edit', null, $txt['cp_adminedit']),
					array('check', 'CP' . $cp . '_view', null, $txt['cp_adminview']),
			);
			$i = 1;
			while (isset($modSettings['CP' . $cp . '_data' . $i . '']))
			{
				$cp_option = preg_replace('/OPTIONNUMBER/', $i, $txt['cp_option']);
				$config_vars[] = array('text', 'CP' . $cp . '_data'. $i . '', null, $cp_option);
				$i++;
			}
			$config_vars[] = '<a href="' . $scripturl . '?action=featuresettings;sa=profile;adddata=' . $cp . ';sesc=' . $sc . '">' . $txt['cp_addoption'] . '</a>';
			$config_vars[] = '<a href="' . $scripturl . '?action=featuresettings;sa=profile;addfield=' . $cp . ';sesc' . $sc . '">' . $txt['cp_recreate'] . '</a>';
		}
	}
	elseif (isset($_GET['addfield']))
	{
		checkSession('get');

		$settings = array(
			'enable_CP' . $_GET['addfield'] . '' => '1',
			'CP' . $_GET['addfield'] . '_name' => $txt['cp_unnamed'],
			'CP' . $_GET['addfield'] . '_desc' => '',
			'CP' . $_GET['addfield'] . '_type' => 'text',
			'CP' . $_GET['addfield'] . '_post' => '0',
			'CP' . $_GET['addfield'] . '_profile' => '1',
			'CP' . $_GET['addfield'] . '_bbc' => '0',
			'CP' . $_GET['addfield'] . '_data1' => '',
			'CP' . $_GET['addfield'] . '_data2' => '',
			'CP' . $_GET['addfield'] . '_id' => 'CP' . $_GET['addfield'] . '',
			'CP' . $_GET['addfield'] . '_hr' => '0',
			'CP' . $_GET['addfield'] . '_reg' => '0',
			'CP' . $_GET['addfield'] . '_edit' => '0',
			'CP' . $_GET['addfield'] . '_view' => '0',
		);
		addSettings($settings);
		redirectexit('action=featuresettings;sa=profile');
	}
	elseif (isset($_GET['adddata']))
	{
		checkSession('get');

		$i = 1;
		while (isset($modSettings['CP' . $_GET['adddata'] . '_data' . $i]))
			$i++;
		$settings = array(
			'CP' . $_GET['adddata'] . '_data' . $i => '',
		);
		addSettings($settings);
		redirectexit('action=featuresettings;sa=profile;cp=' . $_GET['adddata']);
	}
	elseif (isset($_GET['moveup']))
	{
		checkSession('get');

		moveUp($_GET['moveup']);
		redirectexit('action=featuresettings;sa=profile');
	}
	elseif (isset($_GET['movedown']))
	{
		checkSession('get');

		moveDown($_GET['movedown']);
		redirectexit('action=featuresettings;sa=profile');
	}
	elseif (isset($_GET['delete']))
	{
		checkSession('get');

		deleteField($_GET['delete']);
		redirectexit('action=featuresettings;sa=profile');
	}
	else
	{
		$config_vars = array();
		$i = 1;
		while (isset($modSettings['enable_CP' . $i]))
		{
			$n = $i - 1;
			if ($n > 1)
			{
				$config_vars[] = '<a href="' . $scripturl . '?action=featuresettings;sa=profile;cp=' . $n . '">' . $txt['cp_settings'] . '</a> <a href="' . $scripturl . '?action=featuresettings;sa=profile;moveup=' . $n . ';sesc=' . $sc . '">' . $txt['cp_moveup'] . '</a> <a href="' . $scripturl . '?action=featuresettings;sa=profile;movedown=' . $n . ';sesc=' . $sc . '">' . $txt['cp_movedown'] . '</a> <a href="' . $scripturl . '?action=featuresettings;sa=profile;delete=' . $n . ';sesc=' . $sc . '">' . $txt['cp_delete'] . '</a>';
				$config_vars[] = '';
			}
			elseif ($n > 0)
			{
				$config_vars[] = '<a href="' . $scripturl . '?action=featuresettings;sa=profile;cp=' . $n . '">' . $txt['cp_settings'] . '</a> <a href="' . $scripturl . '?action=featuresettings;sa=profile;movedown=' . $n . ';sesc=' . $sc . '">' . $txt['cp_movedown'] . '</a> <a href="' . $scripturl . '?action=featuresettings;sa=profile;delete=' . $n . ';sesc=' . $sc . '">' . $txt['cp_delete'] . '</a>';
				$config_vars[] = '';
			}
			$cp_enable = preg_replace('/FIELDNAME/', $modSettings['CP' . $i . '_name'], $txt['cp_enable']);
			$config_vars[] = array('check', 'enable_CP' . $i . '', null, $cp_enable);
			$config_vars[] = array('select', 'CP' . $i . '_type', array('text' => $txt['cp_text'], 'textarea' => $txt['cp_textarea'], 'check' => $txt['cp_checkbox'], 'select' => $txt['cp_selectbox'],), $txt['cp_type']);
			$i++;
		}
		$n = $i - 1;
		if ($n > 1)
		{
			$config_vars[] = '<a href="' . $scripturl . '?action=featuresettings;sa=profile;cp=' . $n . '">' . $txt['cp_settings'] . '</a> <a href="' . $scripturl . '?action=featuresettings;sa=profile;moveup=' . $n . ';sesc=' . $sc . '">' . $txt['cp_moveup'] . '</a> <a href="' . $scripturl . '?action=featuresettings;sa=profile;delete=' . $n . ';sesc=' . $sc . '">' . $txt['cp_delete'] . '</a>';
			$config_vars[] = '';
		}
		elseif ($n == 1)
		{
			$config_vars[] = '<a href="' . $scripturl . '?action=featuresettings;sa=profile;cp=' . $n . '">' . $txt['cp_settings'] . '</a> <a href="' . $scripturl . '?action=featuresettings;sa=profile;delete=' . $n . ';sesc=' . $sc . '">' . $txt['cp_delete'] . '</a>';
			$config_vars[] = '';
		}
		$txt['cp_addfield'] = preg_replace('/FIELDNUMBER/', $i, $txt['cp_addfield']);
		$config_vars[] = '<a href="' . $scripturl . '?action=featuresettings;sa=profile;addfield=' . $i . ';sesc=' . $sc . '">' . $txt['cp_addfield'] . '</a>';
	}

	if (isset($_GET['save']))
	{
		saveDBSettings($config_vars);
		redirectexit('action=featuresettings;sa=profile');
	}

	if (isset($_GET['cp']))
	{
		$txt['cp_fieldsettings'] = preg_replace('/FIELDNUMBER/', $_GET['cp'], $txt['cp_fieldsettings']);
		$context['settings_title'] = $txt['cp_fieldsettings'];
		$context['post_url'] = $scripturl . '?action=featuresettings2;save;sa=profile;cp=' . $_GET['cp'] .'';
	}
	else
	{
		$context['settings_title'] = $txt['cp_cpfields'];
		$context['post_url'] = $scripturl . '?action=featuresettings2;save;sa=profile';
	}

	prepareDBSettingContext($config_vars);
}

function addSettings($settings, $overwrite = false)
{
	global $db_prefix;

	$string = '';
	foreach ($settings as $k => $v)
		$string .= '
				(\'' . $k . '\', \'' . addslashes($v) . '\'),';

	if ($string != '')
		$result = db_query("
			" . ($overwrite ? 'REPLACE' : 'INSERT IGNORE') . " INTO {$db_prefix}settings
				(variable, value)
			VALUES" . substr($string, 0, -1),__FILE__,__LINE__);
}

function moveDown($id)
{
	global $modSettings;

	$replace = $id + 1;
	if (!isset($modSettings['enable_CP' . $id . '']) || !isset($modSettings['enable_CP' . $replace . '']))
		return false;

	$settings = array(
		'enable_CP' . $replace . '' => $modSettings['enable_CP' . $id],
		'CP' . $replace . '_name' => $modSettings['CP' . $id . '_name'],
		'CP' . $replace . '_desc' => $modSettings['CP' . $id . '_desc'],
		'CP' . $replace . '_type' => $modSettings['CP' . $id . '_type'],
		'CP' . $replace . '_post' => $modSettings['CP' . $id . '_post'],
		'CP' . $replace . '_profile' => $modSettings['CP' . $id . '_profile'],
		'CP' . $replace . '_bbc' => $modSettings['CP' . $id . '_bbc'],
		'CP' . $replace . '_id' => $modSettings['CP' . $id . '_id'],
		'CP' . $replace . '_hr' => $modSettings['CP' . $id . '_hr'],
		'CP' . $replace . '_reg' => $modSettings['CP' . $id . '_reg'],
		'CP' . $replace . '_edit' => $modSettings['CP' . $id . '_edit'],
		'CP' . $replace . '_view' => $modSettings['CP' . $id . '_view'],
		'enable_CP' . $id . '' => $modSettings['enable_CP' . $replace],
		'CP' . $id . '_name' => $modSettings['CP' . $replace . '_name'],
		'CP' . $id . '_desc' => $modSettings['CP' . $replace . '_desc'],
		'CP' . $id . '_type' => $modSettings['CP' . $replace . '_type'],
		'CP' . $id . '_post' => $modSettings['CP' . $replace . '_post'],
		'CP' . $id . '_profile' => $modSettings['CP' . $replace . '_profile'],
		'CP' . $id . '_bbc' => $modSettings['CP' . $replace . '_bbc'],
		'CP' . $id . '_id' => $modSettings['CP' . $replace . '_id'],
		'CP' . $id . '_hr' => $modSettings['CP' . $replace . '_hr'],
		'CP' . $id . '_reg' => $modSettings['CP' . $replace . '_reg'],
		'CP' . $id . '_edit' => $modSettings['CP' . $replace . '_edit'],
		'CP' . $id . '_view' => $modSettings['CP' . $replace . '_view'],
	);

	$i = 1;
	while (isset($modSettings['CP' . $id . '_data' . $i]))
	{
		$settings['CP' . $replace . '_data' . $i] = $modSettings['CP' . $id . '_data' . $i];
		$i++;
	}
	$i = 1;
	while (isset($modSettings['CP' . $replace . '_data' . $i]))
	{
		$settings['CP' . $id . '_data' . $i] = $modSettings['CP' . $replace . '_data' . $i];
		$i++;
	}

	addSettings($settings, true);
}

function moveUp($id)
{
	global $modSettings;

	$replace = $id - 1;
	if (!isset($modSettings['enable_CP' . $id . '']) || !isset($modSettings['enable_CP' . $replace . '']))
		return false;

	$settings = array(
		'enable_CP' . $replace . '' => $modSettings['enable_CP' . $id],
		'CP' . $replace . '_name' => $modSettings['CP' . $id . '_name'],
		'CP' . $replace . '_desc' => $modSettings['CP' . $id . '_desc'],
		'CP' . $replace . '_type' => $modSettings['CP' . $id . '_type'],
		'CP' . $replace . '_post' => $modSettings['CP' . $id . '_post'],
		'CP' . $replace . '_profile' => $modSettings['CP' . $id . '_profile'],
		'CP' . $replace . '_bbc' => $modSettings['CP' . $id . '_bbc'],
		'CP' . $replace . '_id' => $modSettings['CP' . $id . '_id'],
		'CP' . $replace . '_hr' => $modSettings['CP' . $id . '_hr'],
		'CP' . $replace . '_reg' => $modSettings['CP' . $id . '_reg'],
		'CP' . $replace . '_edit' => $modSettings['CP' . $id . '_edit'],
		'CP' . $replace . '_view' => $modSettings['CP' . $id . '_view'],
		'enable_CP' . $id . '' => $modSettings['enable_CP' . $replace],
		'CP' . $id . '_name' => $modSettings['CP' . $replace . '_name'],
		'CP' . $id . '_desc' => $modSettings['CP' . $replace . '_desc'],
		'CP' . $id . '_type' => $modSettings['CP' . $replace . '_type'],
		'CP' . $id . '_post' => $modSettings['CP' . $replace . '_post'],
		'CP' . $id . '_profile' => $modSettings['CP' . $replace . '_profile'],
		'CP' . $id . '_bbc' => $modSettings['CP' . $replace . '_bbc'],
		'CP' . $id . '_id' => $modSettings['CP' . $replace . '_id'],
		'CP' . $id . '_hr' => $modSettings['CP' . $replace . '_hr'],
		'CP' . $id . '_reg' => $modSettings['CP' . $replace . '_reg'],
		'CP' . $id . '_edit' => $modSettings['CP' . $replace . '_edit'],
		'CP' . $id . '_view' => $modSettings['CP' . $replace . '_view'],
	);

	$i = 1;
	while (isset($modSettings['CP' . $id . '_data' . $i]))
	{
		$settings['CP' . $replace . '_data' . $i] = $modSettings['CP' . $id . '_data' . $i];
		$i++;
	}
	$i = 1;
	while (isset($modSettings['CP' . $replace . '_data' . $i]))
	{
		$settings['CP' . $id . '_data' . $i] = $modSettings['CP' . $replace . '_data' . $i];
		$i++;
	}

	addSettings($settings, true);
}

function deleteField($id)
{
	global $modSettings;

	if (!isset($modSettings['enable_CP' . $id . '']))
		return false;

	$i = $id + 1;
	while (isset($modSettings['enable_CP' . $i . '']))
	{
		moveUp($i);
		echo 'up';
		$i++;
	}
	$i--;
	$settings = array('enable_CP' . $i, 'CP' . $i . '_name', 'CP' . $i . '_desc', 'CP' . $i . '_type', 'CP' . $i . '_post', 'CP' . $i . '_profile', 'CP' . $i . '_bbc', 'CP' . $i . '_id', 'CP' . $i . '_hr', 'CP' . $i . '_reg', 'CP' . $i . '_edit', 'CP' . $i . '_view',);
	$n = 1;
	while (isset($modSettings['CP' . $i . '_data' . $n]))
	{
		$settings[] = 'CP' . $i . '_data' . $n;
		$n++;
	}

	deleteSettings($settings);

}

function deleteSettings($settings)
{
	global $db_prefix;

	foreach ($settings as $delete)
		$result = db_query("DELETE FROM {$db_prefix}settings WHERE variable = '$delete' LIMIT 1", __FILE__, __LINE__);
}
?>