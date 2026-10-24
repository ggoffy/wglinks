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
class CategoryHandler extends \XoopsPersistableObjectHandler
{
    /**
     * Constructor
     *
     * @param \XoopsDatabase|null $db
     */
    public function __construct(?\XoopsDatabase $db)
    {
        parent::__construct($db, 'wglinks_categories', Category::class, 'cat_id', 'cat_name');
        $this->db = $db;
    }

    /**
     * @param bool $isNew
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
     * Get Count Category in the database
     * @param int $start
     * @param int $limit
     * @param string $sort
     * @param string $order
     * @return int
     */
    public function getCountCategories(int $start = 0, int $limit = 0, string $sort = 'cat_weight ASC, cat_id', string $order = 'ASC'): int
    {
        $criteriaCountCategories = new \CriteriaCompo();
        $criteriaCountCategories = $this->getCategoriesCriteria($criteriaCountCategories, $start, $limit, $sort, $order);
        return parent::getCount($criteriaCountCategories);
    }

    /**
     * Get All Category in the database
     * @param int $start
     * @param int $limit
     * @param null|string $sort
     * @param null|string $order
     * @return array
     */
    public function getAllCategories(int $start = 0, int $limit = 0, null|string $sort = 'cat_weight ASC, cat_id', null|string $order = 'ASC'): array
    {
        $criteriaAllCategories = new \CriteriaCompo();
        $criteriaAllCategories = $this->getCategoriesCriteria($criteriaAllCategories, $start, $limit, $sort, $order);
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
    private function getCategoriesCriteria($criteriaCategories, $start, $limit, $sort, $order): mixed
    {
        $criteriaCategories->setStart( $start );
        $criteriaCategories->setLimit( $limit );
        $criteriaCategories->setSort( $sort );
        $criteriaCategories->setOrder( $order );
        return $criteriaCategories;
    }

    /**
     * Get max value of category weight
     *
     * @return int
     */
    public function getMaxCategoryWeight(): int
    {
        global $xoopsDB;

        $sql = 'SELECT max(cat_weight) FROM ' . $xoopsDB->prefix('wglinks_categories');

        $result = $xoopsDB->query($sql);
        if (!$xoopsDB->isResultSet($result) || !($result instanceof \mysqli_result)) {
            throw new \RuntimeException(
                \sprintf(_DB_QUERY_ERROR, $sql) . $xoopsDB->error(),
                E_USER_ERROR,
            );
        }
        if (false !== ($row = $xoopsDB->fetchRow($result))) {
            return (int)$row[0];
        }

        return 0;
    }

    /**
     * Get list of categories
     *
     * @return array
     */
    public function getCategoryList(): array
    {
        $categoryList = [];
        $categoriesAll = $this->getAll();
        foreach(\array_keys($categoriesAll) as $i) {
            $categoryList[$i] = $categoriesAll[$i]->getVar('cat_name');
        }

        return $categoryList;
    }
}
