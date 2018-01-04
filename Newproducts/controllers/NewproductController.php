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
 * New Product front contrller
 *
 * @category    Harriswebworks
 * @package     Harriswebworks_Newproducts
 * @author       Enamul Haque
 */
class Harriswebworks_Newproducts_NewproductController extends Mage_Core_Controller_Front_Action
{

    /**
      * default action
      *
      * @access public
      * @return void
      * @author  Enamul Haque
      */
    public function indexAction()
    {
       
		Mage::dispatchEvent(
            'catalog_controller_category_init_before',
            array('controller_action' => $this)
        );
        
        $rootCategoryId = (int) Mage::app()->getStore()->getRootCategoryId();
        if (!$rootCategoryId) {
            $this->_forward('noRoute');
            return;
        }

        $rootCategory = Mage::getModel('catalog/category')
            ->load($rootCategoryId)
                
            // TODO: Fetch from config
            ->setName($this->__('New Products'))
            ->setMetaTitle(Mage::getStoreConfig('harriswebworks_newproducts/newproduct/meta_title'))
            ->setMetaDescription(Mage::getStoreConfig('harriswebworks_newproducts/newproduct/meta_description'))
            ->setMetaKeywords(Mage::getStoreConfig('harriswebworks_newproducts/newproduct/meta_keywords'));
			 

        Mage::register('current_category', $rootCategory);
        
        Mage::getSingleton('catalog/session')
            ->setLastVisitedCategoryId($rootCategory->getId());

        try {
            Mage::dispatchEvent('catalog_controller_category_init_after',
                array(
                    'category' => $rootCategory,
                    'controller_action' => $this
                )
            );
        } catch (Mage_Core_Exception $e) {
            Mage::logException($e);
            return;
        }
         
        // Observer can change category
        if (!$rootCategory->getId()){
            $this->_forward('noRoute');
            return;
        }
		
		$this->loadLayout();
		
        $this->_initLayoutMessages('catalog/session');
        $this->_initLayoutMessages('customer/session');
        $this->_initLayoutMessages('checkout/session');
		
        //if (Mage::helper('harriswebworks_newproducts/newproduct')->getUseBreadcrumbs()) {
		if(Mage::getStoreConfigFlag('harriswebworks_newproducts/newproduct/breadcrumbs')){
            if ($breadcrumbBlock = $this->getLayout()->getBlock('breadcrumbs')) {
                $breadcrumbBlock->addCrumb(
                    'home',
                    array(
                        'label' => Mage::helper('harriswebworks_newproducts')->__('Home'),
                        'link'  => Mage::getUrl(),
                    )
                );
                $breadcrumbBlock->addCrumb(
                    'newproducts',
                    array(
                        'label' => Mage::helper('harriswebworks_newproducts')->__('New Products'),
                        'link'  => '',
                    )
                );
            }
        }
        $headBlock = $this->getLayout()->getBlock('head');
        if ($headBlock) {
            $headBlock->setTitle(Mage::getStoreConfig('harriswebworks_newproducts/newproduct/meta_title'));
            $headBlock->setKeywords(Mage::getStoreConfig('harriswebworks_newproducts/newproduct/meta_keywords'));
            $headBlock->setDescription(Mage::getStoreConfig('harriswebworks_newproducts/newproduct/meta_description'));
        }
        $this->renderLayout();
    }
   
}
