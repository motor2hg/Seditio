<?PHP
/* ====================
Seditio - Website engine
Copyright Seditio Team
https://seditio.org

[BEGIN_SED]
File=plugins/uploader/uploader.ajax.php
Version=178
Updated=2021-jun-23
Type=Plugin
Author=Amro
Description=
[END_SED]

[BEGIN_SED_EXTPLUGIN]
Code=uploader
Part=AjaxUp
File=uploader.ajax
Hooks=ajax
Tags=
Minlevel=0
Order=10
[END_SED_EXTPLUGIN]
==================== */

if (!defined('SED_CODE')) { die('Wrong URL.'); }

list($usr['auth_read'], $usr['auth_write'], $usr['isadmin']) = sed_auth('pfs', 'a');

//error_reporting(0);

$pfs_delete = $cfg['plugin']['uploader']['pfs_delete'];

$upl_delete = sed_import('upl_delete', 'G', 'TXT');
$upl_rotate = sed_import('upl_rotate', 'G', 'TXT');
$upl_degree_lvl = sed_import('upl_degree_lvl', 'G', 'INT');
$upl_pid = sed_import('upl_pid', 'G', 'INT');

$buildfilename = $cfg['plugin']['uploader']['buildfilename'];

$upl_filename = sed_import('upl_filename', 'G', 'TXT'); 

if ($upl_delete)
{
	if ($pfs_delete == "yes")
	{		
		sed_block($usr['auth_write']);
		//sed_check_xg();
		
		$sql = sed_sql_query("SELECT pfs_id, pfs_file, pfs_folderid FROM $db_pfs WHERE pfs_userid='".$usr['id']."' AND pfs_file='$upl_delete' LIMIT 1");
		
		if ($row = sed_sql_fetchassoc($sql))
			{
			$pfs_file = $row['pfs_file'];
			$f = $row['pfs_folderid'];
			$ff = $cfg['pfs_dir'].$pfs_file;
			if (file_exists($ff) && (mb_substr($pfs_file, 0, mb_strpos($pfs_file, "-")) == $usr['id'] || $usr['isadmin']))
				{
				@unlink($ff);
				if (file_exists($cfg['th_dir'].$pfs_file))
					{ @unlink($cfg['th_dir'].$pfs_file); }
				}
			$sql = sed_sql_query("DELETE FROM $db_pfs WHERE pfs_id='".$row['pfs_id']."'");
			exit;
			}				
	}
	exit;
}

elseif ($upl_rotate)
{
	sed_block($usr['auth_write']);
	//sed_check_xg();
	
	$sql = sed_sql_query("SELECT pfs_id, pfs_file, pfs_folderid FROM $db_pfs WHERE pfs_userid='".$usr['id']."' AND pfs_file='$upl_rotate' LIMIT 1");
	
	if ($row = sed_sql_fetchassoc($sql))
		{	
		$pfs_file = $row['pfs_file'];
		$f = $row['pfs_folderid'];
		$ff = $cfg['pfs_dir'].$pfs_file;
		if (file_exists($ff) && (mb_substr($pfs_file, 0, mb_strpos($pfs_file, "-")) == $usr['id'] || $usr['isadmin']))
			{		
			sed_rotateimage($cfg['pfs_dir'].$upl_rotate, $upl_degree_lvl);
			sed_rotateimage($cfg['th_dir'].$upl_rotate, $upl_degree_lvl);
			echo $upl_rotate;
			}
		}
	exit;
}

if ($buildfilename == 'timestamp')
  {
    $filename = time().'_'.strtolower($upl_filename);
    $filename = preg_replace("#\\s+#", "_", $filename);
    $filename = $usr['id']."-".sed_newname($filename);
  }
else
  {
    $filename = '_'.strtolower($upl_filename);
    $filename = preg_replace("#\\s+#", "_", $filename);
    $filename = sed_newname($filename);
    $filename= $usr['id']."-page_".$upl_pid.$filename;
    /* ------- */ 
  }  

$allow_extension = array('gif','png','jpg','jpeg','bmp');
$extension_arr = explode(".", $filename);
$f_extension = end($extension_arr); 

if (in_array($f_extension, $allow_extension) == FALSE)  { exit; }  
  
$bytes = file_put_contents($cfg['pfs_dir'].$filename, file_get_contents('php://input'));

$imgsize = @getimagesize($cfg['pfs_dir'].$filename);

if(!isset($imgsize) || !isset($imgsize['mime']) || !in_array($imgsize['mime'], array('image/jpeg', 'image/png', 'image/gif')))
{
	unlink($cfg['pfs_dir'].$filename);
	exit;
}
else {

	$u_size = filesize($cfg['pfs_dir'].$filename);
	
	$u_sqlname = $filename;
	$u_title = $filename;

	$folder_title = $L[date('F')]." ".date('Y'); 

	$sql = sed_sql_query("SELECT pff_id FROM $db_pfs_folders WHERE pff_userid = '".$usr['id']."' AND pff_title = '".$folder_title."' LIMIT 1");
	if (sed_sql_numrows($sql) > 0) 
		{ 
		$folderid = sed_sql_result($sql, 0, "pff_id"); 
		}
	else 
		{
		$sql = sed_sql_query("INSERT INTO $db_pfs_folders
			(pff_userid,
			pff_title,
			pff_date,
			pff_updated,
			pff_desc,
			pff_type,
			pff_count)
		VALUES
			(".(int)$usr['id'].",
			'".sed_sql_prep($folder_title)."',
			".(int)$sys['now'].",
			".(int)$sys['now'].",
			'',  
			0,
			0)");	
		$folderid = sed_sql_insertid();
		}

	$sql = sed_sql_query("INSERT INTO $db_pfs
		(pfs_userid,
		pfs_date,
		pfs_file,
		pfs_extension,
		pfs_folderid,
		pfs_title,
		pfs_desc,
		pfs_size,
		pfs_count)
	VALUES
		(".(int)$usr['id'].",
		".(int)$sys['now_offset'].",
		'".sed_sql_prep($u_sqlname)."',
		'".sed_sql_prep($f_extension)."',
		".(int)$folderid.",
		'".sed_sql_prep($u_title)."',
		'".sed_sql_prep($desc)."',
		".(int)$u_size.",
		0) ");

	$sql = sed_sql_query("UPDATE $db_pfs_folders SET pff_updated='".$sys['now']."' WHERE pff_id='$folderid'");

	sed_sm_createthumb($cfg['pfs_dir'].$filename, $cfg['th_dir'].$filename, $cfg['th_x'], $cfg['th_y'], $cfg['th_jpeg_quality'], "resize", TRUE);
}

echo $filename;

?>