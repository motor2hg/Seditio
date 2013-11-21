INSERT INTO sed_parser VALUES (1, 'Bold', 0, 0, 1, '[b]', '[/b]', '<strong>', '</strong>', 1);
INSERT INTO sed_parser VALUES (2, 'Underline', 0, 0, 2, '[u]', '[/u]', '<u>', '</u>', 1);
INSERT INTO sed_parser VALUES (3, 'Italic', 0, 0, 3, '[i]', '[/i]', '<em>', '</em>', 1);
INSERT INTO sed_parser VALUES (4, 'Horizontal ruler', 0, 0, 4, '[hr]', '', '<hr />', '', 1);
INSERT INTO sed_parser VALUES (5, 'Spacers', 0, 0, 5, '[_]', '[__]', '&nbsp;', '&nbsp; &nbsp;', 1);
INSERT INTO sed_parser VALUES (6, 'Lists 1', 0, 0, 6, '[list]', '[/list]', '<ul type="square">', '</ul>', 1);
INSERT INTO sed_parser VALUES (7, 'Lists 2', 0, 0, 7, '[li]', '[/li]', '<li>', '</li>', 1);
INSERT INTO sed_parser VALUES (8, 'Color red', 0, 0, 8, '[red]', '[/red]', '<span style="color:#F93737">', '</span>', 1);
INSERT INTO sed_parser VALUES (9, 'Color white', 0, 0, 9, '[white]', '[/white]', '<span style="color:#FFFFFF">', '</span>', 1);
INSERT INTO sed_parser VALUES (10, 'Color green', 0, 0, 10, '[green]', '[/green]', '<span style="color:#09DD09">', '</span>', 1);
INSERT INTO sed_parser VALUES (11, 'Color blue', 0, 0, 11, '[blue]', '[/blue]', '<span style="color:#018BFF">', '</span>', 1);
INSERT INTO sed_parser VALUES (12, 'Color orange', 0, 0, 12, '[orange]', '[/orange]', '<span style="color:#FF9900">', '</span>', 1);
INSERT INTO sed_parser VALUES (13, 'Color yellow', 0, 0, 13, '[yellow]', '[/yellow]', '<span style="color:#FFFF00">', '</span>', 1);
INSERT INTO sed_parser VALUES (14, 'Color purple', 0, 0, 14, '[purple]', '[/purple]', '<span style="color:#A22ADA">', '</span>', 1);
INSERT INTO sed_parser VALUES (15, 'Color black', 0, 0, 15, '[black]', '[/black]', '<span style="color:#000000">', '</span>', 1);
INSERT INTO sed_parser VALUES (16, 'Color grey', 0, 0, 16, '[grey]', '[/grey]', '<span style="color:#B9B9B9">', '</span>', 1);
INSERT INTO sed_parser VALUES (17, 'Color pink', 0, 0, 17, '[pink]', '[/pink]', '<span style="color:#FFC0FF">', '</span>', 1);
INSERT INTO sed_parser VALUES (18, 'Color sky', 0, 0, 18, '[sky]', '[/sky]', '<span style="color:#D1F4F9">', '</span>', 1);
INSERT INTO sed_parser VALUES (19, 'Color sea', 0, 0, 19, '[sea]', '[/sea]', '<span style="color:#171A97">', '</span>', 1);
INSERT INTO sed_parser VALUES (20, 'Quote', 0, 0, 20, '[quote]', '[/quote]', '<blockquote>Quote<p>', '</p></blockquote>', 1);
INSERT INTO sed_parser VALUES (21, 'BR', 0, 0, 21, '[br]', '', '<br />', '', 1);
INSERT INTO sed_parser VALUES (22, 'More', 0, 0, 22, '[more]', '', '<!--readmore-->', '', 1);
INSERT INTO sed_parser VALUES (23, 'Image 1', 0, 1, 10, '/\\[img\\]([^\\\\\\''\\;\\?[]*)\\.(jpg|jpeg|gif|png)\\[\\/img\\]/i', '', '<img src="$1.$2" alt="" />', '', 1);
INSERT INTO sed_parser VALUES (24, 'Image 2', 0, 1, 20, '/\\[img=([^\\\\\\''\\;\\?[]*)\\.(jpg|jpeg|gif|png)\\]([^\\\\[]*)\\.(jpg|jpeg|gif|png)\\[\\/img\\]/i', '', '<a href="$1.$2"><img src="$3.$4" alt="" /></a>', '', 1);
INSERT INTO sed_parser VALUES (25, 'Thumbnail PFS', 0, 1, 30, '/\\[thumb=([^\\\\\\''\\;\\?([]*)\\.(jpg|jpeg|gif|png)\\]([^\\\\[]*)\\.(jpg|jpeg|gif|png)\\[\\/thumb\\]/i', NULL, '<a href="javascript:picture(\'pfs.php?m=view&amp;v=$3.$4\', 200,200)"><img src="$1.$2" alt="" /></a>', NULL, 1);
INSERT INTO sed_parser VALUES (26, 'Thumbnails', 0, 1, 40, '/\\[t=([^\\\\\\''\\;\\?([]*)\\.(jpg|jpeg|gif|png)\\]([^\\\\[]*)\\.(jpg|jpeg|gif|png)\\[\\/t\\]/i', NULL, '<a href="$3.$4"><img src="$1.$2" alt="" /></a>', NULL, 1);
INSERT INTO sed_parser VALUES (27, 'Url 1', 0, 1, 50, '/\\[url\\]([^\\\\([]*)\\[\\/url\\]/i', NULL, '<a href="$1">$1</a>', NULL, 1);
INSERT INTO sed_parser VALUES (28, 'Url 2', 0, 1, 60, '/\\[url=([^\\\\\\''\\;([]*)\\]([^\\\\[]*)\\[\\/url\\]/i', NULL, '<a href="$1">$2</a>', NULL, 1);
INSERT INTO sed_parser VALUES (29, 'Colors', 0, 1, 70, '/\\[color=([0-9A-F]{6})\\]([^\\\\[]*)\\[\\/color\\]/i', '', '<span style="color:#$1">$2</span>', NULL, 1);
INSERT INTO sed_parser VALUES (30, 'Styles', 0, 1, 80, '/\\[style=([1-9]{1})\\]([^\\\\[]*)\\[\\/style\\]/i', NULL, '<span class="bbstyle$1">$2</span>', NULL, 1);
INSERT INTO sed_parser VALUES (31, 'Divs', 0, 1, 90, '/\\[div=([1-9]{1})\\]([^\\\\[]*)\\[\\/div\\]/i', NULL, '<div class="divstyle$1">$2</div>', NULL, 1);
INSERT INTO sed_parser VALUES (32, 'Email 2', 0, 1, 100, '/\\[email=([._A-z0-9-]+@[A-z0-9-]+\\.[.a-z]+)\\]([^\\\\[]*)\\[\\/email\\]/i', NULL, '<a href="mailto:$1">$2</a>', NULL, 1);
INSERT INTO sed_parser VALUES (33, 'Email 1', 0, 1, 110, '/\\[email\\]([._A-z0-9-]+@[A-z0-9-]+\\.[.a-z]+)\\[\\/email\\]/i', NULL, '<a href="mailto:$1">$1</a>', NULL, 1);
INSERT INTO sed_parser VALUES (34, 'user', 0, 1, 120, '/\\[user=([0-9]+)\\]([A-z0-9_\\. -]+)\\[\\/user\\]/i', NULL, '<a href="users.php?m=details&amp;id=$1">$2</a>', NULL, 1);
INSERT INTO sed_parser VALUES (35, 'Page 2', 0, 1, 130, '/\\[page=([0-9]+)\\]([^\\\\[]*)\\[\\/page\\]/i', NULL, '<a href="page.php?id=$1">$2</a>', NULL, 1);
INSERT INTO sed_parser VALUES (36, 'Page 1', 0, 1, 140, '/\\[page\\]([0-9]+)\\[\\/page\\]/i', NULL, '<a href="page.php?id=$1">Page #$1</a>', NULL, 1);
INSERT INTO sed_parser VALUES (37, 'Group', 0, 0, 150, '/\\[group=([0-9]+)\\]([^\\\\([]*)\\[\\/group\\]/i', NULL, '<a href="users.php?g=$1">$2</a>', NULL, 1);
INSERT INTO sed_parser VALUES (38, 'Forum topic', 0, 1, 160, '/\\[topic\\]([0-9]+)\\[\\/topic\\]/i', NULL, '<a href="forums.php?m=posts&amp;q=$1">Topic #$1</a>', NULL, 1);
INSERT INTO sed_parser VALUES (39, 'Forum post', 0, 1, 170, '/\\[post\\]([0-9]+)\\[\\/post\\]/i', NULL, '<a href="forums.php?m=posts&amp;p=$1#$1">Post #$1</a>', NULL, 1);
INSERT INTO sed_parser VALUES (40, 'Private messages', 0, 1, 180, '/\\[pm\\]([0-9]+)\\[\\/pm\\]/i', NULL, '<a href="pm.php?m=send&amp;to=$1">PM</a>', NULL, 1);
INSERT INTO sed_parser VALUES (41, 'Flag', 0, 1, 190, '/\\[f\\]([a-z][a-z])\\[\\/f\\]/i', NULL, '<a href="users.php?f=country_$1"><img src="system/img/flags/f-$1.gif" alt="" /></a>', NULL, 1);
INSERT INTO sed_parser VALUES (42, 'Acronym', 0, 1, 200, '/\\[ac=([^\\\\[]*)\\]([^\\\\[]*)\\[\\/ac\\]/i', NULL, '<acronym title="$1">$2</acronym>', NULL, 1);
INSERT INTO sed_parser VALUES (43, 'Deleted', 0, 1, 210, '/\\[del\\]([^\\\\[]*)\\[\\/del\\]/i', NULL, '<del>$1</del>', NULL, 1);
INSERT INTO sed_parser VALUES (44, 'Quote 2', 0, 1, 220, '/\\[quote=([^\\\\[]*)\\]/i', NULL, '<blockquote>$1<p>', NULL, 1);
INSERT INTO sed_parser VALUES (45, 'Spoiler', 0, 1, 230, '/\\[spoiler=([^\\\\[]*)\\]/i', '/\\[\\/spoiler\\]/i', '<div style="margin:0; margin-top:8px"><div style="margin-bottom:4px"><input type="button" value="Show : $1" onClick="if (this.parentNode.parentNode.getElementsByTagName(''div'')[1].getElementsByTagName(''div'')[0].style.display != '''') { this.parentNode.parentNode.getElementsByTagName(''div'')[1].getElementsByTagName(''div'')[0].style.display = ''''; this.innerText = ''''; this.value = ''Hide : : $1''; } else { this.parentNode.parentNode.getElementsByTagName(''div'')[1].getElementsByTagName(''div'')[0].style.display = ''none''; this.innerText = ''''; this.value = ''Show : $1''; }"></div><div class="spoiler"><div style="display: none;">', '</div></div></div>', 1);
INSERT INTO sed_parser VALUES (46, 'Fold', 0, 1, 240, '/\\[fold=([^\\\\[]*)\\]/i', '/\\[\\/fold\\]/i', '<div style="margin:0;"><div class="fhead"><a href="#fold" onClick="if (this.parentNode.parentNode.getElementsByTagName(''div'')[1].getElementsByTagName(''div'')[0].style.display != '''') { this.parentNode.parentNode.getElementsByTagName(''div'')[1].getElementsByTagName(''div'')[0].style.display = ''''; this.value = ''$1''; } else { this.parentNode.parentNode.getElementsByTagName(''div'')[1].getElementsByTagName(''div'')[0].style.display = ''none''; this.value = ''$1''; }">$1</a></div><div><div style="display: none;" class="fblock">', '</div></div></div>', 1);
INSERT INTO sed_parser VALUES (47, 'Youtube', 0, 1, 250, '/\\[youtube=([^\\\\[]*)\\]/i', NULL, '<object width="425" height="350">\r\n<param name="movie" value="http://www.youtube.com/v/$1"></param>\r\n<embed src="http://www.youtube.com/v/$1" type="application/x-shockwave-flash" width="425" height="350"></embed>\r\n</object>', NULL, 1);
INSERT INTO sed_parser VALUES (48, 'Google Video', 0, 1, 260, '/\\[googlevideo=([^\\\\[]*)\\]/i', NULL, '<embed style="width:425px; height:326px;" type="application/x-shockwave-flash" src="http://video.google.com/googleplayer.swf?docId=$1&hl=en-GB"> </embed>', NULL, 1);
INSERT INTO sed_parser VALUES (49, 'MetaCafe video', 0, 1, 270, '/\\[metacafe=([^\\\\[]*)\\]/i', NULL, '<embed style="width:425px; height:345px;" src="http://www.metacafe.com/fplayer/$1" width="400" height="345" wmode="transparent" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer"></embed>', NULL, 1);
INSERT INTO sed_parser VALUES (50, 'Column left', 0, 1, 280, '/\\[colleft\\]([^\\\\[]*)\\[\\/colleft\\]/i', NULL, '<div class="colleft">$1</div>', NULL, 1);
INSERT INTO sed_parser VALUES (51, 'Column right', 0, 1, 290, '/\\[colright\\]([^\\\\[]*)\\[\\/colright\\]/i', NULL, '<div class="colright">$1</div>', NULL, 1);
INSERT INTO sed_parser VALUES (52, 'Center', 0, 1, 300, '/\\[center\\]([^\\\\[]*)\\[\\/center\\]/i', NULL, '<div style="text-align:center;">$1</div>', NULL, 1);
INSERT INTO sed_parser VALUES (53, 'Align left', 0, 1, 310, '/\\[left\\]([^\\\\[]*)\\[\\/left\\]/i', NULL, '<div style="text-align:left;">$1</div>', NULL, 1);
INSERT INTO sed_parser VALUES (54, 'Align right', 0, 1, 320, '/\\[right\\]([^\\\\[]*)\\[\\/right\\]/i', NULL, '<div style="text-align:right;">$1</div>', NULL, 1);
INSERT INTO sed_parser VALUES (55, 'Columns', 0, 1, 330, '/\\[c1\\:([^\\\\[]*)\\]([^\\\\[]*)\\[c2\\:([^\\\\[]*)\\]([^\\\\[]*)\\[c3\\]/i', NULL, '<table style="margin:0; vertical-align:top; width:100%;"><tr><td style="padding:0 16px 16px 0; vertical-align:top; width:$1%;">$2</td><td  style="padding:0 0 16px 16px; vertical-align:top; width:$3%;">$4</td></tr></table>', NULL, 1);