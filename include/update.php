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
 * @version        $Id: 1.0 update.php 13070 Sun 2016-03-20 15:20:15Z XOOPS Development Team $
 */
/**
 * @param      $module
 * @param null $prev_version
 *
 * @return bool|null
 */
function xoops_module_update_wglinks(&$module, $prev_version = null)
{
    // irmtfan bug fix: solve templates duplicate issue
    $ret = null;
    if ($prev_version < 10) {
        $ret = update_wglinks_v10($module);
    }
    $errors = $module->getErrors();
    if (!empty($errors)) {
        print_r($errors);
    }
    if ($prev_version < 103) {
        $ret = update_wglinks_v103($module);
    }
    if ($prev_version < 105) {
        $ret = update_wglinks_v105($module);
    }
    $errors = $module->getErrors();
    if (!empty($errors)) {
        print_r($errors);
    }

    return $ret;
    
}

// irmtfan bug fix: solve templates duplicate issue
/**
 * @param $module
 *
 * @return bool
 */
function update_wglinks_v10($module)
{
    global $xoopsDB;
    $result = $xoopsDB->query(
        'SELECT t1.tpl_id FROM ' . $xoopsDB->prefix('tplfile') . ' t1, ' . $xoopsDB->prefix('tplfile')
        . ' t2 WHERE t1.tpl_refid = t2.tpl_refid AND t1.tpl_module = t2.tpl_module AND t1.tpl_tplset=t2.tpl_tplset AND t1.tpl_file = t2.tpl_file AND t1.tpl_type = t2.tpl_type AND t1.tpl_id > t2.tpl_id'
    );
    $tplids = [];
    while (list($tplid) = $xoopsDB->fetchRow($result)) {
        $tplids[] = $tplid;
    }
    if (count($tplids) > 0) {
        $tplfile_handler = xoops_getHandler('tplfile');
        $duplicate_files = $tplfile_handler->getObjects(
            new \Criteria('tpl_id', '(' . implode(',', $tplids) . ')', 'IN')
        );

        if (count($duplicate_files) > 0) {
            foreach (array_keys($duplicate_files) as $i) {
                $tplfile_handler->delete($duplicate_files[$i]);
            }
        }
    }
    $sql = 'SHOW INDEX FROM ' . $xoopsDB->prefix('tplfile') . " WHERE KEY_NAME = 'tpl_refid_module_set_file_type'";
    if (!$result = $xoopsDB->queryF($sql)) {
        xoops_error($xoopsDB->error() . '<br />' . $sql);

        return false;
    }
    $ret = [];
    while ($myrow = $xoopsDB->fetchArray($result)) {
        $ret[] = $myrow;
    }
    if (!empty($ret)) {
        $module->setErrors(
            "'tpl_refid_module_set_file_type' unique index is exist. Note: check 'tplfile' table to be sure this index is UNIQUE because XOOPS CORE need it."
        );

        return true;
    }
    $sql = 'ALTER TABLE ' . $xoopsDB->prefix('tplfile')
           . ' ADD UNIQUE tpl_refid_module_set_file_type ( tpl_refid, tpl_module, tpl_tplset, tpl_file, tpl_type )';
    if (!$result = $xoopsDB->queryF($sql)) {
        xoops_error($xoopsDB->error() . '<br />' . $sql);
        $module->setErrors(
            "'tpl_refid_module_set_file_type' unique index is not added to 'tplfile' table. Warning: do not use XOOPS until you add this unique index."
        );

        return false;
    }

    return true;
}
// irmtfan bug fix: solve templates duplicate issue

function update_wglinks_v105 ($module) {
    global $xoopsDB;    
    
    // Making of images folder
    $indexFile = XOOPS_UPLOAD_PATH.'/index.html';
    $blankFile = XOOPS_UPLOAD_PATH.'/blank.gif';
    $wglinks = XOOPS_UPLOAD_PATH.'/wglinks';
    $images = XOOPS_UPLOAD_PATH.'/wglinks/images';
    $links = XOOPS_UPLOAD_PATH.'/wglinks/images/links/large';
    if(!is_dir($links)) {
        if (!mkdir($links, 0777) && !is_dir($links)) {
            throw new \RuntimeException(sprintf('Directory "%s" was not created', $links));
        }
        chmod($links, 0777);
    }
    copy($indexFile, $links.'/index.html');
    copy($blankFile, $links.'/blank.gif');
    $links = XOOPS_UPLOAD_PATH.'/wglinks/images/links/thumbs';
    if(!is_dir($links)) {
        if (!mkdir($links, 0777) && !is_dir($links)) {
            throw new \RuntimeException(sprintf('Directory "%s" was not created', $links));
        }
        chmod($links, 0777);
    }
    copy($indexFile, $links.'/index.html');
    copy($blankFile, $links.'/blank.gif');
    
    // update table links
    $field = 'link_detail';
    $sql = 'ALTER TABLE ' . $xoopsDB->prefix('wglinks_links') . " ADD `$field` text NULL AFTER `link_tooltip`";
    if (!$result = $xoopsDB->queryF($sql)) {
        xoops_error($xoopsDB->error() . '<br />' . $sql);
        $module->setErrors(
            "Error when adding field '$field' to table 'wglinks_links'"
        );
        return false;
    }
    $field = 'link_address';
    $sql = 'ALTER TABLE ' . $xoopsDB->prefix('wglinks_links') . " ADD `$field` varchar(255) NULL DEFAULT '' AFTER `link_tooltip`";
    if (!$result = $xoopsDB->queryF($sql)) {
        xoops_error($xoopsDB->error() . '<br />' . $sql);
        $module->setErrors(
            "Error when adding field '$field' to table 'wglinks_links'"
        );
        return false;
    }
    $field = 'link_phone';
    $sql = 'ALTER TABLE ' . $xoopsDB->prefix('wglinks_links') . " ADD `$field` varchar(255) NULL DEFAULT '' AFTER `link_tooltip`";
    if (!$result = $xoopsDB->queryF($sql)) {
        xoops_error($xoopsDB->error() . '<br />' . $sql);
        $module->setErrors(
            "Error when adding field '$field' to table 'wglinks_links'"
        );
        return false;
    }
    $field = 'link_email';
    $sql = 'ALTER TABLE ' . $xoopsDB->prefix('wglinks_links') . " ADD `$field` text NULL AFTER `link_tooltip`";
    if (!$result = $xoopsDB->queryF($sql)) {
        xoops_error($xoopsDB->error() . '<br />' . $sql);
        $module->setErrors(
            "Error when adding field '$field' to table 'wglinks_links'"
        );
        return false;
    }
    $field = 'link_contact';
    $sql = 'ALTER TABLE ' . $xoopsDB->prefix('wglinks_links') . " ADD `$field` varchar(255) NULL DEFAULT '' AFTER `link_tooltip`";
    if (!$result = $xoopsDB->queryF($sql)) {
        xoops_error($xoopsDB->error() . '<br />' . $sql);
        $module->setErrors(
            "Error when adding field '$field' to table 'wglinks_links'"
        );
        return false;
    }
    return true;
}

