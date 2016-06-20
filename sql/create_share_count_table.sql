CREATE TABLE IF NOT EXISTS `social_share_counts` (
  `id` int(11) NOT NULL auto_increment,
  `url` varchar(255) NOT NULL,
  `entity_guid` int(11),
  `fb_shares` int(8),
  `fb_likes` int(8),
  `google_shares` int(8),
  `google_likes` int(8),
  `tw_shares` int(8),
  `tw_favs` int(8),
  `pin_shares` int(8),
  `stumble_shares` int(8),
  `linked_shares` int(8),
  `reddit_likes` int(8),
  `date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `url` (`url`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;