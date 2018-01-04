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
 * Frontend observer
 *
 * @category    Harriswebworks
 * @package     Harriswebworks_Newproducts
 * @author       Enamul Haque
 */
class Harriswebworks_Newproducts_Model_Observer
{
    /**
     * add items to main menu
     *
     * @access public
     * @param Varien_Event_Observer $observer
     * @return array()
     * @author  Enamul Haque
     */
    public function addItemsToTopmenuItems($observer)
    {
        $menu = $observer->getMenu();
        $tree = $menu->getTree();
        $action = Mage::app()->getFrontController()->getAction()->getFullActionName();
        $newproductNodeId = 'newproduct';
        $data = array(
            'name' => Mage::helper('harriswebworks_newproducts')->__('New Products'),
            'id' => $newproductNodeId,
            'url' => Mage::helper('harriswebworks_newproducts/newproduct')->getNewproductsUrl(),
            'is_active' => ($action == 'harriswebworks_newproducts_newproduct_index' || $action == 'harriswebworks_newproducts_newproduct_view')
        );
        $newproductNode = new Varien_Data_Tree_Node($data, 'id', $tree, $menu);
        $menu->addChild($newproductNode);
        return $this;
    }
}
