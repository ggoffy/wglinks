<?php

namespace XoopsModules\Wglinks;

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
\defined('XOOPS_ROOT_PATH') || die('Restricted access');

/**
 * Class Object WglinksCategories
 */
class Category extends \XoopsObject
{
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->initVar('cat_id', \XOBJ_DTYPE_INT);
        $this->initVar('cat_name', \XOBJ_DTYPE_TXTBOX);
        $this->initVar('cat_desc', \XOBJ_DTYPE_TXTBOX);
        $this->initVar('cat_weight', \XOBJ_DTYPE_INT);
        $this->initVar('cat_logo', \XOBJ_DTYPE_TXTBOX);
        $this->initVar('cat_submitter', \XOBJ_DTYPE_INT);
        $this->initVar('cat_date_created', \XOBJ_DTYPE_INT);
    }

    /**
     * @static function &getInstance
     */
    public static function &getInstance(): void
    {
        static $instance = false;
        if(!$instance) {
            $instance = new self();
        }
    }

    /**
     * The new inserted $Id
     */
    public function getNewInsertedIdCategories()
    {
        return $GLOBALS['xoopsDB']->getInsertId();
    }

    /**
     * Get form
     *
     * @param bool $action
     * @return \XoopsThemeForm
     */
    public function getFormCategories(bool $action = false): \XoopsThemeForm
    {
        if($action === false) {
            $action = $_SERVER['REQUEST_URI'];
        }
        // Title
        $title = $this->isNew() ? \_AM_WGLINKS_CAT_ADD : \_AM_WGLINKS_CAT_EDIT;
        // Get Theme Form
        \xoops_load('XoopsFormLoader');
        $form = new \XoopsThemeForm($title, 'form', $action, 'post', true);
        $form->setExtra('enctype="multipart/form-data"');
        // Form Text LinkName
        $form->addElement(new \XoopsFormText( \_AM_WGLINKS_CAT_NAME, 'cat_name', 50, 255, $this->getVar('cat_name') ), true);
        // Form Text LinkUrl
        $cat_desc = $this->isNew() ? '' : $this->getVar('cat_desc');
        $form->addElement(new \XoopsFormText( \_AM_WGLINKS_CAT_DESC, 'cat_desc', 50, 255, $cat_desc ));
        // Form Text LinkWeight
        $linkWeight = $this->isNew() ? '0' : $this->getVar('cat_weight');
        $form->addElement(new \XoopsFormText( \_AM_WGLINKS_WEIGHT, 'cat_weight', 20, 150, $linkWeight ), true);
        // Form Select User
        $catSubmitter = $this->isNew() ? $GLOBALS['xoopsUser']->getVar('uid') : $this->getVar('cat_submitter');
        $form->addElement(new \XoopsFormSelectUser( \_AM_WGLINKS_SUBMITTER, 'cat_submitter', false, $catSubmitter ), true);
        // Form Text Date Select
        $catDate_created = $this->isNew() ? 0 : $this->getVar('cat_date_created');
        $form->addElement(new \XoopsFormTextDateSelect( \_AM_WGLINKS_DATE_CREATED, 'cat_date_created', '', $catDate_created ), true);
        // To Save
        $form->addElement(new \XoopsFormHidden('op', 'save'));
        $form->addElement(new \XoopsFormButton('', 'submit', _SUBMIT, 'submit'));
        return $form;
    }

    /**
     * Get Values
     * @param null $keys
     * @param null $format
     * @param null $maxDepth
     * @return array
     */
    public function getValuesCategories($keys = null, $format = null, $maxDepth = null): array
    {
        $ret = parent::getValues($keys, $format, $maxDepth);
        $ret['id'] = $this->getVar('cat_id');
        $ret['name'] = $this->getVar('cat_name');
        if ( 'http://' !== $this->getVar('cat_desc') && 'https://' !== $this->getVar('cat_desc') ) {
            $ret['url'] = $this->getVar('cat_desc');
        }
        $ret['weight'] = $this->getVar('cat_weight');
        $ret['logo'] = $this->getVar('cat_logo');
        $ret['submitter'] = \XoopsUser::getUnameFromId($this->getVar('cat_submitter'));
        $ret['date_created'] = \formatTimestamp($this->getVar('cat_date_created'), 's');
        return $ret;
    }

    /**
     * Returns an array representation of the object
     *
     * @return array
     */
    public function toArrayCategories(): array
    {
        $ret = [];
        $vars = $this->getVars();
        foreach(\array_keys($vars) as $var) {
            $ret[$var] = $this->getVar('{$var}');
        }
        return $ret;
    }
}
