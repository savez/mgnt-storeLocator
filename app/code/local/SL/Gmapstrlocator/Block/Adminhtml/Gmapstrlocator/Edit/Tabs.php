<?php

class SL_Block_Adminhtml_Gmapstrlocator_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

  public function __construct()
  {
      parent::__construct();
      $this->setId('gmapstrlocator_tabs');
      $this->setDestElementId('edit_form');
      $this->setTitle(Mage::helper('gmapstrlocator')->__('Store Information'));
  }

  protected function _beforeToHtml()
  {
      $this->addTab('form_section', array(
          'label'     => Mage::helper('gmapstrlocator')->__('Store Information'),
          'title'     => Mage::helper('gmapstrlocator')->__('Store Information'),
          'content'   => $this->getLayout()->createBlock('gmapstrlocator/adminhtml_gmapstrlocator_edit_tab_form')->toHtml(),
      ));
     
      return parent::_beforeToHtml();
  }
}