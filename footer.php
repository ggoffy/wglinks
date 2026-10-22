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
if(\count($xoBreadcrumbs) > 0 && $helper->getConfig('show_breadcrumbs')) {
    $GLOBALS['xoopsTpl']->assign('xoBreadcrumbs', $xoBreadcrumbs);
}
$GLOBALS['xoopsTpl']->assign('adv', $helper->getConfig('advertise'));
// 
$GLOBALS['xoopsTpl']->assign('bookmarks', $helper->getConfig('bookmarks'));
$GLOBALS['xoopsTpl']->assign('fbcomments', $helper->getConfig('fbcomments'));
//
if ( $helper->getConfig('show_copyright') ) {
    $GLOBALS['xoopsTpl']->assign('copyright', $copyright);
}
// 
include_once \XOOPS_ROOT_PATH .'/footer.php';
