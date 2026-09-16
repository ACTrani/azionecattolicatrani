CREATE TABLE IF NOT EXISTS `mkp_stat` (
  `id` int(11) NOT NULL auto_increment,
  `chiave` varchar(255) NOT NULL default '',
  `valore` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM;
INSERT IGNORE INTO `mkp_stat` (`chiave`,`valore`) VALUES
 ('tot_blog','0'),('tot_download','0'),('tot_gallery','0'),('tot_quotes','0'),
 ('tot_reviews','0'),('tot_topsite','0'),('blog_id_blog','0'),('blog_post','0'),
 ('blog_titolo','0'),('urlo_message',''),('urlo_name',''),('urlo_time','0');

CREATE TABLE IF NOT EXISTS `mkp_rss` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL default '',
  `url` varchar(255) NOT NULL default '',
  `position` int(11) NOT NULL default '0',
  `active` varchar(10) NOT NULL default '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM;
