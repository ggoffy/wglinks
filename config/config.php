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
 * @copyright      2020 XOOPS Project (https://xooops.org)
 * @license        GPL 2.0 or later
 * @package        wglinks
 * @author         Goffy - XOOPS Development Team - Email:<goffy@wedega.com> - Website:<https://wedega.com>
 */

/**
 * return object
 */

$moduleDirName  = \basename(\dirname(__DIR__));
$moduleDirNameUpper  = \mb_strtoupper($moduleDirName);
return (object)[
    'name'           => \mb_strtoupper($moduleDirName) . ' Module Configurator',
    'paths'          => [
        'dirname'    => $moduleDirName,
        'admin'      => \XOOPS_ROOT_PATH . '/modules/' . $moduleDirName . '/admin',
        'modPath'    => \XOOPS_ROOT_PATH . '/modules/' . $moduleDirName,
        'modUrl'     => \XOOPS_URL . '/modules/' . $moduleDirName,
        'uploadPath' => XOOPS_UPLOAD_PATH . '/' . $moduleDirName,
        'uploadUrl'  => XOOPS_UPLOAD_URL . '/' . $moduleDirName,
    ],
    'uploadFolders'  => [
        XOOPS_UPLOAD_PATH . '/' . $moduleDirName,
        XOOPS_UPLOAD_PATH . '/' . $moduleDirName . '/categories',
        XOOPS_UPLOAD_PATH . '/' . $moduleDirName . '/links',
        XOOPS_UPLOAD_PATH . '/' . $moduleDirName . '/images',
        XOOPS_UPLOAD_PATH . '/' . $moduleDirName . '/images/links',
        XOOPS_UPLOAD_PATH . '/' . $moduleDirName . '/images/links/large',
        XOOPS_UPLOAD_PATH . '/' . $moduleDirName . '/images/links/thumbs',
        XOOPS_UPLOAD_PATH . '/' . $moduleDirName . '/images/categories',
        XOOPS_UPLOAD_PATH . '/' . $moduleDirName . '/images/categories/large',
        XOOPS_UPLOAD_PATH . '/' . $moduleDirName . '/images/categories/thumbs',
    ],
    'copyBlankFiles' => [
        XOOPS_UPLOAD_PATH . '/' . $moduleDirName . '/images/links',
        XOOPS_UPLOAD_PATH . '/' . $moduleDirName . '/images/links/large',
        XOOPS_UPLOAD_PATH . '/' . $moduleDirName . '/images/links/thumbs',
        XOOPS_UPLOAD_PATH . '/' . $moduleDirName . '/images/categories',
        XOOPS_UPLOAD_PATH . '/' . $moduleDirName . '/images/categories/large',
        XOOPS_UPLOAD_PATH . '/' . $moduleDirName . '/images/categories/thumbs',
        //XOOPS_UPLOAD_PATH . '/flags'
    ],

    'copyTestFolders' => [
        [
            \XOOPS_ROOT_PATH . '/modules/' . $moduleDirName . '/testdata/uploads',
            XOOPS_UPLOAD_PATH . '/' . $moduleDirName,
        ],
    ],

    'templateFolders' => [
        '/templates/',
        //            '/templates/blocks/',
        //            '/templates/admin/'
    ],
    'oldFiles'        => [
        '/class/request.php',
        '/class/registry.php',
        '/class/utilities.php',
        '/class/util.php',
        //            '/include/constants.php',
        //            '/include/functions.php',
    ],
    'oldFolders'      => [
        '/images',
        '/css',
        '/js',
        '/tcpdf',
    ],
    'renameTables' => [//         'XX_archive'     => 'ZZZZ_archive',
    ],
    'renameColumns'  => [
        //'tablename' => ['columnname_old' => 'columnname_new'],
    ],
    'moduleStats'  => [
    ],
    'modCopyright' => "<a href='https://xoops.org' title='XOOPS Project' target='_blank'><img src='" . \XOOPS_ROOT_PATH . '/modules/' . $moduleDirName . "/assets/images/logo/logoModule.png' alt='XOOPS Project'></a>",
];
