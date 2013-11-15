<?php

class SL_Block_Adminhtml_Gmapstrlocator_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
                 
        $this->_objectId = 'id';
        $this->_blockGroup = 'gmapstrlocator';
        $this->_controller = 'adminhtml_gmapstrlocator';
        
        $this->_updateButton('save', 'label', Mage::helper('gmapstrlocator')->__('Save Store'));
        $this->_updateButton('delete', 'label', Mage::helper('gmapstrlocator')->__('Delete Store'));
		
        $this->_addButton('saveandcontinue', array(
            'label'     => Mage::helper('adminhtml')->__('Save And Continue Edit'),
            'onclick'   => 'saveAndContinueEdit()',
            'class'     => 'save',
        ), -100);

        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('gmapstrlocator_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'gmapstrlocator_content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'gmapstrlocator_content');
                }
            }

            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    public function getHeaderText()
    {
        if( Mage::registry('gmapstrlocator_data') && Mage::registry('gmapstrlocator_data')->getId() ) {
            return Mage::helper('gmapstrlocator')->__("Edit Store '%s'", $this->htmlEscape(Mage::registry('gmapstrlocator_data')->getStoreName()));
        } else {
            return Mage::helper('gmapstrlocator')->__('Add Store');
        }
    }
}