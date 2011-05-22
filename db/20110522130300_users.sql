CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(30) NOT NULL,
  `password` varchar(36) NOT NULL,
  `name_first` varchar(20) NOT NULL,
  `name_last` varchar(30) default '',
  `created_at` timestamp default '0000-00-00 00:00:00' NOT NULL,
  `modified_at` timestamp default '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `last_login` timestamp default '0000-00-00 00:00:00' NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MYISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;