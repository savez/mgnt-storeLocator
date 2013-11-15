<?php
class SL_Block_Gmapstrlocator extends Mage_Core_Block_Template
{
	
    public function _prepareLayout(){
	
        
        if ($head = $this->getLayout()->getBlock('head')) {
            $head->setTitle(Mage::helper('gmapstrlocator')->getGMapPageTitle());
            $head->setDescription(Mage::helper('gmapstrlocator')->getGMapMetadescription());
            $head->setKeywords(Mage::helper('gmapstrlocator')->getGMapMetaKeywords());
        }
        
        return parent::_prepareLayout();
        
    }
    
    public function getGmapstrlocator(){
	
        if (!$this->hasData('gmapstrlocator')) {
            $this->setData('gmapstrlocator', Mage::registry('gmapstrlocator'));
        }
        return $this->getData('gmapstrlocator');
        
    }
    
    
    public function getAllStores(){
	
	$web_store = Mage::app()->getStore()->getStoreId();
	
	$collection = Mage::getModel('gmapstrlocator/gmapstrlocator')->getCollection()
									->addStoreFilter($web_store)
									->addFieldToFilter('main_table.status',1)
									->addOrder('main_table.created_time','DESC');
	
	
	
	return $collection->getData();
	
    }
    
    
    
    
    
    
    
    
    
    
    
}