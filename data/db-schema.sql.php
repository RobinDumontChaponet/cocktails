<?php

function getSqlSchema ($tablePrefix) {
	return array(
		'favorite'=>array(
			'drop'
			=>'DROP TABLE IF EXISTS `'.$tablePrefix.'favorite`',

			'create'
			=>'CREATE TABLE `'.$tablePrefix.'favorite` (
			  `login` varchar(50) NOT NULL DEFAULT \'\',
			  `recipeId` int(11) NOT NULL DEFAULT \'0\',
			  PRIMARY KEY (`login`,`recipeId`),
			  CONSTRAINT `favorite_user` FOREIGN KEY (`login`) REFERENCES `'.$tablePrefix.'User` (`login`) ON DELETE CASCADE ON UPDATE CASCADE
			) ENGINE=InnoDB DEFAULT CHARSET=utf8'
		),

		'User'=>array(
			'drop'
			=>'DROP TABLE IF EXISTS `'.$tablePrefix.'User`',

			'create'
			=>'CREATE TABLE `'.$tablePrefix.'User` (
			  `login` varchar(50) NOT NULL DEFAULT \'\',
			  `password` varchar(60) NOT NULL DEFAULT \'\',
			  `firstName` varchar(11) DEFAULT NULL,
			  `lastName` varchar(11) DEFAULT NULL,
			  `sex` enum(\'f\',\'m\') DEFAULT NULL,
			  `email` varchar(128) DEFAULT NULL,
			  `birthDate` date DEFAULT NULL,
			  `address` varchar(11) DEFAULT NULL,
			  `postalCode` int(5) DEFAULT NULL,
			  `city` varchar(11) DEFAULT NULL,
			  `phoneNumber` varchar(10) DEFAULT NULL,
			  PRIMARY KEY (`login`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8'
		)
	);
}

?>