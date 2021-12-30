<?php
/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

/**
 * wgLinks module for xoops
 *
 * @copyright      module for xoops
 * @license        GPL 2.0 or later
 * @package        wglinks
 * @since          1.0
 * @min_xoops      2.5.7
 * @author         XOOPS on Wedega - Email:<webmaster@wedega.com> - Website:<https://xoops.wedega.com>
 * @version        $Id: 1.0 modinfo.php 13070 Sun 2016-03-20 15:20:14Z XOOPS Development Team $
 */

require_once __DIR__ . '/common.php';

// ---------------- Admin Main ----------------
\define('_MI_WGLINKS_NAME', 'wgLinks');
\define('_MI_WGLINKS_DESC', 'Dieses Modul zeigt eine Ansicht der erfassten Links');
// ---------------- Admin Menu ----------------
\define('_MI_WGLINKS_ADMENU1', 'Übersicht');
\define('_MI_WGLINKS_ADMENU2', 'Kategorien');
\define('_MI_WGLINKS_ADMENU3', 'Links');
\define('_MI_WGLINKS_ABOUT', 'Über');
// ---------------- Admin Nav ----------------
\define('_MI_WGLINKS_ADMIN_PAGER', 'Listeneinträge Adminseite');
\define('_MI_WGLINKS_ADMIN_PAGER_DESC', 'Definieren Sie die Anzahl der Einträge pro Liste im Administrations-Bereich');
// User
\define('_MI_WGLINKS_USER_PAGER', 'Listeneinträge Benutzerseite');
\define('_MI_WGLINKS_USER_PAGER_DESC', 'Definieren Sie die Anzahl der Einträge pro Liste im Benutzer-Bereich');
// Submenu
// Blocks
\define('_MI_WGLINKS_BLINKS_DEFAULT', 'Standardblock Links');
\define('_MI_WGLINKS_BLINKS_DEFAULT_DESC', 'Block mit erfassten Links anzeigen');
\define('_MI_WGLINKS_BLINKS_LOGOCHAIN', 'Logo chain block');
\define('_MI_WGLINKS_BLINKS_LOGOCHAIN_DESC', 'Show block with all logos of registered links as a chain');
// Config
\define('_MI_WGLINKS_EDITOR', 'Editor');
\define('_MI_WGLINKS_EDITOR_DESC', 'Bitte den zu verwendenden Editor wählen');
\define('_MI_WGLINKS_MIMETYPES', 'Mime Types');
\define('_MI_WGLINKS_MIMETYPES_DESC', 'Definieren Sie die zulässigen Dateitypen');
\define('_MI_WGLINKS_MAXSIZE', 'Maximale Dateigröße');
\define('_MI_WGLINKS_MAXSIZE_DESC', 'Bitte die für den Upload von Dateien maximal zulässige Dateigröße definieren');
\define('_MI_WGLINKS_MAXSIZE_MB', 'MB');
\define('_MI_WGLINKS_MAXWIDTH', 'Maximale Breite Upload');
\define('_MI_WGLINKS_MAXWIDTH_DESC', 'Bitte die für den Upload von Dateien maximal zulässige Bildbreite definieren (in pixel)');
\define('_MI_WGLINKS_MAXHEIGHT', 'Maximale Höhe Upload');
\define('_MI_WGLINKS_MAXHEIGHT_DESC', 'Bitte die für den Upload von Dateien maximal zulässige Bildhöhe definieren (in pixel)');
\define('_MI_WGLINKS_MAXWIDTH_LARGE', 'Maximale Breite für große Bilder');
\define('_MI_WGLINKS_MAXWIDTH_LARGE_DESC', 'Definieren Sie die maximale Breite, auf die die hochgeladenen Bilder für Format "Große Bilder" automatisch verkleinert werden sollen (in pixel)<br>0 bedeutet, dass Bilder die Originalgröße behalten. <br>Wenn ein Bild kleiner ist als die angegebenen Maximalwerte, so wird das Bild nicht vergrößert, sondern es wird in Originalgröße abgespeichert');
\define('_MI_WGLINKS_MAXHEIGHT_LARGE', 'Maximale Höhe für große Bilder');
\define('_MI_WGLINKS_MAXHEIGHT_LARGE_DESC', 'Definieren Sie die maximale Höhe, auf die die hochgeladenen Bilder für Format "Große Bilder" automatisch verkleinert werden sollen (in pixel)<br>0 bedeutet, dass Bilder die Originalgröße behalten. <br>Wenn ein Bild kleiner ist als die angegebenen Maximalwerte, so wird das Bild nicht vergrößert, sondern es wird in Originalgröße abgespeichert');
\define('_MI_WGLINKS_MAXWIDTH_THUMBS', 'Maximale Breite für Vorschaubilder');
\define('_MI_WGLINKS_MAXWIDTH_THUMBS_DESC', 'Definieren Sie die maximale Breite, auf die die hochgeladenen Bilder für Format "Vorschaubilder" automatisch verkleinert werden sollen (in pixel).');
\define('_MI_WGLINKS_MAXHEIGHT_THUMBS', 'Maximale Höhe für Vorschaubilder');
\define('_MI_WGLINKS_MAXHEIGHT_THUMBS_DESC', 'Definieren Sie die maximale Höhe, auf die die hochgeladenen Bilder für Format "Vorschaubilder" automatisch verkleinert werden sollen (in pixel)');
\define('_MI_WGLINKS_SHOWBCRUMBS', 'Brotkrumen-Navigation (breadcrumbs) anzeigen');
\define('_MI_WGLINKS_SHOWBCRUMBS_DESC', 'Eine Brotkrumen-Navigation zeigt den aktuellen Seitenstand innerhalb der Websitestruktur');
\define('_MI_WGLINKS_SHOWBCRUMBS_MNAME', 'Modulnamen anzeigen');
\define('_MI_WGLINKS_SHOWBCRUMBS_MNAME_DESC', 'Den Modulnamen in der Brotkrumen-Navigation anzeigen');
\define('_MI_WGLINKS_SHOWCOPYRIGHT', 'Copyright anzeigen');
\define('_MI_WGLINKS_SHOWCOPYRIGHT_DESC', 'Sie können das Copyright bei der Galerie entfernen, jedoch wird ersucht, an einer beliebigen Stelle einen Backlink auf www.wedega.com anzubringen');
\define('_MI_WGLINKS_INDEXHEADER', 'Überschrift Index');
\define('_MI_WGLINKS_INDEXHEADER_DESC', 'Bitte geben Sie den Text für die Überschrift auf der Indexseite des Modules an');
\define('_MI_WGLINKS_INDEXINFO', 'Info Index');
\define('_MI_WGLINKS_INDEXINFO_DESC', 'Bitte geben Sie den Infotext an, der auf der Indexseite des Modules angezeigt werden soll');
\define('_MI_WGLINKS_INDEXSTYLE', 'Indexstil');
\define('_MI_WGLINKS_INDEXSTYLE_DESC', 'Bitte geben Sie an, wie die Links auf der Indexseite des Modules angezeigt werden sollen');
\define('_MI_WGLINKS_TITLESTYLE', 'Titelstil');
\define('_MI_WGLINKS_TITLESTYLE_DESC', 'Bitte geben Sie an, wie die Titel der Detailinfos angezeigt werden sollen');
\define('_MI_WGLINKS_TITLESTYLE_TEXT', 'als Text');
\define('_MI_WGLINKS_TITLESTYLE_GLYPH', 'als Glyphicons');
\define('_MI_WGLINKS_MAINTAINEDBY', ' wird unterstützt von ');
// ---------------- End ----------------
