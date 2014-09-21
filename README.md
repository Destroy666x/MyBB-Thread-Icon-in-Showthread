**Thread Icon in Showthread**
===============

**Name**: Thread Icon in Showthread  
**Author**: Destroy666  
**Version**: 1.2  

**Info**:
---------

Plugin for MyBB forum software, coded for versions 1.8.x (will probably also work in 1.6.x/1.4.x).  
It displays the selected thread icon in showthread.php and two other related pages - printthread.php and newreply.php.  
3 template edits  
Released under GNU GPL v3, 29 June 2007. Read the LICENSE.md file for more information.  

**Support/bug reports**: 
------------------------

**Support**: official MyBB forum - http://community.mybb.com/mods.php?action=profile&uid=58253 (don't PM me, post on forums)  
**Bug reports**: my github - https://github.com/Destroy666x  

**Changelog**:
--------------

**1.2** - globalized $theme and cached the template in newreply/printthread  
**1.1** - added missing htmlspecialchars_uni()  
**1.0** - initial release  

**Installation**:
-----------------

1. Upload everything from upload folder to your forum root (where index.php, forumdisplay.php etc. are located).
2. Activate plugin in ACP -> Configuration -> Plugins.

**Templates troubleshooting**:
------------------------------

* Showthread - add **{$thread_icon}** to any showthread template (showthread by default)
* Printthread - add **{$thread_icon}** to the printthread template
* Newreply - add **{$thread_icon}** to any newreply template (newreply by default)

You may also want to wrap the mentioned variable like this `<div style="display: inline-block; vertical-align: middle; padding: 0 3px;">{$thread_icon}</div>`
(it's done by default to align the icon vertically).

