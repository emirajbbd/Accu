<?php
/**
 * Harriswebworks_Distributorcountry extension
 * 
 * NOTICE OF LICENSE
 * 
 * This source file is subject to the MIT License
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/mit-license.php
 * 
 * @category       Harriswebworks
 * @package        Harriswebworks_Distributorcountry
 * @copyright      Copyright (c) 2017
 * @license        http://opensource.org/licenses/mit-license.php MIT License
 */
/**
 * Country admin edit tabs
 *
 * @category    Harriswebworks
 * @package     Harriswebworks_Distributorcountry
 * @author      Ultimate Module Creator
 */
class Harriswebworks_Distributorcountry_Block_Adminhtml_Country_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
    /**
     * Initialize Tabs
     *
     * @access public
     * @author Ultimate Module Creator
     */
    public function __construct()
    {
        parent::__construct();
        $this->setId('country_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('harriswebworks_distributorcountry')->__('Country'));
    }

    /**
     * before render html
     *
     * @access protected
     * @return Harriswebworks_Distributorcountry_Block_Adminhtml_Country_Edit_Tabs
     * @author Ultimate Module Creator
     */
    protected function _beforeToHtml()
    {
        $this->addTab(
            'form_country',
            array(
                'label'   => Mage::helper('harriswebworks_distributorcountry')->__('Country'),
                'title'   => Mage::helper('harriswebworks_distributorcountry')->__('Country'),
                'content' => $this->getLayout()->createBlock(
                    'harriswebworks_distributorcountry/adminhtml_country_edit_tab_form'
                )
                ->toHtml(),
            )
        );
        return parent::_beforeToHtml();
    }

    /**
     * Retrieve country entity
     *
     * @access public
     * @return Harriswebworks_Distributorcountry_Model_Country
     * @author Ultimate Module Creator
     */
    public function getCountry()
    {
        return Mage::registry('current_country');
    }
}
