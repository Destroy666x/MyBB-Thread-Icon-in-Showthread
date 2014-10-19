<?php

/*
Name: Icon in Showthread
Author: Destroy666
Version: 1.3
Info: Plugin for MyBB forum software, coded for versions 1.8.x (will probably also work in 1.6.x/1.4.x).
It displays the selected thread icon in showthread.php and two other related pages - printthread.php and newreply.php.
3 template edits
Released under GNU GPL v3, 29 June 2007. Read the LICENSE.md file for more information.
Support: official MyBB forum - http://community.mybb.com/mods.php?action=profile&uid=58253 (don't PM me, post on forums)
Bug reports: my github - https://github.com/Destroy666x

© 2014 - date('Y')
*/

function icon_in_showthread_info()
{
    global $lang;
	
	$lang->load('icon_in_showthread_acp');
	
	return array(
		'name'			=> $lang->icon_in_showthread,
		'description'	=> $lang->icon_in_showthread_info.'
<br />
<br />
<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="ZRC6HPQ46HPVN">
<input type="image" src="https://www.paypalobjects.com/en_GB/i/btn/btn_donate_SM.gif" style="border: 0;" name="submit" alt="Donate">
<img alt="" src="https://www.paypalobjects.com/pl_PL/i/scr/pixel.gif" style="border: 0; width: 1px; height: 1px;">
</form>',
		'website'		=> 'http://community.mybb.com/mods.php?action=profile&uid=58253',
		'author'		=> 'Destroy666',
		'authorsite'	=> 'https://github.com/Destroy666x',
		'codename'		=> 'icon_in_showthread',
		'version'		=> 1.3,
		'compatibility'	=> '*'
    );
}

function icon_in_showthread_activate()
{
	require_once MYBB_ROOT.'inc/adminfunctions_templates.php';
	
	find_replace_templatesets('showthread', '#'.preg_quote("{\$thread['subject']}</strong>").'#i',
	'{$thread[\'subject\']}</strong> <div style="display: inline-block; vertical-align: middle; padding: 0 3px;">{$thread_icon}</div>');
	find_replace_templatesets('printthread', '#'.preg_quote("{\$thread['subject']}</a>").'#i',
	'{$thread[\'subject\']}</a> <div style="display: inline-block; vertical-align: middle; padding: 0 3px;">{$thread_icon}</div>');
	find_replace_templatesets('newreply', '#'.preg_quote('{$lang->reply_to}</strong>').'#i',
	'{$lang->reply_to}</strong> <div style="display: inline-block; vertical-align: middle; padding: 0 3px;">{$thread_icon}</div>');
}

function icon_in_showthread_deactivate()
{
	require_once MYBB_ROOT.'inc/adminfunctions_templates.php';
	
	find_replace_templatesets('showthread', '#\s?'
	.preg_quote('<div style="display: inline-block; vertical-align: middle; padding: 0 3px;">{$thread_icon}</div>').'#i', '', 0);
	find_replace_templatesets('printthread', '#\s?'
	.preg_quote('<div style="display: inline-block; vertical-align: middle; padding: 0 3px;">{$thread_icon}</div>').'#i', '', 0);
	find_replace_templatesets('newreply', '#\s?'
	.preg_quote('<div style="display: inline-block; vertical-align: middle; padding: 0 3px;">{$thread_icon}</div>').'#i', '', 0);	
}

if(THIS_SCRIPT == 'newreply.php' || THIS_SCRIPT == 'printthread.php')
{
	$GLOBALS['templatelist'] .= !empty($GLOBALS['templatelist'])
								? ',forumdisplay_thread_icon'
								: 'forumdisplay_thread_icon';
}

$plugins->add_hook('showthread_start', 'icon_in_showthread_printthread_newreply');
$plugins->add_hook('printthread_end', 'icon_in_showthread_printthread_newreply'); // end hook due to start hook misplacement..
$plugins->add_hook('newreply_start', 'icon_in_showthread_printthread_newreply');

function icon_in_showthread_printthread_newreply()
{
	global $cache, $thread, $templates, $theme, $thread_icon;
	
	$icon_cache = $cache->read('posticons');
	$thread_icon = '';
	
	if($thread['icon'] && !empty($icon_cache[$thread['icon']]))
	{
		$icon = $icon_cache[$thread['icon']];
		$icon['path'] = htmlspecialchars_uni(str_replace("{theme}", $theme['imgdir'], $icon['path']));
		$icon['name'] = htmlspecialchars_uni($icon['name']);
		
		eval('$thread_icon = "'.$templates->get('forumdisplay_thread_icon').'";');
	}
}