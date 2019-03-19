CREATE TABLE `users` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `first_name` text COLLATE utf8_unicode_ci NOT NULL,
 `last_name` text COLLATE utf8_unicode_ci NOT NULL,
 `email` text COLLATE utf8_unicode_ci NOT NULL,
 `pass` text COLLATE utf8_unicode_ci NOT NULL,
 `is_active` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes',
 `role` int(11) NOT NULL DEFAULT '2',
 PRIMARY KEY (`id`),
 UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
