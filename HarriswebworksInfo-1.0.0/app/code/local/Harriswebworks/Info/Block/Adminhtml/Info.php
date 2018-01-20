<?php

class Harriswebworks_Info_Block_Adminhtml_Info
    extends Mage_Adminhtml_Block_Abstract
    implements Varien_Data_Form_Element_Renderer_Interface
{
    
    /**
     * Render fieldset html
     *
     * @param Varien_Data_Form_Element_Abstract $element
     * @return string
     */
    public function render(Varien_Data_Form_Element_Abstract $element)
    {
        $element  = null;
       $logo = Mage::getDesign()->getSkinUrl('images/harriswebworks/HWW-logo.png');
        $html = <<<HTML
<div style="background: #EFEFEF url('$logo') no-repeat scroll 5px center / 120px auto; 
border:1px solid #ccc; min-height:100px; margin:5px 0; 
padding:15px 15px 15px 140px;">
<p>
<strong>Magento Online Stores &amp; Extensions</strong><br />
Harris Web Works - Certified Magento Business Partner Agency. Offering extensions, custom programming and website administration.
</p>
<p>
Website: <a href="http://www.harriswebworks.com" target="_blank">www.harriswebworks.com</a>
<br />
Like, share and follow us on
<a href="https://www.facebook.com/harriswebworks" target="_blank">Facebook</a>, 
<a href="https://plus.google.com/b/114800674121094565738/114800674121094565738/about" target="_blank">Google+</a>, 
<a href="https://www.linkedin.com/company/harris-webworks/" target="_blank">Linkedin</a>, and 
<a href="https://twitter.com/HarrisWebWorks" target="_blank">Twitter</a>.<br />
For questions regarding sales and services contact us at: <a href="mailto:sales@apptrian.com">sales@harriswebworks.com</a>. 
For support with extensions or services contact us at: <a href="mailto:service@apptrian.com">service@harriswebworks.com</a>.
</p>
</div>
<div>
<p><strong>Products and services you might be interested in:</strong></p>
<!--<a href="http://www.harriswebworks.com/facebook-pixel-for-magento" 
target="_blank" style="margin: 0 15px 15px 0; display: inline-block;">
<img src="http://www.harriswebworks.com/media/facebook-pixel.jpg" 
alt="Facebook Pixel" style="border:1px solid #ccc;" />
</a>
<a href="http://www.harriswebworks.com/image-optimizer-for-magento" 
target="_blank" style="margin: 0 15px 15px 0; display: inline-block;">
<img src="http://www.harriswebworks.com/media/image-optimizer.jpg" 
alt="Image Optimizer" style="border:1px solid #ccc;" />
</a>
<a href="http://www.harriswebworks.com/minify-html-css-js-for-magento" 
target="_blank" style="margin: 0 15px 15px 0; display: inline-block;">
<img src="http://www.harriswebworks.com/media/minify-html-css-js.jpg" 
alt="Minify HTML CSS JS" style="border:1px solid #ccc;" />
</a>
<a href="http://www.harriswebworks.com/professional-magento-installation" 
target="_blank" style="margin: 0 15px 15px 0; display: inline-block;">
<img src="http://www.harriswebworks.com/media/professional-magento-installation.jpg" 
alt="Professional Magento Installation" style="border:1px solid #ccc;" />
</a>
<a href="http://www.harriswebworks.com/quick-search-for-magento" 
target="_blank" style="margin: 0 15px 15px 0; display: inline-block;">
<img src="http://www.harriswebworks.com/media/quick-search.jpg" 
alt="Quick Search" style="border:1px solid #ccc;" />
</a>
<a href="http://www.harriswebworks.com/responsive-product-slider-for-magento" 
target="_blank" style="margin: 0 15px 15px 0; display: inline-block;">
<img src="http://www.harriswebworks.com/media/responsive-product-slider.jpg" 
alt="Responsive Product Slider" style="border:1px solid #ccc;" />
</a>
<a href="http://www.harriswebworks.com/schema-org-microdata-for-magento" 
target="_blank" style="margin: 0 15px 15px 0; display: inline-block;">
<img src="http://www.harriswebworks.com/media/schema-org-microdata-for-magento.jpg" 
alt="Schema.org Microdata for Magento" style="border:1px solid #ccc;" />
</a>
<a href="http://www.harriswebworks.com/snippets-generator-for-magento" 
target="_blank" style="margin: 0 15px 15px 0; display: inline-block;">
<img src="http://www.harriswebworks.com/media/snippets-generator.jpg" 
alt="Snippets Generator" style="border:1px solid #ccc;" />
</a>
<a href="http://www.harriswebworks.com/social-integrator-for-magento" 
target="_blank" style="margin: 0 15px 15px 0; display: inline-block;">
<img src="http://www.harriswebworks.com/media/social-integrator.jpg" 
alt="Social Integrator" style="border:1px solid #ccc;" />
</a>
<a href="http://www.harriswebworks.com/subcategories-grid-list-for-magento" 
target="_blank" style="margin: 0 15px 15px 0; display: inline-block;">
<img src="http://www.harriswebworks.com/media/subcategories-grid-list.jpg" 
alt="Subcategories Grid/List" style="border:1px solid #ccc;" />
</a>-->
</div>
HTML;
        return $html;
    }
}
