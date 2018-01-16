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
 * Country resource model
 *
 * @category    Harriswebworks
 * @package     Harriswebworks_Distributorcountry
 * @author      Ultimate Module Creator
 */
class Harriswebworks_Distributorcountry_Model_Resource_Country extends Mage_Core_Model_Resource_Db_Abstract
{

    /**
     * constructor
     *
     * @access public
     * @author Ultimate Module Creator
     */
    public function _construct()
    {
        $this->_init('harriswebworks_distributorcountry/country', 'entity_id');
    }
}
