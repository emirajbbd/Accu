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
 * Country admin edit form
 *
 * @category    Harriswebworks
 * @package     Harriswebworks_Distributorcountry
 * @author      Ultimate Module Creator
 */
class Harriswebworks_Distributorcountry_Block_Adminhtml_Country_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    /**
     * constructor
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function __construct()
    {
        parent::__construct();
        $this->_blockGroup = 'harriswebworks_distributorcountry';
        $this->_controller = 'adminhtml_country';
        $this->_updateButton(
            'save',
            'label',
            Mage::helper('harriswebworks_distributorcountry')->__('Save Country')
        );
        $this->_updateButton(
            'delete',
            'label',
            Mage::helper('harriswebworks_distributorcountry')->__('Delete Country')
        );
        $this->_addButton(
            'saveandcontinue',
            array(
                'label'   => Mage::helper('harriswebworks_distributorcountry')->__('Save And Continue Edit'),
                'onclick' => 'saveAndContinueEdit()',
                'class'   => 'save',
            ),
            -100
        );
        $this->_formScripts[] = "
            function saveAndContinueEdit() {
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    /**
     * get the edit form header
     *
     * @access public
     * @return string
     * @author Ultimate Module Creator
     */
    public function getHeaderText()
    {
        if (Mage::registry('current_country') && Mage::registry('current_country')->getId()) {
            return Mage::helper('harriswebworks_distributorcountry')->__(
                "Edit Country '%s'",
                $this->escapeHtml(Mage::registry('current_country')->getCountry())
            );
        } else {
            return Mage::helper('harriswebworks_distributorcountry')->__('Add Country');
        }
    }
}
