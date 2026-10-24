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
// Request cat_id
$catId = Request::getInt('cat_id');
switch($op) {
    case 'list':
    default:
        $GLOBALS['xoTheme']->addScript(\WGLINKS_URL . '/assets/js/jquery.js');
        $GLOBALS['xoTheme']->addScript(\WGLINKS_URL . '/assets/js/jquery-ui.js');
        $GLOBALS['xoTheme']->addScript(\WGLINKS_URL . '/assets/js/sortable-categories.js');
        $GLOBALS['xoTheme']->addStylesheet( \WGLINKS_URL . '/assets/css/admin/style.css', null );
        $templateMain = 'wglinks_admin_category.tpl';
        $GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('category.php'));
        $adminObject->addItemButton(\_AM_WGLINKS_ADD_CAT, 'category.php?op=new');
        $GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
        $categoriesCount = $categoryHandler->getCountCategories();
        $categoriesAll = $categoryHandler->getAllCategories();
        $GLOBALS['xoopsTpl']->assign('categories_count', $categoriesCount);
        $GLOBALS['xoopsTpl']->assign('wglinks_url', \WGLINKS_URL);
        $GLOBALS['xoopsTpl']->assign('wglinks_upload_url', \WGLINKS_UPLOAD_URL);
        // Table view categories
        if($categoriesCount > 0) {
            foreach(\array_keys($categoriesAll) as $i) {
                $link = $categoriesAll[$i]->getValuesCategories();
                $GLOBALS['xoopsTpl']->append('categories_list', $link);
                unset($link);
            }
        } else {
            $GLOBALS['xoopsTpl']->assign('error', \_AM_WGLINKS_THEREARENT_CATS);
        }
        break;
    case 'new':
        $templateMain = 'wglinks_admin_category.tpl';
        $GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('category.php'));
        $adminObject->addItemButton(\_AM_WGLINKS_CATS_LIST, 'category.php', 'list');
        $GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
        // Get Form
        $categoriesObj = $categoryHandler->create();
        $form = $categoriesObj->getFormCategories();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
    case 'save':
        // Security Check
        if(!$GLOBALS['xoopsSecurity']->check()) {
            \redirect_header('category.php', 3, \implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
        }
        if(0 < $catId) {
            $categoriesObj = $categoryHandler->get($catId);
        } else {
            $categoriesObj = $categoryHandler->create();
        }
        // Set Vars
        $categoriesObj->setVar('cat_name', Request::getString('cat_name'));
        $categoriesObj->setVar('cat_desc', Request::getText('cat_desc'));
        $catWeight = Request::getInt('cat_weight');
        if (0 === $catWeight) {
            $catWeight = $categoryHandler->getMaxCategoryWeight() + 1;
        }
        $categoriesObj->setVar('cat_weight', $catWeight);
        $categoriesObj->setVar('cat_submitter', Request::getInt('cat_submitter') ?? 0);
        $catDateCreated = Request::getString('cat_date_created');
        if ('' !== $catDateCreated) {
            $catDateCreatedObj = \DateTime::createFromFormat(\_SHORTDATESTRING, $catDateCreated);
            if ($catDateCreatedObj === false) {
                // invalid date
                \redirect_header('event.php?op=list', 2, \_AM_WGHOLIDAY_INVALID_DATE);
            }
            $categoriesObj->setVar('cat_date_created', $catDateCreatedObj->getTimestamp());
        }
        // Insert Data
        if($categoryHandler->insert($categoriesObj)) {
            \redirect_header('category.php?op=list', 2, \_AM_WGLINKS_FORM_OK);
        }
        // Get Form
        $GLOBALS['xoopsTpl']->assign('error', $categoriesObj->getHtmlErrors());
        $form = $categoriesObj->getFormCategories();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
    case 'edit':
        $templateMain = 'wglinks_admin_category.tpl';
        $GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('category.php'));
        $adminObject->addItemButton(\_AM_WGLINKS_ADD_CAT, 'category.php?op=new');
        $adminObject->addItemButton(\_AM_WGLINKS_CATS_LIST, 'category.php', 'list');
        $GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
        // Get Form
        $categoriesObj = $categoryHandler->get($catId);
        $form = $categoriesObj->getFormCategories();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
    case 'delete':
        $categoriesObj = $categoryHandler->get($catId);
        if(1 === Request::getInt('ok')) {
            if(!$GLOBALS['xoopsSecurity']->check()) {
                \redirect_header('category.php', 3, \implode(', ', $GLOBALS['xoopsSecurity']->getErrors()));
            }
            if($categoryHandler->delete($categoriesObj)) {
                \redirect_header('category.php', 3, \_AM_WGLINKS_FORM_DELETE_OK);
            } else {
                $GLOBALS['xoopsTpl']->assign('error', $categoriesObj->getHtmlErrors());
            }
        } else {
            xoops_confirm(['ok' => 1, 'cat_id' => $catId, 'op' => 'delete'], $_SERVER['REQUEST_URI'], \sprintf(\_AM_WGLINKS_FORM_SURE_DELETE, $categoriesObj->getVar('cat_name')));
        }
        break;
    case 'order':
        $corder = Request::getArray('corder');
        for ($i = 0, $iMax = \count($corder); $i < $iMax; $i++){
            $categoriesObj = $categoryHandler->get($corder[$i]);
            $categoriesObj->setVar('cat_weight',$i + 1);
            $categoryHandler->insert($categoriesObj);
            unset($categoriesObj);
        }
        break;
}
include __DIR__ . '/footer.php';
