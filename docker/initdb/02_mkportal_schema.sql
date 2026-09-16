CREATE TABLE IF NOT EXISTS `mkp_blocks` (
  `id` int(11) NOT NULL auto_increment,
  `file` varchar(255) NOT NULL default '',
  `title` varchar(255) NOT NULL default '',
  `position` varchar(20) NOT NULL default 'sinistra',
  `progressive` int(3) NOT NULL default '100',
  `active` varchar(10) default NULL,
  `personal` int(2) NOT NULL default '0',
  `content` text NOT NULL,
  PRIMARY KEY  (`id`)
);

INSERT IGNORE INTO `mkp_blocks` (`id`, `file`, `title`, `position`, `progressive`, `active`, `personal`, `content`) VALUES (4, 'login.php', 'Menu Personale', 'sinistra', 2, 'checked', 0, '');

INSERT IGNORE INTO `mkp_blocks` (`id`, `file`, `title`, `position`, `progressive`, `active`, `personal`, `content`) VALUES (5, 'online.php', 'Utenti online?', 'sinistra', 3, 'checked', 0, '');

INSERT IGNORE INTO `mkp_blocks` (`id`, `file`, `title`, `position`, `progressive`, `active`, `personal`, `content`) VALUES (6, 'sitenav.php', 'Menu Principale', 'sinistra', 1, 'checked', 0, '');

INSERT IGNORE INTO `mkp_blocks` (`id`, `file`, `title`, `position`, `progressive`, `active`, `personal`, `content`) VALUES (40, 'forumnav.php', 'Menu Forum', 'destra', 1, 'checked', 0, '');

INSERT IGNORE INTO `mkp_blocks` (`id`, `file`, `title`, `position`, `progressive`, `active`, `personal`, `content`) VALUES (44, 'site_stat.php', 'Statistiche Sito', 'destra', 5, 'checked', 0, '');

INSERT IGNORE INTO `mkp_blocks` (`id`, `file`, `title`, `position`, `progressive`, `active`, `personal`, `content`) VALUES (45, 'last_urlo.php', 'Ultimi Urli', 'destra', 3, 'checked', 0, '');

INSERT IGNORE INTO `mkp_blocks` (`id`, `file`, `title`, `position`, `progressive`, `active`, `personal`, `content`) VALUES (46, 'random_pic.php', 'Random Gallery', 'sinistra', 5, 'checked', 0, '');

INSERT IGNORE INTO `mkp_blocks` (`id`, `file`, `title`, `position`, `progressive`, `active`, `personal`, `content`) VALUES (47, 'chat.php', 'Chat', 'sinistra', 4, 'checked', 0, '');

INSERT IGNORE INTO `mkp_blocks` (`id`, `file`, `title`, `position`, `progressive`, `active`, `personal`, `content`) VALUES (48, 'calendar.php', 'Calendario', 'destra', 4, 'checked', 0, '');

INSERT IGNORE INTO `mkp_blocks` (`id`, `file`, `title`, `position`, `progressive`, `active`, `personal`, `content`) VALUES (49, 'news.php', 'Ultime News', 'centro', 1, 'checked', 0, '');

CREATE TABLE IF NOT EXISTS `mkp_chat` (
  `id` int(10) NOT NULL default '0',
  `nick` varchar(40) NOT NULL default '',
  `run_time` int(10) NOT NULL default '0',
  PRIMARY KEY  (`id`)
);

