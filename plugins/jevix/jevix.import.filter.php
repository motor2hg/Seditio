<?PHP

/* ====================
Seditio - Website engine
Copyright Neocrome & Seditio Team
http://www.neocrome.net
https://seditio.org
[BEGIN_SED]
File=plugins/jevix/jevix.import.filter.php
Version=178
Updated=2012-may-22
Type=Plugin
Author=Amro
Description=
[END_SED]

[BEGIN_SED_EXTPLUGIN]
Code=jevix
Part=jeviximport
File=jevix.import.filter
Hooks=import.filter
Tags=
Order=10
[END_SED_EXTPLUGIN]
==================== */

if (!defined('SED_CODE')) { die('Wrong URL.'); }

global $usr, $location, $flocation;

require_once('plugins/jevix/inc/jevix.class.php');

$jevix_filter_settings = array(
  'Pages' => 'full', 
  'Private_Messages' => 'medium', 
  'Polls' => 'micro', 
  'Gallery' => 'micro', 
  'PFS' => 'micro', 
  'Users' => 'micro', 
  'Plugins' => 'full', 
  'Forums' => 'full',
  'Comments' => 'medium', 
  'Administration' => 'full'
);

$flocation = (empty($flocation)) ? $location : $flocation;

if (array_key_exists($flocation, $jevix_filter_settings))
  {
  $filter = $jevix_filter_settings[$flocation];
  }
else { $filter = 'micro'; }

// Use XHTML ?
$use_xhtml = ($cfg['plugin']['jevix']['use_xhtml'] == "yes") ? true : false;  

// Use for Administrators ?
$use_admin = (($cfg['plugin']['jevix']['use_for_admin'] == "no") && ($usr['maingrp'] == 5)) ? false : true;

// Use jevix only html mode
if ($cfg['textmode'] != "bbcode") { $v = sed_jevix($v, $filter, $use_xhtml, $use_admin); }

?>