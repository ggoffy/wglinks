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
 * @since          1.0
 * @min_xoops      2.5.7
 * @author         XOOPS on Wedega - Email:<webmaster@wedega.com> - Website:<https://xoops.wedega.com>
 * @version        $Id: 1.0 links.php 13070 Sun 2016-03-20 15:20:14Z XOOPS Development Team $
 */
\defined('XOOPS_ROOT_PATH') || die('Restricted access');

/**
 * Class Object Handler WglinksCategories
 */
class LinksHandler extends \XoopsPersistableObjectHandler
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
		parent::__construct($db, 'wglinks_links', Links::class, 'link_id', 'link_url');
		$this->wglinks = \XoopsModules\Wglinks\Helper::getInstance();
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
     * @return \XoopsObject|null reference to the {@link Get} object
     */
	public function get($i = null, $fields = null)
	{
		return parent::get($i, $fields);
	}

	/**
	 * get inserted id
	 *
	 * @param null
	 * @return int reference to the {@link Get} object
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
		$criteriaCountLinks = new \CriteriaCompo();
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
		$criteriaAllLinks = new \CriteriaCompo();
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
