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
 * @version        $Id: 1.0 links.php 13070 Sun 2016-03-20 15:20:14Z XOOPS Development Team $
 */
include_once \XOOPS_ROOT_PATH.'/modules/wglinks/include/common.php';
// Function show block
function b_wglinks_links_show($options)
{
    include_once \XOOPS_ROOT_PATH.'/modules/wglinks/class/Links.php';
    $myts = MyTextSanitizer::getInstance();
    $GLOBALS['xoopsTpl']->assign('wglinks_upload_url', \WGLINKS_UPLOAD_URL);
    $GLOBALS['xoopsTpl']->assign('wglinks_url', \WGLINKS_URL);
    $GLOBALS['xoTheme']->addStylesheet(\XOOPS_URL . '/modules/wglinks/assets/css/style.css');
    $block       = [];
    $typeBlock   = $options[0];
    $sortby      = $options[1];
    $limit       = $options[2];
    $lenghtTitle = $options[3];
    $logoHeight  = $options[4];
    $blockStyle  = $options[5];
    $showMore    = $options[6];
    $wglinks = \XoopsModules\Wglinks\Helper::getInstance();
    if (0 < $logoHeight) {
        $GLOBALS['xoopsTpl']->assign('imgheight', $logoHeight . 'px');
    }
    $linksHandler = $wglinks->getHandler('links');
    \array_shift($options);
    \array_shift($options);
    \array_shift($options);
    \array_shift($options);
    \array_shift($options);
    \array_shift($options);
    \array_shift($options);
    $crLinks = new \CriteriaCompo();
    $crLinks->add(new \Criteria('link_state', 1));
    switch ( $sortby ) {
        case 'date_asc':
            $crLinks->setSort('link_date');
            $crLinks->setOrder('ASC');
        break;
        case 'date_desc':
            $crLinks->setSort('link_date');
            $crLinks->setOrder('DESC');
        break;
        case 'random':
            $crLinks->setSort('RAND()');
        break;
        case 'default':
        default:
            $crLinks->setSort('link_weight');
            $crLinks->setOrder('ASC');
        break;
    }
    $cat_ids = \implode(',', $options);
    if ( '0' !== \substr($cat_ids, 0, 1)) {
        $crLinks->add(new \Criteria('link_catid', '(' . $cat_ids . ')', 'IN'));
        $GLOBALS['xoopsTpl']->assign('cat_ids', $cat_ids);
    }
    if ($limit > 0) {
        $crLinks->setLimit($limit);
    }
    $linksAll = $linksHandler->getAll($crLinks);
    unset($crLinks);
    foreach(\array_keys($linksAll) as $i)
    {
        $block[$i] = $linksAll[$i]->getValuesLinks();
    }

    $GLOBALS['xoopsTpl']->assign('blockStyle', $blockStyle);
    $GLOBALS['xoopsTpl']->assign('index_style', $blockStyle);
    $GLOBALS['xoopsTpl']->assign('title_style', $wglinks->getConfig('title_style'));
    $GLOBALS['xoopsTpl']->assign('showMore', $showMore);

    return $block;
}