function update_wglinks_v103 ($module) {
    global $xoopsDB;
    // create dir for categories
    
    $indexFile = XOOPS_UPLOAD_PATH.'/index.html';
    $blankFile = XOOPS_UPLOAD_PATH.'/blank.gif';
    // Making of uploads/wglinks folder
    $wglinks = XOOPS_UPLOAD_PATH.'/wglinks';
    if(!is_dir($wglinks)) {
        if (!mkdir($wglinks, 0777) && !is_dir($wglinks)) {
            throw new \RuntimeException(sprintf('Directory "%s" was not created', $wglinks));
        }
        chmod($wglinks, 0777);
    }
    copy($indexFile, $wglinks.'/index.html');
    // Making of cats uploads folder
    $categories = $wglinks.'/categories';
    if(!is_dir($categories)) {
        if (!mkdir($categories, 0777) && !is_dir($categories)) {
            throw new \RuntimeException(sprintf('Directory "%s" was not created', $categories));
        }
        chmod($categories, 0777);
    }
    copy($indexFile, $categories.'/index.html');
    // Making of images folder
    $images = $wglinks.'/images';
    if(!is_dir($images)) {
        if (!mkdir($images, 0777) && !is_dir($images)) {
            throw new \RuntimeException(sprintf('Directory "%s" was not created', $images));
        }
        chmod($images, 0777);
    }
    copy($indexFile, $images.'/index.html');
    copy($blankFile, $images.'/blank.gif');
    // Making of images/links folder
    $categories = $images.'/categories';
    if(!is_dir($categories)) {
        if (!mkdir($categories, 0777) && !is_dir($categories)) {
            throw new \RuntimeException(sprintf('Directory "%s" was not created', $categories));
        }
        chmod($categories, 0777);
    }
    copy($indexFile, $categories.'/index.html');
    copy($blankFile, $categories.'/blank.gif');
    
    // update table links
    $sql = 'ALTER TABLE ' . $xoopsDB->prefix('wglinks_links') . " ADD `link_state` INT(10) NOT NULL DEFAULT '0' AFTER `link_logo`";
    if (!$result = $xoopsDB->queryF($sql)) {
        xoops_error($xoopsDB->error() . '<br />' . $sql);
        $module->setErrors(
            "Error when adding field 'link_catid' to table 'wglinks_links'"
        );
        return false;
    }
    
    // update table links
    $sql = 'ALTER TABLE ' . $xoopsDB->prefix('wglinks_links') . " ADD `link_catid` INT(10) NOT NULL DEFAULT '0' AFTER `link_id`";
    if (!$result = $xoopsDB->queryF($sql)) {
        xoops_error($xoopsDB->error() . '<br />' . $sql);
        $module->setErrors(
            "Error when adding field 'link_catid' to table 'wglinks_links'"
        );
        return false;
    }
    
    // create table
    $sql = 'CREATE TABLE ' . $xoopsDB->prefix('wglinks_categories') . " (
              `cat_id` INT(8) UNSIGNED NOT NULL AUTO_INCREMENT,
              `cat_name` VARCHAR(100) NOT NULL DEFAULT '',
              `cat_desc` TEXT NULL,
              `cat_weight` INT(8) NOT NULL DEFAULT '0',
              `cat_submitter` INT(10) NOT NULL DEFAULT '0',
              `cat_date_created` INT(10) NOT NULL DEFAULT '0',
              PRIMARY KEY (`cat_id`)
            ) ENGINE=InnoDB;";
    if (!$result = $xoopsDB->queryF($sql)) {
        xoops_error($xoopsDB->error() . '<br />' . $sql);
        $module->setErrors(
            "Error when creating table 'wglinks_cats'"
        );
        return false;
    }

    return true;
}
