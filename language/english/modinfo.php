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
\define('_MI_WGLINKS_DESC', 'This module shows a block with registered links');
// ---------------- Admin Menu ----------------
\define('_MI_WGLINKS_ADMENU1', 'Dashboard');
\define('_MI_WGLINKS_ADMENU2', 'Categories');
\define('_MI_WGLINKS_ADMENU3', 'Links');
\define('_MI_WGLINKS_ADMENU20', 'Clone');
\define('_MI_WGLINKS_ADMENU21', 'Feedback');
\define('_MI_WGLINKS_ABOUT', 'About');
// ---------------- Admin Nav ----------------
\define('_MI_WGLINKS_ADMIN_PAGER', 'List items admin pages');
\define('_MI_WGLINKS_ADMIN_PAGER_DESC', 'Define the number of list items in the admin area');
// User
\define('_MI_WGLINKS_USER_PAGER', 'List items user pages');
\define('_MI_WGLINKS_USER_PAGER_DESC', 'Define the number of list items in the user area');
// Submenu
// Blocks
\define('_MI_WGLINKS_BLINKS_DEFAULT', 'Default links block');
\define('_MI_WGLINKS_BLINKS_DEFAULT_DESC', 'Show block with registered links');
\define('_MI_WGLINKS_BLINKS_LOGOCHAIN', 'Logo chain block');
\define('_MI_WGLINKS_BLINKS_LOGOCHAIN_DESC', 'Show block with all logos of registered links as a chain');
// Config
\define('_MI_WGLINKS_EDITOR', 'Editor');
\define('_MI_WGLINKS_EDITOR_DESC', 'Select the Editor Desc to use');
\define('_MI_WGLINKS_MIMETYPES', 'Mime Types');
\define('_MI_WGLINKS_MIMETYPES_DESC', 'Set the mime types selected');
\define('_MI_WGLINKS_MAXSIZE', 'Max file size');
\define('_MI_WGLINKS_MAXSIZE_DESC', 'Set a number of max size for uploads file in byte');
\define('_MI_WGLINKS_MAXSIZE_MB', 'MB');
\define('_MI_WGLINKS_MAXWIDTH', 'Maximum width upload');
\define('_MI_WGLINKS_MAXWIDTH_DESC', 'Set the max width which is allowed for uploading images (in pixel)');
\define('_MI_WGLINKS_MAXHEIGHT', 'Maximum height upload');
\define('_MI_WGLINKS_MAXHEIGHT_DESC', 'Set the max height which is allowed for uploading images (in pixel)');
\define('_MI_WGLINKS_MAXWIDTH_LARGE', 'Maximum width large image');
\define('_MI_WGLINKS_MAXWIDTH_LARGE_DESC', 'Set the max width to which uploaded images should be scaled (in pixel)<br>0 means, that large images keeps the original size. <br>If an image is smaller than maximum value then the image will be not enlarge, it will be save in original size.');
\define('_MI_WGLINKS_MAXHEIGHT_LARGE', 'Maximum height large image');
\define('_MI_WGLINKS_MAXHEIGHT_LARGE_DESC', 'Set the max height to which uploaded images should be scaled (in pixel)<br>0 means, that large images keeps the original size. <br>If an image is smaller than maximum value then the image will be not enlarge, it will be save in original size.');
\define('_MI_WGLINKS_MAXWIDTH_THUMBS', 'Maximum width thumbs');
\define('_MI_WGLINKS_MAXWIDTH_THUMBS_DESC', 'Set the max width to which uploaded images will be scaled for thumbs (in pixel)');
\define('_MI_WGLINKS_MAXHEIGHT_THUMBS', 'Maximum height thumbs');
\define('_MI_WGLINKS_MAXHEIGHT_THUMBS_DESC', 'Set the max height to which uploaded images should be scaled for thumbs (in pixel)');
\define('_MI_WGLINKS_SHOWBCRUMBS', 'Show breadcrumb navigation');
\define('_MI_WGLINKS_SHOWBCRUMBS_DESC', "Breadcrumb navigation displays the current page's context within the site structure.");
\define('_MI_WGLINKS_SHOWBCRUMBS_MNAME', 'Show module name');
\define('_MI_WGLINKS_SHOWBCRUMBS_MNAME_DESC', 'Show the module name in breadcrumb navigation');
\define('_MI_WGLINKS_SHOWCOPYRIGHT', 'Show copyright');
\define('_MI_WGLINKS_SHOWCOPYRIGHT_DESC', 'You can remove the copyright from the gallery, but a backlinks to www.wedega.com is expected, anywhere on your site');
\define('_MI_WGLINKS_INDEXHEADER', 'Header Index');
\define('_MI_WGLINKS_INDEXHEADER_DESC', 'Please define the header for the module index page');
\define('_MI_WGLINKS_INDEXINFO', 'Info Index');
\define('_MI_WGLINKS_INDEXINFO_DESC', 'Please type in the info, which should be shown on your module index page');
\define('_MI_WGLINKS_INDEXSTYLE', 'Index style');
\define('_MI_WGLINKS_INDEXSTYLE_DESC', 'Please define in which style the links should be shown on the module index page');
\define('_MI_WGLINKS_TITLESTYLE', 'Title style');
\define('_MI_WGLINKS_TITLESTYLE_DESC', 'Please define in which style the titles of the detail infos should be shown on the user page');
\define('_MI_WGLINKS_TITLESTYLE_TEXT', 'as Text');
\define('_MI_WGLINKS_TITLESTYLE_GLYPH', 'as glyphicons');
\define('_MI_WGLINKS_MAINTAINEDBY', ' is maintained by ');
// ---------------- End ----------------