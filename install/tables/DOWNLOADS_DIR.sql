CREATE TABLE `DOWNLOADS_DIR` (
  
`ID` int(11) NOT NULL AUTO_INCREMENT,
  
`NAME` varchar(200) NOT NULL,
  
`EXT` varchar(2000) NOT NULL,
  
`PRIVATE` int(11) NOT NULL,
  
`ID_DIR` int(11) NOT NULL,
  
`ID_DIR_O` int(11) NOT NULL,
  
`RATING` int(11) NOT NULL,
PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1;