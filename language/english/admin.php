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
 * @version        $Id: 1.0 admin.php 13070 Sun 2016-03-20 15:20:15Z XOOPS Development Team $
 */

require_once __DIR__ . '/common.php';

// ---------------- Admin Index ----------------
\define('_AM_WGLINKS_STATISTICS', 'Statistics');
// There are
\define('_AM_WGLINKS_THEREARE_CATS', "There are <span class='bold'>%s</span> categories in the database");
\define('_AM_WGLINKS_THEREARE_LINKS', "There are <span class='bold'>%s</span> links in the database");
// ---------------- Admin Files ----------------
// There aren't
\define('_AM_WGLINKS_THEREARENT_CATS', "There aren't categories");
\define('_AM_WGLINKS_THEREARENT_LINKS', "There aren't links");
// Save/Delete
\define('_AM_WGLINKS_FORM_OK', 'Successfully saved');
\define('_AM_WGLINKS_FORM_DELETE_OK', 'Successfully deleted');
\define('_AM_WGLINKS_FORM_SURE_DELETE', "Are you sure to delete: <b><span style='color : Red;'>%s </span></b>");
\define('_AM_WGLINKS_FORM_SURE_RENEW', "Are you sure to update: <b><span style='color : Red;'>%s </span></b>");
// Buttons
\define('_AM_WGLINKS_ADD_CAT', 'Add New Category');
\define('_AM_WGLINKS_ADD_LINK', 'Add New Link');
// Lists
\define('_AM_WGLINKS_CATS_LIST', 'List of Categorie');
\define('_AM_WGLINKS_LINKS_LIST', 'List of Links');
// ---------------- Admin Classes ----------------
\define('_AM_WGLINKS_STATE_OFFLINE', 'Offline');
\define('_AM_WGLINKS_STATE_ONLINE', 'Online');
// Category add/edit
\define('_AM_WGLINKS_CAT_ADD', 'Add Category');
\define('_AM_WGLINKS_CAT_EDIT', 'Edit Category');
// Elements of Category
\define('_AM_WGLINKS_CAT', 'Category');
\define('_AM_WGLINKS_CAT_ID', 'Id');
\define('_AM_WGLINKS_CAT_NAME', 'Name');
\define('_AM_WGLINKS_CAT_DESC', 'Description');
\define('_AM_WGLINKS_CAT_LOGO', 'Logo');
// Link add/edit
\define('_AM_WGLINKS_LINK_ADD', 'Add Link');
\define('_AM_WGLINKS_LINK_EDIT', 'Edit Link');
// Elements of Link
\define('_AM_WGLINKS_LINK_ID', 'Id');
\define('_AM_WGLINKS_LINK_NAME', 'Name');
\define('_AM_WGLINKS_LINK_URL', 'Url');
\define('_AM_WGLINKS_LINK_TOOLTIP', 'Tooltip');
\define('_AM_WGLINKS_LINK_DETAIL', 'Detailbeschreibung');
\define('_AM_WGLINKS_LINK_CONTACT', 'Kontakt');
\define('_AM_WGLINKS_LINK_EMAIL', 'e-Mail');
\define('_AM_WGLINKS_LINK_PHONE', 'Telefon');
\define('_AM_WGLINKS_LINK_ADDRESS', 'Adresse');
\define('_AM_WGLINKS_LINK_LOGO', 'Logo');
\define('_AM_WGLINKS_LINK_STATE', 'State');
// General
\define('_AM_WGLINKS_WEIGHT', 'Weight');
\define('_AM_WGLINKS_SUBMITTER', 'Submitter');
\define('_AM_WGLINKS_DATE_CREATED', 'Date created');
\define('_AM_WGLINKS_FORM_UPLOAD', 'Upload file');
\define('_AM_WGLINKS_FORM_IMAGE_PATH', 'Files in %s ');
\define('_AM_WGLINKS_FORM_ACTION', 'Action');
\define('_AM_WGLINKS_FORM_EDIT', 'Modification');
\define('_AM_WGLINKS_FORM_DELETE', 'Clear');
\define('_AM_WGLINKS_FORM_UPLOAD_IMAGE_LINKS', 'Upload Logo:<br>- max. %w x %h pixels<br>- max. %b bytes<br>');
// ---------------- Admin Others ----------------
\define('_AM_WGLINKS_MAINTAINEDBY', ' is maintained by ');
if (!\defined('_ER_UP_NOFILE')) {
    \define('_ER_UP_NOFILE', 'No file for upload selected');
}
