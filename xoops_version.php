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
 * @version        $Id: 1.0 xoops_version.php 13070 Sun 2016-03-20 15:20:15Z XOOPS Development Team $
 */
// 

$moduleDirName      = \basename(__DIR__);
$moduleDirNameUpper = \mb_strtoupper($moduleDirName);

// ------------------- Informations ------------------- //
$modversion['name']                = \_MI_WGLINKS_NAME;
$modversion['version']             = '1.1.1';
$modversion['module_status']       = 'RC1';
$modversion['description']         = \_MI_WGLINKS_DESC;
$modversion['author']              = 'XOOPS on Wedega';
$modversion['author_mail']         = 'webmaster@wedega.com';
$modversion['author_website_url']  = 'http://xoops.org';
$modversion['author_website_name'] = 'XOOPS Project';
$modversion['credits']             = 'XOOPS Development Team';
$modversion['license']             = 'GPL 2.0 or later';
$modversion['license_url']         = 'www.gnu.org/licenses/gpl-2.0.html/';
$modversion['help']                = 'page=help';
$modversion['release_info']        = 'release_info';
$modversion['release_file']        = \XOOPS_URL . '/modules/wglinks/docs/release_info file';
$modversion['release_date']        = '2023/03/14'; // format: yyyy/mm/dd
$modversion['manual']              = 'link to manual file';
$modversion['manual_file']         = \XOOPS_URL . '/modules/wglinks/docs/install.txt';
$modversion['min_php']             = '7.4';
$modversion['min_xoops']           = '2.5.11 Stable';
$modversion['min_admin']           = '1.1';
$modversion['min_db']              = ['mysql' => '5.0.7', 'mysqli' => '5.0.7'];
$modversion['image']               = 'assets/images/wglinks_logo.png';
$modversion['dirname']             = $moduleDirName;
$modversion['dirmoduleadmin']      = 'Frameworks/moduleclasses/moduleadmin';
$modversion['sysicons16']          = '../../Frameworks/moduleclasses/icons/16';
$modversion['sysicons32']          = '../../Frameworks/moduleclasses/icons/32';
$modversion['modicons16']          = 'assets/icons/16';
$modversion['modicons32']          = 'assets/icons/32';
$modversion['demo_site_url']       = 'http://www.xoops.org';
$modversion['demo_site_name']      = 'XOOPS Demo Site';
$modversion['support_url']         = 'http://xoops.org/modules/newbb';
$modversion['support_name']        = 'Support Forum';
$modversion['module_website_url']  = 'www.xoops.org';
$modversion['module_website_name'] = 'XOOPS Project';
$modversion['release']             = '2023-03-14';
$modversion['system_menu']         = 1;
$modversion['hasAdmin']            = 1;
$modversion['hasMain']             = 1;
$modversion['adminindex']          = 'admin/index.php';
$modversion['adminmenu']           = 'admin/menu.php';
$modversion['onInstall']           = 'include/install.php';
$modversion['onUpdate']            = 'include/update.php';
$modversion['onUninstall']         = 'include/onuninstall.php';
// ------------------- Templates ------------------- //
// Admin
$modversion['templates'][] = ['file' => 'wglinks_admin_about.tpl', 'description' => '', 'type' => 'admin'];
$modversion['templates'][] = ['file' => 'wglinks_admin_header.tpl', 'description' => '', 'type' => 'admin'];
$modversion['templates'][] = ['file' => 'wglinks_admin_index.tpl', 'description' => '', 'type' => 'admin'];
$modversion['templates'][] = ['file' => 'wglinks_admin_category.tpl', 'description' => '', 'type' => 'admin'];
$modversion['templates'][] = ['file' => 'wglinks_admin_link.tpl', 'description' => '', 'type' => 'admin'];
$modversion['templates'][] = ['file' => 'wglinks_admin_clone.tpl', 'description' => '', 'type' => 'admin'];
$modversion['templates'][] = ['file' => 'wglinks_admin_footer.tpl', 'description' => '', 'type' => 'admin'];
// User
$modversion['templates'][] = ['file' => 'wglinks_header.tpl', 'description' => ''];
$modversion['templates'][] = ['file' => 'wglinks_index.tpl', 'description' => ''];
$modversion['templates'][] = ['file' => 'wglinks_link_default.tpl', 'description' => ''];
$modversion['templates'][] = ['file' => 'wglinks_link_cards.tpl', 'description' => ''];
$modversion['templates'][] = ['file' => 'wglinks_block_link_default.tpl', 'description' => ''];
$modversion['templates'][] = ['file' => 'wglinks_block_link_cards.tpl', 'description' => ''];
$modversion['templates'][] = ['file' => 'wglinks_breadcrumb.tpl', 'description' => ''];
$modversion['templates'][] = ['file' => 'wglinks_footer.tpl', 'description' => ''];
// ------------------- Mysql ------------------- //
$modversion['sqlfile']['mysql'] = 'sql/mysql.sql';
// Tables
$modversion['tables'][1] = 'wglinks_links';
$modversion['tables'][2] = 'wglinks_categories';
// ------------------- Blocks ------------------- //
// Blocks
$modversion['blocks'][] = [
    'file'        => 'link.php',
    'name'        => \_MI_WGLINKS_BLINKS_DEFAULT,
    'description' => \_MI_WGLINKS_BLINKS_DEFAULT_DESC,
    'show_func'   => 'b_wglinks_links_show',
    'edit_func'   => 'b_wglinks_links_edit',
    'template'    => 'wglinks_block_link.tpl',
    'options'     => 'default|default|10|100|50|default|0'
];
$modversion['blocks'][] = [
    'file'        => 'link.php',
    'name'        => \_MI_WGLINKS_BLINKS_LOGOCHAIN,
    'description' => \_MI_WGLINKS_BLINKS_LOGOCHAIN_DESC,
    'show_func'   => 'b_wglinks_links_show',
    'edit_func'   => 'b_wglinks_links_edit',
    'template'    => 'wglinks_block_link_logochain.tpl',
    'options'     => 'logochain|default|10|100|50|default|0'
];

