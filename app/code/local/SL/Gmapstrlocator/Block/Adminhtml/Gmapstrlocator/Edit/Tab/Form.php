<?php

class SL_Block_Adminhtml_Gmapstrlocator_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
  protected function _prepareForm()
  {
      $form = new Varien_Data_Form();
      $this->setForm($form);
      $fieldset = $form->addFieldset('gmapstrlocator_form', array('legend'=>Mage::helper('gmapstrlocator')->__('Store information')));
     
      $fieldset->addField('store_name', 'text', array(
          'label'     => Mage::helper('gmapstrlocator')->__('Store Name'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'store_name',
      ));
      
      
      
      $fieldset->addField('country', 'select', array(
        'name'  => 'country',
        'label'     => 'Country',
        'values'    => Mage::getModel('gmapstrlocator/system_config_source_countrylist')->toOptionArray(),
	'class'     => 'required-entry',
	'required'  => true,
      ));
      
       $fieldset->addField('district', 'text', array(
          'label'     => Mage::helper('gmapstrlocator')->__('District / City'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'district',
      ));
       
      $fieldset->addField('state', 'text', array(
          'label'     => Mage::helper('gmapstrlocator')->__('State'),
          'class'     => '',
          'required'  => false,
          'name'      => 'state',
      ));
       
      $fieldset->addField('postal_code', 'text', array(
          'label'     => Mage::helper('gmapstrlocator')->__('Postal / Zip Code'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'postal_code',
	  'style'     => 'width:150px;',	
      )); 
     
      $fieldset->addField('address', 'text', array(
          'label'     => Mage::helper('gmapstrlocator')->__('Address'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'address',
      ));
      
      $fieldset->addField('latitude', 'text', array(
          'label'     => Mage::helper('gmapstrlocator')->__('Latitude'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'latitude',
	  'style'     => 'width:150px;',
      ));
      
      $fieldset->addField('longitude', 'text', array(
          'label'     => Mage::helper('gmapstrlocator')->__('Longitude'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'longitude',
	  'style'     => 'width:150px;',
      ));
      
      
      
//      $fieldset->addField('filename', 'file', array(
//          'label'     => Mage::helper('gmapstrlocator')->__('File'),
//          'required'  => false,
//          'name'      => 'filename',
//	  ));


		
      $fieldset->addField('status', 'select', array(
          'label'     => Mage::helper('gmapstrlocator')->__('Status'),
          'name'      => 'status',
          'values'    => array(
              array(
                  'value'     => 1,
                  'label'     => Mage::helper('gmapstrlocator')->__('Enabled'),
              ),

              array(
                  'value'     => 2,
                  'label'     => Mage::helper('gmapstrlocator')->__('Disabled'),
              ),
          ),
      ));
     
     
      $fieldset->addField('store_phone', 'text', array(
          'label'     => Mage::helper('gmapstrlocator')->__('Phone'),
          'class'     => '',
          'required'  => false,
          'name'      => 'store_phone',
      ));
     
     
      $fieldset->addField('store_fax', 'text', array(
          'label'     => Mage::helper('gmapstrlocator')->__('Fax'),
          'class'     => '',
          'required'  => false,
          'name'      => 'store_fax',
      ));
      
     $fieldset->addField('store_image', 'file', array(
          'label'     => Mage::helper('gmapstrlocator')->__('Store Image'),
          'class'     => '',
          'required'  => false,
          'name'      => 'store_image',
      ));
      
     
     
     try{
	
	    $config = Mage::getSingleton('cms/wysiwyg_config')->getConfig(
		      array(
			    'add_widgets' => false,
			    'add_variables' => false,
			    //'add_images'	=> false,
			    'files_browser_window_url'=> $this->getBaseUrl().'admin/cms_wysiwyg_images/index/',
		      ));
	    $config->setData(Mage::helper('gmapstrlocator')->recursiveReplace(
						'/gmapstrlocator/',
						'/'.(string)Mage::app()->getConfig()->getNode('admin/routers/adminhtml/args/frontName').'/',
						$config->getData()
					)
				);
      }
      catch (Exception $ex){
			$config = null;
      }
     
     
     
      $fieldset->addField('store_description', 'editor', array(
          'name'      => 'store_description',
          'label'     => Mage::helper('gmapstrlocator')->__('Store Description'),
          'title'     => Mage::helper('gmapstrlocator')->__('Store Description'),
          'style'     => 'width:400px; height:200px;',
          'wysiwyg'   => true,
          'required'  => true,
	  'config'    => $config,
      ));
      
     
      
      $all_products = Mage::getModel('gmapstrlocator/gmapstrlocator')->loadAllProductsForSelect();
      
      $fieldset->addField('linked_products','multiselect',array(
	    'name'      => 'linked_products[]',
            'label'     => Mage::helper('gmapstrlocator')->__('Select Products'),
            'title'     => Mage::helper('gmapstrlocator')->__('Select Products'),
            'required'  => false,
	    'values'    => $all_products
      ));
      
         
      $fieldset->addField('store_id','multiselect',array(
	    'name'      => 'store_id[]',
            'label'     => Mage::helper('gmapstrlocator')->__('Website Store View'),
            'title'     => Mage::helper('gmapstrlocator')->__('Website Store View'),
            'required'  => true,
	    'values'    => Mage::getSingleton('adminhtml/system_store')->getStoreValuesForForm(false, true)
      ));
      
      
      
      
      
      
      
     
      if ( Mage::getSingleton('adminhtml/session')->getGmapstrlocatorData() )
      {
          $form->setValues(Mage::getSingleton('adminhtml/session')->getGmapstrlocatorData());
          Mage::getSingleton('adminhtml/session')->setGmapstrlocatorData(null);
      } elseif ( Mage::registry('gmapstrlocator_data') ) {
          $form->setValues(Mage::registry('gmapstrlocator_data')->getData());
      }
      return parent::_prepareForm();
  }
}