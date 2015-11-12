-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 12, 2015 at 04:56 AM
-- Server version: 5.6.26
-- PHP Version: 5.5.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `flowMeter`
--

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE IF NOT EXISTS `login_attempts` (
  `ip` varchar(45) NOT NULL,
  `first_attempt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `tries` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id_users` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_users`, `name`, `email`, `password`) VALUES
(1, 'Rogers Guedes', 'rogerguedes.ft@gmail.com', 'xTJVMXuxFwfQ9hRpazzm8iHQ4vI='),
(2, 'Vinícius Carvalho', 'viniciuscarvalho789@gmail.com', 'xTJVMXuxFwfQ9hRpazzm8iHQ4vI=');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`ip`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_users`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_users` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;--
-- Database: `netmedidor`
--

-- --------------------------------------------------------

--
-- Table structure for table `commands`
--

CREATE TABLE IF NOT EXISTS `commands` (
  `id_cmd` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `description` varchar(45) NOT NULL,
  `query` varchar(45) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `commands`
--

INSERT INTO `commands` (`id_cmd`, `name`, `description`, `query`) VALUES
(1, 'Comando14', 'Lorem ipsum dolor sit amet, consectetur adipi', 'GET /all');

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE IF NOT EXISTS `login_attempts` (
  `ip` varchar(45) NOT NULL,
  `first_attempt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `tries` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `meter_models`
--

CREATE TABLE IF NOT EXISTS `meter_models` (
  `id_mm` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `description` varchar(256) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `meter_models`
--

INSERT INTO `meter_models` (`id_mm`, `name`, `description`) VALUES
(2, 'Cronos7023', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse pulvinar, erat vel eleifend finibus, magna ligula blandit ante, quis interdum ex sapien ac tortor. Mauris sit amet scelerisque augue. Donec eu posuere augue. Aenean massa neque, mollis a.'),
(3, 'Cronos6021', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse pulvinar, erat vel eleifend finibus, magna ligula blandit ante, quis interdum ex sapien ac tortor. Mauris sit amet scelerisque augue. Donec eu posuere augue. Aenean massa neque, mollis a.');

-- --------------------------------------------------------

--
-- Table structure for table `meters`
--

CREATE TABLE IF NOT EXISTS `meters` (
  `id_meters` int(11) NOT NULL,
  `fk_mm` int(11) NOT NULL,
  `fk_syncs` int(11) NOT NULL,
  `alias` varchar(45) DEFAULT NULL,
  `ipAddress` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mm_has_commands`
--

CREATE TABLE IF NOT EXISTS `mm_has_commands` (
  `idmm_has_commands` int(11) NOT NULL,
  `mm_fk` int(11) NOT NULL,
  `cmd_fk` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mm_has_commands`
--

INSERT INTO `mm_has_commands` (`idmm_has_commands`, `mm_fk`, `cmd_fk`) VALUES
(1, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sn_has_commands`
--

CREATE TABLE IF NOT EXISTS `sn_has_commands` (
  `idsn_has_commands` int(11) NOT NULL,
  `sn_fk` int(11) NOT NULL,
  `cmd_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sync_nodes`
--

CREATE TABLE IF NOT EXISTS `sync_nodes` (
  `id_sn` int(11) NOT NULL,
  `alias` varchar(45) DEFAULT NULL,
  `ipAddress` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id_users` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `access_level` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_users`, `name`, `email`, `password`, `access_level`) VALUES
(1, 'Rogers Guedes', 'rogerguedes.ft@gmail.com', 'xTJVMXuxFwfQ9hRpazzm8iHQ4vI=', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `commands`
--
ALTER TABLE `commands`
  ADD PRIMARY KEY (`id_cmd`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`ip`);

--
-- Indexes for table `meter_models`
--
ALTER TABLE `meter_models`
  ADD PRIMARY KEY (`id_mm`);

--
-- Indexes for table `meters`
--
ALTER TABLE `meters`
  ADD PRIMARY KEY (`id_meters`),
  ADD KEY `fk_meters_1` (`fk_mm`),
  ADD KEY `fk_meters_2` (`fk_syncs`);

--
-- Indexes for table `mm_has_commands`
--
ALTER TABLE `mm_has_commands`
  ADD PRIMARY KEY (`idmm_has_commands`),
  ADD KEY `fk_mm_has_commands_1` (`mm_fk`),
  ADD KEY `fk_mm_has_commands_2` (`cmd_fk`);

--
-- Indexes for table `sn_has_commands`
--
ALTER TABLE `sn_has_commands`
  ADD PRIMARY KEY (`idsn_has_commands`),
  ADD KEY `fk_sn_has_commands_1` (`sn_fk`),
  ADD KEY `fk_sn_has_commands_2` (`cmd_fk`);

--
-- Indexes for table `sync_nodes`
--
ALTER TABLE `sync_nodes`
  ADD PRIMARY KEY (`id_sn`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_users`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `commands`
--
ALTER TABLE `commands`
  MODIFY `id_cmd` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `meter_models`
--
ALTER TABLE `meter_models`
  MODIFY `id_mm` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `meters`
--
ALTER TABLE `meters`
  MODIFY `id_meters` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mm_has_commands`
--
ALTER TABLE `mm_has_commands`
  MODIFY `idmm_has_commands` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `sn_has_commands`
--
ALTER TABLE `sn_has_commands`
  MODIFY `idsn_has_commands` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sync_nodes`
--
ALTER TABLE `sync_nodes`
  MODIFY `id_sn` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_users` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `meters`
--
ALTER TABLE `meters`
  ADD CONSTRAINT `fk_meters_1` FOREIGN KEY (`fk_mm`) REFERENCES `meter_models` (`id_mm`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_meters_2` FOREIGN KEY (`fk_syncs`) REFERENCES `sync_nodes` (`id_sn`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `mm_has_commands`
--
ALTER TABLE `mm_has_commands`
  ADD CONSTRAINT `fk_mm_has_commands_1` FOREIGN KEY (`mm_fk`) REFERENCES `meter_models` (`id_mm`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_mm_has_commands_2` FOREIGN KEY (`cmd_fk`) REFERENCES `commands` (`id_cmd`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `sn_has_commands`
--
ALTER TABLE `sn_has_commands`
  ADD CONSTRAINT `fk_sn_has_commands_1` FOREIGN KEY (`sn_fk`) REFERENCES `sync_nodes` (`id_sn`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_sn_has_commands_2` FOREIGN KEY (`cmd_fk`) REFERENCES `commands` (`id_cmd`) ON DELETE NO ACTION ON UPDATE NO ACTION;
--
-- Database: `phpmyadmin`
--

-- --------------------------------------------------------

--
-- Table structure for table `pma__bookmark`
--

CREATE TABLE IF NOT EXISTS `pma__bookmark` (
  `id` int(11) NOT NULL,
  `dbase` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `label` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `query` text COLLATE utf8_bin NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Bookmarks';

-- --------------------------------------------------------

--
-- Table structure for table `pma__column_info`
--

CREATE TABLE IF NOT EXISTS `pma__column_info` (
  `id` int(5) unsigned NOT NULL,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `column_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `comment` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `mimetype` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `transformation` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `transformation_options` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Column information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__designer_coords`
--

CREATE TABLE IF NOT EXISTS `pma__designer_coords` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `x` int(11) DEFAULT NULL,
  `y` int(11) DEFAULT NULL,
  `v` tinyint(4) DEFAULT NULL,
  `h` tinyint(4) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table coordinates for Designer';

-- --------------------------------------------------------

--
-- Table structure for table `pma__history`
--

CREATE TABLE IF NOT EXISTS `pma__history` (
  `id` bigint(20) unsigned NOT NULL,
  `username` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `timevalue` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `sqlquery` text COLLATE utf8_bin NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='SQL history for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__pdf_pages`
--

CREATE TABLE IF NOT EXISTS `pma__pdf_pages` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `page_nr` int(10) unsigned NOT NULL,
  `page_descr` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='PDF relation pages for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__recent`
--

CREATE TABLE IF NOT EXISTS `pma__recent` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `tables` text COLLATE utf8_bin NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Recently accessed tables';

--
-- Dumping data for table `pma__recent`
--

INSERT INTO `pma__recent` (`username`, `tables`) VALUES
('flowMeter', '[{"db":"flowMeter","table":"login_attempts"},{"db":"flowMeter","table":"users"}]');

-- --------------------------------------------------------

--
-- Table structure for table `pma__relation`
--

CREATE TABLE IF NOT EXISTS `pma__relation` (
  `master_db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `master_table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `master_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Relation table';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_coords`
--

CREATE TABLE IF NOT EXISTS `pma__table_coords` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `pdf_page_number` int(11) NOT NULL DEFAULT '0',
  `x` float unsigned NOT NULL DEFAULT '0',
  `y` float unsigned NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table coordinates for phpMyAdmin PDF output';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_info`
--

CREATE TABLE IF NOT EXISTS `pma__table_info` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `display_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_uiprefs`
--

CREATE TABLE IF NOT EXISTS `pma__table_uiprefs` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `prefs` text COLLATE utf8_bin NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tables'' UI preferences';

-- --------------------------------------------------------

--
-- Table structure for table `pma__tracking`
--

CREATE TABLE IF NOT EXISTS `pma__tracking` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `version` int(10) unsigned NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `schema_snapshot` text COLLATE utf8_bin NOT NULL,
  `schema_sql` text COLLATE utf8_bin,
  `data_sql` longtext COLLATE utf8_bin,
  `tracking` set('UPDATE','REPLACE','INSERT','DELETE','TRUNCATE','CREATE DATABASE','ALTER DATABASE','DROP DATABASE','CREATE TABLE','ALTER TABLE','RENAME TABLE','DROP TABLE','CREATE INDEX','DROP INDEX','CREATE VIEW','ALTER VIEW','DROP VIEW') COLLATE utf8_bin DEFAULT NULL,
  `tracking_active` int(1) unsigned NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=COMPACT COMMENT='Database changes tracking for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__userconfig`
--

CREATE TABLE IF NOT EXISTS `pma__userconfig` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `timevalue` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `config_data` text COLLATE utf8_bin NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User preferences storage for phpMyAdmin';

--
-- Dumping data for table `pma__userconfig`
--

INSERT INTO `pma__userconfig` (`username`, `timevalue`, `config_data`) VALUES
('root', '2015-10-18 19:41:21', '{"collation_connection":"utf8mb4_unicode_ci"}'),
('flowMeter', '2015-11-12 03:03:03', '{"collation_connection":"utf8mb4_unicode_ci"}');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pma__column_info`
--
ALTER TABLE `pma__column_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `db_name` (`db_name`,`table_name`,`column_name`);

--
-- Indexes for table `pma__designer_coords`
--
ALTER TABLE `pma__designer_coords`
  ADD PRIMARY KEY (`db_name`,`table_name`);

--
-- Indexes for table `pma__history`
--
ALTER TABLE `pma__history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`,`db`,`table`,`timevalue`);

--
-- Indexes for table `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  ADD PRIMARY KEY (`page_nr`),
  ADD KEY `db_name` (`db_name`);

--
-- Indexes for table `pma__recent`
--
ALTER TABLE `pma__recent`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__relation`
--
ALTER TABLE `pma__relation`
  ADD PRIMARY KEY (`master_db`,`master_table`,`master_field`),
  ADD KEY `foreign_field` (`foreign_db`,`foreign_table`);

--
-- Indexes for table `pma__table_coords`
--
ALTER TABLE `pma__table_coords`
  ADD PRIMARY KEY (`db_name`,`table_name`,`pdf_page_number`);

--
-- Indexes for table `pma__table_info`
--
ALTER TABLE `pma__table_info`
  ADD PRIMARY KEY (`db_name`,`table_name`);

--
-- Indexes for table `pma__table_uiprefs`
--
ALTER TABLE `pma__table_uiprefs`
  ADD PRIMARY KEY (`username`,`db_name`,`table_name`);

--
-- Indexes for table `pma__tracking`
--
ALTER TABLE `pma__tracking`
  ADD PRIMARY KEY (`db_name`,`table_name`,`version`);

--
-- Indexes for table `pma__userconfig`
--
ALTER TABLE `pma__userconfig`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pma__column_info`
--
ALTER TABLE `pma__column_info`
  MODIFY `id` int(5) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pma__history`
--
ALTER TABLE `pma__history`
  MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  MODIFY `page_nr` int(10) unsigned NOT NULL AUTO_INCREMENT;--
-- Database: `test`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `test_multi_sets`()
    DETERMINISTIC
begin
        select user() as first_col;
        select user() as first_col, now() as second_col;
        select user() as first_col, now() as second_col, now() as third_col;
        end$$

DELIMITER ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
