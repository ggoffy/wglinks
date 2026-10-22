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

use Xmf\Request;

include __DIR__ . '/header.php';
$GLOBALS['xoopsOption']['template_main'] = 'wglinks_index.tpl';
include_once \XOOPS_ROOT_PATH .'/header.php';

$op        = Request::getString('op', 'list');
$linkId    = Request::getInt('link_id');
$linkCatId = Request::getInt('link_catid');
$catIds    = Request::getString('cat_ids', '0');
$start     = Request::getInt('start');
$limit     = Request::getInt('limit', $helper->getConfig('userpager'));

// Define Stylesheet
$GLOBALS['xoTheme']->addStylesheet( $style, null );
// 
$GLOBALS['xoopsTpl']->assign('xoops_icons32_url', XOOPS_ICONS32_URL);
$GLOBALS['xoopsTpl']->assign('wglinks_url', \WGLINKS_URL);
$GLOBALS['xoopsTpl']->assign('index_header', $helper->getConfig('index_header'));
$GLOBALS['xoopsTpl']->assign('index_info',   $helper->getConfig('index_info'));
$GLOBALS['xoopsTpl']->assign('index_style',  $helper->getConfig('index_style'));
$GLOBALS['xoopsTpl']->assign('title_style',  $helper->getConfig('title_style'));
$GLOBALS['xoopsTpl']->assign('admin', \WGLINKS_URL . '/admin/index.php');

$crLinks = new \CriteriaCompo();
$crLinks->add(new \Criteria('link_state', 1));
if ( 0 < $linkId ) {
    $crLinks->add(new \Criteria('link_id', $linkId));
    $GLOBALS['xoopsTpl']->assign('1card', true);
}
if ( 0 < $linkCatId ) {
    $crLinks->add(new \Criteria('link_catid', $linkCatId));
}
if (!str_starts_with($catIds, '0')) {
    $crLinks->add(new \Criteria('link_catid', '(' . $catIds . ')', 'IN'));
}
$crLinks->setStart( $start );
$crLinks->setLimit( $limit );
$crLinks->setSort('link_catid ASC, link_weight ASC, link_id');
$crLinks->setOrder('ASC');
$linksCount = $linksHandler->getCount($crLinks);

$keywords = [];
$links    = [];

if($linksCount > 0) {
    $linksAll = $linksHandler->getAll($crLinks);
    // Get All Link
    foreach(\array_keys($linksAll) as $i) {
        $links[] = $linksAll[$i]->getValuesLinks();
        $keywords[] = $linksAll[$i]->getVar('link_name');
    }
    // Display Navigation
    if($linksCount > $limit) {
        include_once \XOOPS_ROOT_PATH .'/class/pagenav.php';
        $pagenav = new \XoopsPageNav($linksCount, $limit, $start, 'start', 'op=list&limit=' . $limit);
        $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav());
    }
}

$GLOBALS['xoopsTpl']->append('links_list', $links);
unset($links);
unset($count);
// Breadcrumbs
if ($helper->getConfig('show_breadcrumbs')) {
    $xoBreadcrumbs[] = ['title' => \_MA_WGLINKS_INDEX];
    $GLOBALS['xoopsTpl']->assign('show_breadcrumbs', true);
}

// Keywords
wglinksMetaKeywords($helper->getConfig('keywords').', '. \implode(',', $keywords));
unset($keywords);
// Description
wglinksMetaDescription(\_MA_WGLINKS_INDEX_DESC);
$GLOBALS['xoopsTpl']->assign('xoops_mpageurl', \WGLINKS_URL.'/index.php');
$GLOBALS['xoopsTpl']->assign('xoops_icons32_url', XOOPS_ICONS32_URL);
$GLOBALS['xoopsTpl']->assign('wglinks_upload_url', \WGLINKS_UPLOAD_URL);
include __DIR__ . '/footer.php';
