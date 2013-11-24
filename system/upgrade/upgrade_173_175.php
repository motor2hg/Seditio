<?PHP

/* ====================
Seditio - Website engine
Copyright Neocrome & Seditio Team
http://www.neocrome.net
http://www.seditio.org
[BEGIN_SED]
File=upgrade_173_175.php
Version=175
Updated=2013-jun-25
Type=Core.upgrade
Author=Neocrome & Seditio Team
Description=Database upgrade
[END_SED]
==================== */

if ( !defined('SED_CODE') || !defined('SED_ADMIN') ) { die('Wrong URL.'); }


// ========================================

$adminmain .= "Clearing the internal SQL cache...<br />";
$sql = sed_sql_query("TRUNCATE TABLE ".$cfg['sqldbprefix']."cache");

//Reinstall plugin CKeditor
if ($cfg['textmode'] == "html")
    {      
      $adminmain .= "Rinstall the plugin Ckeditor<br />";
      $adminmain .= sed_plugin_uninstall('ckeditor');          
      $adminmain .= sed_plugin_install('ckeditor');
    }

$adminmain .= "Adding the 'grp_color' column to table users groups...<br />";
$sqlqr = "ALTER TABLE ".$cfg['sqldbprefix']."groups ADD grp_color varchar(24) NOT NULL DEFAULT 'inherit' AFTER grp_icon";
$adminmain .= sed_cc($sqlqr)."<br />";
$sql = sed_sql_query($sqlqr);

$adminmain .= "Adding the 'color_group' new config into the core<br />";
$sqlqr = "INSERT INTO ".$cfg['sqldbprefix']."config (config_owner, config_cat, config_order, config_name, config_type, config_value, config_default)
VALUES ('core', 'users', '10', 'color_group', 3, '0', '')";
$adminmain .= sed_cc($sqlqr)."<br />";
$sql = sed_sql_query($sqlqr);

$adminmain .= "Adding the 'maintenance' new config into the core<br />";
$sqlqr = "INSERT INTO ".$cfg['sqldbprefix']."config (config_owner, config_cat, config_order, config_name, config_type, config_value, config_default)
VALUES ('core', 'main', '21', 'maintenance', 3, '0', '')";
$adminmain .= sed_cc($sqlqr)."<br />";
$sql = sed_sql_query($sqlqr);

$adminmain .= "Adding the 'maintenancelevel' new config into the core<br />";
$sqlqr = "INSERT INTO ".$cfg['sqldbprefix']."config (config_owner, config_cat, config_order, config_name, config_type, config_value, config_default)
VALUES ('core', 'main', '22', 'maintenancelevel', 2, '95', '')";
$adminmain .= sed_cc($sqlqr)."<br />";
$sql = sed_sql_query($sqlqr);    

$adminmain .= "Reinstall table ".$cfg['sqldbprefix']."parser<br />";
$sqlqr = "TRUNCATE TABLE ".$cfg['sqldbprefix']."parser";
$adminmain .= sed_cc($sqlqr)."<br />";
$sql = sed_sql_query($sqlqr);

$lines = file("system/install/install.parser.sql");
foreach($lines as $line)
	{
	$line = str_replace('sed_', $cfg['sqldbprefix'], $line);      //???
	sed_sql_query($line);
	}  

// SEF URL's

$adminmain .= "Adding the 'absurls' new config into the core<br />";
$sqlqr = "INSERT INTO ".$cfg['sqldbprefix']."config (config_owner, config_cat, config_order, config_name, config_type, config_value, config_default)
VALUES ('core', 'main', '04', 'absurls', 3, '0', '')";
$adminmain .= sed_cc($sqlqr)."<br />";
$sql = sed_sql_query($sqlqr);

$adminmain .= "Adding the 'multihost' new config into the core<br />";
$sqlqr = "INSERT INTO ".$cfg['sqldbprefix']."config (config_owner, config_cat, config_order, config_name, config_type, config_value, config_default)
VALUES ('core', 'main', '03', 'multihost', 3, '1', '')";
$adminmain .= sed_cc($sqlqr)."<br />";
$sql = sed_sql_query($sqlqr);	
	
$adminmain .= "Adding the 'sefurls' new config into the core<br />";
$sqlqr = "INSERT INTO ".$cfg['sqldbprefix']."config (config_owner, config_cat, config_order, config_name, config_type, config_value, config_default)
VALUES ('core', 'main', '04', 'sefurls', 3, '0', '')";
$adminmain .= sed_cc($sqlqr)."<br />";
$sql = sed_sql_query($sqlqr);

$adminmain .= "Adding the 'sefurls301' new config into the core<br />";
$sqlqr = "INSERT INTO ".$cfg['sqldbprefix']."config (config_owner, config_cat, config_order, config_name, config_type, config_value, config_default)
VALUES ('core', 'main', '04', 'sefurls301', 3, '0', '')";
$adminmain .= sed_cc($sqlqr)."<br />";
$sql = sed_sql_query($sqlqr);