// Function edit block
function b_wglinks_links_edit($options)
{
    include_once \XOOPS_ROOT_PATH.'/modules/wglinks/class/Links.php';
    $wglinks = \XoopsModules\Wglinks\Helper::getInstance();
    $categoriesHandler = $wglinks->getHandler('categories');
    $GLOBALS['xoopsTpl']->assign('wglinks_upload_url', \WGLINKS_UPLOAD_URL);

    $form = "<input type='hidden' name='options[0]' size='5' maxlength='255' value='".$options[0]."' />";
    $form .= \_MB_WGLINKS_LINKS_SORTBY.":&nbsp;&nbsp;<select name='options[1]' size='4'>";
    $currSortBy = $options[1];
    $form .= "<option value='default' " . ( 'default' === $currSortBy ? "selected='selected'" : '' ) . '>'  . \_MB_WGLINKS_LINKS_SORTBY_DEFAULT . '</option>';
    $form .= "<option value='date_asc' " . ( 'date_asc' === $currSortBy ? "selected='selected'" : '' ) . '>'  . \_MB_WGLINKS_LINKS_SORTBY_DATEASC . '</option>';
    $form .= "<option value='date_desc' " . ( 'date_desc' === $currSortBy ? "selected='selected'" : '' ) . '>'  . \_MB_WGLINKS_LINKS_SORTBY_DATEDESC . '</option>';
    $form .= "<option value='random' " . ( 'random' === $currSortBy ? "selected='selected'" : '' ) . '>'  . \_MB_WGLINKS_LINKS_SORTBY_RANDOM . '</option>';
    $form .= '</select><br /><br />';
    

    $form .= \_MB_WGLINKS_DISPLAY . ":&nbsp;&nbsp;<input type='text' name='options[2]' size='5' maxlength='255' value='".$options[2]."' />&nbsp;<br />";
    $form .= \_MB_WGLINKS_TITLE_LENGTH.":&nbsp;&nbsp;<input type='text' name='options[3]' size='5' maxlength='255' value='".$options[3]."' /><br /><br />";
    $form .= \_MB_WGLINKS_IMGHEIGHT.":&nbsp;&nbsp;<input type='text' name='options[4]' size='5' maxlength='255' value='".$options[4]."' /><br /><br />";
    $blockStyle = $options[5];
    if ('logochain' === $options[0]) {
        $form .= "<input type='hidden' name='options[5]' size='5' maxlength='255' value='".$options[5]."' />";
    } else {
        $form .= \_MB_WGLINKS_LINKS_BSTYLE.":&nbsp;&nbsp;<select name='options[5]' size='5'>";
        $form .= "<option value='default' " . ( 'default' === $blockStyle ? "selected='selected'" : '' ) . '>'  . \_MB_WGLINKS_LINKS_BSTYLE_DEFAULT . '</option>';
        $form .= "<option value='2cards' " . ( '2cards' === $blockStyle ? "selected='selected'" : '' ) . '>'  . \_MB_WGLINKS_LINKS_BSTYLE_2CARDS . '</option>';
        $form .= "<option value='3cards' " . ( '3cards' === $blockStyle ? "selected='selected'" : '' ) . '>'  . \_MB_WGLINKS_LINKS_BSTYLE_3CARDS . '</option>';
        $form .= "<option value='4cards' " . ( '4cards' === $blockStyle ? "selected='selected'" : '' ) . '>'  . \_MB_WGLINKS_LINKS_BSTYLE_4CARDS . '</option>';
        $form .= "<option value='6cards' " . ( '6cards' === $blockStyle ? "selected='selected'" : '' ) . '>'  . \_MB_WGLINKS_LINKS_BSTYLE_6CARDS . '</option>';
        $form .= "<option value='12cards' " . ( '12cards' === $blockStyle ? "selected='selected'" : '' ) . '>'  . \_MB_WGLINKS_LINKS_BSTYLE_12CARDS . '</option>';
        $form .= '</select><br /><br />';
    }
    $form .= \_MB_WGLINKS_BTN_SHOW_MORE. ":&nbsp;&nbsp;<input type='radio' name='options[6]' value='0' " . ( '0' == $options[6] ? "checked='checked'" : '' ) . '>&nbsp;' . _NO;
    $form .= "&nbsp;<input type='radio' name='options[6]' value='1' " . ( '1' == $options[6] ? "checked='checked'" : '' ) . '>' . _YES . '<br /><br />';
    \array_shift($options);
    \array_shift($options);
    \array_shift($options);
    \array_shift($options);
    \array_shift($options);
    \array_shift($options);
    \array_shift($options);

    $crCats = new \CriteriaCompo();
    $crCats->setSort('cat_weight ASC, cat_id');
    $crCats->setOrder('ASC');
    $categoriesAll = $categoriesHandler->getAll($crCats);
    unset($crCats);
    $form .= \_MB_WGLINKS_LINKS_TO_DISPLAY.":<br><select name='options[]' multiple='multiple' size='5'>";
    $form .= "<option value='0' " . (\in_array(0, $options) === false ? '' : "selected='selected'") . '>' . \_MB_WGLINKS_ALL_CATS . '</option>';
    foreach (\array_keys($categoriesAll) as $i) {
        $cat_id = $categoriesAll[$i]->getVar('cat_id');
        $form .= "<option value='" . $cat_id . "' " . (\in_array($cat_id, $options) === false || \in_array(0, $options) === true ? '' : "selected='selected'") . '>' . $categoriesAll[$i]->getVar('cat_name') . '</option>';
    }
    $form .= '</select>';
    unset($crCats);
    return $form;
}
