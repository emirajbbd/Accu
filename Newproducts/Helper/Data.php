<?php
/**
 * Harriswebworks_Newproducts extension
 * 
 * NOTICE OF LICENSE
 * 
 * This source file is subject to the MIT License
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/mit-license.php
 * 
 * @category       Harriswebworks
 * @package        Harriswebworks_Newproducts
 * @copyright      Copyright (c) 2017
 * @license        http://opensource.org/licenses/mit-license.php MIT License
 */
/**
 * Newproducts default helper
 *
 * @category    Harriswebworks
 * @package     Harriswebworks_Newproducts
 * @author       Enamul Haque
 */
class Harriswebworks_Newproducts_Helper_Data extends Mage_Core_Helper_Abstract
{
    /**
     * Returns extension version.
     *
     * @return string
     */
    public function getExtensionVersion()
    {
        return (string) Mage::getConfig()
            ->getNode()->modules->Harriswebworks_Newproducts->version;
    }
}
