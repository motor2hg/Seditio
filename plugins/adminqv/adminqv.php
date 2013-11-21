<?PHP

/* ====================
Seditio - Website engine
Copyright Neocrome & Seditio Team
http://www.neocrome.net
http://www.seditio.org

[BEGIN_SED]
File=plugins/adminqv/adminqv.php
Version=173
Updated=2012-sep-23
Type=Plugin
Author=Neocrome
Description=
[END_SED]

[BEGIN_SED_EXTPLUGIN]
Code=adminqv
Part=main
File=adminqv
Hooks=admin.home
Tags=
Order=10
[END_SED_EXTPLUGIN]
==================== */

if (!defined('SED_CODE')) { die('Wrong URL.'); }

require ('plugins/adminqv/lang/adminqv.'.$usr['lang'].'.lang.php');

$timeback = $sys['now_offset'] - (7 * 86400); // 7 days
$timeback_stats = 15; // 15 days

$sql = sed_sql_query("SELECT COUNT(*) FROM $db_users WHERE user_regdate>'$timeback'");
$newusers = sed_sql_result($sql, 0, "COUNT(*)");

$sql = sed_sql_query("SELECT COUNT(*) FROM $db_pages WHERE page_date >'$timeback'");
$newpages = sed_sql_result($sql, 0, "COUNT(*)");

$sql = sed_sql_query("SELECT COUNT(*) FROM $db_forum_topics WHERE ft_creationdate>'$timeback'");
$newtopics = sed_sql_result($sql, 0, "COUNT(*)");

$sql = sed_sql_query("SELECT COUNT(*) FROM $db_forum_posts WHERE fp_updated>'$timeback'");
$newposts = sed_sql_result($sql, 0, "COUNT(*)");

$sql = sed_sql_query("SELECT COUNT(*) FROM $db_com WHERE com_date>'$timeback'");
$newcomments = sed_sql_result($sql, 0, "COUNT(*)");

$sql = sed_sql_query("SELECT COUNT(*) FROM $db_pm WHERE pm_date>'$timeback'");
$newpms = sed_sql_result($sql, 0, "COUNT(*)");

$sql = sed_sql_query("SELECT * FROM $db_stats WHERE stat_name LIKE '20%' ORDER BY stat_name DESC LIMIT ".$timeback_stats);
while ($row = sed_sql_fetchassoc($sql))
	{
	$y = mb_substr($row['stat_name'], 0, 4);
	$m = mb_substr($row['stat_name'], 5, 2);
	$d = mb_substr($row['stat_name'], 8, 2);
	$dat = @date('d D', mktime(0,0,0,$m,$d,$y));
	$hits_d[$dat] = $row['stat_value'];
	}

$hits_d_max = max($hits_d);

$sql = sed_sql_query("SHOW TABLES");

while ($row = sed_sql_fetchrow($sql))
	{
	$table_name = $row[0];
	$status = sed_sql_query("SHOW TABLE STATUS LIKE '$table_name'");
	$status1 = sed_sql_fetcharray($status);
	$tables[] = $status1;
    }

while (list($i,$dat) = each($tables))
	{
	$table_length = $dat['Index_length']+$dat['Data_length'];
	$total_length += $table_length;
	$total_rows += $dat['Rows'];
	$total_index_length += $dat['Index_length'];
	$total_data_length += $dat['Data_length'];
	}

$adminmain .= "<h4>".$L['plu_title']." :</h4>";

$adminmain .= "<table style=\"width:100%;\">";
$adminmain .= "<tr><td style=\"width:50%; vertical-align:top; padding:8px;\">";

$adminmain .= "<table class=\"cells\">";
$adminmain .= "<tr><td colspan=\"2\" class=\"coltop\">".$L['plu_pastdays']."</td></tr>";
$adminmain .= "<tr><td><a href=\"users.php?f=all&amp;s=regdate&amp;w=desc\">".$L['plu_newusers']."</a></td>";
$adminmain .= "<td style=\"text-align:center;\">".$newusers ."</td></tr>";
$adminmain .= "<tr><td><a href=\"admin.php?m=page\">".$L['plu_newpages']."</a></td>";
$adminmain .= "<td style=\"text-align:center;\">".$newpages ."</td></tr>";
$adminmain .= "<tr><td><a href=\"forums.php\">".$L['plu_newtopics']."</a></td>";
$adminmain .= "<td style=\"text-align:center;\">".$newtopics ."</td></tr>";
$adminmain .= "<tr><td><a href=\"forums.php\">".$L['plu_newposts']."</a></td>";
$adminmain .= "<td style=\"text-align:center;\">".$newposts ."</td></tr>";
$adminmain .= "<tr><td><a href=\"admin.php?m=comments\">".$L['plu_newcomments']."</a></td>";
$adminmain .= "<td style=\"text-align:center;\">".$newcomments ."</td></tr>";
$adminmain .= "<tr><td>".$L['plu_newpms']."</td>";
$adminmain .= "<td style=\"text-align:center;\">".$newpms ."</td></tr>";
$adminmain .= "</table>";

$adminmain .= "<h4>".$L['Statistics']." :</h4>";

$adminmain .= "<table class=\"cells\">";
$adminmain .= "<tr><td>".$L['plu_db_rows']."</td>";
$adminmain .= "<td style=\"text-align:right;\">".$total_rows."</td></tr>";
$adminmain .= "<tr><td>".$L['plu_db_indexsize']."</td>";
$adminmain .= "<td style=\"text-align:right;\">".number_format(($total_index_length/1024),1,'.',' ')."</td></tr>";
$adminmain .= "<tr><td>".$L['plu_db_datassize']."</td>";
$adminmain .= "<td style=\"text-align:right;\">".number_format(($total_data_length/1024),1,'.',' ')."</td></tr>";
$adminmain .= "<tr><td>".$L['plu_db_totalsize']."</td>";
$adminmain .= "<td style=\"text-align:right;\">".number_format(($total_length/1024),1,'.',' ')."</td></tr>";
$adminmain .= "</table>";

$adminmain .= "</td><td style=\"width:50%; vertical-align:top; padding:8px;\">";

$adminmain .= "<table class=\"cells\">";
$adminmain .= "<tr><td colspan=\"4\" class=\"coltop\">".$L['plu_hitsmonth']."</td></tr>";

foreach ($hits_d as $day => $hits)
	{
	$percentbar = floor(($hits / $hits_d_max) * 100);
	$adminmain .= "<tr><td style=\"width:128px;\">".$day."</td>";
	$adminmain .= "<td style=\"text-align:right; width:96px;\">".$hits." ".$L['Hits']."</td>";
	$adminmain .= "<td style=\"text-align:right; width:40px;\">$percentbar%</td><td>";
	$adminmain .= "<div style=\"width:128px;\"><div class=\"bar_back\">";
	$adminmain .= "<div class=\"bar_front\" style=\"width:".$percentbar."%;\"></div></div></div></td></tr>";
	}

$adminmain .= "<tr><td colspan=\"4\"><a href=\"admin.php?m=hits\">".$L['More']."</a></td></tr>";
$adminmain .= "</table>";

$adminmain .= "</td></tr></table>";

?>