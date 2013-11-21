<?PHP

/* ====================
Seditio - Website engine
Copyright Neocrome & Seditio Team
http://www.neocrome.net
http://www.seditio.org
[BEGIN_SED]
File=plugins/ckeditor/ckeditor.pfs.stndl.php
Version=173
Updated=2012-feb-23
Type=Plugin
Author=Amro
Description=
[END_SED]

[BEGIN_SED_EXTPLUGIN]
Code=ckeditor
Part=pfs
File=ckeditor.pfs.stndl
Hooks=pfs.stndl
Tags=
Order=10
[END_SED_EXTPLUGIN]
==================== */

if (!defined('SED_CODE')) { die('Wrong URL.'); }

$auto_popup_close = $cfg['plugin']['ckeditor']['auto_popup_close'];

$pfs_header1 = $cfg['doctype']."<html><head>
<title>".$cfg['maintitle']."</title>".sed_htmlmetas()."
<script type=\"text/javascript\">
<!--

function addthumb(thmb, image)
	{ 
  var html = '<a href=\"'+image+'\"><img src=\"'+thmb+'\" alt=\"\" /></a>'; 
  window.opener.CKEDITOR.instances['".$c2."'].insertHtml(html);  
	window.close();   
  }

function addpix(gfile)
	{ 
  var html = '<img src=\"'+gfile+'\" alt=\"\" />';
  window.opener.CKEDITOR.instances['".$c2."'].insertHtml(html);
	window.close();
  }

function addfile(gfile, gpath)
	{ 
  var html = '<a href=\"'+gpath+'\" title=\"\">'+gfile+'</a>';
  window.opener.CKEDITOR.instances['".$c2."'].insertHtml(html);
	window.close(); 
  }

function addfile_pageurl(gfile,c1,c2)
	{ opener.document.".$c1.".".$c2.".value += gfile; 
  	window.close(); 
  }

//-->
</script>
";

?>