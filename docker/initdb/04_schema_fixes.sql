-- Reconcile MKPortal 1.1 installer schema with the site's 1.2 code (added columns).
ALTER TABLE `mkp_news` ADD COLUMN `totalcomm` int(11) NOT NULL default '0';
ALTER TABLE `mkp_mainlinks` ADD COLUMN `position` int(11) NOT NULL default '0';
ALTER TABLE `mkp_mainlinks` ADD COLUMN `target` varchar(50) NOT NULL default '';
