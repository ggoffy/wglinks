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

use XoopsModules\Wglinks;

include \dirname(__DIR__) . '/preloads/autoloader.php';
include \dirname(__DIR__, 3) . '/include/cp_header.php';
include_once \dirname(__DIR__) .'/include/common.php';

$sysPathIcon16  = '../' . $GLOBALS['xoopsModule']->getInfo('sysicons16');
$sysPathIcon32  = '../' . $GLOBALS['xoopsModule']->getInfo('sysicons32');
$pathModuleAdmin  = $GLOBALS['xoopsModule']->getInfo('dirmoduleadmin');
$modPathIcon16  = $GLOBALS['xoopsModule']->getInfo('modicons16');
$modPathIcon32  = $GLOBALS['xoopsModule']->getInfo('modicons32');
// Get instance of module
$helper = \XoopsModules\Wglinks\Helper::getInstance();
$utility = new \XoopsModules\Wglinks\Utility();
$categoriesHandler = $helper->getHandler('Category');
$linksHandler = $helper->getHandler('Link');
$myts = MyTextSanitizer::getInstance();
// 
if(!isset($xoopsTpl) || !\is_object($xoopsTpl)) {
include_once \XOOPS_ROOT_PATH .'/class/template.php';
    $xoopsTpl = new \XoopsTpl();
}
// System icons path
$GLOBALS['xoopsTpl']->assign('sysPathIcon16', $sysPathIcon16);
$GLOBALS['xoopsTpl']->assign('sysPathIcon32', $sysPathIcon32);
$GLOBALS['xoopsTpl']->assign('modPathIcon16', $modPathIcon16);
$GLOBALS['xoopsTpl']->assign('modPathIcon32', $modPathIcon32);
// Load languages
//\xoops_loadLanguage('admin');
\xoops_loadLanguage('modinfo', 'wglinks');
\xoops_loadLanguage('main', 'wglinks');

\xoops_cp_header();
$adminObject = \Xmf\Module\Admin::getInstance();
