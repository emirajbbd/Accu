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
 * Country edit form tab
 *
 * @category    Harriswebworks
 * @package     Harriswebworks_Distributorcountry
 * @author      Ultimate Module Creator
 */
class Harriswebworks_Distributorcountry_Block_Adminhtml_Country_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    /**
     * prepare the form
     *
     * @access protected
     * @return Harriswebworks_Distributorcountry_Block_Adminhtml_Country_Edit_Tab_Form
     * @author Ultimate Module Creator
     */
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $form->setHtmlIdPrefix('country_');
        $form->setFieldNameSuffix('country');
        $this->setForm($form);
        $fieldset = $form->addFieldset(
            'country_form',
            array('legend' => Mage::helper('harriswebworks_distributorcountry')->__('Country'))
        );

        $fieldset->addField(
            'country',
            'text',
            array(
                'label' => Mage::helper('harriswebworks_distributorcountry')->__('Country'),
                'name'  => 'country',
                'required'  => true,
                'class' => 'required-entry',

           )
        );

        $fieldset->addField(
            'country_code',
            'text',
            array(
                'label' => Mage::helper('harriswebworks_distributorcountry')->__('Country Code'),
                'name'  => 'country_code',
                'required'  => true,
                'class' => 'required-entry',

           )
        );

        $fieldset->addField(
            'exclusive',
            'select',
            array(
                'label' => Mage::helper('harriswebworks_distributorcountry')->__('Exclusive'),
                'name'  => 'exclusive',
                'required'  => true,
                'class' => 'required-entry',

            'values'=> array(
                array(
                    'value' => 1,
                    'label' => Mage::helper('harriswebworks_distributorcountry')->__('Yes'),
                ),
                array(
                    'value' => 0,
                    'label' => Mage::helper('harriswebworks_distributorcountry')->__('No'),
                ),
            ),
           )
        );
		 $fieldset->addField(
            'dea_exempt',
            'select',
            array(
                'label' => Mage::helper('harriswebworks_distributorcountry')->__('DEA Exempt'),
                'name'  => 'dea_exempt',
                'required'  => true,
                'class' => 'required-entry',

            'values'=> array(
                array(
                    'value' => 1,
                    'label' => Mage::helper('harriswebworks_distributorcountry')->__('Yes'),
                ),
                array(
                    'value' => 0,
                    'label' => Mage::helper('harriswebworks_distributorcountry')->__('No'),
                ),
            ),
           )
        );
        $fieldset->addField(
            'kp_country_id',
            'text',
            array(
                'label' => Mage::helper('harriswebworks_distributorcountry')->__('KP Country Id'),
                'name'  => 'kp_country_id',
                'required'  => true,
                'class' => 'required-entry',

           )
        );
        $fieldset->addField(
            'status',
            'select',
            array(
                'label'  => Mage::helper('harriswebworks_distributorcountry')->__('Status'),
                'name'   => 'status',
                'values' => array(
                    array(
                        'value' => 1,
                        'label' => Mage::helper('harriswebworks_distributorcountry')->__('Enabled'),
                    ),
                    array(
                        'value' => 0,
                        'label' => Mage::helper('harriswebworks_distributorcountry')->__('Disabled'),
                    ),
                ),
            )
        );
        $formValues = Mage::registry('current_country')->getDefaultValues();
        if (!is_array($formValues)) {
            $formValues = array();
        }
        if (Mage::getSingleton('adminhtml/session')->getCountryData()) {
            $formValues = array_merge($formValues, Mage::getSingleton('adminhtml/session')->getCountryData());
            Mage::getSingleton('adminhtml/session')->setCountryData(null);
        } elseif (Mage::registry('current_country')) {
            $formValues = array_merge($formValues, Mage::registry('current_country')->getData());
        }
        $form->setValues($formValues);
        return parent::_prepareForm();
    }
}
