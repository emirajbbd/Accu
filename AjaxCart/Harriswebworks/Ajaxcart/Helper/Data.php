<?php
/**
 * Harriswebworks_Ajaxcart extension
 * 
 * NOTICE OF LICENSE
 * 
 * This source file is subject to the MIT License
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/mit-license.php
 * 
 * @category       Harriswebworks
 * @package        Harriswebworks_Ajaxcart
 * @copyright      Copyright (c) 2017
 * @license        http://opensource.org/licenses/mit-license.php MIT License
 */
/**
 * Ajaxcart default helper
 *
 * @category    Harriswebworks
 * @package     Harriswebworks_Ajaxcart
 * @author       Enamul Haque
 */
class Harriswebworks_Ajaxcart_Helper_Data extends Mage_Core_Helper_Abstract
{
    /**
     * Returns extension version.
     *
     * @return string
     */
    public function getExtensionVersion()
    {
        return (string) Mage::getConfig()
            ->getNode()->modules->Harriswebworks_Ajaxcart->version;
    }
}
