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
 * @author         XOOPS on Wedega - Email:<info@email.com> - Website:<http://xoops.org>
 */
include \dirname(__DIR__, 2) . '/mainfile.php';
include __DIR__ .'/include/common.php';
$dirname  = \basename(__DIR__);
$moduleDirNameUpper = \mb_strtoupper($dirname);

// Get instance of module
$helper = \XoopsModules\Wglinks\Helper::getInstance();
$linksHandler = $helper->getHandler('Link');
// Breadcrumbs
$xoBreadcrumbs = [];
if ($helper->getConfig('show_breadcrumbs') && $helper->getConfig('show_bcrumb_mname')) {
    if ( isset($GLOBALS['xoopsModule']) && \is_object($GLOBALS['xoopsModule'])) { // necessary to check, otherwise uploader runs into errors
        $xoBreadcrumbs[] = ['title' => $GLOBALS['xoopsModule']->getVar('name'), 'link' => \WGLINKS_URL . '/'];
    }
}
// Permission
include_once \XOOPS_ROOT_PATH .'/class/xoopsform/grouppermform.php';
$gpermHandler = \xoops_getHandler('groupperm');
if(\is_object($xoopsUser)) {
    $groups  = $xoopsUser->getGroups();
} else {
    $groups  = \XOOPS_GROUP_ANONYMOUS;
}
// 
$myts = MyTextSanitizer::getInstance();
// Default Css Style
$style = \WGLINKS_URL . '/assets/css/style.css';
if(!\file_exists($style)) {
    return false;
}
// Smarty Default
$sysPathIcon16 = $GLOBALS['xoopsModule']->getInfo('sysicons16');
$sysPathIcon32 = $GLOBALS['xoopsModule']->getInfo('sysicons32');
$pathModuleAdmin = $GLOBALS['xoopsModule']->getInfo('dirmoduleadmin');
$modPathIcon16 = $GLOBALS['xoopsModule']->getInfo('modicons16');
$modPathIcon32 = $GLOBALS['xoopsModule']->getInfo('modicons16');
// Load Languages
\xoops_loadLanguage('main');
\xoops_loadLanguage('modinfo');
