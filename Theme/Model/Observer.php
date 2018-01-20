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

class Harriswebworks_Theme_Model_Observer extends Varien_Event_Observer
{
	
		
	public function prepareLayoutBefore(Varien_Event_Observer $observer){
		 /* @var $block Mage_Page_Block_Html_Head */
		 $block = $observer->getEvent()->getBlock();
		 if("head" == $block->getNameInLayout()) {
		if(Mage::helper('harriswebworks_theme')->isEnabledJquery()){
			
			$jquery = Mage::helper('harriswebworks_theme')->jquery;
			$this->addjs($block,$jquery);
			
		}
			//return $this;
		
		$font = Mage::helper('harriswebworks_theme')->addGoogleFont();
		if($font!=''){
			$cssfile = Mage::helper('harriswebworks_theme')->fontcss;
			$this->addcss($block,$cssfile);
		}
		 }
		/*if("head" == $block->getNameInLayout()) {
            $block->addJs($jquery);
        }*/
        return $this;
	}
	protected function addjs($block,$file){
		
            $block->addJs($file);
	}
	protected function addcss($block,$file){
            $block->addItem('skin_css', $file);
	}
}