CREATE TABLE IF NOT EXISTS `mkp_config` (
  `id` int(11) NOT NULL auto_increment,
  `chiave` varchar(255) NOT NULL default '',
  `valore` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`)
);

INSERT IGNORE INTO `mkp_config` (`chiave`, `valore`) VALUES ('approval_quote', '0');

INSERT IGNORE INTO `mkp_config` (`chiave`, `valore`) VALUES ('approval_blog', '0');

INSERT IGNORE INTO `mkp_config` (`chiave`, `valore`) VALUES ('approval_gallery', '0');

INSERT IGNORE INTO `mkp_config` (`chiave`, `valore`) VALUES ('approval_download', '0');

INSERT IGNORE INTO `mkp_config` (`chiave`, `valore`) VALUES ('approval_news', '0');

INSERT IGNORE INTO `mkp_config` (`chiave`, `valore`) VALUES ('approval_topsite', '0');

INSERT IGNORE INTO `mkp_config` (`chiave`, `valore`) VALUES ('approval_review', '0');

INSERT IGNORE INTO `mkp_config` (`id`, `chiave`, `valore`) VALUES (8, 'chat_channel', '#MKPortal_Chat');

INSERT IGNORE INTO `mkp_config` (`id`, `chiave`, `valore`) VALUES (9, 'urlo_page', '20');

INSERT IGNORE INTO `mkp_config` (`id`, `chiave`, `valore`) VALUES (10, 'urlo_max', '300');

INSERT IGNORE INTO `mkp_config` (`id`, `chiave`, `valore`) VALUES (11, 'urlo_block', '10');

INSERT IGNORE INTO `mkp_config` (`id`, `chiave`, `valore`) VALUES (12, 'upload_file_max', '1000');

INSERT IGNORE INTO `mkp_config` (`id`, `chiave`, `valore`) VALUES (13, 'upload_image_max', '1000');

INSERT IGNORE INTO `mkp_config` (`id`, `chiave`, `valore`) VALUES (15, 'news_page', '10');

INSERT IGNORE INTO `mkp_config` (`id`, `chiave`, `valore`) VALUES (16, 'news_block', '10');

INSERT IGNORE INTO `mkp_config` (`id`, `chiave`, `valore`) VALUES (17, 'poll_active', '0');

INSERT IGNORE INTO `mkp_config` (`id`, `chiave`, `valore`) VALUES (18, 'news_words', '0');

INSERT IGNORE INTO `mkp_config` (`id`, `chiave`, `valore`) VALUES (19, 'news_html', '0');

INSERT IGNORE INTO `mkp_config` (`id`, `chiave`, `valore`) VALUES (20, 'mod_reviews', '0');

INSERT IGNORE INTO `mkp_config` (`id`, `chiave`, `valore`) VALUES (21, 'rev_sec_page', '10');

INSERT IGNORE INTO `mkp_config` (`id`, `chiave`, `valore`) VALUES (22, 'rev_file_page', '10');

INSERT IGNORE INTO `mkp_config` (`id`, `chiave`, `valore`) VALUES (23, 'quote_page', '50');

INSERT IGNORE INTO `mkp_config` (`id`, `chiave`, `valore`) VALUES (24, 'mod_quote', '0');

INSERT IGNORE INTO `mkp_config` (`chiave`, `valore`) VALUES ('approval_quote', '0');

INSERT IGNORE INTO `mkp_config` (`chiave`, `valore`) VALUES ('approval_blog', '0');

INSERT IGNORE INTO `mkp_config` (`chiave`, `valore`) VALUES ('approval_gallery', '0');

INSERT IGNORE INTO `mkp_config` (`chiave`, `valore`) VALUES ('approval_download', '0');

INSERT IGNORE INTO `mkp_config` (`chiave`, `valore`) VALUES ('approval_news', '0');

INSERT IGNORE INTO `mkp_config` (`chiave`, `valore`) VALUES ('approval_topsite', '0');

INSERT IGNORE INTO `mkp_config` (`chiave`, `valore`) VALUES ('approval_review', '0');

CREATE TABLE IF NOT EXISTS `mkp_download` (
  `id` int(10) NOT NULL auto_increment,
  `idcategoria` int(10) NOT NULL default '0',
  `name` varchar(255) NOT NULL default '',
  `description` text NOT NULL,
  `file` text NOT NULL,
  `downloads` int(10) NOT NULL default '0',
  `click` int(10) NOT NULL default '0',
  `data` int(10) NOT NULL default '0',
  `rate` varchar(10) NOT NULL default '',
  `trate` int(10) NOT NULL default '0',
  `screen1` varchar(255) NOT NULL default '',
  `screen2` varchar(255) NOT NULL default '',
  `demo` varchar(255) NOT NULL default '',
  `autore` varchar(40) NOT NULL default '',
  `peso` int(11) NOT NULL default '0',
  `validate` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`id`)
);

CREATE TABLE IF NOT EXISTS `mkp_download_comments` (
  `id` int(10) NOT NULL auto_increment,
  `identry` int(10) NOT NULL default '0',
  `autore` varchar(255) NOT NULL default '',
  `testo` text NOT NULL,
  `data` int(10) NOT NULL default '0',
  PRIMARY KEY  (`id`)
);

CREATE TABLE IF NOT EXISTS `mkp_download_sections` (
  `id` int(11) NOT NULL auto_increment,
  `evento` varchar(255) NOT NULL default '',
  `descrizione` text NOT NULL,
  `position` int(4) NOT NULL default '1',
  `father` int(10) NOT NULL default '0',
  PRIMARY KEY  (`id`)
);

CREATE TABLE IF NOT EXISTS `mkp_gallery` (
  `id` int(11) NOT NULL auto_increment,
  `evento` int(4) NOT NULL default '0',
  `titolo` varchar(255) NOT NULL default '',
  `descrizione` varchar(255) NOT NULL default '',
  `file` text NOT NULL,
  `click` int(10) NOT NULL default '0',
  `rate` varchar(10) NOT NULL default '',
  `trate` int(10) NOT NULL default '0',
  `autore` varchar(40) NOT NULL default '',
  `peso` int(11) NOT NULL default '0',
  `data` int(10) NOT NULL default '0',
  `validate` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`id`)
);

CREATE TABLE IF NOT EXISTS `mkp_gallery_comments` (
  `id` int(10) NOT NULL auto_increment,
  `identry` int(10) NOT NULL default '0',
  `autore` varchar(255) NOT NULL default '',
  `testo` text NOT NULL,
  `data` int(10) NOT NULL default '0',
  PRIMARY KEY  (`id`)
);

CREATE TABLE IF NOT EXISTS `mkp_gallery_events` (
  `id` int(11) NOT NULL auto_increment,
  `evento` varchar(255) NOT NULL default '',
  `position` int(4) NOT NULL default '1',
  `father` int(10) NOT NULL default '0',
  PRIMARY KEY  (`id`)
);

CREATE TABLE IF NOT EXISTS `mkp_news` (
  `id` int(11) NOT NULL auto_increment,
  `idcategoria` int(10) NOT NULL default '0',
  `idautore` int(10) NOT NULL default '0',
  `titolo` varchar(255) NOT NULL default '',
  `autore` varchar(34) NOT NULL default '',
  `testo` text NOT NULL,
  `data` int(10) NOT NULL default '0',
  `validate` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`id`)
);

INSERT IGNORE INTO `mkp_news` (`id`, `idcategoria`, `idautore`, `titolo`, `autore`, `testo`, `data`) VALUES (1, 1, 1, 'Benvenuti in MKPortal', 'meo', '\r\n        \r\n        \r\n        \r\n    	\r\n		<p style=\"margin-top: 0px; margin-bottom: 0px;\" align=\"center\"><b><u>\r\n<font color=\"#ff0000\" size=\"4\">Benvenuti in MKPortal<br /></font></u></b></p>\r\n\r\n\r\n\r\n<p style=\"margin-top: 0px; margin-bottom: 0px;\" align=\"center\">&nbsp;</p>\r\n<p style=\"margin-top: 0px; margin-bottom: 0px;\" align=\"justify\">\r\n<img src=\"mkportal/include/mkbox.jpg\" align=\"left\" width=\"197\" height=\"311\" alt=\"\" /></p>\r\n<p style=\"margin-top: 0px; margin-bottom: 0px;\" align=\"justify\">&nbsp;</p>\r\n<p style=\"margin-top: 0px; margin-bottom: 0px;\" align=\"justify\">&nbsp;</p>\r\n<p style=\"margin-top: 0px; margin-bottom: 0px;\" align=\"justify\">&nbsp;</p>\r\n<p style=\"margin-top: 0px; margin-bottom: 0px;\" align=\"justify\">\r\nMkportal è un prodotto che si va ad inserire in una categoria particolare.<br />L\'obiettivo di mkportal è di fornire all\'utente un portal-system di nuova concezione, semplice da gestire, ma completo ed efficiente.<br />Mkportal è votato alla massima intuitività e semplicità di uso e si pone come prodotto complementare ad una bullettin Board system (Forum). <br />Mkportal non comprende un proprio forum, ma rimane una applicazione separata, anche se per essere seguita presuppone comunque un forum a cui essere collegata.<br />Il codice e la struttura di mkportal sono del tutto separati dalle Board su cui vengono installati.<br />.<font size=\"2\" color=\"#363636\" face=\"Verdana, Helvetica\">&nbsp;</font></p>\r\n<p style=\"margin-top: 0px; margin-bottom: 0px;\" align=\"justify\">&nbsp;</p>\r\n<p style=\"margin-top: 0px; margin-bottom: 0px;\" align=\"justify\"><u><b>Features presenti</b></u></p>\r\n<p style=\"margin-top: 0px; margin-bottom: 0px;\" align=\"justify\">&nbsp;</p>\r\n<p style=\"margin-top: 0px; margin-bottom: 0px;\" align=\"justify\">&nbsp;</p>\r\n<p style=\"margin-top: 0px; margin-bottom: 0px;\" align=\"justify\"><a href=\"index.php?ind=downloads\">Download system</a> (possibilità di caricare file, gestirli votarli e commentarli)</p>\r\n<p style=\"margin-top: 0px; margin-bottom: 0px;\" align=\"justify\"><a href=\"index.php?ind=chat\">Chat</a> (chiacchierare online con gli altri utenti direttamente dal vostro portale)</p>\r\n<p style=\"margin-top: 0px; margin-bottom: 0px;\" align=\"justify\"><a href=\"index.php?ind=urlobox\">Urlobox</a> (possibilità di lasciar dei messaggi istantanei sullo stile di un guestbook)</p>\r\n<p style=\"margin-top: 0px; margin-bottom: 0px;\" align=\"justify\"><a href=\"index.php?ind=gallery\">Gallery</a> (inserimento e gestione di immagini potendole votare e commentare)</p>\r\n<p style=\"margin-top: 0px; margin-bottom: 0px;\" align=\"justify\"><a href=\"index.php?ind=news\">News</a> (creare delle news e gestirle, classificarle e archiviarle comodamente)</p>\r\n<p style=\"margin-top: 0px; margin-bottom: 0px;\" align=\"justify\">&nbsp;</p>\r\n\r\n\r\n\r\n\r\n\r\n\r\n<p style=\"margin-top: 0px; margin-bottom: 0px;\" align=\"justify\">Oltre a questo, potrete anche creare a vostro piacimento blocchi in puro <b>html</b> o utilizzando <b>php</b>, avrete le principali statistiche del forum inserite in blocchi laterali, un <b>contatore</b> delle visite integrato, un <b>calendario e tantissime altre opzioni che vi lasciamo scoprire.</b></p>\r\n\r\n		\r\n		\r\n		\r\n		\r\n		\r\n		', 1080395927);

CREATE TABLE IF NOT EXISTS `mkp_news_sections` (
  `id` int(10) NOT NULL auto_increment,
  `titolo` varchar(40) NOT NULL default '',
  `icona` varchar(255) NOT NULL default '',
  `position` int(4) NOT NULL default '0',
  PRIMARY KEY  (`id`)
);

INSERT IGNORE INTO `mkp_news_sections` (`id`, `titolo`, `icona`, `position`) VALUES (1, 'Annunci', '1', 0);

CREATE TABLE IF NOT EXISTS `mkp_pages` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(250) NOT NULL default '',
  `content` text NOT NULL,
  PRIMARY KEY  (`id`)
);

CREATE TABLE IF NOT EXISTS `mkp_pgroups` (
  `g_id` int(3) NOT NULL default '0',
  `g_title` varchar(23) NOT NULL default '',
  `g_send_news` tinyint(1) NOT NULL default '0',
  `g_mod_news` tinyint(1) NOT NULL default '0',
  `g_access_download` tinyint(1) NOT NULL default '0',
  `g_send_download` tinyint(1) NOT NULL default '0',
  `g_mod_download` tinyint(1) NOT NULL default '0',
  `g_access_gallery` tinyint(1) NOT NULL default '0',
  `g_send_gallery` tinyint(1) NOT NULL default '0',
  `g_mod_gallery` tinyint(1) NOT NULL default '0',
  `g_access_urlobox` tinyint(1) NOT NULL default '0',
  `g_send_urlobox` tinyint(1) NOT NULL default '0',
  `g_mod_urlobox` tinyint(1) NOT NULL default '0',
  `g_access_chat` tinyint(1) NOT NULL default '0',
  `g_access_cpa` tinyint(1) NOT NULL default '0',
  `g_access_blog` tinyint(1) NOT NULL default '1',
  `g_send_blog` tinyint(1) NOT NULL default '0',
  `g_access_topsite` tinyint(1) NOT NULL default '1',
  `g_send_topsite` tinyint(1) NOT NULL default '0',
  `g_send_ecard` tinyint(1) NOT NULL default '0',
  `g_send_quote` tinyint(1) NOT NULL default '0',
  `g_send_comments` tinyint(1) NOT NULL default '0',
  `g_access_reviews` tinyint(1) NOT NULL default '0',
  `g_send_reviews` tinyint(1) NOT NULL default '0',
  `g_mod_reviews` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`g_id`)
);

INSERT IGNORE INTO `mkp_pgroups` (`g_id`, `g_title`, `g_send_news`, `g_mod_news`, `g_access_download`, `g_send_download`, `g_mod_download`, `g_access_gallery`, `g_send_gallery`, `g_mod_gallery`, `g_access_urlobox`, `g_send_urlobox`, `g_mod_urlobox`, `g_access_chat`, `g_access_cpa`) VALUES (3, 'Member', 0, 0, 1, 0, 0, 1, 0, 0, 1, 1, 0, 1, 0);

INSERT IGNORE INTO `mkp_pgroups` (`g_id`, `g_title`, `g_send_news`, `g_mod_news`, `g_access_download`, `g_send_download`, `g_mod_download`, `g_access_gallery`, `g_send_gallery`, `g_mod_gallery`, `g_access_urlobox`, `g_send_urlobox`, `g_mod_urlobox`, `g_access_chat`, `g_access_cpa`) VALUES (2, 'Moderator', 0, 0, 1, 0, 0, 1, 0, 0, 1, 1, 0, 1, 0);

INSERT IGNORE INTO `mkp_pgroups` (`g_id`, `g_title`, `g_send_news`, `g_mod_news`, `g_access_download`, `g_send_download`, `g_mod_download`, `g_access_gallery`, `g_send_gallery`, `g_mod_gallery`, `g_access_urlobox`, `g_send_urlobox`, `g_mod_urlobox`, `g_access_chat`, `g_access_cpa`) VALUES (1, 'Guest', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

INSERT IGNORE INTO `mkp_pgroups` (`g_id`, `g_title`, `g_send_news`, `g_mod_news`, `g_access_download`, `g_send_download`, `g_mod_download`, `g_access_gallery`, `g_send_gallery`, `g_mod_gallery`, `g_access_urlobox`, `g_send_urlobox`, `g_mod_urlobox`, `g_access_chat`, `g_access_cpa`) VALUES (3, 'Member', 0, 0, 1, 0, 0, 1, 0, 0, 1, 1, 0, 1, 0);

INSERT IGNORE INTO `mkp_pgroups` (`g_id`, `g_title`, `g_send_news`, `g_mod_news`, `g_access_download`, `g_send_download`, `g_mod_download`, `g_access_gallery`, `g_send_gallery`, `g_mod_gallery`, `g_access_urlobox`, `g_send_urlobox`, `g_mod_urlobox`, `g_access_chat`, `g_access_cpa`) VALUES (2, 'Moderator', 0, 0, 1, 0, 0, 1, 0, 0, 1, 1, 0, 1, 0);

INSERT IGNORE INTO `mkp_pgroups` (`g_id`, `g_title`, `g_send_news`, `g_mod_news`, `g_access_download`, `g_send_download`, `g_mod_download`, `g_access_gallery`, `g_send_gallery`, `g_mod_gallery`, `g_access_urlobox`, `g_send_urlobox`, `g_mod_urlobox`, `g_access_chat`, `g_access_cpa`) VALUES (1, 'Guest', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

INSERT IGNORE INTO `mkp_pgroups` (`g_id`, `g_title`, `g_send_news`, `g_mod_news`, `g_access_download`, `g_send_download`, `g_mod_download`, `g_access_gallery`, `g_send_gallery`, `g_mod_gallery`, `g_access_urlobox`, `g_send_urlobox`, `g_mod_urlobox`, `g_access_chat`, `g_access_cpa`) VALUES (3, 'Member', 0, 0, 1, 0, 0, 1, 0, 0, 1, 1, 0, 1, 0);

INSERT IGNORE INTO `mkp_pgroups` (`g_id`, `g_title`, `g_send_news`, `g_mod_news`, `g_access_download`, `g_send_download`, `g_mod_download`, `g_access_gallery`, `g_send_gallery`, `g_mod_gallery`, `g_access_urlobox`, `g_send_urlobox`, `g_mod_urlobox`, `g_access_chat`, `g_access_cpa`) VALUES (2, 'Moderator', 0, 0, 1, 0, 0, 1, 0, 0, 1, 1, 0, 1, 0);

INSERT IGNORE INTO `mkp_pgroups` (`g_id`, `g_title`, `g_send_news`, `g_mod_news`, `g_access_download`, `g_send_download`, `g_mod_download`, `g_access_gallery`, `g_send_gallery`, `g_mod_gallery`, `g_access_urlobox`, `g_send_urlobox`, `g_mod_urlobox`, `g_access_chat`, `g_access_cpa`) VALUES (1, 'Guest', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

INSERT IGNORE INTO `mkp_pgroups` (`g_id`, `g_title`, `g_send_news`, `g_mod_news`, `g_access_download`, `g_send_download`, `g_mod_download`, `g_access_gallery`, `g_send_gallery`, `g_mod_gallery`, `g_access_urlobox`, `g_send_urlobox`, `g_mod_urlobox`, `g_access_chat`, `g_access_cpa`) VALUES (2, 'Global Moderator', 0, 0, 1, 0, 0, 1, 0, 0, 1, 1, 0, 1, 0);

INSERT IGNORE INTO `mkp_pgroups` (`g_id`, `g_title`, `g_send_news`, `g_mod_news`, `g_access_download`, `g_send_download`, `g_mod_download`, `g_access_gallery`, `g_send_gallery`, `g_mod_gallery`, `g_access_urlobox`, `g_send_urlobox`, `g_mod_urlobox`, `g_access_chat`, `g_access_cpa`) VALUES (3, 'Member', 0, 0, 1, 0, 0, 1, 0, 0, 1, 1, 0, 1, 0);

INSERT IGNORE INTO `mkp_pgroups` (`g_id`, `g_title`, `g_send_news`, `g_mod_news`, `g_access_download`, `g_send_download`, `g_mod_download`, `g_access_gallery`, `g_send_gallery`, `g_mod_gallery`, `g_access_urlobox`, `g_send_urlobox`, `g_mod_urlobox`, `g_access_chat`, `g_access_cpa`) VALUES (2, 'Moderator', 0, 0, 1, 0, 0, 1, 0, 0, 1, 1, 0, 1, 0);

INSERT IGNORE INTO `mkp_pgroups` (`g_id`, `g_title`, `g_send_news`, `g_mod_news`, `g_access_download`, `g_send_download`, `g_mod_download`, `g_access_gallery`, `g_send_gallery`, `g_mod_gallery`, `g_access_urlobox`, `g_send_urlobox`, `g_mod_urlobox`, `g_access_chat`, `g_access_cpa`) VALUES (1, 'Guest', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

INSERT IGNORE INTO `mkp_pgroups` (`g_id`, `g_title`, `g_send_news`, `g_mod_news`, `g_access_download`, `g_send_download`, `g_mod_download`, `g_access_gallery`, `g_send_gallery`, `g_mod_gallery`, `g_access_urlobox`, `g_send_urlobox`, `g_mod_urlobox`, `g_access_chat`, `g_access_cpa`) VALUES (2, 'Global Moderator', 0, 0, 1, 0, 0, 1, 0, 0, 1, 1, 0, 1, 0);

INSERT IGNORE INTO `mkp_pgroups` (`g_id`, `g_title`, `g_send_news`, `g_mod_news`, `g_access_download`, `g_send_download`, `g_mod_download`, `g_access_gallery`, `g_send_gallery`, `g_mod_gallery`, `g_access_urlobox`, `g_send_urlobox`, `g_mod_urlobox`, `g_access_chat`, `g_access_cpa`) VALUES (3, 'Moderator', 0, 0, 1, 0, 0, 1, 0, 0, 1, 1, 0, 1, 0);

INSERT IGNORE INTO `mkp_pgroups` (`g_id`, `g_title`, `g_send_news`, `g_mod_news`, `g_access_download`, `g_send_download`, `g_mod_download`, `g_access_gallery`, `g_send_gallery`, `g_mod_gallery`, `g_access_urlobox`, `g_send_urlobox`, `g_mod_urlobox`, `g_access_chat`, `g_access_cpa`) VALUES (4, 'Newbie', 0, 0, 1, 0, 0, 1, 0, 0, 1, 1, 0, 1, 0);

INSERT IGNORE INTO `mkp_pgroups` (`g_id`, `g_title`, `g_send_news`, `g_mod_news`, `g_access_download`, `g_send_download`, `g_mod_download`, `g_access_gallery`, `g_send_gallery`, `g_mod_gallery`, `g_access_urlobox`, `g_send_urlobox`, `g_mod_urlobox`, `g_access_chat`, `g_access_cpa`) VALUES (2, 'Global Moderator', 0, 0, 1, 0, 0, 1, 0, 0, 1, 1, 0, 1, 0);

INSERT IGNORE INTO `mkp_pgroups` (`g_id`, `g_title`, `g_send_news`, `g_mod_news`, `g_access_download`, `g_send_download`, `g_mod_download`, `g_access_gallery`, `g_send_gallery`, `g_mod_gallery`, `g_access_urlobox`, `g_send_urlobox`, `g_mod_urlobox`, `g_access_chat`, `g_access_cpa`) VALUES (3, 'Moderator', 0, 0, 1, 0, 0, 1, 0, 0, 1, 1, 0, 1, 0);

INSERT IGNORE INTO `mkp_pgroups` (`g_id`, `g_title`, `g_send_news`, `g_mod_news`, `g_access_download`, `g_send_download`, `g_mod_download`, `g_access_gallery`, `g_send_gallery`, `g_mod_gallery`, `g_access_urlobox`, `g_send_urlobox`, `g_mod_urlobox`, `g_access_chat`, `g_access_cpa`) VALUES (4, 'Newbie', 0, 0, 1, 0, 0, 1, 0, 0, 1, 1, 0, 1, 0);

INSERT IGNORE INTO `mkp_pgroups` (`g_id`, `g_title`, `g_send_news`, `g_mod_news`, `g_access_download`, `g_send_download`, `g_mod_download`, `g_access_gallery`, `g_send_gallery`, `g_mod_gallery`, `g_access_urlobox`, `g_send_urlobox`, `g_mod_urlobox`, `g_access_chat`, `g_access_cpa`) VALUES (5, 'Jr. Member', 0, 0, 1, 0, 0, 1, 0, 0, 1, 1, 0, 1, 0);

INSERT IGNORE INTO `mkp_pgroups` (`g_id`, `g_title`, `g_send_news`, `g_mod_news`, `g_access_download`, `g_send_download`, `g_mod_download`, `g_access_gallery`, `g_send_gallery`, `g_mod_gallery`, `g_access_urlobox`, `g_send_urlobox`, `g_mod_urlobox`, `g_access_chat`, `g_access_cpa`) VALUES (6, 'Full Member', 0, 0, 1, 0, 0, 1, 0, 0, 1, 1, 0, 1, 0);

INSERT IGNORE INTO `mkp_pgroups` (`g_id`, `g_title`, `g_send_news`, `g_mod_news`, `g_access_download`, `g_send_download`, `g_mod_download`, `g_access_gallery`, `g_send_gallery`, `g_mod_gallery`, `g_access_urlobox`, `g_send_urlobox`, `g_mod_urlobox`, `g_access_chat`, `g_access_cpa`) VALUES (7, 'Sr. Member', 0, 0, 1, 0, 0, 1, 0, 0, 1, 1, 0, 1, 0);

INSERT IGNORE INTO `mkp_pgroups` (`g_id`, `g_title`, `g_send_news`, `g_mod_news`, `g_access_download`, `g_send_download`, `g_mod_download`, `g_access_gallery`, `g_send_gallery`, `g_mod_gallery`, `g_access_urlobox`, `g_send_urlobox`, `g_mod_urlobox`, `g_access_chat`, `g_access_cpa`) VALUES (8, 'Hero Member', 0, 0, 1, 0, 0, 1, 0, 0, 1, 1, 0, 1, 0);

INSERT IGNORE INTO `mkp_pgroups` (`g_id`, `g_title`, `g_send_news`, `g_mod_news`, `g_access_download`, `g_send_download`, `g_mod_download`, `g_access_gallery`, `g_send_gallery`, `g_mod_gallery`, `g_access_urlobox`, `g_send_urlobox`, `g_mod_urlobox`, `g_access_chat`, `g_access_cpa`) VALUES (99, 'Guests', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

CREATE TABLE IF NOT EXISTS `mkp_urlobox` (
  `id` int(11) NOT NULL auto_increment,
  `idaut` int(10) NOT NULL default '0',
  `name` varchar(40) NOT NULL default '',
  `message` text NOT NULL,
  `time` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
);

CREATE TABLE IF NOT EXISTS `mkp_blog` (
  `id` int(11) NOT NULL default '0',
  `autore` varchar(40) NOT NULL default '',
  `titolo` varchar(25) NOT NULL default '',
  `descrizione` text NOT NULL,
  `template` text NOT NULL,
  `template2` text NOT NULL,
  `eta` varchar(25) NOT NULL default '',
  `segno` varchar(25) NOT NULL default '',
  `citta` varchar(25) NOT NULL default '',
  `libri` text NOT NULL,
  `film` text NOT NULL,
  `canzoni` text NOT NULL,
  `link` text NOT NULL,
  `amo` text NOT NULL,
  `odio` text NOT NULL,
  `umore` varchar(30) NOT NULL default 'felice',
  `citazione` text NOT NULL,
  `click` int(11) NOT NULL default '0',
  `privacy` varchar(5) NOT NULL default 'ok',
  `mailcomm` varchar(5) NOT NULL default 'ok',
  `mailbloga` varchar(5) NOT NULL default 'ok',
  `maxmess` int(3) NOT NULL default '10',
  `aggiornato` int(11) NOT NULL default '0',
  `categoria` varchar(30) NOT NULL default '',
  `link_blog` text NOT NULL,
  `anon_comm` char(2) NOT NULL default 'no',
  `creato` int(11) NOT NULL default '0',
  `ip_address` varchar(32) NOT NULL default '',
  `rate` varchar(10) NOT NULL default '',
  `trate` int(10) NOT NULL default '0',
  `banner` varchar(255) NOT NULL default '',
  `validate` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`id`)
);

CREATE TABLE IF NOT EXISTS `mkp_blog_commenti` (
  `id` int(11) NOT NULL auto_increment,
  `id_blog` int(11) NOT NULL default '0',
  `id_post` int(11) NOT NULL default '0',
  `autore` varchar(25) NOT NULL default '',
  `home` varchar(80) NOT NULL default '',
  `commento` text NOT NULL,
  PRIMARY KEY  (`id`)
);

CREATE TABLE IF NOT EXISTS `mkp_blog_post` (
  `id` int(11) NOT NULL auto_increment,
  `id_blog` int(11) NOT NULL default '0',
  `post` text NOT NULL,
  `data` int(11) NOT NULL default '0',
  `ncom` int(4) NOT NULL default '0',
  PRIMARY KEY  (`id`)
);

CREATE TABLE IF NOT EXISTS `mkp_topsite` (
  `id` int(10) NOT NULL auto_increment,
  `id_member` int(10) NOT NULL default '0',
  `title` varchar(80) NOT NULL default '',
  `description` varchar(200) NOT NULL default '',
  `link` varchar(255) NOT NULL default '',
  `banner` varchar(255) NOT NULL default '',
  `banner2` varchar(255) NOT NULL default '',
  `click` int(6) NOT NULL default '0',
  `rate` varchar(40) NOT NULL default '',
  `trate` int(6) NOT NULL default '0',
  `validate` tinyint(1) NOT NULL default '0',
  `email` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`)
);

