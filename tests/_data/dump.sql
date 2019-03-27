CREATE TABLE `users` (
 `id` int(11) NOT NULL PRIMARY KEY,
 `first_name` text NOT NULL,
 `last_name` text NOT NULL,
 `email` text NOT NULL,
 `pass` text NOT NULL,
 `is_active` text CHECK( is_active IN ('yes','no') ) NOT NULL DEFAULT 'yes',
 `role` int(11) NOT NULL DEFAULT '2'
);

CREATE TABLE `password_resets` ( 
`id` INT(11) NOT NULL PRIMARY KEY,
`email` text NOT NULL,
`token` text NOT NULL 
);
