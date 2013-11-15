<?php

class SL_Model_Mysql4_Gmapstrlocator_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('gmapstrlocator/gmapstrlocator');
    }
    
    
    public function addStoreFilter($store)
    {
        if ($store instanceof Mage_Core_Model_Store) {
            $store = array($store->getId());
        }

        $this->getSelect()->join(
            array('store_table' => $this->getTable('gmapstrlocator_store')),
            'main_table.gmapstrlocator_id = store_table.gmapstrlocator_id',
            array()
        )
        ->where('store_table.store_id in (?)', array(0, $store));

        return $this;
    }
    
}