CREATE TABLE IF NOT EXISTS `mkp_votes` (
  `id` int(10) NOT NULL auto_increment,
  `id_entry` int(10) NOT NULL default '0',
  `module` varchar(40) NOT NULL default '',
  `id_member` int(10) NOT NULL default '0',
  `ip` varchar(40) NOT NULL default '',
  PRIMARY KEY  (`id`)
);

INSERT IGNORE INTO `mkp_config` (`id`, `chiave`, `valore`) VALUES (25, 'topsite_page', '10');

INSERT IGNORE INTO `mkp_config` (`id`, `chiave`, `valore`) VALUES (26, 'blog_page', '10');

INSERT IGNORE INTO `mkp_config` (`id`, `chiave`, `valore`) VALUES (27, 'mod_blog', '');

INSERT IGNORE INTO `mkp_config` (`id`, `chiave`, `valore`) VALUES (28, 'mod_gallery', '');

INSERT IGNORE INTO `mkp_config` (`id`, `chiave`, `valore`) VALUES (29, 'mod_urlobox', '');

INSERT IGNORE INTO `mkp_config` (`id`, `chiave`, `valore`) VALUES (30, 'mod_downloads', '');

INSERT IGNORE INTO `mkp_config` (`id`, `chiave`, `valore`) VALUES (31, 'mod_news', '');

