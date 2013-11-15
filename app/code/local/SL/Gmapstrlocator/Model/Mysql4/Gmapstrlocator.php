<?php

class SL_Model_Mysql4_Gmapstrlocator extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {    
        // Note that the gmapstrlocator_id refers to the key field in your database table.
        $this->_init('gmapstrlocator/gmapstrlocator', 'gmapstrlocator_id');
    }
    
    
    protected function _afterLoad(Mage_Core_Model_Abstract $object)
    {        
        //This load the selected stores
        $select = $this->_getReadAdapter()->select()->from($this->getTable('gmapstrlocator_store'))->where('gmapstrlocator_id = (?)', $object->getId());
        
        if($data = $this->_getReadAdapter()->fetchAll($select)){
            $storeArray = array();            
            foreach($data as $str_info){                
                $storeArray[] = $str_info['store_id'];
            }            
            $object->setData('store_id',$storeArray);
            
        }
        
        
        //This load the selected products
        $pselect = $this->_getReadAdapter()->select()->from($this->getTable('gmapstrlocator_products'))->where('gmapstrlocator_id = (?)', $object->getId());
 
        if($pdata = $this->_getReadAdapter()->fetchAll($pselect)){
            $prodArray = array();            
            foreach($pdata as $prod_info){                
                $prodArray[] = $prod_info['product_id'];
            }            
            $object->setData('linked_products',$prodArray);
            
        }
        
        
    
        return parent::_afterLoad($object);    
    }
    
    
    
    
    protected function _afterSave(Mage_Core_Model_Abstract $object)
    {        
        //This update the store table
        $condition = $this->_getWriteAdapter()->quoteInto('gmapstrlocator_id = ?', $object->getId());
        
        $this->_getWriteAdapter()->delete($this->getTable('gmapstrlocator_store'), $condition);        
        foreach ((array)$object->getData('store_id') as $store) {
            $storeArray = array();
            $storeArray['gmapstrlocator_id'] = $object->getId();
            $storeArray['store_id'] = $store;
            $this->_getWriteAdapter()->insert($this->getTable('gmapstrlocator_store'), $storeArray);
        }
    
        //This update the product table
        $this->_getWriteAdapter()->delete($this->getTable('gmapstrlocator_products'), $condition);
        foreach((array)$object->getData('linked_products') as $prod){
            $prodArray = array();
            $prodArray['gmapstrlocator_id'] = $object->getId();
            $prodArray['product_id'] = $prod;
            $this->_getWriteAdapter()->insert($this->getTable('gmapstrlocator_products'),$prodArray);
        }
    
        
        return parent::_afterSave($object);        
    }
    
    
    
    
    
    
    
    
    
}