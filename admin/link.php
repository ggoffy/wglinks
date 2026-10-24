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
    case 'check_urls':
    default:
        $GLOBALS['xoTheme']->addScript(\WGLINKS_URL . '/assets/js/jquery.js');
        $GLOBALS['xoTheme']->addScript(\WGLINKS_URL . '/assets/js/jquery-ui.js');
        $GLOBALS['xoTheme']->addScript(\WGLINKS_URL . '/assets/js/sortable-links.js');
        $GLOBALS['xoTheme']->addStylesheet( \WGLINKS_URL . '/assets/css/admin/style.css', null );
        $templateMain = 'wglinks_admin_link.tpl';
        $GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('link.php'));
        $GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
        $linksCount = $linkHandler->getCountLinks();
        $linksAll = $linkHandler->getAllLinks();
        $GLOBALS['xoopsTpl']->assign('links_count', $linksCount);
        $GLOBALS['xoopsTpl']->assign('wglinks_url', \WGLINKS_URL);
        $GLOBALS['xoopsTpl']->assign('wglinks_upload_url', \WGLINKS_UPLOAD_URL);
        //check_urls
        $checkResults = [];
        $checksTotal  = 0;
        $checksOk     = 0;
        $checksFailed = 0;
        $sslVerifyPeer = true;
        if ('check_urls' === $op) {
            set_time_limit(0);
            $GLOBALS['xoopsTpl']->assign('links_listcheck', true);
            $sslVerifyPeer = (bool)$helper->getConfig('ssl_verifypeer');
        }
        // Table view links
        if($linksCount > 0) {
            $cat_id_prev = 0;
            $categoryList = $categoryHandler->getCategoryList();
            foreach(\array_keys($linksAll) as $i) {
                $link = $linksAll[$i]->getValuesLinks($categoryList);
                if ($cat_id_prev == $link['catid']) {
                    $link['new_cat'] = 0;
                } else {
                    $link['new_cat'] = 1;
                    $cat_id_prev = $link['catid'];
                }
                $url = trim((string) $link['url']);
                if ('check_urls' === $op && $url != '') {
                    if (!filter_var($url, FILTER_VALIDATE_URL)
                        || !in_array(strtolower((string) parse_url($url, PHP_URL_SCHEME)), ['http', 'https'], true)) {
                        $link['check_icon'] = 'warning';
                        $link['check_result'] = \_AM_WGLINKS_CHECK_INVALID_URL;
                        $link['check_status'] = 0;
                        $checksFailed++;
                        $checksTotal++;
                    } else {
                        $check = checkUrl($url, $sslVerifyPeer);
                        $status = $check['status'];

                        // HTTP 2xx and 3xx are reachable
                        if ($status >= 200 && $status < 400) {
                            $link['check_icon'] = 'ok';
                            $link['check_result'] = \_AM_WGLINKS_CHECK_OK;
                            $link['check_status'] = $status;
                            $checksOk++;
                        } elseif ($status > 0) {
                            $link['check_icon'] = 'warning';
                            $link['check_result'] = \_AM_WGLINKS_CHECK_ERROR;
                            $link['check_status'] = $status;
                            $checksFailed++;
                        } else {
                            $responseText = $check['error'] ?: \_AM_WGLINKS_CHECK_NO_RESPONSE;
                            $link['check_icon'] = 'warning';
                            $link['check_result'] = \_AM_WGLINKS_CHECK_NO_CONNECTION . ': ' . $responseText;
                            $link['check_status'] = $status;
                            $checksFailed++;
                        }
                    }
                    $checksTotal++;
                }
                $GLOBALS['xoopsTpl']->append('links_list', $link);
                unset($link);
            }
            $GLOBALS['xoopsTpl']->assign('start', $start);
            $GLOBALS['xoopsTpl']->assign('limit', $limit);
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
        $linksObj = $linkHandler->create();
        $form = $linksObj->getFormLinks();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
    case 'save':
        // Security Check
        if(!$GLOBALS['xoopsSecurity']->check()) {
            \redirect_header('link.php', 3, \implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
        }
        if(isset($linkId)) {
            $linksObj = $linkHandler->get($linkId);
        } else {
            $linksObj = $linkHandler->create();
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
        $linkWeight = Request::getInt('link_weight');
        if (0 === $linkWeight) {
            $linkWeight = $linkHandler->getMaxLinkWeight() + 1;
        }
        $linksObj->setVar('link_weight', $linkWeight);
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
        if($linkHandler->insert($linksObj)) {
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
        $linksObj = $linkHandler->get($linkId);
        $form = $linksObj->getFormLinks();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
    case 'delete':
        $linksObj = $linkHandler->get($linkId);
        if(1 === Request::getInt('ok')) {
            if(!$GLOBALS['xoopsSecurity']->check()) {
                \redirect_header('link.php', 3, \implode(', ', $GLOBALS['xoopsSecurity']->getErrors()));
            }
            if($linkHandler->delete($linksObj)) {
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
            $linksObj = $linkHandler->get($lorder[$i]);
            $linksObj->setVar('link_weight',$i + 1);
            $linkHandler->insert($linksObj);
            unset($linksObj);
        }
        $linksAll = $linkHandler->getAllLinks();
        $cat_id_prev = 0;
        $counter = 0;
        foreach(\array_keys($linksAll) as $i) {
            $link = $linksAll[$i]->getValuesLinks();
            if ($cat_id_prev == $link['catid']) {
                $counter++;
            } else {
                $counter = 1;
                $cat_id_prev = $link['catid'];
            }
            $linksObj = $linkHandler->get($link['id']);
            $linksObj->setVar('link_weight',$counter);
            $linkHandler->insert($linksObj);
            unset($linksObj);
            unset($link);
            }
        break;
    case 'change_state':
        if(isset($linkId)) {
            $linksObj = $linkHandler->get($linkId);
            // Set Vars
            $linksObj->setVar('link_state', Request::getInt('link_state'));
            // Insert Data
            if($linkHandler->insert($linksObj)) {
                \redirect_header('link.php?op=list&amp;start=' . $start . '&amp;limit=' . $limit, 2, \_AM_WGLINKS_FORM_OK);
            }
            // Get Form
            $GLOBALS['xoopsTpl']->assign('error', $linksObj->getHtmlErrors());
        }
        break;
}
include __DIR__ . '/footer.php';

/** function to check url validity
 *
 * @param string $url
 * @param bool   $sslVerifyPeer
 * @return array
 */
function checkUrl(string $url, bool $sslVerifyPeer): array
{
    if (!function_exists('curl_init')) {
        return [
            'status'   => 0,
            'finalUrl' => $url,
            'error'    => \_AM_WGLINKS_CURL_DONOTEXIST_1,
        ];
    }

    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => false,
        CURLOPT_MAXREDIRS      => 5,
        CURLOPT_CONNECTTIMEOUT => 5,
        CURLOPT_TIMEOUT        => 15,
        CURLOPT_USERAGENT      => 'XOOPS-wgLinks-URL-Checker/1.0',
        CURLOPT_SSL_VERIFYPEER => $sslVerifyPeer,
        CURLOPT_SSL_VERIFYHOST => 2,
        CURLOPT_NOBODY         => true,
    ]);

    $response = curl_exec($ch);
    $httpCode = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $finalUrl = (string) curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
    $error = curl_error($ch);

    // some server doesn't support HEAD request
    // retry with GET request
    if (in_array($httpCode, [403, 405, 501], true)) {
        $ch = curl_init($url);

        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => false,
            CURLOPT_MAXREDIRS      => 5,
            CURLOPT_CONNECTTIMEOUT => 5,
            CURLOPT_TIMEOUT        => 15,
            CURLOPT_USERAGENT      => 'XOOPS-wgLinks-URL-Checker/1.0',
            CURLOPT_SSL_VERIFYPEER => $sslVerifyPeer,
            CURLOPT_SSL_VERIFYHOST => 2,
            CURLOPT_RANGE          => '0-0',
        ]);

        curl_exec($ch);

        $httpCode = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $finalUrl = (string) curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
        $error = curl_error($ch);
    }

    return [
        'status'   => $httpCode,
        'finalUrl' => $finalUrl,
        'error'    => $error,
    ];
}
