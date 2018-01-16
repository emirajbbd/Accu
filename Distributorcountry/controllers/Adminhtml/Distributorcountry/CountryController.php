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
 * Country admin controller
 *
 * @category    Harriswebworks
 * @package     Harriswebworks_Distributorcountry
 * @author      Ultimate Module Creator
 */
class Harriswebworks_Distributorcountry_Adminhtml_Distributorcountry_CountryController extends Harriswebworks_Distributorcountry_Controller_Adminhtml_Distributorcountry
{
    /**
     * init the country
     *
     * @access protected
     * @return Harriswebworks_Distributorcountry_Model_Country
     */
    protected function _initCountry()
    {
        $countryId  = (int) $this->getRequest()->getParam('id');
        $country    = Mage::getModel('harriswebworks_distributorcountry/country');
        if ($countryId) {
            $country->load($countryId);
        }
        Mage::register('current_country', $country);
        return $country;
    }

    /**
     * default action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function indexAction()
    {
        $this->loadLayout();
        $this->_title(Mage::helper('harriswebworks_distributorcountry')->__('Distributor Countries'))
             ->_title(Mage::helper('harriswebworks_distributorcountry')->__('Countries'));
        $this->renderLayout();
    }

    /**
     * grid action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function gridAction()
    {
        $this->loadLayout()->renderLayout();
    }

    /**
     * edit country - action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function editAction()
    {
        $countryId    = $this->getRequest()->getParam('id');
        $country      = $this->_initCountry();
        if ($countryId && !$country->getId()) {
            $this->_getSession()->addError(
                Mage::helper('harriswebworks_distributorcountry')->__('This country no longer exists.')
            );
            $this->_redirect('*/*/');
            return;
        }
        $data = Mage::getSingleton('adminhtml/session')->getCountryData(true);
        if (!empty($data)) {
            $country->setData($data);
        }
        Mage::register('country_data', $country);
        $this->loadLayout();
        $this->_title(Mage::helper('harriswebworks_distributorcountry')->__('Distributor Countries'))
             ->_title(Mage::helper('harriswebworks_distributorcountry')->__('Countries'));
        if ($country->getId()) {
            $this->_title($country->getCountry());
        } else {
            $this->_title(Mage::helper('harriswebworks_distributorcountry')->__('Add country'));
        }
        if (Mage::getSingleton('cms/wysiwyg_config')->isEnabled()) {
            $this->getLayout()->getBlock('head')->setCanLoadTinyMce(true);
        }
        $this->renderLayout();
    }

    /**
     * new country action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function newAction()
    {
        $this->_forward('edit');
    }

    /**
     * save country - action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function saveAction()
    {
        if ($data = $this->getRequest()->getPost('country')) {
            try {
                $country = $this->_initCountry();
                $country->addData($data);
                $country->save();
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('harriswebworks_distributorcountry')->__('Country was successfully saved')
                );
                Mage::getSingleton('adminhtml/session')->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/*/edit', array('id' => $country->getId()));
                    return;
                }
                $this->_redirect('*/*/');
                return;
            } catch (Mage_Core_Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setCountryData($data);
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            } catch (Exception $e) {
                Mage::logException($e);
                Mage::getSingleton('adminhtml/session')->addError(
                    Mage::helper('harriswebworks_distributorcountry')->__('There was a problem saving the country.')
                );
                Mage::getSingleton('adminhtml/session')->setCountryData($data);
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }
        Mage::getSingleton('adminhtml/session')->addError(
            Mage::helper('harriswebworks_distributorcountry')->__('Unable to find country to save.')
        );
        $this->_redirect('*/*/');
    }

    /**
     * delete country - action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function deleteAction()
    {
        if ( $this->getRequest()->getParam('id') > 0) {
            try {
                $country = Mage::getModel('harriswebworks_distributorcountry/country');
                $country->setId($this->getRequest()->getParam('id'))->delete();
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('harriswebworks_distributorcountry')->__('Country was successfully deleted.')
                );
                $this->_redirect('*/*/');
                return;
            } catch (Mage_Core_Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError(
                    Mage::helper('harriswebworks_distributorcountry')->__('There was an error deleting country.')
                );
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                Mage::logException($e);
                return;
            }
        }
        Mage::getSingleton('adminhtml/session')->addError(
            Mage::helper('harriswebworks_distributorcountry')->__('Could not find country to delete.')
        );
        $this->_redirect('*/*/');
    }

    /**
     * mass delete country - action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function massDeleteAction()
    {
        $countryIds = $this->getRequest()->getParam('country');
        if (!is_array($countryIds)) {
            Mage::getSingleton('adminhtml/session')->addError(
                Mage::helper('harriswebworks_distributorcountry')->__('Please select countries to delete.')
            );
        } else {
            try {
                foreach ($countryIds as $countryId) {
                    $country = Mage::getModel('harriswebworks_distributorcountry/country');
                    $country->setId($countryId)->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('harriswebworks_distributorcountry')->__('Total of %d countries were successfully deleted.', count($countryIds))
                );
            } catch (Mage_Core_Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError(
                    Mage::helper('harriswebworks_distributorcountry')->__('There was an error deleting countries.')
                );
                Mage::logException($e);
            }
        }
        $this->_redirect('*/*/index');
    }

    /**
     * mass status change - action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function massStatusAction()
    {
        $countryIds = $this->getRequest()->getParam('country');
        if (!is_array($countryIds)) {
            Mage::getSingleton('adminhtml/session')->addError(
                Mage::helper('harriswebworks_distributorcountry')->__('Please select countries.')
            );
        } else {
            try {
                foreach ($countryIds as $countryId) {
                $country = Mage::getSingleton('harriswebworks_distributorcountry/country')->load($countryId)
                            ->setStatus($this->getRequest()->getParam('status'))
                            ->setIsMassupdate(true)
                            ->save();
                }
                $this->_getSession()->addSuccess(
                    $this->__('Total of %d countries were successfully updated.', count($countryIds))
                );
            } catch (Mage_Core_Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError(
                    Mage::helper('harriswebworks_distributorcountry')->__('There was an error updating countries.')
                );
                Mage::logException($e);
            }
        }
        $this->_redirect('*/*/index');
    }

    /**
     * mass Exclusive change - action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function massExclusiveAction()
    {
        $countryIds = $this->getRequest()->getParam('country');
        if (!is_array($countryIds)) {
            Mage::getSingleton('adminhtml/session')->addError(
                Mage::helper('harriswebworks_distributorcountry')->__('Please select countries.')
            );
        } else {
            try {
                foreach ($countryIds as $countryId) {
                $country = Mage::getSingleton('harriswebworks_distributorcountry/country')->load($countryId)
                    ->setExclusive($this->getRequest()->getParam('flag_exclusive'))
                    ->setIsMassupdate(true)
                    ->save();
                }
                $this->_getSession()->addSuccess(
                    $this->__('Total of %d countries were successfully updated.', count($countryIds))
                );
            } catch (Mage_Core_Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError(
                    Mage::helper('harriswebworks_distributorcountry')->__('There was an error updating countries.')
                );
                Mage::logException($e);
            }
        }
        $this->_redirect('*/*/index');
    }

    /**
     * export as csv - action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function exportCsvAction()
    {
        $fileName   = 'country.csv';
        $content    = $this->getLayout()->createBlock('harriswebworks_distributorcountry/adminhtml_country_grid')
            ->getCsv();
        $this->_prepareDownloadResponse($fileName, $content);
    }

    /**
     * export as MsExcel - action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function exportExcelAction()
    {
        $fileName   = 'country.xls';
        $content    = $this->getLayout()->createBlock('harriswebworks_distributorcountry/adminhtml_country_grid')
            ->getExcelFile();
        $this->_prepareDownloadResponse($fileName, $content);
    }

    /**
     * export as xml - action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function exportXmlAction()
    {
        $fileName   = 'country.xml';
        $content    = $this->getLayout()->createBlock('harriswebworks_distributorcountry/adminhtml_country_grid')
            ->getXml();
        $this->_prepareDownloadResponse($fileName, $content);
    }

    /**
     * Check if admin has permissions to visit related pages
     *
     * @access protected
     * @return boolean
     * @author Ultimate Module Creator
     */
    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('harriswebworks_distributorcountry/country');
    }
}
