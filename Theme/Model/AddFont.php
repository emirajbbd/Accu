<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License (AFL 3.0)
 * that is bundled with this package in the file LICENSE_AFL.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/afl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @category    Harriswebworks
 * @package     Harriswebworks_Theme
 * @copyright   Copyright (c) 2012 Magento Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 */

class Harriswebworks_Theme_Model_AddFont extends Mage_Core_Model_Config_Data
{
	
		
	public function save(){
		$fonturls = $this->getValue(); //get the value from our config
		if($fonturls=='')
		return parent::save(); 
		
		$oldurls = Mage::helper('harriswebworks_theme')->addGoogleFont();
		if($fonturls==$oldurls)
		return parent::save(); 
		
		$fonturls_array = explode(PHP_EOL, $fonturls);
		$content = '';
		foreach($fonturls_array as $url){
			$url = trim($url);
			if($url!='' && filter_var($url, FILTER_VALIDATE_URL))
			{
				 $curlSession = curl_init();
				curl_setopt($curlSession, CURLOPT_URL, $url);
				curl_setopt($curlSession, CURLOPT_BINARYTRANSFER, true);
				curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, true);
			
				$content .= (curl_exec($curlSession));
				curl_close($curlSession);
			}
		}
		if($content!=''){
				//$file = new Varien_Io_File();
			$websiteCode = Mage::app()->getRequest()->getParam('website');
			$storeCode = Mage::app()->getRequest()->getParam('store');		
	/*			
	if (is_null($storeCode) && $websiteCode) //check for website scope
    {
        $scopeId = Mage::getModel('core/website')->load($websiteCode)->getId();
        //$description  = Mage::app()->getWebsite($scopeId)->getConfig('design/custom/description');
        $currentScope = 'websites';
    }
    elseif($storeCode) //check for store scope
    {
        $scopeId =   Mage::getModel('core/store')->load($storeCode)->getId();
       // $description  = Mage::app()->getStore($scopeId)->getConfig('design/custom/description');
        $currentScope = 'stores';
    }
    else //for default scope
    {
        $scopeId = 0;
       // $description  = Mage::getStoreConfig('design/social-meta-tags/design/custom/description');
        $currentScope = 'default';
    }
			echo $scopeId;	
			echo 	$currentScope;*/
		$this->generateCss('font_css',$content, $websiteCode, $storeCode);		
		}
		
        return parent::save(); 
	}
	
	 public function generateCss($cssfile,$content, $web, $store){
		 if ($web){
			  if ($store) {
				  $this->_generateStoreCss($cssfile,$content, $store);
				} else {
					$this->_generateWebsiteCss($cssfile,$content, $web);
				 }
			}else{
				$websites = Mage::app()->getWebsites(false, true);
				foreach ($websites as $store => $val) {
					$this->_generateWebsiteCss($cssfile,$content, $store);
				 }
			}
	 }
	protected function _generateWebsiteCss($cssfile,$content, $web) {
		$stores = Mage::app()->getWebsite($web);
		foreach ($stores->getStoreCodes() as $store){
			 $this->_generateStoreCss($cssfile,$content, $store);
		} 
	}
	
	protected function _generateStoreCss($cssfile,$content, $store){
		if (!Mage::app()->getStore($store)->getIsActive())
		 	return;
			$storeid = Mage::getModel('core/store')->load($store)->getId();
			
		Mage::register('fontgen_store', $store);
		//echo Mage::getDesign()->getTheme('default');
		$theme = Mage::getStoreConfig('design/theme/default',$storeid);
		$package = Mage::getStoreConfig('design/package/name',$storeid );
		$basedir = Mage::getSingleton('core/design_package')->getSkinBaseDir(array('_area' => 'frontend','_package' => $package,'_theme' => $theme));
		
		$cssdir=$basedir.DS.'css';
		$filename=$cssfile.'.css';
		echo $cssfile = $cssdir.DS.$filename;
		try {
					
						$file = new Varien_Io_File();
						$file->setAllowCreateFolders(true);
						$file->open(array( 'path' => $cssdir ));
						$file->streamOpen($cssfile, 'w+', 0777);
						$file->streamLock(true);
						$file->streamWrite($content);
						$file->streamUnlock();
						$file->streamClose(); 
					
					   // $file->mkdir($exportReadyDir);
						//$file->write($cssfile, $content);
						
					 
					} catch (Exception $e) {
						Mage::getSingleton('adminhtml/session')->addError(__('Failed generating CSS file: %s in %s', $filename, $cssdir). '<br/>Message: ' . $e->getMessage());
							 Mage::logException($e);
					}
				Mage::unregister('fontgen_store');
		 }
}