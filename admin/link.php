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
use XoopsModules\Wglinks\Common\Resizer;

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
        $uploaderErrors = '';
        $linkFile = Request::getArray('attachedfile', [], 'FILES');
        $filename = $linkFile['name'];
        if ('' !== (string)$filename) {
            require_once \XOOPS_ROOT_PATH . '/class/uploader.php';
            $uploadFile0 = Request::getArray('xoops_upload_file')[0];
            $imgMimetype = $linkFile['type'];
            $imgNameDef = trim(preg_replace('/[^a-z0-9]+/', '-', \strtolower(Request::getString('link_name'))));
            if ('' === $imgNameDef) {
                $imgNameDef = 'image';
            }
            $uploader = new \XoopsMediaUploader(\WGLINKS_UPLOAD_IMAGE_PATH . '/links/large/',
                $helper->getConfig('mimetypes'),
                $helper->getConfig('maxsize'), null, null);
            if (!empty($uploadFile0) && $uploader->fetchMedia($uploadFile0)) {
                $uploader->setPrefix($imgNameDef);
                if ($uploader->upload()) {
                    $savedFilename = $uploader->getSavedFileName();
                    $maxwidth  = (int)$helper->getConfig('maxwidth_large');
                    $maxheight = (int)$helper->getConfig('maxheight_large');
                    if ($maxwidth > 0 && $maxheight > 0) {
                        // resize large image
                        $imgHandler                = new Resizer();
                        $imgHandler->sourceFile    = \WGLINKS_UPLOAD_IMAGE_PATH . '/links/large/' . $savedFilename;
                        $imgHandler->endFile       = \WGLINKS_UPLOAD_IMAGE_PATH . '/links/large/' . $savedFilename;
                        $imgHandler->imageMimetype = $imgMimetype;
                        $imgHandler->maxWidth      = $maxwidth;
                        $imgHandler->maxHeight     = $maxheight;
                        $result                    = $imgHandler->resizeImage();
                    }
                    // resize thumb image
                    $thumbFile = \WGLINKS_UPLOAD_IMAGE_PATH . '/links/thumbs/' . $savedFilename;
                    $largeFile = \WGLINKS_UPLOAD_IMAGE_PATH . '/links/large/' . $savedFilename;
                    if ($maxwidth > 0 && $maxheight > 0) {
                            $imgHandler                = new Resizer();
                            $imgHandler->sourceFile    = $largeFile;
                            $imgHandler->endFile       = $thumbFile;
                            $imgHandler->imageMimetype = $imgMimetype;
                            $imgHandler->maxWidth      = $maxwidth;
                            $imgHandler->maxHeight     = $maxheight;
                            $result                    = $imgHandler->resizeImage();
                            if ('copy' === $result) {
                                \copy($largeFile, $thumbFile);
                            }
                    } else {
                        \copy($largeFile, $thumbFile);
                    }
                    $linksObj->setVar('link_logo', $savedFilename);
                } else {
                    $uploaderErrors .= '<br>' . $uploader->getErrors();
                }
            } else {
                if ($filename > '') {
                    $uploaderErrors .= '<br>' . $uploader->getErrors();
                }
                $linksObj->setVar('link_logo', Request::getString('link_logo'));
            }
        } else {
            $linksObj->setVar('link_logo', Request::getString('link_logo'));
        }
        $linksObj->setVar('link_state', Request::getInt('link_state'));
        $linksObj->setVar('link_type', Request::getInt('link_type'));
        $linksObj->setVar('link_target', Request::getString('link_target'));
        $linksObj->setVar('link_submitter', Request::getInt('link_submitter'));
        $linkDateCreated = Request::getString('link_date_created');
        if ('' !== $linkDateCreated) {
            $linkDateCreatedObj = \DateTime::createFromFormat(\_SHORTDATESTRING, $linkDateCreated);
            if ($linkDateCreatedObj === false) {
                // invalid date
                \redirect_header('link.php?op=list', 2, \_AM_WGHOLIDAY_INVALID_DATE);
            }
            $linksObj->setVar('link_date_created', $linkDateCreatedObj->getTimestamp());
        }
        // Insert Data
        if($linksHandler->insert($linksObj)) {
            $savedLinkId = $linkId > 0 ? $linkId : $linksObj->getNewInsertedIdLink();
            if ('' !== $uploaderErrors) {
                \redirect_header('link.php?op=edit&link_id=' . $savedLinkId, 5, $uploaderErrors);
            } else {
                \redirect_header('link.php?op=list', 3, \_AM_WGLINKS_FORM_OK);
            }
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
        if(1 === Request::getInt('ok')) {
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
        $lorder = Request::getArray('lorder');
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
