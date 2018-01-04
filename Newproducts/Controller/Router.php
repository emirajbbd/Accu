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
 * Router
 *
 * @category    Harriswebworks
 * @package     Harriswebworks_Newproducts
 * @author      Enamul Haque
 */
class Harriswebworks_Newproducts_Controller_Router extends Mage_Core_Controller_Varien_Router_Abstract
{
    /**
     * init routes
     *
     * @access public
     * @param Varien_Event_Observer $observer
     * @return Harriswebworks_Newproducts_Controller_Router
     * @author  Enamul Haque
     */
    public function initControllerNewproducts($observer)
    {
        $front = $observer->getEvent()->getFront();
        $front->addRouter('harriswebworks_newproducts', $this);
        return $this;
    }

    /**
     * Validate and match entities and modify request
     *
     * @access public
     * @param Zend_Controller_Request_Http $request
     * @return bool
     * @author  Enamul Haque
     */
    public function match(Zend_Controller_Request_Http $request)
    {
        /*if (!Mage::isInstalled()) {
            Mage::app()->getFrontController()->getResponse()
                ->setRedirect(Mage::getUrl('install'))
                ->sendResponse();
            exit;
        }*/
        $urlKey = trim($request->getPathInfo(), '/');
        $check = array();
		//$suff = Mage::getStoreConfig('harriswebworks_newproducts/newproduct/url_suffix');
		//if($suff)
		//$suff = ".".$suff;
        $check['newproduct'] = new Varien_Object(
            array(
                'prefix'        => Mage::getStoreConfig('harriswebworks_newproducts/newproduct/url_prefix'),
                'suffix'        => Mage::getStoreConfig('harriswebworks_newproducts/newproduct/url_suffix'),
                'list_key'      => Mage::getStoreConfig('harriswebworks_newproducts/newproduct/url_rewrite_list'),
                'list_action'   => 'index',
                'model'         =>'harriswebworks_newproducts/newproduct',
                'controller'    => 'newproduct',
                'action'        => 'index',
                'param'         => 'id',
                'check_path'    => 1
            )
        );
		//Mage::log($urlKey,true);
        foreach ($check as $key=>$settings) {
            if ($settings->getListKey()) {
				//Mage::log($settings,true);
				
				//$prefix = $settings->getPrefix()?$settings->getPrefix():'';
				//$suffixd = $suff ?  $suff : "";
				//Mage::log(Mage_Core_Model_Url_Rewrite::REWRITE_REQUEST_PATH_ALIAS,true);
                if ($urlKey ==  $settings->getListKey()) {
					
                    $request->setModuleName('newproducts')
                        ->setControllerName($settings->getController())
                        ->setActionName($settings->getListAction());
                    $request->setAlias(
                        Mage_Core_Model_Url_Rewrite::REWRITE_REQUEST_PATH_ALIAS,
                        $urlKey
                    );
					//Mage::log($request,true);
                    return true;
                }
            }
	
      /* if ($settings['prefix']) {
                $parts = explode('/', $urlKey);
                if ($parts[0] != $settings['prefix'] || count($parts) != 2) {
                    continue;
                }
                $urlKey = $parts[1];
            }
            if ($settings['suffix']) {
               // $urlKey = substr($urlKey, 0, -strlen($settings['suffix']) - 1);
            }*/
          //  $model = Mage::getModel($settings->getModel());
           // $id = $model->checkUrlKey($urlKey, Mage::app()->getStore()->getId());
           // if ($id) {
			   //Mage::log($urlKey,true);
               //Mage::log($request,true);
			  // return true;
                /*$request->setModuleName('new')
                    ->setControllerName($settings->getController())
                    ->setActionName($settings->getAction())
                    ;
                $request->setAlias(
                    Mage_Core_Model_Url_Rewrite::REWRITE_REQUEST_PATH_ALIAS,
                    $urlKey
                );*/
                //return true;
           // }
        }
        return false;
    }
}
