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
defined('XOOPS_ROOT_PATH') || die('Restricted access');

/**
 * Class Object WglinksLinks
 */
class WglinksLinks extends XoopsObject
{
	/**
	 * @var mixed
	 */
	private $wglinks = null;

	/**
	 * Constructor 
	 *
	 * @param null
	 */
	public function __construct()
	{
		$this->wglinks = WglinksHelper::getInstance();
		$this->initVar('link_id', XOBJ_DTYPE_INT);
        $this->initVar('link_catid', XOBJ_DTYPE_INT);
		$this->initVar('link_name', XOBJ_DTYPE_TXTBOX);
		$this->initVar('link_url', XOBJ_DTYPE_TXTBOX);
		$this->initVar('link_tooltip', XOBJ_DTYPE_TXTBOX);
        $this->initVar('link_detail', XOBJ_DTYPE_TXTBOX);
        $this->initVar('link_contact', XOBJ_DTYPE_TXTBOX);
        $this->initVar('link_email', XOBJ_DTYPE_TXTBOX);
        $this->initVar('link_phone', XOBJ_DTYPE_TXTBOX);
        $this->initVar('link_address', XOBJ_DTYPE_TXTBOX);
		$this->initVar('link_weight', XOBJ_DTYPE_INT);
		$this->initVar('link_logo', XOBJ_DTYPE_TXTBOX);
        $this->initVar('link_state', XOBJ_DTYPE_INT);
		$this->initVar('link_submitter', XOBJ_DTYPE_INT);
		$this->initVar('link_date_created', XOBJ_DTYPE_INT);
	}

