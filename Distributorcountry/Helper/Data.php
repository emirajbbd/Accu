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
 * Distributorcountry default helper
 *
 * @category    Harriswebworks
 * @package     Harriswebworks_Distributorcountry
 * @author      Ultimate Module Creator
 */
class Harriswebworks_Distributorcountry_Helper_Data extends Mage_Core_Helper_Abstract
{
    /**
     * convert array to options
     *
     * @access public
     * @param $options
     * @return array
     * @author Ultimate Module Creator
     */
	 const CFG_ENABLED = 'harriswebworks_distributorcountry/general/distributorcountry_enabled';
	 const CFG_EXCLUDE_IPS = 'harriswebworks_distributorcountry/general/admin_ips';
	 
	 /**
     * @return mixed
     */
    public function getVersion()
    {
        return Mage::getConfig()->getModuleConfig('Harriswebworks_Distributorcountry')->version;
    }

    /**
     * @return bool
     */
    public function isEnabled()
    {
        return Mage::getStoreConfigFlag(self::CFG_ENABLED);
    }
	
	 public function excludeIps()
    {
		$ips = explode(',',Mage::getStoreConfigFlag(self::CFG_EXCLUDE_IPS));
        return $ips;
    }
	
	
    public function convertOptions($options)
    {
        $converted = array();
        foreach ($options as $option) {
            if (isset($option['value']) && !is_array($option['value']) &&
                isset($option['label']) && !is_array($option['label'])) {
                $converted[$option['value']] = $option['label'];
            }
        }
        return $converted;
    }
}
