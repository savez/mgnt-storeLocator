<?php
class SL_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction(){
    	
		$this->loadLayout();     
		$this->renderLayout();
    }
    
    
    
    public function searchprodAction(){
	
	
	
	if($data = $this->getRequest()->getPost()){
	    
	    $query_string = $data['query_string'];
	    $store_id = Mage::app()->getStore()->getId();
	    $result_prod_ids = array();
	    
	    $collection = Mage::getResourceModel('catalog/product_collection')->setStoreId($store_id);  
	    Mage::getSingleton('catalog/product_visibility')->addVisibleInCatalogFilterToCollection($collection);
	    Mage::getSingleton('catalog/product_status')->addVisibleFilterToCollection($collection);
	    
	    $collection->addAttributeToFilter(
                array(
                    array('attribute'=>'name', 'like'=>'%'.$query_string.'%'),
                    array('attribute'=>'sku', 'like'=>'%'.$query_string.'%')
                )
            );
	    
	    // array of resulted product ids in array
	    
	    $final_prod_ids = array();	    
	    
	    foreach($collection as $prod){
		
		$final_prod_ids[] = $prod->getId();
		
	    }
	    
	    
	    //Now find the GMap-stores against these product ids
	    $read_connection = Mage::getSingleton('core/resource')->getConnection('core_read');
	    $store_prod_table = Mage::getSingleton('core/resource')->getTableName('gmapstrlocator/gmapstrlocator_products');
	    $store_table = Mage::getSingleton('core/resource')->getTableName('gmapstrlocator/gmapstrlocator');
	    
	    
	    $select = $read_connection->select()->from(array('s_p' => $store_prod_table), array('s_p.gmapstrlocator_id'))
						->join(array('locator' => $store_table),'locator.gmapstrlocator_id = s_p.gmapstrlocator_id', array('locator.latitude','locator.longitude'))
						->where('s_p.product_id in (?)', $final_prod_ids); 
	    
	    
	    
	    
	    $resulting_stores = $read_connection->fetchAll($select);
	    
	    	    
	    $js_var = json_encode($resulting_stores);   
	    
	    echo $js_var;
	}
	
	
	
	
    }
    
    
    
}