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
 * @version        $Id: 1.0 category.php 13070 Sun 2016-03-20 15:20:14Z XOOPS Development Team $
 */
\defined('XOOPS_ROOT_PATH') || die('Restricted access');

/**
 * Class Object Handler WglinksCategories
 */
class CategoryHandler extends \XoopsPersistableObjectHandler
{
    /**
     * @var mixed
     */
    private $wgCategories = null;

    /**
     * Constructor 
     *
     * @param string $db
     */
    public function __construct($db)
    {
        parent::__construct($db, 'wglinks_categories', Category::class, 'cat_id', 'cat_name');
        $this->wgCategories = \XoopsModules\Wglinks\Helper::getInstance();
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
     * Get Count Category in the database
     * @param int $start
     * @param int $limit
     * @param string $sort
     * @param string $order
     * @return int
     */
    public function getCountCategories($start = 0, $limit = 0, $sort = 'cat_id ASC, cat_desc', $order = 'ASC')
    {
        $criteriaCountCategories = new \CriteriaCompo();
        $criteriaCountCategories = $this->getCategoriesCriteria($criteriaCountCategories, $start, $limit, $sort, $order);
        return parent::getCount($criteriaCountCategories);
    }

    /**
     * Get All Category in the database
     * @param int $start
     * @param int $limit
     * @param string $sort
     * @param string $order
     * @return array
     */
    public function getAllCategories($start = 0, $limit = 0, $sort = 'cat_id ASC, cat_desc', $order = 'ASC')
    {
        $criteriaAllCategories = new \CriteriaCompo();
        $criteriaAllCategories = $this->getCategoriesCriteria($criteriaAllCategories, $start, $limit, $sort = 'cat_id ASC, cat_desc', $order = 'ASC');
        return parent::getAll($criteriaAllCategories);
    }

    /**
     * Get Criteria Category
     * @param $criteriaCategories
     * @param $start
     * @param $limit
     * @param $sort
     * @param $order
     * @return mixed
     */
    private function getCategoriesCriteria($criteriaCategories, $start, $limit, $sort, $order)
    {
        $criteriaCategories->setStart( $start );
        $criteriaCategories->setLimit( $limit );
        $criteriaCategories->setSort( $sort );
        $criteriaCategories->setOrder( $order );
        return $criteriaCategories;
    }
}
