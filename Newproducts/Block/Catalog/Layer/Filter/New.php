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
 * New Product new block
 *
 * @category    Harriswebworks
 * @package     Harriswebworks_Newproducts
 * @author  Enamul Haque
 */
class Harriswebworks_Newproducts_Block_Catalog_Layer_Filter_New extends Mage_Catalog_Block_Layer_Filter_Abstract
{

    public function __construct()
    {
        parent::__construct();
        $this->_filterModelName = 'harriswebworks_newproducts/catalog_layer_filter_new';
    }

}
