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
 * Country admin grid block
 *
 * @category    Harriswebworks
 * @package     Harriswebworks_Distributorcountry
 * @author      Ultimate Module Creator
 */
class Harriswebworks_Distributorcountry_Block_Adminhtml_Country_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    /**
     * constructor
     *
     * @access public
     * @author Ultimate Module Creator
     */
    public function __construct()
    {
        parent::__construct();
        $this->setId('countryGrid');
        $this->setDefaultSort('entity_id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
    }

    /**
     * prepare collection
     *
     * @access protected
     * @return Harriswebworks_Distributorcountry_Block_Adminhtml_Country_Grid
     * @author Ultimate Module Creator
     */
    protected function _prepareCollection()
    {
        $collection = Mage::getModel('harriswebworks_distributorcountry/country')
            ->getCollection();
        
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    /**
     * prepare grid collection
     *
     * @access protected
     * @return Harriswebworks_Distributorcountry_Block_Adminhtml_Country_Grid
     * @author Ultimate Module Creator
     */
    protected function _prepareColumns()
    {
        $this->addColumn(
            'entity_id',
            array(
                'header' => Mage::helper('harriswebworks_distributorcountry')->__('Id'),
                'index'  => 'entity_id',
                'type'   => 'number'
            )
        );
        $this->addColumn(
            'country',
            array(
                'header'    => Mage::helper('harriswebworks_distributorcountry')->__('Country'),
                'align'     => 'left',
                'index'     => 'country',
            )
        );
        
        $this->addColumn(
            'status',
            array(
                'header'  => Mage::helper('harriswebworks_distributorcountry')->__('Status'),
                'index'   => 'status',
                'type'    => 'options',
                'options' => array(
                    '1' => Mage::helper('harriswebworks_distributorcountry')->__('Enabled'),
                    '0' => Mage::helper('harriswebworks_distributorcountry')->__('Disabled'),
                )
            )
        );
        $this->addColumn(
            'country_code',
            array(
                'header' => Mage::helper('harriswebworks_distributorcountry')->__('Country Code'),
                'index'  => 'country_code',
                'type'=> 'text',

            )
        );
        $this->addColumn(
            'exclusive',
            array(
                'header' => Mage::helper('harriswebworks_distributorcountry')->__('Exclusive'),
                'index'  => 'exclusive',
                'type'    => 'options',
                    'options'    => array(
                    '1' => Mage::helper('harriswebworks_distributorcountry')->__('Yes'),
                    '0' => Mage::helper('harriswebworks_distributorcountry')->__('No'),
                )

            )
        );
		$this->addColumn(
            'dea_exempt',
            array(
                'header' => Mage::helper('harriswebworks_distributorcountry')->__('DEA Exempt'),
                'index'  => 'dea_exempt',
                'type'    => 'options',
                    'options'    => array(
                    '1' => Mage::helper('harriswebworks_distributorcountry')->__('Yes'),
                    '0' => Mage::helper('harriswebworks_distributorcountry')->__('No'),
                )

            )
        );
        $this->addColumn(
            'kp_country_id',
            array(
                'header' => Mage::helper('harriswebworks_distributorcountry')->__('KP Country Id'),
                'index'  => 'kp_country_id',
                'type'=> 'text',

            )
        );
        $this->addColumn(
            'action',
            array(
                'header'  =>  Mage::helper('harriswebworks_distributorcountry')->__('Action'),
                'width'   => '100',
                'type'    => 'action',
                'getter'  => 'getId',
                'actions' => array(
                    array(
                        'caption' => Mage::helper('harriswebworks_distributorcountry')->__('Edit'),
                        'url'     => array('base'=> '*/*/edit'),
                        'field'   => 'id'
                    )
                ),
                'filter'    => false,
                'is_system' => true,
                'sortable'  => false,
            )
        );
        $this->addExportType('*/*/exportCsv', Mage::helper('harriswebworks_distributorcountry')->__('CSV'));
        $this->addExportType('*/*/exportExcel', Mage::helper('harriswebworks_distributorcountry')->__('Excel'));
        $this->addExportType('*/*/exportXml', Mage::helper('harriswebworks_distributorcountry')->__('XML'));
        return parent::_prepareColumns();
    }

    /**
     * prepare mass action
     *
     * @access protected
     * @return Harriswebworks_Distributorcountry_Block_Adminhtml_Country_Grid
     * @author Ultimate Module Creator
     */
    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('entity_id');
        $this->getMassactionBlock()->setFormFieldName('country');
        $this->getMassactionBlock()->addItem(
            'delete',
            array(
                'label'=> Mage::helper('harriswebworks_distributorcountry')->__('Delete'),
                'url'  => $this->getUrl('*/*/massDelete'),
                'confirm'  => Mage::helper('harriswebworks_distributorcountry')->__('Are you sure?')
            )
        );
        $this->getMassactionBlock()->addItem(
            'status',
            array(
                'label'      => Mage::helper('harriswebworks_distributorcountry')->__('Change status'),
                'url'        => $this->getUrl('*/*/massStatus', array('_current'=>true)),
                'additional' => array(
                    'status' => array(
                        'name'   => 'status',
                        'type'   => 'select',
                        'class'  => 'required-entry',
                        'label'  => Mage::helper('harriswebworks_distributorcountry')->__('Status'),
                        'values' => array(
                            '1' => Mage::helper('harriswebworks_distributorcountry')->__('Enabled'),
                            '0' => Mage::helper('harriswebworks_distributorcountry')->__('Disabled'),
                        )
                    )
                )
            )
        );
        $this->getMassactionBlock()->addItem(
            'exclusive',
            array(
                'label'      => Mage::helper('harriswebworks_distributorcountry')->__('Change Exclusive'),
                'url'        => $this->getUrl('*/*/massExclusive', array('_current'=>true)),
                'additional' => array(
                    'flag_exclusive' => array(
                        'name'   => 'flag_exclusive',
                        'type'   => 'select',
                        'class'  => 'required-entry',
                        'label'  => Mage::helper('harriswebworks_distributorcountry')->__('Exclusive'),
                        'values' => array(
                                '1' => Mage::helper('harriswebworks_distributorcountry')->__('Yes'),
                                '0' => Mage::helper('harriswebworks_distributorcountry')->__('No'),
                            )

                    )
                )
            )
        );
		
		$this->getMassactionBlock()->addItem(
            'dea_exempt',
            array(
                'label'      => Mage::helper('harriswebworks_distributorcountry')->__('Change DEA Exempt'),
                'url'        => $this->getUrl('*/*/massExclusive', array('_current'=>true)),
                'additional' => array(
                    'flag_dea_exempt' => array(
                        'name'   => 'flag_dea_exempt',
                        'type'   => 'select',
                        'class'  => 'required-entry',
                        'label'  => Mage::helper('harriswebworks_distributorcountry')->__('DEA Exempt'),
                        'values' => array(
                                '1' => Mage::helper('harriswebworks_distributorcountry')->__('Yes'),
                                '0' => Mage::helper('harriswebworks_distributorcountry')->__('No'),
                            )

                    )
                )
            )
        );
		
		
        return $this;
    }

    /**
     * get the row url
     *
     * @access public
     * @param Harriswebworks_Distributorcountry_Model_Country
     * @return string
     * @author Ultimate Module Creator
     */
    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }

    /**
     * get the grid url
     *
     * @access public
     * @return string
     * @author Ultimate Module Creator
     */
    public function getGridUrl()
    {
        return $this->getUrl('*/*/grid', array('_current'=>true));
    }

    /**
     * after collection load
     *
     * @access protected
     * @return Harriswebworks_Distributorcountry_Block_Adminhtml_Country_Grid
     * @author Ultimate Module Creator
     */
    protected function _afterLoadCollection()
    {
        $this->getCollection()->walk('afterLoad');
        parent::_afterLoadCollection();
    }
}