// ------------------- Config ------------------- /
// Editor desc
\xoops_load('xoopseditorhandler');
$editorHandlerDesc      = \XoopsEditorHandler::getInstance();
$modversion['config'][] = [
    'name'        => 'editor',
    'title'       => '\_MI_WGLINKS_EDITOR',
    'description' => '\_MI_WGLINKS_EDITOR_DESC',
    'formtype'    => 'select',
    'valuetype'   => 'text',
    'default'     => 'dhtml',
    'options'     => \array_flip($editorHandlerDesc->getList())
];
// Uploads : mimetypes of image
$modversion['config'][] = [
    'name'        => 'mimetypes',
    'title'       => '\_MI_WGLINKS_MIMETYPES',
    'description' => '\_MI_WGLINKS_MIMETYPES_DESC',
    'formtype'    => 'select_multi',
    'valuetype'   => 'array',
    'default'     => ['image/gif', 'image/jpg', 'image/jpeg', 'image/png'],
    'options'     => ['bmp' => 'image/bmp', 'gif' => 'image/gif', 'pjpeg' => 'image/pjpeg', 'jpeg' => 'image/jpeg', 'jpg' => 'image/jpg', 'jpe' => 'image/jpe', 'png' => 'image/png']
];
// Uploads : maxsize of image
$optionMaxsize = 0;
require_once __DIR__ . '/include/xoops_version.inc.php';
$iniPostMaxSize = wgLinksReturnBytes(\ini_get('post_max_size'));
$iniUploadMaxFileSize = wgLinksReturnBytes(\ini_get('upload_max_filesize'));
$maxSize              = min($iniPostMaxSize, $iniUploadMaxFileSize);
if ($maxSize > 10000 * 1048576) {
    $increment = 500;
}
if ($maxSize <= 10000 * 1048576) {
    $increment = 200;
}
if ($maxSize <= 5000 * 1048576) {
    $increment = 100;
}
if ($maxSize <= 2500 * 1048576) {
    $increment = 50;
}
if ($maxSize <= 1000 * 1048576) {
    $increment = 10;
}
if ($maxSize <= 500 * 1048576) {
    $increment = 5;
}
if ($maxSize <= 100 * 1048576) {
    $increment = 2;
}
if ($maxSize <= 50 * 1048576) {
    $increment = 1;
}
if ($maxSize <= 25 * 1048576) {
    $increment = 0.5;
}
$optionMaxsize = [];
$i = $increment;
while ($i * 1048576 <= $maxSize) {
    $optionMaxsize[$i . ' ' . \_MI_WGLINKS_MAXSIZE_MB] = $i * 1048576;
    $i += $increment;
}
$modversion['config'][] = [
    'name'        => 'maxsize',
    'title'       => '\_MI_WGLINKS_MAXSIZE',
    'description' => '\_MI_WGLINKS_MAXSIZE_DESC',
    'formtype'    => 'select',
    'valuetype'   => 'int',
    'default'     => 3145728,
    'options'    => $optionMaxsize,
];
// Uploads : max width of images for upload
$modversion['config'][] = [
    'name'        => 'maxwidth',
    'title'       => '\_MI_WGLINKS_MAXWIDTH',
    'description' => '\_MI_WGLINKS_MAXWIDTH_DESC',
    'formtype'    => 'textbox',
    'valuetype'   => 'int',
    'default'     => 4000,
];
// Uploads : max height of images for upload
$modversion['config'][] = [
    'name'        => 'maxheight',
    'title'       => '\_MI_WGLINKS_MAXHEIGHT',
    'description' => '\_MI_WGLINKS_MAXHEIGHT_DESC',
    'formtype'    => 'textbox',
    'valuetype'   => 'int',
    'default'     => 4000,
];
// Uploads : max width for large images
$modversion['config'][] = [
    'name'        => 'maxwidth_large',
    'title'       => '\_MI_WGLINKS_MAXWIDTH_LARGE',
    'description' => '\_MI_WGLINKS_MAXWIDTH_LARGE_DESC',
    'formtype'    => 'textbox',
    'valuetype'   => 'int',
    'default'     => 2000,
];
// Uploads : max height for large images
$modversion['config'][] = [
    'name'        => 'maxheight_large',
    'title'       => '\_MI_WGLINKS_MAXHEIGHT_LARGE',
    'description' => '\_MI_WGLINKS_MAXHEIGHT_LARGE_DESC',
    'formtype'    => 'textbox',
    'valuetype'   => 'int',
    'default'     => 2000,
];
// Uploads : max width for thumbs
$modversion['config'][] = [
    'name'        => 'maxwidth_thumbs',
    'title'       => '\_MI_WGLINKS_MAXWIDTH_THUMBS',
    'description' => '\_MI_WGLINKS_MAXWIDTH_THUMBS_DESC',
    'formtype'    => 'textbox',
    'valuetype'   => 'int',
    'default'     => 200,
];
// Uploads : max height for thumbs
$modversion['config'][] = [
    'name'        => 'maxheight_thumbs',
    'title'       => '\_MI_WGLINKS_MAXHEIGHT_THUMBS',
    'description' => '\_MI_WGLINKS_MAXHEIGHT_THUMBS_DESC',
    'formtype'    => 'textbox',
    'valuetype'   => 'int',
    'default'     => 200,
];
// Admin pager
$modversion['config'][] = [
    'name'        => 'adminpager',
    'title'       => '\_MI_WGLINKS_ADMIN_PAGER',
    'description' => '\_MI_WGLINKS_ADMIN_PAGER_DESC',
    'formtype'    => 'textbox',
    'valuetype'   => 'int',
    'default'     => 10,
];
// User pager
$modversion['config'][] = [
    'name'        => 'userpager',
    'title'       => '\_MI_WGLINKS_USER_PAGER',
    'description' => '\_MI_WGLINKS_USER_PAGER_DESC',
    'formtype'    => 'textbox',
    'valuetype'   => 'int',
    'default'     => 10,
];
// Show breadcrumb
$modversion['config'][] = [
    'name'        => 'show_breadcrumbs',
    'title'       => '\_MI_WGLINKS_SHOWBCRUMBS',
    'description' => '\_MI_WGLINKS_SHOWBCRUMBS_DESC',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 1,
];
// Show module name
$modversion['config'][] = [
    'name'        => 'show_bcrumb_mname',
    'title'       => '\_MI_WGLINKS_SHOWBCRUMBS_MNAME',
    'description' => '\_MI_WGLINKS_SHOWBCRUMBS_MNAME_DESC',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 1,
];
// Maintained by
$modversion['config'][] = [
    'name'        => 'maintainedby',
    'title'       => '\_MI_WGLINKS_MAINTAINEDBY',
    'description' => '',
    'formtype'    => 'textbox',
    'valuetype'   => 'text',
    'default'     => 'https://xoops.wedega.com',
];
// Show copyright
$modversion['config'][] = [
    'name'        => 'show_copyright',
    'title'       => '\_MI_WGLINKS_SHOWCOPYRIGHT',
    'description' => '\_MI_WGLINKS_SHOWCOPYRIGHT_DESC',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 1,
];
// text for header index page
$modversion['config'][] = [
    'name'        => 'index_header',
    'title'       => '\_MI_WGLINKS_INDEXHEADER',
    'description' => '\_MI_WGLINKS_INDEXHEADER_DESC',
    'formtype'    => 'textbox',
    'valuetype'   => 'text',
    'default'     => \_MI_WGLINKS_INDEXHEADER,
];
// text for info index page
$modversion['config'][] = [
    'name'        => 'index_info',
    'title'       => '\_MI_WGLINKS_INDEXINFO',
    'description' => '\_MI_WGLINKS_INDEXINFO_DESC',
    'formtype'    => 'textbox',
    'valuetype'   => 'text',
    'default'     => \_MI_WGLINKS_INDEXINFO,
];
// style for index page
$modversion['config'][] = [
    'name'        => 'index_style',
    'title'       => '\_MI_WGLINKS_INDEXSTYLE',
    'description' => '\_MI_WGLINKS_INDEXSTYLE_DESC',
    'formtype'    => 'select',
    'valuetype'   => 'text',
    'default'     => 'default',
    'options'    => ['default' => 'default', '2 cards' => '2cards', '3 cards' => '3cards', '4 cards' => '4cards'],
];
// title style
$modversion['config'][] = [
    'name'        => 'title_style',
    'title'       => '\_MI_WGLINKS_TITLESTYLE',
    'description' => '\_MI_WGLINKS_TITLESTYLE_DESC',
    'formtype'    => 'select',
    'valuetype'   => 'text',
    'default'     => 'text',
    'options'    => [\_MI_WGLINKS_TITLESTYLE_TEXT => 'text', \_MI_WGLINKS_TITLESTYLE_GLYPH => 'glyphicons'],
];
/**
 * Make Sample button visible?
 */
$modversion['config'][] = [
    'name'        => 'displaySampleButton',
    'title'       => 'CO_' . $moduleDirNameUpper . '_' . 'SHOW_SAMPLE_BUTTON',
    'description' => 'CO_' . $moduleDirNameUpper . '_' . 'SHOW_SAMPLE_BUTTON_DESC',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 1,
];

/**
 * Show Developer Tools?
 */
/* $modversion['config'][] = [
    'name'        => 'displayDeveloperTools',
    'title'       => 'CO_' . $moduleDirNameUpper . '_' . 'SHOW_DEV_TOOLS',
    'description' => 'CO_' . $moduleDirNameUpper . '_' . 'SHOW_DEV_TOOLS_DESC',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 0,
]; */
