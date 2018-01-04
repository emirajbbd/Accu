<?php

/**
* Inchoo
*
* NOTICE OF LICENSE
*
* This source file is subject to the Open Software License (OSL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/osl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@magentocommerce.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Please do not edit or add to this file if you wish to upgrade
* Magento or this extension to newer versions in the future.
** Inchoo *give their best to conform to
* "non-obtrusive, best Magento practices" style of coding.
* However,* Inchoo *guarantee functional accuracy of
* specific extension behavior. Additionally we take no responsibility
* for any possible issue(s) resulting from extension usage.
* We reserve the full right not to provide any kind of support for our free extensions.
* Thank you for your understanding.
*
* @category Inchoo
* @package New
* @author Marko Martinović <marko.martinovic@inchoo.net>
* @copyright Copyright (c) Inchoo (http://inchoo.net/)
* @license http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
*/

class Harriswebworks_Newproducts_Model_Catalog_Layer_Filter_New extends Mage_Catalog_Model_Layer_Filter_Abstract
{

    const FILTER_ON_NEW = 1;
    const FILTER_NOT_ON_NEW = 2;

    /**
     * Class constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->_requestVar = 'new';
    }

    /**
     * Apply sale filter to layer
     *
     * @param   Zend_Controller_Request_Abstract $request
     * @param   Mage_Core_Block_Abstract $filterBlock
     * @return  Mage_Catalog_Model_Layer_Filter_New
     */
    public function apply(Zend_Controller_Request_Abstract $request, $filterBlock)
    {
        $filter = (int) $request->getParam($this->getRequestVar());
        if (!$filter || Mage::registry('harriswebworks_newproducts_filter')) {
            return $this;
        }
		$todayStartOfDayDate  = Mage::app()->getLocale()->date()
            ->setTime('00:00:00')
            ->toString(Varien_Date::DATETIME_INTERNAL_FORMAT);
        $select = $this->getLayer()->getProductCollection()->getSelect();
        /* @var $select Zend_Db_Select */

        if ($filter == self::FILTER_ON_NEW) {
           $select->where("((e.news_to_date >= '".$todayStartOfDayDate."') OR (e.news_to_date IS null))");
			
            $stateLabel = Mage::helper('harriswebworks_newproducts')->__('New');
        } else {
            $select->where("((e.news_to_date <= '".$todayStartOfDayDate."') OR (e.news_to_date IS null))");
			
            $stateLabel = Mage::helper('harriswebworks_newproducts')->__('Not New');
        }

        $state = $this->_createItem(
            $stateLabel, $filter
        )->setVar($this->_requestVar);
        /* @var $state Mage_Catalog_Model_Layer_Filter_Item */

        $this->getLayer()->getState()->addFilter($state);

        Mage::register('harriswebworks_newproducts_filter', true);

        return $this;
    }

    /**
     * Get filter name
     *
     * @return string
     */
    public function getName()
    {
        return Mage::helper('harriswebworks_newproducts')->__('New');
    }

    /**
     * Get data array for building sale filter items
     *
     * @return array
     */
    protected function _getItemsData()
    {
        $data = array();
        $status = $this->_getCount();

        $data[] = array(
            'label' => Mage::helper('harriswebworks_newproducts')->__('New'),
            'value' => self::FILTER_ON_NEW,
            'count' => $status['yes'],
        );

        $data[] = array(
            'label' => Mage::helper('harriswebworks_newproducts')->__('Not New'),
            'value' => self::FILTER_NOT_ON_NEW,
            'count' => $status['no'],
        );
        return $data;
    }

    protected function _getCount()
    {
        // Clone the select
    	$select = clone $this->getLayer()->getProductCollection()->getSelect();
        /* @var $select Zend_Db_Select */

	$select->reset(Zend_Db_Select::ORDER);
        $select->reset(Zend_Db_Select::LIMIT_COUNT);
        $select->reset(Zend_Db_Select::LIMIT_OFFSET);
        $select->reset(Zend_Db_Select::WHERE);
//$select->where("((e.news_to_date <= '".$todayStartOfDayDate."') OR (e.news_to_date IS null))");
        // Count the on sale and not on sale
        $sql = 'SELECT IF(((e.news_to_date <= \''.$todayStartOfDayDate.'\') OR (e.news_to_date IS null)), "no", "yes") as new, COUNT(*) as count from ('.$select->__toString().') AS q GROUP BY new';

        $connection = Mage::getSingleton('core/resource')->getConnection('core_read');
        /* @var $connection Zend_Db_Adapter_Abstract */

        return $connection->fetchPairs($sql);
    }

}
