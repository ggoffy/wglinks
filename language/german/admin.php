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
 * @author         XOOPS on Wedega - Email:<webmaster@wedega.com> - Website:<https://xoops.wedega.com>
 */

require_once __DIR__ . '/common.php';

// ---------------- Admin Index ----------------
\define('_AM_WGLINKS_STATISTICS', 'Statistiken');
// There are
\define('_AM_WGLINKS_THEREARE_CATS', "Es gibt <span class='bold'>%s</span> Kategorien in der Datenbank");
\define('_AM_WGLINKS_THEREARE_LINKS', "Es gibt <span class='bold'>%s</span> Links in der Datenbank");
// ---------------- Admin Files ----------------
// There aren't
\define('_AM_WGLINKS_THEREARENT_CATS', 'Es gibt keine Kategorien');
\define('_AM_WGLINKS_THEREARENT_LINKS', 'Es gibt keine Links');
// Save/Delete
\define('_AM_WGLINKS_FORM_OK', 'Erfolgreich gespeichert');
\define('_AM_WGLINKS_FORM_DELETE_OK', 'Erfolgreich gelöscht');
\define('_AM_WGLINKS_FORM_SURE_DELETE', "Wollen Sie wirklich löschen: <b><span style='color : #ff0000;'>%s </span></b>");
\define('_AM_WGLINKS_FORM_SURE_RENEW', "Wollen Sie wirklich aktualisieren: <b><span style='color : #ff0000;'>%s </span></b>");
// Buttons
\define('_AM_WGLINKS_ADD_CAT', 'Neue Kategorie hinzufügen');
\define('_AM_WGLINKS_ADD_LINK', 'Neuen Link hinzufügen');
// Lists
\define('_AM_WGLINKS_CATS_LIST', 'Liste der Kategorien');
\define('_AM_WGLINKS_LINKS_LIST', 'Liste der Links');
// ---------------- Admin Classes ----------------
// Link add/edit
\define('_AM_WGLINKS_CAT_ADD', 'Link hinzufügen');
\define('_AM_WGLINKS_CAT_EDIT', 'Link bearbeiten');
// Elements of Category
\define('_AM_WGLINKS_CAT', 'Kategorie');
\define('_AM_WGLINKS_CAT_ID', 'Id');
\define('_AM_WGLINKS_CAT_NAME', 'Name');
\define('_AM_WGLINKS_CAT_DESC', 'Beschreibung');
\define('_AM_WGLINKS_CAT_LOGO', 'Logo');
// Link add/edit
\define('_AM_WGLINKS_LINK_ADD', 'Link hinzufügen');
\define('_AM_WGLINKS_LINK_EDIT', 'Link bearbeiten');
// Elements of Link
\define('_AM_WGLINKS_LINK_ID', 'Id');
\define('_AM_WGLINKS_LINK_NAME', 'Name');
\define('_AM_WGLINKS_LINK_URL', 'Url');
\define('_AM_WGLINKS_LINK_TOOLTIP', 'Tooltip');
\define('_AM_WGLINKS_LINK_DETAIL', 'Detailbeschreibung');
\define('_AM_WGLINKS_LINK_CONTACT', 'Kontakt');
\define('_AM_WGLINKS_LINK_EMAIL', 'Email');
\define('_AM_WGLINKS_LINK_PHONE', 'Telefon');
\define('_AM_WGLINKS_LINK_ADDRESS', 'Adresse');
\define('_AM_WGLINKS_LINK_LOGO', 'Logo');
\define('_AM_WGLINKS_LINK_STATE', 'Status');
// Clone feature
\define('_AM_WGLINKS_CLONE', 'Klonen');
\define('_AM_WGLINKS_CLONE_DSC', 'Ein Modul zu klonen war noch nie so einfach! Geben Sie einfach den Namen den Sie wollen und Knopf drücken!');
\define('_AM_WGLINKS_CLONE_TITLE', 'Klone %s');
\define('_AM_WGLINKS_CLONE_NAME', 'Wählen Sie einen Namen für das neue Modul');
\define('_AM_WGLINKS_CLONE_NAME_DSC', 'Verwenden Sie keine Sonderzeichen ! <br> Wählen Sie bitte kein vorhandenes Modul Modul Verzeichnisname  oder Datenbank-Tabellenname!');
\define('_AM_WGLINKS_CLONE_INVALIDNAME', 'FEHLER: Ungültige Modulnamen, bitte versuchen Sie einen anderen!');
\define('_AM_WGLINKS_CLONE_EXISTS', 'FEHLER: Modulnamen bereits benutzt, bitte versuchen Sie einen anderen!');
\define('_AM_WGLINKS_CLONE_CONGRAT', 'Herzliche Glückwünsche! %s wurde erfolgreich erstellt! <br /> Sie können Änderungen in Sprachdateien machen.');
\define('_AM_WGLINKS_CLONE_IMAGEFAIL', 'Achtung, wir haben es nicht geschafft, das neue Modul-Logo zu erstellen. Bitte beachten Sie assets / images / logo_module.png manuell zu modifizieren!');
\define('_AM_WGLINKS_CLONE_FAIL', "Leider konnten wir den neuen Klon nicht erstellen . Vielleicht müssen Sie die Schreibrechte von 'modules' Verzeichnis auf  (CHMOD 777) festlegen und neu versuchen.");
// General
\define('_AM_WGLINKS_WEIGHT', 'Reihung');
\define('_AM_WGLINKS_SUBMITTER', 'Einsender');
\define('_AM_WGLINKS_DATE_CREATED', 'Datum');
\define('_AM_WGLINKS_FORM_UPLOAD', 'Datei hochladen');
\define('_AM_WGLINKS_FORM_IMAGE_PATH', 'Dateien in %s ');
\define('_AM_WGLINKS_FORM_ACTION', 'Aktion');
\define('_AM_WGLINKS_FORM_EDIT', 'Bearbeiten');
\define('_AM_WGLINKS_FORM_DELETE', 'Löschen');
\define('_AM_WGLINKS_FORM_UPLOAD_IMAGE_LINKS', 'Logo hochladen: <br>- max. %w x %h Pixel<br>- max. %b Bytes<br>');
// ---------------- Admin Others ----------------
\define('_AM_WGLINKS_MAINTAINEDBY', ' wird unterstützt von ');
if (!\defined('_ER_UP_NOFILE')) {
    \define('_ER_UP_NOFILE', 'Keine Datei für Upload ausgewählt');
}
