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
 * New Product newproduct view block
 *
 * @category    Harriswebworks
 * @package     Harriswebworks_Newproducts
 * @author  Enamul Haque
 */
class Harriswebworks_Newproducts_Block_Catalog_Layer_View extends Mage_Catalog_Block_Layer_View
{
    const NEW_FILTER_POSITION = 2;

    /**
     * State block name
     *
     * @var string
     */
    protected $_newBlockName;

    protected function _initBlocks()
    {
        parent::_initBlocks();

        $this->_newBlockName = 'harriswebworks_newproducts/catalog_layer_filter_new';
    }

    /**
     * Prepare child blocks
     *
     * @return Mage_Catalog_Block_Layer_View
     */
    protected function _prepareLayout()
    {
        $newBlock = $this->getLayout()->createBlock($this->_newBlockName)
                ->setLayer($this->getLayer())
                ->init();

        $this->setChild('new_filter', $newBlock);

        return parent::_prepareLayout();
    }

    public function getFilters()
    {
        $filters = parent::getFilters();

        if (($newFilter = $this->_getNewFilter())) {
            // Insert new filter to the self::NEW_FILTER_POSITION position
            $filters = array_merge(
                array_slice(
                    $filters,
                    0,
                    self::NEW_FILTER_POSITION - 1
                ),
                array($newFilter),
                array_slice(
                    $filters,
                    self::NEW_FILTER_POSITION - 1,
                    count($filters) - 1
                )
            );
        }

        return $filters;
    }

    /**
     * Get new filter block
     *
     * @return Mage_Catalog_Block_Layer_Filter_Category
     */
    protected function _getNewFilter()
    {
        return $this->getChild('new_filter');
    }

}
