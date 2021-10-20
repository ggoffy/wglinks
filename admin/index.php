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
 * @version        $Id: 1.0 index.php 13070 Sun 2016-03-20 15:20:14Z XOOPS Development Team $
 */
include __DIR__ . '/header.php';
// Count elements
$countCategories = $categoriesHandler->getCount();
$countLinks = $linksHandler->getCount();
// Template Index
$templateMain = 'wglinks_admin_index.tpl';
// InfoBox Statistics
$adminObject->addInfoBox(_AM_WGLINKS_STATISTICS);
// Info elements
$adminObject->addInfoBoxLine(sprintf('<label>' . _AM_WGLINKS_THEREARE_CATS . '</label>', $countCategories));
$adminObject->addInfoBoxLine(sprintf('<label>' . _AM_WGLINKS_THEREARE_LINKS . '</label>', $countLinks));
// Upload Folders
$folder = [
	WGLINKS_UPLOAD_PATH,
	WGLINKS_UPLOAD_PATH . '/categories/',
    WGLINKS_UPLOAD_PATH . '/links/',
    WGLINKS_UPLOAD_PATH . '/images/',
    WGLINKS_UPLOAD_PATH . '/images/links/',
    WGLINKS_UPLOAD_PATH . '/images/categories/',
];
// Uploads Folders Created
foreach(array_keys($folder) as $i) {
	$adminObject->addConfigBoxLine($folder[$i], 'folder');
	$adminObject->addConfigBoxLine([$folder[$i], '777'], 'chmod');
}

//------------- Test Data ----------------------------
if ($helper->getConfig('displaySampleButton')) {
    xoops_loadLanguage('admin/modulesadmin', 'system');
    require dirname(__DIR__) . '/testdata/index.php';

    $adminObject->addItemButton(constant('CO_' . $moduleDirNameUpper . '_' . 'ADD_SAMPLEDATA'), '__DIR__ . /../../testdata/index.php?op=load', 'add');
    $adminObject->addItemButton(constant('CO_' . $moduleDirNameUpper . '_' . 'SAVE_SAMPLEDATA'), '__DIR__ . /../../testdata/index.php?op=save', 'add');
    //    $adminObject->addItemButton(constant('CO_' . $moduleDirNameUpper . '_' . 'EXPORT_SCHEMA'), '__DIR__ . /../../testdata/index.php?op=exportschema', 'add');
    $adminObject->displayButton('left', '');
}
//------------- End Test Data ----------------------------
$GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('index.php'));
$GLOBALS['xoopsTpl']->assign('index', $adminObject->displayIndex());
include __DIR__ . '/footer.php';
