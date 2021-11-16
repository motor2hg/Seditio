<?PHP

/* ====================
Seditio - Website engine
Copyright Neocrome
http://www.neocrome.net
[BEGIN_SED]
File=datas/config.php
Version=178
Updated=2021-jun-12
Type=Config
Author=Neocrome
Description=Configuration file (Gen.:2021-Jun-12 10:02:13)
[END_SED]
==================== */

// ========================
// MySQL database parameters. Change to fit your host.
// ========================

$cfg['mysqlhost'] = 'localhost';		// Database host URL
$cfg['mysqluser'] = 'root';			// Database user
$cfg['mysqlpassword'] = '';			// Database password
$cfg['mysqldb'] = 'newsedorg';		// Database name

// ========================
// Default skin and default language
// ========================

$cfg['defaultskin'] = 'sympfy';	// Default skin code. Be SURE it's pointing to a valid folder in /skins/...
$cfg['defaultlang'] = 'en';			// Default language code

// ========================
// More settings
// Should work fine in most of cases.
// If you don't know, don't change.
// TRUE = enabled / FALSE = disabled
// ========================

$cfg['sqldbprefix'] = 'sed_';			// Database tables prefix
$cfg['sqldb'] = 'mysqli';  				// Type of the database connector driver, set 'mysql' or 'mysqli'.
$cfg['site_secret'] = 'd450832e311e1f55a3ce62f5e5e25026'; 					// Site secret key
$cfg['authmode'] = 3; 					// (1:cookies, 2:sessions, 3:cookies+sessions) default=3
$cfg['redirmode'] = FALSE;				// 0 or 1, Set to '1' if you cannot sucessfully log in on your server)
$cfg['ipcheck'] = TRUE;  				// Will kill the logged-in session if the IP has changed
$cfg['multihost'] = TRUE;            // Allow multiple host names for this site

// ========================
// Name of MySQL tables
// (OPTIONAL, if missing, Seditio will set default values)
// Change the $cfg['sqldbprefix'] above if you'd like to
// make 2 separated install in the same database.
// or you'd like to share some tables between 2 sites.
// Else do not change.
// ========================

$db_auth				= $cfg['sqldbprefix'].'auth';
$db_banlist 			= $cfg['sqldbprefix'].'banlist';
$db_cache 			= $cfg['sqldbprefix'].'cache';
$db_com 				= $cfg['sqldbprefix'].'com';
$db_core				= $cfg['sqldbprefix'].'core';
$db_config 			= $cfg['sqldbprefix'].'config';
$db_forum_posts 		= $cfg['sqldbprefix'].'forum_posts';
$db_forum_sections 	= $cfg['sqldbprefix'].'forum_sections';
$db_forum_structure 	= $cfg['sqldbprefix'].'forum_structure';
$db_forum_topics 	= $cfg['sqldbprefix'].'forum_topics';
$db_groups 			= $cfg['sqldbprefix'].'groups';
$db_groups_users 	= $cfg['sqldbprefix'].'groups_users';
$db_logger 			= $cfg['sqldbprefix'].'logger';
$db_online 			= $cfg['sqldbprefix'].'online';
$db_pages 			= $cfg['sqldbprefix'].'pages';
$db_pfs 				= $cfg['sqldbprefix'].'pfs';
$db_pfs_folders 		= $cfg['sqldbprefix'].'pfs_folders';
$db_plugins 			= $cfg['sqldbprefix'].'plugins';
$db_pm 				= $cfg['sqldbprefix'].'pm';
$db_polls 			= $cfg['sqldbprefix'].'polls';
$db_polls_options 	= $cfg['sqldbprefix'].'polls_options';
$db_polls_voters 	= $cfg['sqldbprefix'].'polls_voters';
$db_rated 			= $cfg['sqldbprefix'].'rated';
$db_ratings 			= $cfg['sqldbprefix'].'ratings';
$db_referers 		= $cfg['sqldbprefix'].'referers';
$db_smilies 			= $cfg['sqldbprefix'].'smilies';
$db_stats 			= $cfg['sqldbprefix'].'stats';
$db_structure 		= $cfg['sqldbprefix'].'structure';
$db_trash	 		= $cfg['sqldbprefix'].'trash';
$db_users 			= $cfg['sqldbprefix'].'users';

?>