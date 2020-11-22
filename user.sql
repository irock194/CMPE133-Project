CREATE TABLE `users` (
  'id' int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(64) NOT NULL,
  `password` varchar(128) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_user_deleted` varchar(3) NOT NULL,
  `friends` text NOT NULL,
  PRIMARY KEY (`id`)
  );
