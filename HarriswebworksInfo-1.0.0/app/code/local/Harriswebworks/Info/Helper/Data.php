<?php
class Harriswebworks_Info_Helper_Data extends Mage_Core_Helper_Abstract{
 
    public function getExtensionVersion()
    {
        return (string) Mage::getConfig()
            ->getNode()->modules->Harriswebworks_Info->version;
    }
}
