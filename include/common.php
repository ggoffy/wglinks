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

if (!\defined('WGLINKS_MODULE_PATH')) {
    if (!\defined('XOOPS_ICONS32_PATH')) {
        \define('XOOPS_ICONS32_PATH', \XOOPS_ROOT_PATH . '/Frameworks/moduleclasses/icons/32');
    }
    if (!\defined('XOOPS_ICONS32_URL')) {
        \define('XOOPS_ICONS32_URL', \XOOPS_URL . '/Frameworks/moduleclasses/icons/32');
    }
    \define('WGLINKS_DIRNAME', 'wglinks');
    \define('WGLINKS_PATH', \XOOPS_ROOT_PATH.'/modules/'.\WGLINKS_DIRNAME);
    \define('WGLINKS_URL', \XOOPS_URL.'/modules/'.\WGLINKS_DIRNAME);
    \define('WGLINKS_ICONS_PATH', \WGLINKS_PATH.'/assets/icons');
    \define('WGLINKS_ICONS_URL', \WGLINKS_URL.'/assets/icons');
    \define('WGLINKS_IMAGE_PATH', \WGLINKS_PATH.'/assets/images');
    \define('WGLINKS_IMAGE_URL', \WGLINKS_URL.'/assets/images');
    \define('WGLINKS_UPLOAD_PATH', XOOPS_UPLOAD_PATH.'/'.\WGLINKS_DIRNAME);
    \define('WGLINKS_UPLOAD_URL', XOOPS_UPLOAD_URL.'/'.\WGLINKS_DIRNAME);
    \define('WGLINKS_UPLOAD_IMAGE_PATH', \WGLINKS_UPLOAD_PATH.'/images');
    \define('WGLINKS_UPLOAD_IMAGE_URL', \WGLINKS_UPLOAD_PATH.'/images');
    \define('WGLINKS_ADMIN', \WGLINKS_URL . '/admin/index.php');
}
// module information
$copyright = "<a href='https://xoops.wedega.com' title='XOOPS on Wedega' target='_blank'>
                     <img src='" . \WGLINKS_IMAGE_URL . "/wedega_logo.png' alt='XOOPS on Wedega' /></a>";

// include_once \XOOPS_ROOT_PATH.'/class/xoopsrequest.php';
include_once \WGLINKS_PATH.'/class/Helper.php';
include_once \WGLINKS_PATH.'/include/functions.php';