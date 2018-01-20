<?php
class Harriswebworks_Distributorcountry_Model_Observer extends Varien_Event_Observer
{
	public $exclusive = false;
	private $active = false;
	protected function isActivate(){
		$this->active = Mage::helper('harriswebworks_distributorcountry/data')->isEnabled();
		return $this->active;
	}
	public function hidePrice(Varien_Event_Observer $observer){
			
			if(!$this->isActivate())
			return;
			
			$session = Mage::getSingleton("core/session",  array("name"=>"frontend"));
			//if(!$session->getData("distributorcountry")){
				if(true){
				$event = $observer->getEvent();
				$product = $event->getProduct();
				//Mage::log('here',true);
				$this->exclusive = $this->getDistributorcountryInfo();
				//Mage::log($this->exclusive,true);
				if($this->exclusive){
					$session->setData("hideprice", 1);
					$session->setData("distributorcountry", 1);
					$product->setFinalPrice(0);
					$product->setPrice(0);
				}else{
					$session->setData("hideprice", 0);
				}
			}
            // Mage::log($session->getData("hideprice"),true);
    }
	public function setDeaExempt(Varien_Event_Observer $observer){
		if(!$this->isActivate())
			return;
		$data = $this->checkDataInfo();
		
		//echo $data[0]->dea_exempt; addAttributeToFilter
		//Mage::log($data,true);
		//&& !in_array($ip,$excludeips)
		if($data[0]['dea_exempt']!=1 ){
			$collection = $observer->getCollection()->addAttributeToFilter(
    array(
        array(
            'attribute' => 'hazard_code',
            'null' => ''
        ),
        array(
            'attribute' => 'hazard_code',
            'neq' => 'V'
        )
    )
);
			//addFieldToFilter('hazard_code', array('neq' => 'V','eq'=>''),'or');
			//Mage::log((string) $collection->getSelect());
		}
	}
	
	
    public function hidePriceCatalog(Varien_Event_Observer $observer){
		if(!$this->isActivate())
			return;
		$session = Mage::getSingleton("core/session",  array("name"=>"frontend"));
		if(!$session->getData("distributorcountry")){
			$products = $observer->getCollection();
			$this->exclusive = $this->getDistributorcountryInfo();
			//Mage::log($this->exclusive,true);
			if($this->exclusive){
				$session->setData("hideprice", 1);
				$session->setData("distributorcountry", 1);
				
				foreach( $products as $product )
				{
					$product->setFinalPrice(0);
					$product->setPrice(0);
				}
			}else{
				$session->setData("hideprice", 0);
			}
		}
    }
	public function checkIfDistributorcountry(){
		if(!$this->isActivate())
			return;
		$session = Mage::getSingleton("core/session",  array("name"=>"frontend"));
		if(!$session->getData("distributorcountry")){
			$this->exclusive = $this->getDistributorcountryInfo();
			if($this->exclusive){
				$session->setData("hideprice", 1);
				$session->setData("distributorcountry", 1);
			}else{
				$session->setData("hideprice", 0);
				$session->setData("distributorcountry", 1);
			}
		}
	}
	public function cleanUpSession(){
		if(!$this->isActivate())
			return;
		$session = Mage::getSingleton("core/session",  array("name"=>"frontend"));
		$session->setData("distributorcountry",'');	
		$session->unsData("distributorcountry");
		$session->setData("hideprice",'');	
		$session->unsData("hideprice");
	}
	public function checkDistributorcountry(){
		if(!$this->isActivate())
			return;
		$session = Mage::getSingleton("core/session",  array("name"=>"frontend"));
		$this->exclusive = $this->getDistributorcountryInfo();
		if($this->exclusive){
			$session->setData("distributorcountry", 1);
			$session->setData("hideprice", 1);
		}else{
			$session->setData("distributorcountry", 1);
			$session->setData("hideprice", 0);
		}
	}
	
	protected function checkDataInfo(){
		$deep_detect=true;
		$ip = isset($_SERVER["REMOTE_ADDR"]) ? $_SERVER["REMOTE_ADDR"] :'';
        if ($deep_detect) {
            if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
                $ip = isset($_SERVER['HTTP_X_FORWARDED_FOR'])?$_SERVER['HTTP_X_FORWARDED_FOR']:'';
            if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
                $ip = isset($_SERVER['HTTP_CLIENT_IP'])?$_SERVER['HTTP_CLIENT_IP']:'';
        }
		if($ip ){
		  	list( $o1, $o2, $o3,$o4 ) = explode('.',$ip);
			$integer_ip =   ( 16777216 * $o1 ) + ( 65536 * $o2 ) + ( 256 * $o3 ) + $o4;
			$resource = Mage::getSingleton('core/resource');
			$connection = $resource->getConnection('core/resource');
		  	$qr="SELECT exclusive, dea_exempt FROM amasty_geoip_location l, amasty_geoip_block b, harriswebworks_distributorcountry_country c WHERE l.geoip_loc_id = b.geoip_loc_id AND INET_ATON( '".$ip."' ) BETWEEN b.start_ip_num AND b.end_ip_num and c.country_code=l.country LIMIT 1";
			$qrrun = $connection->fetchAll($qr);	
			//Mage::log($qr,true);
			//Mage::log($qrrun,true);
			return $qrrun;
		}
		return null;
	}
	private function getDistributorcountryInfo(){
		if(!$this->isActivate())
			return;
		 	$data = $this->checkDataInfo();
			$excludeips = Mage::helper('harriswebworks_distributorcountry/data')->excludeIps();
		  	if($data[0]['exclusive']==1 && !in_array($ip,$excludeips)/*!($ip=='68.185.185.100' || $ip=='75.80.107.35' )*/){
				 $customer = Mage::getSingleton('customer/session');
				// Mage::log('exyes',true);
				if(!Mage::getSingleton('customer/session')->isLoggedIn()){
					//Mage::log('yes',true);
					return true;
				}else{
					$customerdata = $customer->getCustomer();
					if($customerdata->getDistributorPrices()==0)
					return true;
				}
			}
		 // Mage::log('no',true);
		return false;
	}
}//$ip ='45.125.222.800' ||