// Changing the length of columns in tables

$adminmain .= "Changing the length of columns in tables<br />";
$sqlqr = "ALTER TABLE ".$cfg['sqldbprefix']."structure MODIFY structure_title VARCHAR(100)";
$adminmain .= sed_cc($sqlqr)."<br />";
$sql = sed_sql_query($sqlqr);

$sqlqr = "ALTER TABLE ".$cfg['sqldbprefix']."structure MODIFY structure_code VARCHAR(255)";
$adminmain .= sed_cc($sqlqr)."<br />";
$sql = sed_sql_query($sqlqr);

$sqlqr = "ALTER TABLE ".$cfg['sqldbprefix']."structure MODIFY structure_path VARCHAR(255)";
$adminmain .= sed_cc($sqlqr)."<br />";
$sql = sed_sql_query($sqlqr);

$sqlqr = "ALTER TABLE ".$cfg['sqldbprefix']."pages MODIFY page_alias VARCHAR(255)";
$adminmain .= sed_cc($sqlqr)."<br />";
$sql = sed_sql_query($sqlqr);

$sqlqr = "ALTER TABLE ".$cfg['sqldbprefix']."pages MODIFY page_cat VARCHAR(255)";
$adminmain .= sed_cc($sqlqr)."<br />";
$sql = sed_sql_query($sqlqr);

$sqlqr = "ALTER TABLE ".$cfg['sqldbprefix']."auth MODIFY auth_code VARCHAR(255)";
$adminmain .= sed_cc($sqlqr)."<br />";
$sql = sed_sql_query($sqlqr);

$sqlqr = "ALTER TABLE ".$cfg['sqldbprefix']."auth MODIFY auth_option VARCHAR(255)";
$adminmain .= sed_cc($sqlqr)."<br />";
$sql = sed_sql_query($sqlqr);    

// PFS Upgrade

$adminmain .= "Adding the 'pfs_title' column to table users groups...<br />";
$sqlqr = "ALTER TABLE ".$cfg['sqldbprefix']."pfs ADD pfs_title varchar(255) NOT NULL DEFAULT '' AFTER pfs_folderid";
$adminmain .= sed_cc($sqlqr)."<br />";
$sql = sed_sql_query($sqlqr);

$adminmain .= "Adding the 'pfs_desc_ishtml' column to table users groups...<br />";
$sqlqr = "ALTER TABLE ".$cfg['sqldbprefix']."pfs ADD pfs_desc_ishtml tinyint(1) DEFAULT '1' AFTER pfs_desc";
$adminmain .= sed_cc($sqlqr)."<br />";
$sql = sed_sql_query($sqlqr);

$adminmain .= "Adding the 'pff_desc_ishtml' column to table users groups...<br />";
$sqlqr = "ALTER TABLE ".$cfg['sqldbprefix']."pfs_folders ADD pff_desc_ishtml tinyint(1) DEFAULT '1' AFTER pff_desc";
$adminmain .= sed_cc($sqlqr)."<br />";
$sql = sed_sql_query($sqlqr);

$sqlqr = "ALTER TABLE ".$cfg['sqldbprefix']."pfs_folders MODIFY pff_desc TEXT";
$adminmain .= sed_cc($sqlqr)."<br />";
$sql = sed_sql_query($sqlqr); 

$sqlqr = "SELECT pfs_id, pfs_desc FROM ".$cfg['sqldbprefix']."pfs";
$adminmain .= sed_cc($sqlqr)."<br />";
$sql = sed_sql_query($sqlqr);

while ($pfs = sed_sql_fetchassoc($sql)) 
{
  $pfs_title = strip_tags(mb_substr($pfs['pfs_desc'], 0, 255));
  $sql_update = sed_sql_query("UPDATE ".$cfg['sqldbprefix']."pfs SET pfs_title = '".sed_sql_prep($pfs_title)."' WHERE pfs_id =".$pfs['pfs_id']); 
}

// Structure Upgrade

$adminmain .= "Adding the 'structure_text' column to table structure...<br />";
$sqlqr = "ALTER TABLE ".$cfg['sqldbprefix']."structure ADD structure_text TEXT AFTER structure_desc";
$adminmain .= sed_cc($sqlqr)."<br />";
$sql = sed_sql_query($sqlqr);

$adminmain .= "Adding the 'structure_text_ishtml' column to table structure...<br />";
$sqlqr = "ALTER TABLE ".$cfg['sqldbprefix']."structure ADD structure_ishtml tinyint(1) DEFAULT '1' AFTER structure_text";
$adminmain .= sed_cc($sqlqr)."<br />";
$sql = sed_sql_query($sqlqr);

$adminmain .= "Changing the SQL version number to 175...<br />";
$sql = sed_sql_query("UPDATE ".$cfg['sqldbprefix']."stats SET stat_value=175 WHERE stat_name='version'"); 

$upg_status = TRUE;

?>