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
 * Class Object Handler WglinksCategories
 */
class LinkHandler extends \XoopsPersistableObjectHandler
{
    /**
     * @var mixed
     */
    private mixed $wglinks = null;

    /**
     * Constructor 
     *
     * @param null|XoopsDatabase $db
     */
    public function __construct(?\XoopsDatabase $db)
    {
        parent::__construct($db, 'wglinks_links', Link::class, 'link_id', 'link_url');
        $this->wglinks = \XoopsModules\Wglinks\Helper::getInstance();
        $this->db = $db;
    }

    /**
     * @param $isNew
     *
     * @return object
     */
    public function create($isNew = true): object
    {
        return parent::create($isNew);
    }

    /**
     * retrieve a field
     *
     * @param $id field id
     * @param $fields
     * @return \XoopsObject|null reference to the {@link Get} object
     */
    public function get($id = null, $fields = null): ?\XoopsObject
    {
        return parent::get($id, $fields);
    }

    /**
     * get inserted id
     *
     * @return int reference to the {@link Get} object
     */
    public function getInsertId(): int
    {
        return $this->db->getInsertId();
    }

    /**
     * Get Count Link in the database
     * @param int $start
     * @param int $limit
     * @param string $sort
     * @param string $order
     * @return int
     */
    public function getCountLinks(int $start = 0, int $limit = 0, string $sort = 'link_catid ASC, link_weight ASC, link_id', string $order = 'ASC'): int
    {
        $criteriaCountLinks = new \CriteriaCompo();
        $criteriaCountLinks = $this->getLinksCriteria($criteriaCountLinks, $start, $limit, $sort, $order);
        return parent::getCount($criteriaCountLinks);
    }

    /**
     * Get All Link in the database
     * @param int $start
     * @param int $limit
     * @param null|string $sort
     * @param null|string $order
     * @return array
     */
    public function getAllLinks(int $start = 0, int $limit = 0, null|string $sort = 'link_catid ASC, link_weight ASC, link_id', null|string $order = 'ASC'): array
    {
        $criteriaAllLinks = new \CriteriaCompo();
        $criteriaAllLinks = $this->getLinksCriteria($criteriaAllLinks, $start, $limit, $sort, $order);
        return parent::getAll($criteriaAllLinks);
    }

    /**
     * Get Criteria Link
     * @param $criteriaLinks
     * @param $start
     * @param $limit
     * @param $sort
     * @param $order
     * @return mixed
     */
    private function getLinksCriteria($criteriaLinks, $start, $limit, $sort, $order): mixed
    {
        $criteriaLinks->setStart( $start );
        $criteriaLinks->setLimit( $limit );
        $criteriaLinks->setSort( $sort );
        $criteriaLinks->setOrder( $order );
        return $criteriaLinks;
    }
}
