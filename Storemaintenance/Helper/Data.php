<?php

/**
 * Copyright [2014] [Harriswebworks]
 *
 * @package   Harriswebworks_StoreMaintenance
 * @author    Harriswebworks
 * @license   http://www.apache.org/licenses/LICENSE-2.0
 */
 
class Harriswebworks_Storemaintenance_Helper_Data extends Mage_Core_Helper_Abstract
{
     public function getExtensionVersion()
    {
        return (string) Mage::getConfig()
            ->getNode()->modules->Harriswebworks_Storemaintenance->version;
    }  
}