<?php

/**
 * Copyright [2014] [Harriswebworks]
 *
 * @package   Harriswebworks_StoreMaintenance
 * @author    Harriswebworks
 * @license   http://www.apache.org/licenses/LICENSE-2.0
 */
 
class Harriswebworks_Storemaintenance_Model_Observer
{
    public function initControllerStoremaintenance($request) 
    {
    	// Sets the timezone selected by shopkeeper
    	//date_default_timezone_set(Mage::getStoreConfig('general/locale/timezone'));        	
		
    	$url = Mage::helper('core/url')->getCurrentUrl();
		$adminArea = 0;
		
		// checks whether the current page belongs to the administrator
		if (strpos($url, '/admin') || strpos($url, '/adminhtml') || strpos($url, '/downloader')) {
			$adminArea = 1;
		}
		
		// Performs if not is administrative area
        if ($adminArea == 0) {
        	
            $storeId = Mage::app()->getStore()->getStoreId();
            $isEnabled = Mage::getStoreConfig('harriswebworks_storemaintenance/storemaintenance/activate',$storeId);
			
			// verifies if the module is enabled
			 if ($isEnabled == 1) {
            	
				$start_date = Mage::getStoreConfig('harriswebworks_storemaintenance/storemaintenance/start_date');				
				$endDate = Mage::getStoreConfig('harriswebworks_storemaintenance/storemaintenance/end_date');
				$start_time = Mage::getStoreConfig('harriswebworks_storemaintenance/storemaintenance/start_time');				
				$end_time = Mage::getStoreConfig('harriswebworks_storemaintenance/storemaintenance/end_time');
				$checkStartDate = 0;
				$checkDate = 0;
				$currentDate = date('m/d/Y H:i:s');
				$timestamp_currentDate = strtotime($currentDate);	
				// Checks if a date was set for the end of maintenance
				if ($start_date) {					
					$timestamp_startDate = strtotime($start_date.' '.str_replace(",",":",$start_time));
					// checks whether the current date is greater than the date specified in the module					
					if ($timestamp_currentDate == $timestamp_startDate) {
						$checkStartDate = 1;
					}
				}
				if ($endDate) {					
					$timestamp_endDate = strtotime($endDate.' '.str_replace(",",":",$end_time));
					// checks whether the current date is greater than the date specified in the module					
					if ($timestamp_currentDate > $timestamp_endDate) {
						$checkDate = 1;
					}
				}
				//echo $checkDate;
				$blockid = Mage::getStoreConfig('harriswebworks_storemaintenance/storemaintenance/block_static');
				
				if( $checkStartDate == 1 && $checkDate == 0 && $blockid){
					$resource = Mage::getSingleton('core/resource');
					$readConnection 	=	$resource->getConnection('core/resource');
					
					$updatesecondtable = "UPDATE `cms_block` SET `is_active` = 1 WHERE `block_id` =$blockid";
					$readConnection->query($updatesecondtable);
					Mage::app()->getCache()->clean();
				}
				
				
				if( $checkDate == 1 && $blockid){
					$resource = Mage::getSingleton('core/resource');
					$readConnection 	=	$resource->getConnection('core/resource');
					$selectqr = "select is_active from `cms_block` WHERE `block_id` =$blockid";
					$isex = $readConnection->fetchOne($selectqr);
					if($isex==1){
					Mage::getConfig()->saveConfig('harriswebworks_storemaintenance/storemaintenance/activate', '0', 'default', 0);
					$updatesecondtable = "UPDATE `cms_block` SET `is_active` = 0 WHERE `block_id` =$blockid";
					$readConnection->query($updatesecondtable);
					Mage::app()->getCache()->clean();
					}
				}
				
            }
    	}
    }        
}
