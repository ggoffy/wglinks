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

include_once 'main.php';
// Admin Edit
\define('_MB_WGLINKS_DISPLAY', 'Wieviele Link sollen angezeigt werden (0 = kein Limit)');
\define('_MB_WGLINKS_TITLE_LENGTH', 'Titellänge (0 = kein Limit)');
\define('_MB_WGLINKS_LINKS_SORTBY', 'Sortierung der Link');
\define('_MB_WGLINKS_LINKS_SORTBY_DEFAULT', 'nach Gewichtung');
\define('_MB_WGLINKS_LINKS_SORTBY_DATEASC', 'nach Datum aufsteigend');
\define('_MB_WGLINKS_LINKS_SORTBY_DATEDESC', 'nach Datum absteigend');
\define('_MB_WGLINKS_LINKS_SORTBY_RANDOM', 'Zufällige Auswahl');
\define('_MB_WGLINKS_LINKS_BSTYLE', 'Blockstil');
\define('_MB_WGLINKS_LINKS_BSTYLE_DEFAULT', 'Standard');
\define('_MB_WGLINKS_LINKS_BSTYLE_2CARDS', '2 Cards');
\define('_MB_WGLINKS_LINKS_BSTYLE_3CARDS', '3 Cards');
\define('_MB_WGLINKS_LINKS_BSTYLE_4CARDS', '4 Cards');
\define('_MB_WGLINKS_LINKS_BSTYLE_6CARDS', '6 Cards');
\define('_MB_WGLINKS_LINKS_BSTYLE_12CARDS', '12 Cards');
\define('_MB_WGLINKS_BTN_SHOW_MORE', "Schaltflächte '" . \_MA_WGLINKS_SHOW_MORE . "' anzeigen");
// Link
\define('_MB_WGLINKS_ALL_LINKS', 'Alle Link');
\define('_MB_WGLINKS_LINKS_TO_DISPLAY', 'Link-Kategorien zum Anzeigen');
\define('_MB_WGLINKS_LINK_NAME', 'Name');
\define('_MB_WGLINKS_LINK_TOOLTIP', 'Tooltip');
\define('_MB_WGLINKS_ALL_CATS', 'Alle Kategorien');
\define('_MB_WGLINKS_IMGHEIGHT', 'Höhe des Logos für die Anzeige');
// ---------------- End ----------------