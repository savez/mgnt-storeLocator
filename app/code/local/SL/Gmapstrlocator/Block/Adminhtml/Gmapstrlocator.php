<?php
class SL_Block_Adminhtml_Gmapstrlocator extends Mage_Adminhtml_Block_Widget_Grid_Container
{
  public function __construct()
  {
    $this->_controller = 'adminhtml_gmapstrlocator';
    $this->_blockGroup = 'gmapstrlocator';
    $this->_headerText = Mage::helper('gmapstrlocator')->__('G-Map Store Locator Manager');
    $this->_addButtonLabel = Mage::helper('gmapstrlocator')->__('Add New Store');
    parent::__construct();
  }
}