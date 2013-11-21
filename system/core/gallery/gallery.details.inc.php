<?PHP

/* ====================
Seditio - Website engine
Copyright Neocrome & Seditio Team
http://www.neocrome.net
http://www.seditio.org
[BEGIN_SED]
File=gallery.details.inc
Version=173
Updated=2012-sep-23
Type=Core
Author=Neocrome
Description=PFS
[END_SED]
==================== */

if (!defined('SED_CODE') || !defined('SED_GALLERY')) { die('Wrong URL.'); }

list($usr['auth_read'], $usr['auth_write'], $usr['isadmin']) = sed_auth('gallery', 'a');
sed_block($usr['auth_read']);

$comments = sed_import('comments','G','BOL');
unset($browse_list, $browse_zoom);

/* === Hook === */
$extp = sed_getextplugins('gallery.details.first');
if (is_array($extp))
	{ foreach($extp as $k => $pl) { include('plugins/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php'); } }
/* ===== */


$sql_pfs = sed_sql_query("SELECT * FROM $db_pfs WHERE pfs_id='$id' LIMIT 1");
sed_die(sed_sql_numrows($sql_pfs)==0);
$pfs = sed_sql_fetchassoc($sql_pfs);
$f = $pfs['pfs_folderid'];

$sql_pff = sed_sql_query("SELECT f.*, u.user_name FROM $db_pfs_folders f
LEFT JOIN $db_users AS u ON f.pff_userid=u.user_id
WHERE pff_id='$f' AND pff_type=2");
sed_die(sed_sql_numrows($sql_pff)==0);
$pff = sed_sql_fetchassoc($sql_pff);

$sql_pfsall = sed_sql_query("SELECT pfs_id FROM $db_pfs
WHERE pfs_folderid='$f' AND pfs_extension IN $gd_supported_sql ORDER BY pfs_id ASC");
$pos = 0;

while ($row = sed_sql_fetchassoc($sql_pfsall))
	{
  	$pos++;
  	$pfsall[$pos] = $row['pfs_id'];
  	if ($row['pfs_id'] == $id)
    	{ $current = $pos; }
	}
$total = count ($pfsall);

foreach($pfsall as $j => $k)
  {
  $browse_list .= ($current==$j) ? "<strong>[" : '';
  $browse_list .= "<a href=\"gallery.php?id=$k\">$j</a>";
  $browse_list .= ($current==$j) ? "]</strong>" : '';
  $browse_list .= " &nbsp;";
  }

$browse_prev = ($pfsall[$current-1]>0) ? "<a href=\"gallery.php?id=".$pfsall[$current-1]."\"><img src=\"skins/".$skin."/img/system/gallery_prev.png\" alt=\"\" /></a>": '';
$browse_next = ($pfsall[$current+1]>0) ? "<a href=\"gallery.php?id=".$pfsall[$current+1]."\"><img src=\"skins/".$skin."/img/system/gallery_next.png\" alt=\"\" /></a>": '';
$browse_back =  "<a href=\"gallery.php?f=".$f."\"><img src=\"skins/".$skin."/img/system/gallery_back.png\" alt=\"\" /></a>";

$pfs['pfs_fullfile'] = $cfg['pfs_dir'].$pfs['pfs_file'];
$pfs['pfs_filesize'] = floor($pfs['pfs_size']/1024);
$pfs['pfs_imgsize'] = @getimagesize($pfs['pfs_fullfile']);
$pfs['pfs_imgsize_xy'] = $pfs['pfs_imgsize'][0].'x'.$pfs['pfs_imgsize'][1];
$pfs['pfs_img'] = "<img src=\"".$cfg['pfs_dir'].$pfs['pfs_file']."\" alt=\"\" />";

if ($pfs['pfs_imgsize'][0]>$cfg['gallery_imgmaxwidth'])
  {
  if (!file_exists($cfg['res_dir'].$pfs['pfs_file']))
    { sed_image_resize($pfs['pfs_fullfile'], $cfg['res_dir'].$pfs['pfs_file'], $cfg['gallery_imgmaxwidth'], $pfs['pfs_extension'], 90); }

  if (file_exists($cfg['res_dir'].$pfs['pfs_file']))
    {
    $pfs['pfs_img'] = "<a href=\"javascript:picture('pfs.php?m=view&amp;v=".$pfs['pfs_file']."',200,200)\">";
    $pfs['pfs_img'] .= "<img src=\"".$cfg['res_dir'].$pfs['pfs_file']."\" alt=\"\" /></a>";
    $browse_zoom = "<a href=\"javascript:picture('pfs.php?m=view&amp;v=".$pfs['pfs_file']."',200,200)\">";
    $browse_zoom .= "<img src=\"skins/".$skin."/img/system/gallery_zoom.png\" title=\"Zoom\" /></a>";
    }
  }

if ($usr['isadmin'])
  {
  $pfs['admin'] = "<a href=\"pfs.php?m=edit&amp;id=".$pfs['pfs_id']."&amp;userid=".$pfs['pfs_userid']."\">".$out['img_edit']."</a>";
  $pfs['admin'] .= " &nbsp; <a href=\"plug.php?e=gallery&amp;m=edit&amp;a=potw&amp;id=".$pfs['pfs_id']."\">".$L['gal_setaspotw']."</a>";
  }

$item_code = 'g'.$pfs['pfs_id'];

list($comments_link, $comments_display, $comments_count) = sed_build_comments($item_code, "gallery.php?id=".$pfs['pfs_id'], $comments);
$sql2 = sed_sql_query("UPDATE $db_pfs SET pfs_count=pfs_count+1 WHERE pfs_id='".$id."' LIMIT 1");

$title = "<a href=\"gallery.php\">".$L['gallery_home_title']."</a> ".$cfg['separator']." <a href=\"gallery.php?f=".$pff['pff_id']."\">".$pff['pff_title']."</a> ".$cfg['separator']." <a href=\"gallery.php?id=".$id."\">".$L['gallery_details_title']." #".$id."</a>";
$subtitle = '';
$out['subtitle'] = '';


/* === Hook === */
$extp = sed_getextplugins('gallery.details.main');
if (is_array($extp))
	{ foreach($extp as $k => $pl) { include('plugins/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php'); } }
/* ===== */


require("system/header.php");
$t = new XTemplate("skins/".$skin."/gallery.details.tpl");

$t-> assign(array(
	"GALLERY_DETAILS_TITLE" => $title,
	"GALLERY_DETAILS_SUBTITLE" => $subtitle
		));


	$t-> assign(array(
		"GALLERY_DETAILS_ID" => $pfs['pfs_id'],
		"GALLERY_DETAILS_VIEW_URL" => "gallery.php?id=".$pfs['pfs_id'],
		"GALLERY_DETAILS_VIEW_POPUP" => $pfs['popup'],
		"GALLERY_DETAILS_FILE" => $pfs['pfs_file'],
		"GALLERY_DETAILS_FULLFILE" => $pfs['pfs_fullfile'],
		"GALLERY_DETAILS_THUMB" => "<img src=\"".$cfg['th_dir'].$pfs['pfs_file']."\" alt=\"\" />",
		"GALLERY_DETAILS_IMG" => $pfs['pfs_img'],
		"GALLERY_DETAILS_ICON" => $icon[$pfs['pfs_extension']],
		"GALLERY_DETAILS_DESC" => sed_parse($pfs['pfs_desc'],1,1,1),
		"GALLERY_DETAILS_SHORTDESC" => sed_cutstring(sed_cc($pfs['pfs_desc']), 48),
		"GALLERY_DETAILS_DATE" => date($cfg['dateformat'], $pfs['pfs_date'] + $usr['timezone'] * 3600),
		"GALLERY_DETAILS_SIZE" => $pfs['pfs_filesize'].$L['kb'],
		"GALLERY_DETAILS_ROW_DIMX" => $pfs['pfs_imgsize'][0],
		"GALLERY_DETAILS_ROW_DIMY" => $pfs['pfs_imgsize'][1],
		"GALLERY_DETAILS_ROW_DIMXY" => $pfs['pfs_imgsize_xy'],
    	"GALLERY_DETAILS_COUNT" => $pfs['pfs_count'],
		"GALLERY_DETAILS_BROWSER" => $browse_list,
		"GALLERY_DETAILS_PREV" => $browse_prev,
		"GALLERY_DETAILS_NEXT" => $browse_next,
		"GALLERY_DETAILS_BACK" => $browse_back,
		"GALLERY_DETAILS_ZOOM" => $browse_zoom,
		"GALLERY_DETAILS_ADMIN" => $pfs['admin'],
   	 	"GALLERY_DETAILS_COMMENTS" => $comments_link,
   	 	"GALLERY_DETAILS_COMMENTS_DISPLAY" => $comments_display,
    	"GALLERY_DETAILS_COMMENTS_COUNT" => $comments_count,
		"GALLERY_DETAILS_COND1" => $pfs['cond1'],
		"GALLERY_DETAILS_COND2" => $pfs['cond2'],
				));


/* === Hook === */
$extp = sed_getextplugins('gallery.details.tags');
if (is_array($extp))
	{ foreach($extp as $k => $pl) { include('plugins/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php'); } }
/* ===== */

$t->parse("MAIN");
$t->out("MAIN");

require("system/footer.php");


?>