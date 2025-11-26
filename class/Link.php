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
 * Class Object WglinksLinks
 */
class Link extends \XoopsObject
{
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->initVar('link_id', \XOBJ_DTYPE_INT);
        $this->initVar('link_catid', \XOBJ_DTYPE_INT);
        $this->initVar('link_name', \XOBJ_DTYPE_TXTBOX);
        $this->initVar('link_url', \XOBJ_DTYPE_TXTBOX);
        $this->initVar('link_tooltip', \XOBJ_DTYPE_TXTBOX);
        $this->initVar('link_detail', \XOBJ_DTYPE_TXTBOX);
        $this->initVar('link_contact', \XOBJ_DTYPE_TXTBOX);
        $this->initVar('link_email', \XOBJ_DTYPE_TXTBOX);
        $this->initVar('link_phone', \XOBJ_DTYPE_TXTBOX);
        $this->initVar('link_address', \XOBJ_DTYPE_TXTBOX);
        $this->initVar('link_weight', \XOBJ_DTYPE_INT);
        $this->initVar('link_logo', \XOBJ_DTYPE_TXTBOX);
        $this->initVar('link_state', \XOBJ_DTYPE_INT);
        $this->initVar('link_type', \XOBJ_DTYPE_INT);
        $this->initVar('link_target', \XOBJ_DTYPE_TXTBOX);
        $this->initVar('link_submitter', \XOBJ_DTYPE_INT);
        $this->initVar('link_date_created', \XOBJ_DTYPE_INT);
    }

    /**
     * @static function &getInstance
     */
    public static function getInstance(): void
    {
        static $instance = false;
        if(!$instance) {
            $instance = new self();
        }
    }

    /**
     * The new inserted $Id
     */
    public function getNewInsertedIdLinks()
    {
        return $GLOBALS['xoopsDB']->getInsertId();
    }

    /**
     * Get form
     *
     * @param mixed $action
     * @return \XoopsThemeForm
     * @throws \Exception
     */
    public function getFormLinks(mixed $action = false): \XoopsThemeForm
    {
        $helper = \XoopsModules\Wglinks\Helper::getInstance();
        if($action === false) {
            $action = $_SERVER['REQUEST_URI'];
        }
        // Title
        $title = $this->isNew() ? \_AM_WGLINKS_LINK_ADD : \_AM_WGLINKS_LINK_EDIT;
        // Get Theme Form
        \xoops_load('XoopsFormLoader');
        $form = new \XoopsThemeForm($title, 'form', $action, 'post', true);
        $form->setExtra('enctype="multipart/form-data"');
        // Form Table categories
        $categoriesHandler = $helper->getHandler('Category');
        $imgCatidSelect = new \XoopsFormSelect( \_AM_WGLINKS_CAT, 'link_catid', $this->getVar('link_catid'));
        $imgCatidSelect->addOptionArray($categoriesHandler->getList());
        $form->addElement($imgCatidSelect, true);
        // Form Text LinkName
        $form->addElement(new \XoopsFormText( \_AM_WGLINKS_LINK_NAME, 'link_name', 50, 255, $this->getVar('link_name') ), true);
        // Form Text LinkUrl
        $link_url = $this->isNew() ? 'https://' : $this->getVar('link_url');
        $form->addElement(new \XoopsFormText( \_AM_WGLINKS_LINK_URL, 'link_url', 50, 255, $link_url ));
        // Form Text LinkTooltip
        $form->addElement(new \XoopsFormText( \_AM_WGLINKS_LINK_TOOLTIP, 'link_tooltip', 50, 255, $this->getVar('link_tooltip') ));
        // Form editor link_detail
        $editorConfigs           = [];
        $editorConfigs['name']   = 'link_detail';
        $editorConfigs['value']  = $this->getVar('link_detail', 'e');
        $editorConfigs['rows']   = 5;
        $editorConfigs['cols']   = 40;
        $editorConfigs['width']  = '100%';
        $editorConfigs['height'] = '400px';
        $editorConfigs['editor'] = $helper->getConfig('editor');
        $form->addElement(new \XoopsFormEditor(\_AM_WGLINKS_LINK_DETAIL, 'link_detail', $editorConfigs));
        // Form Text link_contact
        $form->addElement(new \XoopsFormText( \_AM_WGLINKS_LINK_CONTACT, 'link_contact', 50, 255, $this->getVar('link_contact') ));
        // Form Text link_email
        $form->addElement(new \XoopsFormText( \_AM_WGLINKS_LINK_EMAIL, 'link_email', 50, 255, $this->getVar('link_email') ));
        // Form Text link_phone
        $form->addElement(new \XoopsFormText( \_AM_WGLINKS_LINK_PHONE, 'link_phone', 50, 255, $this->getVar('link_phone') ));
        // Form editor link_address
        $editorConfigs           = [];
        $editorConfigs['name']   = 'link_address';
        $editorConfigs['value']  = $this->getVar('link_address', 'e');
        $editorConfigs['rows']   = 5;
        $editorConfigs['cols']   = 40;
        $editorConfigs['width']  = '100%';
        $editorConfigs['height'] = '400px';
        $editorConfigs['editor'] = $helper->getConfig('editor');
        $form->addElement(new \XoopsFormEditor(\_AM_WGLINKS_LINK_ADDRESS, 'link_address', $editorConfigs));
        // Form Upload Image
        $getLinkLogo = $this->getVar('link_logo');
        $linkLogo = $getLinkLogo ?: 'blank.gif';
        $imageDirectory = '/uploads/wglinks/images/links/large';
        $imageTray = new \XoopsFormElementTray(\_AM_WGLINKS_LINK_LOGO, '<br />' );
        $imageSelect = new \XoopsFormSelect(\sprintf(\_AM_WGLINKS_FORM_IMAGE_PATH, ".$imageDirectory/"), 'link_logo', $linkLogo, 5);
        $imageArray = \XoopsLists::getImgListAsArray( \XOOPS_ROOT_PATH . $imageDirectory );
        foreach($imageArray as $image1) {
            $imageSelect->addOption((string)($image1), $image1);
        }
        $imageSelect->setExtra("onchange='showImgSelected(\"image1\", \"link_logo\", \"".$imageDirectory."\", \"\", \"".\XOOPS_URL."\")'");
        $imageTray->addElement($imageSelect);
        $imageTray->addElement(new \XoopsFormLabel('', "<br /><img src='".\XOOPS_URL . '/' . $imageDirectory . '/' . $linkLogo . "' name='image1' id='image1' alt='' style='max-width:100px' />"));
        // Form File
        $fileSelectTray = new \XoopsFormElementTray('', '<br />' );
        $uploadFileInfo = \str_replace('%w', $helper->getConfig('maxwidth'), \_AM_WGLINKS_FORM_UPLOAD_IMAGE_LINKS );
        $uploadFileInfo = \str_replace('%h', $helper->getConfig('maxheight'), $uploadFileInfo );
        $uploadFileInfo = \str_replace('%b', $helper->getConfig('maxsize'), $uploadFileInfo );
        $fileSelectTray->addElement(new \XoopsFormFile( $uploadFileInfo, 'attachedfile', $helper->getConfig('maxsize') ));
        $fileSelectTray->addElement(new \XoopsFormLabel(''));
        $imageTray->addElement($fileSelectTray);
        $form->addElement($imageTray);
        // Form Text LinkWeight
        $linkWeight = $this->isNew() ? '0' : $this->getVar('link_weight');
        $form->addElement(new \XoopsFormText( \_AM_WGLINKS_WEIGHT, 'link_weight', 20, 150, $linkWeight ), true);
        // Form Select LinkState
        $linkState = $this->isNew() ? Constants::STATUS_OFFLINE : $this->getVar('link_state');
        $linkStateSelect = new \XoopsFormRadio( \_AM_WGLINKS_LINK_STATE, 'link_state', $linkState);
        $linkStateSelect->addOption(Constants::STATUS_OFFLINE, \_MA_WGLINKS_STATE_OFFLINE);
        $linkStateSelect->addOption(Constants::STATUS_ONLINE, \_MA_WGLINKS_STATE_ONLINE);
        $form->addElement($linkStateSelect);
        // Form Select LinkType
        $linkType = $this->isNew() ? Constants::TYPE_CONTENT : $this->getVar('link_type');
        $linkTypeSelect = new \XoopsFormRadio( \_MA_WGLINKS_LINK_TYPE, 'link_type', $linkType);
        $linkTypeSelect->addOption(Constants::TYPE_CONTENT, \_MA_WGLINKS_LINK_TYPE_CONTENT);
        $linkTypeSelect->addOption(Constants::TYPE_DIRECT, \_MA_WGLINKS_LINK_TYPE_DIRECT);
        $form->addElement($linkTypeSelect);
        // Form Select LinkTarget
        $linkTarget = $this->isNew() ? Constants::TARGET_SELF : $this->getVar('link_target');
        $linkTargetSelect = new \XoopsFormRadio( \_MA_WGLINKS_LINK_TARGET, 'link_target', $linkTarget);
        $linkTargetSelect->addOption(Constants::TARGET_SELF, \_MA_WGLINKS_LINK_TARGET_SELF);
        $linkTargetSelect->addOption(Constants::TARGET_BLANK, \_MA_WGLINKS_LINK_TARGET_BLANK);
        $linkTargetSelect->addOption(Constants::TARGET_PARENT, \_MA_WGLINKS_LINK_TARGET_PARENT);
        $linkTargetSelect->addOption(Constants::TARGET_TOP, \_MA_WGLINKS_LINK_TARGET_TOP);
        $form->addElement($linkTargetSelect);
        // Form Select User
        $linkSubmitter = $this->isNew() ? $GLOBALS['xoopsUser']->getVar('uid') : $this->getVar('link_submitter');
        $form->addElement(new \XoopsFormSelectUser( \_AM_WGLINKS_SUBMITTER, 'link_submitter', false, $linkSubmitter ), true);
        // Form Text Date Select
        $linkDate_created = $this->isNew() ? 0 : $this->getVar('link_date_created');
        $form->addElement(new \XoopsFormTextDateSelect( \_AM_WGLINKS_DATE_CREATED, 'link_date_created', '', $linkDate_created ), true);
        // To Save
        $form->addElement(new \XoopsFormHidden('op', 'save'));
        $form->addElement(new \XoopsFormButtonTray('', _SUBMIT, 'submit', '', false));
        return $form;
    }

    /**
     * Get Values
     * @param null $keys
     * @param null $format
     * @param null $maxDepth
     * @return array
     * @throws \Exception
     */
    public function getValuesLinks($keys = null, $format = null, $maxDepth = null): array
    {
        $helper = \XoopsModules\Wglinks\Helper::getInstance();
        $ret = parent::getValues($keys, $format, $maxDepth);
        $ret['id'] = $this->getVar('link_id');
        $ret['catid'] = $this->getVar('link_catid');
        $categoriesHandler = $helper->getHandler('Category');
        $categoriesObj = $categoriesHandler->get($this->getVar('link_catid'));
        $ret['catname'] = $categoriesObj->getVar('cat_name');
        $ret['name'] = $this->getVar('link_name');
        $ret['url'] = '';
        if ( 'http://' !== $this->getVar('link_url') && 'https://' !== $this->getVar('link_url') ) {
            $ret['url'] = $this->getVar('link_url');
            if (str_starts_with($this->getVar('link_url'), 'http:')) {
                $ret['url_text'] = \substr($this->getVar('link_url'), 7);
            }
            if (str_starts_with($this->getVar('link_url'), 'https:')) {
                $ret['url_text'] = \substr($this->getVar('link_url'), 8);
            }
        }
        $ret['tooltip'] = $this->getVar('link_tooltip');
        $ret['detail'] = $this->getVar('link_detail', 'n');
        $ret['detail_truncated'] = $helper->truncateHtml($this->getVar('link_detail', 'n'), 50);
        $ret['contact'] = $this->getVar('link_contact');
        $ret['email'] = $this->getVar('link_email');
        $ret['phone'] = $this->getVar('link_phone');
        $ret['address'] = $this->getVar('link_address', 'n');
        $ret['weight'] = $this->getVar('link_weight');
        $ret['logo'] = 'blank.gif' === $this->getVar('link_logo') ? '' : $this->getVar('link_logo');
        $ret['state'] = $this->getVar('link_state');
        $ret['state_text'] = Constants::STATUS_ONLINE == $this->getVar('link_state') ? \_MA_WGLINKS_STATE_ONLINE : \_MA_WGLINKS_STATE_OFFLINE;
        $ret['type'] = $this->getVar('link_type');
        switch ($this->getVar('link_type')) {
            case Constants::TYPE_DIRECT:
                $ret['type_text'] = \_MA_WGLINKS_LINK_TYPE_DIRECT;
                $ret['href']      = $ret['url'];
                break;
            case Constants::TYPE_CONTENT:
            default:
                $ret['type_text'] = \_MA_WGLINKS_LINK_TYPE_CONTENT;
                $ret['href']      = \WGLINKS_URL . '/index.php?link_id=' . $ret['id'];
                break;
        }
        $ret['target_text'] = match ($this->getVar('link_target')) {
            Constants::TARGET_BLANK => \_MA_WGLINKS_LINK_TARGET_BLANK,
            Constants::TARGET_PARENT => \_MA_WGLINKS_LINK_TARGET_PARENT,
            Constants::TARGET_TOP => \_MA_WGLINKS_LINK_TARGET_TOP,
            default => \_MA_WGLINKS_LINK_TARGET_SELF,
        };
        $ret['submitter'] = \XoopsUser::getUnameFromId($this->getVar('link_submitter'));
        $ret['date_created'] = \formatTimestamp($this->getVar('link_date_created'), 's');
        return $ret;
    }

    /**
     * Returns an array representation of the object
     *
     * @return array
     */
    public function toArrayLinks(): array
    {
        $ret = [];
        $vars = $this->getVars();
        foreach(\array_keys($vars) as $var) {
            $ret[$var] = $this->getVar('{$var}');
        }
        return $ret;
    }
}
