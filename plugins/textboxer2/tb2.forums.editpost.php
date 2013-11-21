<?PHP

/* ====================
Seditio - Website engine
Copyright Neocrome & Seditio Team
http://www.neocrome.net
http://www.seditio.org
[BEGIN_SED]
File=plugins/textboxer2/tb2.forums.editpost.php
Version=173
Updated=2012-sep-23
Type=Plugin
Author=Arkkimaagi
Description=
[END_SED]

[BEGIN_SED_EXTPLUGIN]
Code=textboxer2
Part=forums.editpost
File=tb2.forums.editpost
Hooks=forums.editpost.tags
Tags=forums.editpost.tpl:{FORUMS_EDITPOST_TEXTBOXER}
Order=10
[END_SED_EXTPLUGIN]
==================== */

if (!defined('SED_CODE')) { die('Wrong URL.'); }

require_once("plugins/textboxer2/lang/textboxer2.".$usr['lang'].".lang.php");
require_once("plugins/textboxer2/inc/textboxer2.inc.php");

$tb2DropdownIcons = array(-1,49,1,7,10,15,19,23,35);
$tb2MaxSmilieDropdownHeight = 300; 	// Height in px for smilie dropdown
$tb2InitialSmilieLimit = 20;		// Smilies loaded by default to dropdown
$tb2TextareaRows = 16;				// Rows of the textarea

// Do not edit below this line !

$tb2ParseBBcodes=TRUE;
$tb2ParseSmilies=TRUE;
$tb2ParseBR=TRUE;

$ta = $edittopictitle.sed_textboxer2('rtext',
			'editpost',
			sed_cc($fp_text),
			$tb2TextareaRows,
			$tb2TextareaCols,
			'forumseditpost',
			$tb2ParseBBcodes,
			$tb2ParseSmilies,
			$tb2ParseBR,
			$tb2Buttons,
			$tb2DropdownIcons,
			$tb2MaxSmilieDropdownHeight,
			$tb2InitialSmilieLimit).$pfs;

$t->assign("FORUMS_EDITPOST_TEXT", $ta);
$t->assign("FORUMS_EDITPOST_TEXTBOXER", $ta);

?>