	/**
	 * @static function &getInstance
	 *
	 * @param null
	 */
	public static function &getInstance()
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
		$newInsertedId = $GLOBALS['xoopsDB']->getInsertId();
		return $newInsertedId;
	}

    /**
     * Get form
     *
     * @param mixed $action
     * @return XoopsThemeForm
     */
	public function getFormLinks($action = false)
	{
		if($action === false) {
			$action = $_SERVER['REQUEST_URI'];
		}
		// Title
		$title = $this->isNew() ? sprintf(_AM_WGLINKS_LINK_ADD) : sprintf(_AM_WGLINKS_LINK_EDIT);
		// Get Theme Form
		xoops_load('XoopsFormLoader');
		$form = new XoopsThemeForm($title, 'form', $action, 'post', true);
		$form->setExtra('enctype="multipart/form-data"');
        // Form Table categories
		$categoriesHandler = $this->wglinks->getHandler('categories');
		$imgCatidSelect = new XoopsFormSelect( _AM_WGLINKS_CAT, 'link_catid', $this->getVar('link_catid'));
		$imgCatidSelect->addOptionArray($categoriesHandler->getList());
		$form->addElement($imgCatidSelect, true);
        // Form Text LinkName
		$form->addElement(new XoopsFormText( _AM_WGLINKS_LINK_NAME, 'link_name', 50, 255, $this->getVar('link_name') ), true);
        // Form Text LinkUrl
        $link_url = $this->isNew() ? 'https://' : $this->getVar('link_url');
		$form->addElement(new XoopsFormText( _AM_WGLINKS_LINK_URL, 'link_url', 50, 255, $link_url ), false);
        // Form Text LinkTooltip
		$form->addElement(new XoopsFormText( _AM_WGLINKS_LINK_TOOLTIP, 'link_tooltip', 50, 255, $this->getVar('link_tooltip') ));
        // Form editor link_detail
        $editorConfigs           = [];
        $editorConfigs['name']   = 'link_detail';
        $editorConfigs['value']  = $this->getVar('link_detail', 'e');
        $editorConfigs['rows']   = 5;
        $editorConfigs['cols']   = 40;
        $editorConfigs['width']  = '100%';
        $editorConfigs['height'] = '400px';
        $editorConfigs['editor'] = $this->wglinks->getConfig('editor');
        $form->addElement(new \XoopsFormEditor(_AM_WGLINKS_LINK_DETAIL, 'link_detail', $editorConfigs));
        // Form Text link_contact
		$form->addElement(new XoopsFormText( _AM_WGLINKS_LINK_CONTACT, 'link_contact', 50, 255, $this->getVar('link_contact') ));
        // Form Text link_email
		$form->addElement(new XoopsFormText( _AM_WGLINKS_LINK_EMAIL, 'link_email', 50, 255, $this->getVar('link_email') ));
        // Form Text link_phone
		$form->addElement(new XoopsFormText( _AM_WGLINKS_LINK_PHONE, 'link_phone', 50, 255, $this->getVar('link_phone') ));
        // Form editor link_address
        $editorConfigs           = [];
        $editorConfigs['name']   = 'link_address';
        $editorConfigs['value']  = $this->getVar('link_address', 'e');
        $editorConfigs['rows']   = 5;
        $editorConfigs['cols']   = 40;
        $editorConfigs['width']  = '100%';
        $editorConfigs['height'] = '400px';
        $editorConfigs['editor'] = $this->wglinks->getConfig('editor');
        $form->addElement(new \XoopsFormEditor(_AM_WGLINKS_LINK_ADDRESS, 'link_address', $editorConfigs));
		// Form Upload Image
		$getLinkLogo = $this->getVar('link_logo');
		$linkLogo = $getLinkLogo ? $getLinkLogo : 'blank.gif';
		$imageDirectory = '/uploads/wglinks/images/links/large';
		$imageTray = new XoopsFormElementTray(_AM_WGLINKS_LINK_LOGO, '<br />' );
		$imageSelect = new XoopsFormSelect( sprintf(_AM_WGLINKS_FORM_IMAGE_PATH, ".{$imageDirectory}/"), 'link_logo', $linkLogo, 5);
		$imageArray = XoopsLists::getImgListAsArray( XOOPS_ROOT_PATH . $imageDirectory );
		foreach($imageArray as $image1) {
			$imageSelect->addOption("{$image1}", $image1);
		}
		$imageSelect->setExtra("onchange='showImgSelected(\"image1\", \"link_logo\", \"".$imageDirectory."\", \"\", \"".XOOPS_URL."\")'");
		$imageTray->addElement($imageSelect, false);
		$imageTray->addElement(new XoopsFormLabel('', "<br /><img src='".XOOPS_URL."/".$imageDirectory."/".$linkLogo."' name='image1' id='image1' alt='' style='max-width:100px' />"));
        // Form File
		$fileSelectTray = new XoopsFormElementTray('', '<br />' );
        $uploadFileInfo = str_replace( '%w', $this->wglinks->getConfig('maxwidth'), _AM_WGLINKS_FORM_UPLOAD_IMAGE_LINKS );
        $uploadFileInfo = str_replace( '%h', $this->wglinks->getConfig('maxheight'), $uploadFileInfo );
        $uploadFileInfo = str_replace( '%b', $this->wglinks->getConfig('maxsize'), $uploadFileInfo );
		$fileSelectTray->addElement(new XoopsFormFile( $uploadFileInfo, 'attachedfile', $this->wglinks->getConfig('maxsize') ));
		$fileSelectTray->addElement(new XoopsFormLabel(''));
		$imageTray->addElement($fileSelectTray);
		$form->addElement($imageTray);
        // Form Text LinkWeight
        $linkWeight = $this->isNew() ? '0' : $this->getVar('link_weight');
		$form->addElement(new XoopsFormText( _AM_WGLINKS_WEIGHT, 'link_weight', 20, 150, $linkWeight ), true);
        // Form Select Albstate
		$linkState = $this->isNew() ? 0 : $this->getVar('link_state');
		$linkStateSelect = new XoopsFormRadio( _AM_WGLINKS_LINK_STATE, 'link_state', $linkState);
		$linkStateSelect->addOption(0, _AM_WGLINKS_STATE_OFFLINE);
		$linkStateSelect->addOption(1, _AM_WGLINKS_STATE_ONLINE);
		$form->addElement($linkStateSelect);
		// Form Select User
        $linkSubmitter = $this->isNew() ? $GLOBALS['xoopsUser']->getVar('uid') : $this->getVar('link_submitter');
		$form->addElement(new XoopsFormSelectUser( _AM_WGLINKS_SUBMITTER, 'link_submitter', false, $linkSubmitter ), true);
		// Form Text Date Select
		$linkDate_created = $this->isNew() ? 0 : $this->getVar('link_date_created');
		$form->addElement(new XoopsFormTextDateSelect( _AM_WGLINKS_DATE_CREATED, 'link_date_created', '', $linkDate_created ), true);
		// To Save
		$form->addElement(new XoopsFormHidden('op', 'save'));
		$form->addElement(new XoopsFormButtonTray('', _SUBMIT, 'submit', '', false));
		return $form;
	}

    /**
     * Get Values
     * @param null $keys
     * @param null $format
     * @param null $maxDepth
     * @return array
     */
	public function getValuesLinks($keys = null, $format = null, $maxDepth = null)
	{
		$ret = parent::getValues($keys, $format, $maxDepth);
		$ret['id'] = $this->getVar('link_id');
        $ret['catid'] = $this->getVar('link_catid');
        $categoriesHandler = $this->wglinks->getHandler('categories');
        $categoriesObj = $categoriesHandler->get($this->getVar('link_catid'));
        $ret['catname'] = $categoriesObj->getVar('cat_name');
		$ret['name'] = $this->getVar('link_name');
		if ( 'http://' !== $this->getVar('link_url') && 'https://' !== $this->getVar('link_url') ) {
			$ret['url'] = $this->getVar('link_url');
            if ( substr($this->getVar('link_url'), 0, 5) == 'http:') {
                $ret['url_text'] = substr($this->getVar('link_url'), 7);
            }
            if ( substr($this->getVar('link_url'), 0, 6) == 'https:') {
                $ret['url_text'] = substr($this->getVar('link_url'), 8);
            }
		}
		$ret['tooltip'] = $this->getVar('link_tooltip');
        $ret['detail'] = $this->getVar('link_detail', 'n');
        $ret['detail_truncated'] = $this->wglinks->truncateHtml($this->getVar('link_detail', 'n'), 50);
        $ret['contact'] = $this->getVar('link_contact');
        $ret['email'] = $this->getVar('link_email');
        $ret['phone'] = $this->getVar('link_phone');
        $ret['address'] = $this->getVar('link_address', 'n');
        $ret['weight'] = $this->getVar('link_weight');
		$ret['logo'] = $this->getVar('link_logo');
        $ret['state'] = $this->getVar('link_state');
		$ret['submitter'] = XoopsUser::getUnameFromId($this->getVar('link_submitter'));
		$ret['date_created'] = formatTimeStamp($this->getVar('link_date_created'), 's');
		return $ret;
	}

	/**
	 * Returns an array representation of the object
	 *
	 * @return array
	 */
	public function toArrayLinks()
	{
		$ret = array();
		$vars = $this->getVars();
		foreach(array_keys($vars) as $var) {
			$ret[$var] = $this->getVar('{$var}');
		}
		return $ret;
	}
}

