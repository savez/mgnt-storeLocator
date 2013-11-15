<?php

class SL_Model_Gmapstrlocator extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('gmapstrlocator/gmapstrlocator');
    }
    
    public function loadAllProductsForSelect(){
        
        $storeId = Mage::app()->getStore()->getId();
         
        $collection = Mage::getModel('catalog/product')
            ->getCollection()
            ->addStoreFilter($storeId)
            ->addAttributeToSelect('*');
        
        $prodct_array = array();
        
        
        foreach ($collection as $product) {
            
            $prodct_array[] = array(
                                        'label' => $product->getName(),
                                        'value' => $product->getId()
                                    
                                    );
        }
            
        return $prodct_array;
     
    }
}

