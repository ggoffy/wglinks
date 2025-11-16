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

use Xmf\Request;

include __DIR__ . '/header.php';
// It recovered the value of argument op in URL$
$op = Request::getString('op', 'list');
// Request link_id
$linkId = Request::getInt('link_id');
$start  = Request::getInt('start');
$limit  = Request::getInt('limit');

switch($op) {
    case 'list':
    default:
        $GLOBALS['xoTheme']->addScript(\WGLINKS_URL . '/assets/js/jquery.js');
        $GLOBALS['xoTheme']->addScript(\WGLINKS_URL . '/assets/js/jquery-ui.js');
        $GLOBALS['xoTheme']->addScript(\WGLINKS_URL . '/assets/js/sortable-links.js');
        $start = Request::getInt('start');
        $limit = Request::getInt('limit', $helper->getConfig('adminpager'));
        $templateMain = 'wglinks_admin_link.tpl';
        $GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('link.php'));
        $adminObject->addItemButton(\_AM_WGLINKS_ADD_LINK, 'link.php?op=new');
        $GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
        $linksCount = $linksHandler->getCountLinks();
        $linksAll = $linksHandler->getAllLinks($start, $limit);
        $GLOBALS['xoopsTpl']->assign('links_count', $linksCount);
        $GLOBALS['xoopsTpl']->assign('wglinks_url', \WGLINKS_URL);
        $GLOBALS['xoopsTpl']->assign('wglinks_upload_url', \WGLINKS_UPLOAD_URL);
        // Table view links
        if($linksCount > 0) {
            $cat_id_prev = 0;
            foreach(\array_keys($linksAll) as $i) {
                $link = $linksAll[$i]->getValuesLinks();
                if ($cat_id_prev == $link['catid']) {
                    $link['new_cat'] = 0;
                } else {
                    $link['new_cat'] = 1;
                    $cat_id_prev = $link['catid'];
                }
                $GLOBALS['xoopsTpl']->append('links_list', $link);
                unset($link);
            }
            $GLOBALS['xoopsTpl']->assign('start', $start);
            $GLOBALS['xoopsTpl']->assign('limit', $limit);
            // Display Navigation
            if($linksCount > $limit) {
                include_once \XOOPS_ROOT_PATH .'/class/pagenav.php';
                $pagenav = new \XoopsPageNav($linksCount, $limit, $start, 'start', 'op=list&limit=' . $limit);
                $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav());
            }
        } else {
            $GLOBALS['xoopsTpl']->assign('error', \_AM_WGLINKS_THEREARENT_LINKS);
        }

    break;
    case 'new':
        $templateMain = 'wglinks_admin_link.tpl';
        $GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('link.php'));
        $adminObject->addItemButton(\_AM_WGLINKS_LINKS_LIST, 'link.php', 'list');
        $GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
        // Get Form
        $linksObj = $linksHandler->create();
        $form = $linksObj->getFormLinks();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());

    break;
    case 'save':
        // Security Check
        if(!$GLOBALS['xoopsSecurity']->check()) {
            \redirect_header('link.php', 3, \implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
        }
        if(isset($linkId)) {
            $linksObj = $linksHandler->get($linkId);
        } else {
            $linksObj = $linksHandler->create();
        }
        // Set Vars
        $linksObj->setVar('link_catid', Request::getInt('link_catid'));
        $linksObj->setVar('link_name', Request::getString('link_name'));
        $linksObj->setVar('link_url', Request::getString('link_url'));
        $linksObj->setVar('link_tooltip', Request::getString('link_tooltip'));
        $linksObj->setVar('link_detail', Request::getString('link_detail'));
        $linksObj->setVar('link_contact', Request::getString('link_contact'));
        $linksObj->setVar('link_email', Request::getString('link_email'));
        $linksObj->setVar('link_phone', Request::getString('link_phone'));
        $linksObj->setVar('link_address', Request::getString('link_address'));
        $linksObj->setVar('link_weight', Request::getInt('link_weight'));
        // Set Var link_logo
        $fileName = $_FILES['attachedfile']['name'];
        if (\strlen($fileName) > 0) {
            $imageMimetype = $_FILES['attachedfile']['type'];
            include_once \XOOPS_ROOT_PATH .'/class/uploader.php';
            $uploader = new \XoopsMediaUploader(\WGLINKS_UPLOAD_IMAGE_PATH . '/links/large/', $helper->getConfig('mimetypes'), $helper->getConfig('maxsize'), null, null);
            if($uploader->fetchMedia($_POST['xoops_upload_file'][0])) {
                $extension = \preg_replace('/^.+\.([^.]+)$/sU', '', $fileName);
                $imgName = \str_replace(' ', '', Request::getString('link_name')) . '.' . $extension;
                $uploader->setPrefix($imgName);
                $uploader->fetchMedia($_POST['xoops_upload_file'][0]);
                if (!$uploader->upload()) {
                    $errors = $uploader->getErrors();
                    \redirect_header('javascript:history.go(-1)', 3, $errors);
                } else {
                    $savedFilename = $uploader->getSavedFileName();
                    $linksObj->setVar('link_logo', $savedFilename);
                    // resize image
                    include_once \XOOPS_ROOT_PATH . '/modules/wglinks/include/imagehandler.php';
                    // resize large image
                    $maxwidth = $helper->getConfig('maxwidth_large');
                    $maxheight = $helper->getConfig('maxheight_large');
                    $ret = ResizeImage(\WGLINKS_UPLOAD_IMAGE_PATH . '/links/large/' . $savedFilename, \WGLINKS_UPLOAD_IMAGE_PATH . '/links/large/' . $savedFilename, $maxwidth, $maxheight, $imageMimetype);
                    // resize thumb image
                    $maxwidth = $helper->getConfig('maxwidth_thumbs');
                    $maxheight = $helper->getConfig('maxheight_thumbs');
                    $ret = ResizeImage(\WGLINKS_UPLOAD_IMAGE_PATH . '/links/large/' . $savedFilename, \WGLINKS_UPLOAD_IMAGE_PATH . '/links/thumbs/' . $savedFilename, $maxwidth, $maxheight, $imageMimetype);
                }
            }
        } else {
                $linksObj->setVar('link_logo', Request::getString('link_logo'));
        }
        $linksObj->setVar('link_state', Request::getInt('link_state'));
        $linksObj->setVar('link_type', Request::getInt('link_type'));
        $linksObj->setVar('link_target', Request::getString('link_target'));
        $linksObj->setVar('link_submitter', Request::getInt('link_submitter'));
        $linksObj->setVar('link_date_created', \strtotime(Request::getString('link_date_created')));
        // Insert Data
        if($linksHandler->insert($linksObj)) {
            \redirect_header('link.php?op=list', 2, \_AM_WGLINKS_FORM_OK);
        }
        // Get Form
        $GLOBALS['xoopsTpl']->assign('error', $linksObj->getHtmlErrors());
        $form = $linksObj->getFormLinks();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());

    break;
    case 'edit':
        $templateMain = 'wglinks_admin_link.tpl';
        $GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('link.php'));
        $adminObject->addItemButton(\_AM_WGLINKS_ADD_LINK, 'link.php?op=new');
        $adminObject->addItemButton(\_AM_WGLINKS_LINKS_LIST, 'link.php', 'list');
        $GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
        // Get Form
        $linksObj = $linksHandler->get($linkId);
        $form = $linksObj->getFormLinks();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());

    break;
    case 'delete':
        $linksObj = $linksHandler->get($linkId);
        if(isset($_REQUEST['ok']) && 1 == $_REQUEST['ok']) {
            if(!$GLOBALS['xoopsSecurity']->check()) {
                \redirect_header('link.php', 3, \implode(', ', $GLOBALS['xoopsSecurity']->getErrors()));
            }
            if($linksHandler->delete($linksObj)) {
                \redirect_header('link.php', 3, \_AM_WGLINKS_FORM_DELETE_OK);
            } else {
                $GLOBALS['xoopsTpl']->assign('error', $linksObj->getHtmlErrors());
            }
        } else {
            xoops_confirm(['ok' => 1, 'link_id' => $linkId, 'op' => 'delete'], $_SERVER['REQUEST_URI'], \sprintf(\_AM_WGLINKS_FORM_SURE_DELETE, $linksObj->getVar('link_name')));
        }

    break;
    case 'order':
        $lorder = Request::getInt('lorder');
        for ($i = 0, $iMax = \count($lorder); $i < $iMax; $i++){
            $linksObj = $linksHandler->get($lorder[$i]);
            $linksObj->setVar('link_weight',$i+1);
            $linksHandler->insert($linksObj);
            unset($linksObj);
        }
        $linksAll = $linksHandler->getAllLinks();
        $cat_id_prev = 0;
        $j = 0;
        foreach(\array_keys($linksAll) as $i) {
            $link = $linksAll[$i]->getValuesLinks();
            if ($cat_id_prev == $link['catid']) {
                $j++;
            } else {
                $j = 1;
                $cat_id_prev = $link['catid'];
            }
            $linksObj = $linksHandler->get($link['id']);
            $linksObj->setVar('link_weight',$j);
            $linksHandler->insert($linksObj);
            unset($linksObj);
            unset($link);
            }
    break;
    case 'change_state':
        if(isset($linkId)) {
            $linksObj = $linksHandler->get($linkId);
            // Set Vars
            $linksObj->setVar('link_state', Request::getInt('link_state'));
            // Insert Data
            if($linksHandler->insert($linksObj)) {
                \redirect_header('link.php?op=list&amp;start=' . $start . '&amp;limit=' . $limit, 2, \_AM_WGLINKS_FORM_OK);
            }
            // Get Form
            $GLOBALS['xoopsTpl']->assign('error', $linksObj->getHtmlErrors());
        }
    break;
}
include __DIR__ . '/footer.php';
