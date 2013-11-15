<?php

class SL_Block_Adminhtml_Gmapstrlocator_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
  public function __construct()
  {
      parent::__construct();
      $this->setId('gmapstrlocatorGrid');
      $this->setDefaultSort('gmapstrlocator_id');
      $this->setDefaultDir('ASC');
      $this->setSaveParametersInSession(true);
  }

  protected function _prepareCollection()
  {
      $collection = Mage::getModel('gmapstrlocator/gmapstrlocator')->getCollection();
      $this->setCollection($collection);
      return parent::_prepareCollection();
  }

  protected function _prepareColumns()
  {
      $this->addColumn('gmapstrlocator_id', array(
          'header'    => Mage::helper('gmapstrlocator')->__('ID'),
          'align'     =>'right',
          'width'     => '50px',
          'index'     => 'gmapstrlocator_id',
      ));

      $this->addColumn('store_name', array(
          'header'    => Mage::helper('gmapstrlocator')->__('Store Name'),
          'align'     =>'left',
          'index'     => 'store_name',
	  'width'     => '350px',
      ));
      
      $this->addColumn('country', array(
          'header'    => Mage::helper('gmapstrlocator')->__('Country'),
          'align'     =>'left',
          'index'     => 'country',
	  'type'      => 'options',
	  'options'   => Mage::getModel('gmapstrlocator/system_config_source_countrylist')->toOptionArray(true),
	  
      ));
      
      $this->addColumn('district', array(
          'header'    => Mage::helper('gmapstrlocator')->__('District / City'),
          'align'     =>'left',
          'index'     => 'district',
      ));
      
      $this->addColumn('postal_code', array(
          'header'    => Mage::helper('gmapstrlocator')->__('Postal / Zip Code'),
          'align'     =>'left',
          'index'     => 'postal_code',
      ));
      
      
      $this->addColumn('address', array(
          'header'    => Mage::helper('gmapstrlocator')->__('Address'),
          'align'     =>'left',
          'index'     => 'address',
	  'width'     => '250px',      
      ));
      
      
    

      $this->addColumn('status', array(
          'header'    => Mage::helper('gmapstrlocator')->__('Status'),
          'align'     => 'left',
          'width'     => '80px',
          'index'     => 'status',
          'type'      => 'options',
          'options'   => array(
              1 => 'Enabled',
              2 => 'Disabled',
          ),
      ));
	  
        $this->addColumn('action',
            array(
                'header'    =>  Mage::helper('gmapstrlocator')->__('Action'),
                'width'     => '100',
                'type'      => 'action',
                'getter'    => 'getId',
                'actions'   => array(
                    array(
                        'caption'   => Mage::helper('gmapstrlocator')->__('Edit'),
                        'url'       => array('base'=> '*/*/edit'),
                        'field'     => 'id'
                    )
                ),
                'filter'    => false,
                'sortable'  => false,
                'index'     => 'stores',
                'is_system' => true,
        ));
		
		$this->addExportType('*/*/exportCsv', Mage::helper('gmapstrlocator')->__('CSV'));
		$this->addExportType('*/*/exportXml', Mage::helper('gmapstrlocator')->__('XML'));
	  
      return parent::_prepareColumns();
  }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('gmapstrlocator_id');
        $this->getMassactionBlock()->setFormFieldName('gmapstrlocator');

        $this->getMassactionBlock()->addItem('delete', array(
             'label'    => Mage::helper('gmapstrlocator')->__('Delete'),
             'url'      => $this->getUrl('*/*/massDelete'),
             'confirm'  => Mage::helper('gmapstrlocator')->__('Are you sure?')
        ));

        $statuses = Mage::getSingleton('gmapstrlocator/status')->getOptionArray();

        array_unshift($statuses, array('label'=>'', 'value'=>''));
        $this->getMassactionBlock()->addItem('status', array(
             'label'=> Mage::helper('gmapstrlocator')->__('Change status'),
             'url'  => $this->getUrl('*/*/massStatus', array('_current'=>true)),
             'additional' => array(
                    'visibility' => array(
                         'name' => 'status',
                         'type' => 'select',
                         'class' => 'required-entry',
                         'label' => Mage::helper('gmapstrlocator')->__('Status'),
                         'values' => $statuses
                     )
             )
        ));
        return $this;
    }

  public function getRowUrl($row)
  {
      return $this->getUrl('*/*/edit', array('id' => $row->getId()));
  }

}