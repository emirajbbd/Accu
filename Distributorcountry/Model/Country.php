<?php
/**
 * Harriswebworks_Distributorcountry extension
 * 
 * NOTICE OF LICENSE
 * 
 * This source file is subject to the MIT License
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/mit-license.php
 * 
 * @category       Harriswebworks
 * @package        Harriswebworks_Distributorcountry
 * @copyright      Copyright (c) 2017
 * @license        http://opensource.org/licenses/mit-license.php MIT License
 */
/**
 * Country model
 *
 * @category    Harriswebworks
 * @package     Harriswebworks_Distributorcountry
 * @author      Ultimate Module Creator
 */
class Harriswebworks_Distributorcountry_Model_Country extends Mage_Core_Model_Abstract
{
    /**
     * Entity code.
     * Can be used as part of method name for entity processing
     */
    const ENTITY    = 'harriswebworks_distributorcountry_country';
    const CACHE_TAG = 'harriswebworks_distributorcountry_country';

    /**
     * Prefix of model events names
     *
     * @var string
     */
    protected $_eventPrefix = 'harriswebworks_distributorcountry_country';

    /**
     * Parameter name in event
     *
     * @var string
     */
    protected $_eventObject = 'country';

    /**
     * constructor
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function _construct()
    {
        parent::_construct();
        $this->_init('harriswebworks_distributorcountry/country');
    }

    /**
     * before save country
     *
     * @access protected
     * @return Harriswebworks_Distributorcountry_Model_Country
     * @author Ultimate Module Creator
     */
    protected function _beforeSave()
    {
        parent::_beforeSave();
        $now = Mage::getSingleton('core/date')->gmtDate();
        if ($this->isObjectNew()) {
            $this->setCreatedAt($now);
        }
        $this->setUpdatedAt($now);
        return $this;
    }

    /**
     * save country relation
     *
     * @access public
     * @return Harriswebworks_Distributorcountry_Model_Country
     * @author Ultimate Module Creator
     */
    protected function _afterSave()
    {
        return parent::_afterSave();
    }

    /**
     * get default values
     *
     * @access public
     * @return array
     * @author Ultimate Module Creator
     */
    public function getDefaultValues()
    {
        $values = array();
        $values['status'] = 1;
        return $values;
    }
    
}