INSERT IGNORE INTO `mkp_config` (`id`, `chiave`, `valore`) VALUES (32, 'mod_topsite', '');

INSERT IGNORE INTO `mkp_config` (`id`, `chiave`, `valore`) VALUES (33, 'mod_chat', '');

CREATE TABLE IF NOT EXISTS `mkp_news_comments` (
  `id` int(10) NOT NULL auto_increment,
  `identry` int(10) NOT NULL default '0',
  `autore` varchar(255) NOT NULL,
  `testo` text NOT NULL,
  `data` int(10) NOT NULL default '0',
  PRIMARY KEY  (`id`)
);

CREATE TABLE IF NOT EXISTS `mkp_quotes` (
  `id` int(11) NOT NULL auto_increment,
  `author` varchar(64) NOT NULL default 'Unknown',
  `member` varchar(64) NOT NULL default 'Staff',
  `member_id` int(11) NOT NULL default '0',
  `quote` varchar(255) NOT NULL default 'No quote',
  `date_added` int(11) NOT NULL default '0',
  `validate` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`)
);

CREATE TABLE IF NOT EXISTS `mkp_ecards` (
  `id` int(10) NOT NULL auto_increment,
  `titolo` varchar(64) NOT NULL,
  `file` varchar(255) NOT NULL,
  `destinatario` varchar(64) NOT NULL,
  `mittente` varchar(64) NOT NULL,
  `emailmit` varchar(64) NOT NULL,
  `testo` text NOT NULL,
  `member` varchar(64) NOT NULL,
  `date` int(10) NOT NULL default '0',
  `code` int(4) NOT NULL default '0',
  PRIMARY KEY  (`id`)
);

CREATE TABLE IF NOT EXISTS `mkp_reviews` (
  `id` int(10) NOT NULL auto_increment,
  `id_cat` int(10) NOT NULL default '0',
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `field1` varchar(255) NOT NULL,
  `field2` varchar(255) NOT NULL,
  `field3` varchar(255) NOT NULL,
  `field4` varchar(255) NOT NULL,
  `field5` varchar(255) NOT NULL,
  `field6` varchar(255) NOT NULL,
  `field7` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `review` text NOT NULL,
  `author` varchar(40) NOT NULL,
  `idauth` int(10) NOT NULL default '0',
  `click` int(10) NOT NULL default '0',
  `rate` varchar(10) NOT NULL,
  `trate` int(10) NOT NULL default '0',
  `date` int(10) NOT NULL default '0',
  `validate` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`id`)
);

CREATE TABLE IF NOT EXISTS `mkp_reviews_comments` (
  `id` int(10) NOT NULL auto_increment,
  `identry` int(10) NOT NULL default '0',
  `autore` varchar(40) NOT NULL,
  `testo` text NOT NULL,
  `data` int(10) NOT NULL default '0',
  `scambio` tinyint(1) NOT NULL default '0',
  `id_autore` int(10) NOT NULL default '0',
  PRIMARY KEY  (`id`)
);

CREATE TABLE IF NOT EXISTS `mkp_reviews_sections` (
  `id` int(10) NOT NULL auto_increment,
  `title` varchar(60) NOT NULL default '',
  `description` varchar(255) NOT NULL default '',
  `field1` varchar(60) NOT NULL,
  `field2` varchar(60) NOT NULL,
  `field3` varchar(60) NOT NULL,
  `field4` varchar(60) NOT NULL,
  `field5` varchar(60) NOT NULL,
  `field6` varchar(60) NOT NULL,
  `field7` text NOT NULL,
  `position` int(4) NOT NULL default '0',
  PRIMARY KEY  (`id`)
);

CREATE TABLE IF NOT EXISTS `mkp_mainlinks` (
  `id` tinyint(3) NOT NULL auto_increment,
  `icon` text NOT NULL,
  `title` varchar(255) NOT NULL default '',
  `url` text NOT NULL,
  `type` tinyint(2) NOT NULL default '0',
  PRIMARY KEY  (`id`)
);
