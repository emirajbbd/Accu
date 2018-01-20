<?php
/**
 * Harriswebworks_Theme extension
 * 
 * NOTICE OF LICENSE
 * 
 * This source file is subject to the MIT License
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/mit-license.php
 * 
 * @category       Harriswebworks
 * @package        Harriswebworks_Theme
 * @copyright      Copyright (c) 2018
 * @license        http://opensource.org/licenses/mit-license.php MIT License
 */
/**
 * Newproducts default helper
 *
 * @category    Harriswebworks
 * @package     Harriswebworks_Theme
 * @author       Enamul Haque
 */
class Harriswebworks_Theme_Helper_Data extends Mage_Core_Helper_Abstract
{
    /**
     * Returns extension version.
     *
     * @return string
     */
	 const CFG_ENABLED_JQUERY = 'harriswebworks_theme/config_head/enabled_jquery';
	 const CFG_ADD_FONT = 'harriswebworks_theme/config_head/google_font';
	 public $jquery = 'skin/accustandard/jquery-1.11.0-min.js';
	 public $fontcss = 'css/font_css.css';
	 
	 
    public function getExtensionVersion()
    {
        return (string) Mage::getConfig()
            ->getNode()->modules->Harriswebworks_Theme->version;
    }
	/**
     * Add jquery.
     *
     * @return string
     */
	public function isEnabledJquery()
    {
        return Mage::getStoreConfigFlag(self::CFG_ENABLED_JQUERY);
    }
	/**
     * add fonts.
     *
     * @return string
     */
	public function addGoogleFont()
    {
        return Mage::getStoreConfigFlag(self::CFG_ADD_FONT);
    }
}
