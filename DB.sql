-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 31. Mrz 2016 um 11:44
-- Server-Version: 5.5.47-0+deb8u1
-- PHP-Version: 5.6.17-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Datenbank: `christk`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `Content`
--

CREATE TABLE `Content` (
  `idContent` int(11) NOT NULL,
  `Contentcol` longtext,
  `MetaData_idMetaData` int(11) NOT NULL,
  `ContentGroups_idContentGroups` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `Content`
--

INSERT INTO `Content` (`idContent`, `Contentcol`, `MetaData_idMetaData`, `ContentGroups_idContentGroups`) VALUES
(1, '<h1>Lorem Impsum</h1><p>Lorem Ipsum Sit dolor amet...</p>', 1, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `ContentGroups`
--

CREATE TABLE `ContentGroups` (
  `idContentGroups` int(11) NOT NULL,
  `Label` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `ContentGroups`
--

INSERT INTO `ContentGroups` (`idContentGroups`, `Label`) VALUES
(1, 'PAGES');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `Content_has_Media`
--

CREATE TABLE `Content_has_Media` (
  `Content_idContent` int(11) NOT NULL,
  `Media_idMedia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `Media`
--

CREATE TABLE `Media` (
  `idMedia` int(11) NOT NULL,
  `Mediatype` varchar(45) DEFAULT NULL,
  `URL` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `MetaData`
--

CREATE TABLE `MetaData` (
  `idMetaData` int(11) NOT NULL,
  `Created` datetime DEFAULT NULL,
  `LastModified` datetime DEFAULT NULL,
  `Lang` varchar(2) DEFAULT NULL,
  `Title` varchar(45) DEFAULT NULL,
  `Header` varchar(45) DEFAULT NULL,
  `Keywords` varchar(255) DEFAULT NULL,
  `Descr` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `MetaData`
--

INSERT INTO `MetaData` (`idMetaData`, `Created`, `LastModified`, `Lang`, `Title`, `Header`, `Keywords`, `Descr`) VALUES
(1, '2016-03-30 19:08:19', '2016-03-30 19:08:19', 'DE', 'Home', NULL, '', '');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `Root2Leaves`
--

CREATE TABLE `Root2Leaves` (
  `idRoot2Leaves` int(11) NOT NULL,
  `rURL` varchar(255) NOT NULL,
  `DisplayName` varchar(45) NOT NULL,
  `isRoot` tinyint(1) DEFAULT NULL,
  `isToplevel` tinyint(1) DEFAULT NULL,
  `Content_idContent` int(11) DEFAULT NULL,
  `Root2Leaves_idRoot2Leaves` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `Root2Leaves`
--

INSERT INTO `Root2Leaves` (`idRoot2Leaves`, `rURL`, `DisplayName`, `isRoot`, `isToplevel`, `Content_idContent`, `Root2Leaves_idRoot2Leaves`) VALUES
(1, 'home_page.rkpx', 'Home', 1, 1, 1, NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `Users`
--

CREATE TABLE `Users` (
  `idUsers` int(11) NOT NULL,
  `LoginName` varchar(45) DEFAULT NULL,
  `LoginPass` varchar(240) DEFAULT NULL,
  `Realname` varchar(45) DEFAULT NULL,
  `Emailadress` varchar(45) DEFAULT NULL,
  `isActive` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `Users`
--

INSERT INTO `Users` (`idUsers`, `LoginName`, `LoginPass`, `Realname`, `Emailadress`, `isActive`) VALUES
(1, 'admin', '$2y$10$txdbPmpNHbEi4CJFTRtDAeZ.F6QrGhdNtWkQcPfGp2Iizx8YbU4ym', 'Admin', 'email@rkcsd.com', 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `Users_has_Content`
--

CREATE TABLE `Users_has_Content` (
  `Users_idUsers` int(11) NOT NULL,
  `Content_idContent` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `Content`
--
ALTER TABLE `Content`
  ADD PRIMARY KEY (`idContent`),
  ADD KEY `fk_Content_MetaData` (`MetaData_idMetaData`),
  ADD KEY `fk_Content_ContentGroups1` (`ContentGroups_idContentGroups`);

--
-- Indizes für die Tabelle `ContentGroups`
--
ALTER TABLE `ContentGroups`
  ADD PRIMARY KEY (`idContentGroups`);

--
-- Indizes für die Tabelle `Content_has_Media`
--
ALTER TABLE `Content_has_Media`
  ADD PRIMARY KEY (`Content_idContent`,`Media_idMedia`),
  ADD KEY `fk_Content_has_Media_Media1` (`Media_idMedia`),
  ADD KEY `fk_Content_has_Media_Content1` (`Content_idContent`);

--
-- Indizes für die Tabelle `Media`
--
ALTER TABLE `Media`
  ADD PRIMARY KEY (`idMedia`);

--
-- Indizes für die Tabelle `MetaData`
--
ALTER TABLE `MetaData`
  ADD PRIMARY KEY (`idMetaData`);

--
-- Indizes für die Tabelle `Root2Leaves`
--
ALTER TABLE `Root2Leaves`
  ADD PRIMARY KEY (`idRoot2Leaves`,`rURL`),
  ADD KEY `fk_Root2Leaves_Content1` (`Content_idContent`),
  ADD KEY `fk_Root2Leaves_Root2Leaves1` (`Root2Leaves_idRoot2Leaves`);

--
-- Indizes für die Tabelle `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`idUsers`);

--
-- Indizes für die Tabelle `Users_has_Content`
--
ALTER TABLE `Users_has_Content`
  ADD PRIMARY KEY (`Users_idUsers`,`Content_idContent`),
  ADD KEY `fk_Users_has_Content_Content1` (`Content_idContent`),
  ADD KEY `fk_Users_has_Content_Users1` (`Users_idUsers`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `Content`
--
ALTER TABLE `Content`
  MODIFY `idContent` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;
--
-- AUTO_INCREMENT für Tabelle `ContentGroups`
--
ALTER TABLE `ContentGroups`
  MODIFY `idContentGroups` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT für Tabelle `Media`
--
ALTER TABLE `Media`
  MODIFY `idMedia` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `MetaData`
--
ALTER TABLE `MetaData`
  MODIFY `idMetaData` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;
--
-- AUTO_INCREMENT für Tabelle `Root2Leaves`
--
ALTER TABLE `Root2Leaves`
  MODIFY `idRoot2Leaves` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;
--
-- AUTO_INCREMENT für Tabelle `Users`
--
ALTER TABLE `Users`
  MODIFY `idUsers` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `Content`
--
ALTER TABLE `Content`
  ADD CONSTRAINT `fk_Content_ContentGroups1` FOREIGN KEY (`ContentGroups_idContentGroups`) REFERENCES `ContentGroups` (`idContentGroups`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Content_MetaData` FOREIGN KEY (`MetaData_idMetaData`) REFERENCES `MetaData` (`idMetaData`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints der Tabelle `Content_has_Media`
--
ALTER TABLE `Content_has_Media`
  ADD CONSTRAINT `fk_Content_has_Media_Content1` FOREIGN KEY (`Content_idContent`) REFERENCES `Content` (`idContent`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Content_has_Media_Media1` FOREIGN KEY (`Media_idMedia`) REFERENCES `Media` (`idMedia`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints der Tabelle `Root2Leaves`
--
ALTER TABLE `Root2Leaves`
  ADD CONSTRAINT `fk_Root2Leaves_Content1` FOREIGN KEY (`Content_idContent`) REFERENCES `Content` (`idContent`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Root2Leaves_Root2Leaves1` FOREIGN KEY (`Root2Leaves_idRoot2Leaves`) REFERENCES `Root2Leaves` (`idRoot2Leaves`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints der Tabelle `Users_has_Content`
--
ALTER TABLE `Users_has_Content`
  ADD CONSTRAINT `fk_Users_has_Content_Content1` FOREIGN KEY (`Content_idContent`) REFERENCES `Content` (`idContent`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Users_has_Content_Users1` FOREIGN KEY (`Users_idUsers`) REFERENCES `Users` (`idUsers`) ON DELETE NO ACTION ON UPDATE NO ACTION;
