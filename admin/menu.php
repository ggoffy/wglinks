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
 * @version        $Id: 1.0 menu.php 13070 Sun 2016-03-20 15:20:14Z XOOPS Development Team $
 */
$dirname = \basename(\dirname(__DIR__));
$moduleHandler = \xoops_getHandler('module');
$xoopsModule = \XoopsModule::getByDirname($dirname);
$moduleInfo = $moduleHandler->get($xoopsModule->getVar('mid'));
$sysPathIcon32 = $moduleInfo->getInfo('sysicons32');

$adminmenu[] = [
    'title' => \_MI_WGLINKS_ADMENU1,
    'link' => 'admin/index.php',
    'icon' => 'assets/icons/32/dashboard.png',
];
$adminmenu[] = [
    'title' => \_MI_WGLINKS_ADMENU2,
    'link' => 'admin/category.php',
    'icon' => 'assets/icons/32/category.png',
];
$adminmenu[] = [
    'title' => \_MI_WGLINKS_ADMENU3,
    'link' => 'admin/link.php',
    'icon' => 'assets/icons/32/link.png',
];
$adminmenu[] = [
    'title' => \_MI_WGLINKS_ADMENU20,
    'link' => 'admin/clone.php',
    'icon' => 'assets/icons/32/clone.png',
];
$adminmenu[] = [
    'title' => \_MI_WGLINKS_ADMENU21,
    'link' => 'admin/feedback.php',
    'icon' => 'assets/icons/32/feedback.png',
];
$adminmenu[] = [
    'title' => \_MI_WGLINKS_ABOUT,
    'link' => 'admin/about.php',
    'icon' => 'assets/icons/32/about.png',
];