/**
 * Class Object Handler WglinksCategories
 */
class WglinksLinksHandler extends XoopsPersistableObjectHandler
{
	/**
	 * @var mixed
	 */
	private $wglinks = null;

	/**
	 * Constructor 
	 *
	 * @param string $db
	 */
	public function __construct($db)
	{
		parent::__construct($db, 'wglinks_links', 'wglinkslinks', 'link_id', 'link_url');
		$this->wglinks = WglinksHelper::getInstance();
		$this->db = $db;
	}

	/**
	 * @param bool $isNew
	 *
	 * @return object
	 */
	public function create($isNew = true)
	{
		return parent::create($isNew);
	}

    /**
     * retrieve a field
     *
     * @param int $i field id
     * @param null $fields
     * @return mixed reference to the {@link Get} object
     */
	public function get($i = null, $fields = null)
	{
		return parent::get($i, $fields);
	}

	/**
	 * get inserted id
	 *
	 * @param null
	 * @return integer reference to the {@link Get} object
	 */
	public function getInsertId()
	{
		return $this->db->getInsertId();
	}

    /**
     * Get Count Links in the database
     * @param int $start
     * @param int $limit
     * @param string $sort
     * @param string $order
     * @return int
     */
	public function getCountLinks($start = 0, $limit = 0, $sort = 'link_catid ASC, link_weight ASC, link_id', $order = 'ASC')
	{
		$criteriaCountLinks = new CriteriaCompo();
		$criteriaCountLinks = $this->getLinksCriteria($criteriaCountLinks, $start, $limit, $sort, $order);
		return parent::getCount($criteriaCountLinks);
	}

    /**
     * Get All Links in the database
     * @param int $start
     * @param int $limit
     * @param string $sort
     * @param string $order
     * @return array
     */
	public function getAllLinks($start = 0, $limit = 0, $sort = 'link_catid ASC, link_weight ASC, link_id', $order = 'ASC')
	{
		$criteriaAllLinks = new CriteriaCompo();
		$criteriaAllLinks = $this->getLinksCriteria($criteriaAllLinks, $start, $limit, $sort = 'link_catid ASC, link_weight ASC, link_id', $order = 'ASC');
		return parent::getAll($criteriaAllLinks);
	}

    /**
     * Get Criteria Links
     * @param $criteriaLinks
     * @param $start
     * @param $limit
     * @param $sort
     * @param $order
     * @return mixed
     */
	private function getLinksCriteria($criteriaLinks, $start, $limit, $sort, $order)
	{
		$criteriaLinks->setStart( $start );
		$criteriaLinks->setLimit( $limit );
		$criteriaLinks->setSort( $sort );
		$criteriaLinks->setOrder( $order );
		return $criteriaLinks;
	}
}
