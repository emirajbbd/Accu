<?php

class Harriswebworks_Info_Block_Adminhtml_About
    extends Mage_Adminhtml_Block_Abstract
    implements Varien_Data_Form_Element_Renderer_Interface
{


    public function render(Varien_Data_Form_Element_Abstract $element)
    {
        $element  = null;
		 
        $version  = Mage::helper('harriswebworks_info')->getExtensionVersion();
        $logo = Mage::getDesign()->getSkinUrl('images/harriswebworks/HWW-logo.png');
        $html = <<<HTML
<div style="background: #EFEFEF url('$logo') no-repeat scroll 5px center / 120px auto; 
border:1px solid #ccc; min-height:100px; margin:5px 0; 
padding:15px 15px 15px 140px;">
<p>
<strong>Harriswebworks Newproducts Extension v$version</strong><br />
Display all the new products under root category on the default list layout.
</p>
<p>
Website: 
<a href="http://www.harriswebworks.com" target="_blank">www.harriswebworks.com</a><br />
Like, share and follow us on 
<a href="https://www.facebook.com/harriswebworks" target="_blank">Facebook</a>, 
<a href="https://plus.google.com/b/114800674121094565738/114800674121094565738/about" target="_blank">Google+</a>, 
<a href="https://www.linkedin.com/company/harris-webworks/" target="_blank">Linkedin</a>, and 
<a href="https://twitter.com/HarrisWebWorks" target="_blank">Twitter</a>.<br />
For questions regarding sales and services contact us at: <a href="mailto:sales@apptrian.com">sales@harriswebworks.com</a>. 
For support with extensions or services contact us at: <a href="mailto:service@apptrian.com">service@harriswebworks.com</a>.
</p>
</div>
HTML;
        return $html;
    }
}
