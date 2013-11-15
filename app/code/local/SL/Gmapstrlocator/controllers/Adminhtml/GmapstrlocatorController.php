<?php

class SL_Adminhtml_GmapstrlocatorController extends Mage_Adminhtml_Controller_Action
{

	protected function _initAction() {
		$this->loadLayout()
			->_setActiveMenu('gmapstrlocator/items')
			->_addBreadcrumb(Mage::helper('adminhtml')->__('Store Locator Manager'), Mage::helper('adminhtml')->__('Store Locator Manager'));
		
		return $this;
	}   
 
	public function indexAction() {
		$this->_initAction()
			->renderLayout();
	}

	public function editAction() {
		$id     = $this->getRequest()->getParam('id');
		$model  = Mage::getModel('gmapstrlocator/gmapstrlocator')->load($id);

		if ($model->getId() || $id == 0) {
			$data = Mage::getSingleton('adminhtml/session')->getFormData(true);
			if (!empty($data)) {
				$model->setData($data);
			}

			Mage::register('gmapstrlocator_data', $model);

			$this->loadLayout();
			$this->_setActiveMenu('gmapstrlocator/items');

			$this->_addBreadcrumb(Mage::helper('adminhtml')->__('Store Locator Manager'), Mage::helper('adminhtml')->__('Store Locator Manager'));
			$this->_addBreadcrumb(Mage::helper('adminhtml')->__('Store Locator Manager'), Mage::helper('adminhtml')->__('Store Locator Manager'));

			$this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
			$this->getLayout()->getBlock('head')->setCanLoadTinyMce(true);

			$this->_addContent($this->getLayout()->createBlock('gmapstrlocator/adminhtml_gmapstrlocator_edit'))
				->_addLeft($this->getLayout()->createBlock('gmapstrlocator/adminhtml_gmapstrlocator_edit_tabs'));

			$this->renderLayout();
		} else {
			Mage::getSingleton('adminhtml/session')->addError(Mage::helper('gmapstrlocator')->__('Item does not exist'));
			$this->_redirect('*/*/');
		}
	}
 
	public function newAction() {
		$this->_forward('edit');
	}
 
	public function saveAction() {
		if ($data = $this->getRequest()->getPost()) {
			
			
			
			
			if(isset($_FILES['store_image']['name']) && $_FILES['store_image']['name'] != '') {
		        //this way the name is saved in DB
	  			$data['store_image'] = $_FILES['store_image']['name'];
			}
	  			
	  			
			$model = Mage::getModel('gmapstrlocator/gmapstrlocator');		
			$model->setData($data)
				->setId($this->getRequest()->getParam('id'));
			
			try {
				if ($model->getCreatedTime == NULL || $model->getUpdateTime() == NULL) {
					$model->setCreatedTime(now())
						->setUpdateTime(now());
				} else {
					$model->setUpdateTime(now());
				}	
				
				$model->save();
				
				$lastInsertedId = $model->getId();
				
				if(isset($_FILES['store_image']['name']) && $_FILES['store_image']['name'] != '') {
					try {	
						/* Starting upload */	
						$uploader = new Varien_File_Uploader('store_image');
						
						// Any extention would work
						$uploader->setAllowedExtensions(array('jpg','JPG','jpeg','gif','GIF','png','PNG'));
						$uploader->setAllowRenameFiles(false);
						$uploader->setFilesDispersion(false);
								
						// We set media/gmapstrlocator as the upload dir
						$path = Mage::getBaseDir('media') . DS ;
						$path = $path .'gmapstrlocator'. DS .$lastInsertedId. DS;
						
						$uploader->save($path, $_FILES['store_image']['name'] );
						
						//create a thumb and save it
						
						$imgPathFull = $path.$_FILES['store_image']['name'];
						$thumbResizedPath = $path.'thumb'. DS .$_FILES['store_image']['name'];
						$imageObj = new Varien_Image($imgPathFull);
						$imageObj->constrainOnly(TRUE);
						$imageObj->keepAspectRatio(TRUE);
						$imageObj->resize(110,110);
						$imageObj->save($thumbResizedPath);						
						
					} catch (Exception $e) {
			      
					}
				}
				
				
				
				Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('gmapstrlocator')->__('Store was successfully saved'));
				Mage::getSingleton('adminhtml/session')->setFormData(false);

				if ($this->getRequest()->getParam('back')) {
					$this->_redirect('*/*/edit', array('id' => $model->getId()));
					return;
				}
				$this->_redirect('*/*/');
				return;
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setFormData($data);
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }
        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('gmapstrlocator')->__('Unable to find Store to save'));
        $this->_redirect('*/*/');
	}
 
	public function deleteAction() {
		if( $this->getRequest()->getParam('id') > 0 ) {
			try {
				$model = Mage::getModel('gmapstrlocator/gmapstrlocator');
				 
				$model->setId($this->getRequest()->getParam('id'))
					->delete();
					 
				Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Store was successfully deleted'));
				$this->_redirect('*/*/');
			} catch (Exception $e) {
				Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
				$this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
			}
		}
		$this->_redirect('*/*/');
	}

    public function massDeleteAction() {
        $gmapstrlocatorIds = $this->getRequest()->getParam('gmapstrlocator');
        if(!is_array($gmapstrlocatorIds)) {
			Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('Please select Store(s)'));
        } else {
            try {
                foreach ($gmapstrlocatorIds as $gmapstrlocatorId) {
                    $gmapstrlocator = Mage::getModel('gmapstrlocator/gmapstrlocator')->load($gmapstrlocatorId);
                    $gmapstrlocator->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('adminhtml')->__(
                        'Total of %d record(s) were successfully deleted', count($gmapstrlocatorIds)
                    )
                );
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/index');
    }
	
    public function massStatusAction()
    {
        $gmapstrlocatorIds = $this->getRequest()->getParam('gmapstrlocator');
        if(!is_array($gmapstrlocatorIds)) {
            Mage::getSingleton('adminhtml/session')->addError($this->__('Please select Store(s)'));
        } else {
            try {
                foreach ($gmapstrlocatorIds as $gmapstrlocatorId) {
                    $gmapstrlocator = Mage::getSingleton('gmapstrlocator/gmapstrlocator')
                        ->load($gmapstrlocatorId)
                        ->setStatus($this->getRequest()->getParam('status'))
                        ->setIsMassupdate(true)
                        ->save();
                }
                $this->_getSession()->addSuccess(
                    $this->__('Total of %d record(s) were successfully updated', count($gmapstrlocatorIds))
                );
            } catch (Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/index');
    }
  
    public function exportCsvAction()
    {
        $fileName   = 'gmapstrlocator.csv';
        $content    = $this->getLayout()->createBlock('gmapstrlocator/adminhtml_gmapstrlocator_grid')
            ->getCsv();

        $this->_sendUploadResponse($fileName, $content);
    }

    public function exportXmlAction()
    {
        $fileName   = 'gmapstrlocator.xml';
        $content    = $this->getLayout()->createBlock('gmapstrlocator/adminhtml_gmapstrlocator_grid')
            ->getXml();

        $this->_sendUploadResponse($fileName, $content);
    }

    protected function _sendUploadResponse($fileName, $content, $contentType='application/octet-stream')
    {
        $response = $this->getResponse();
        $response->setHeader('HTTP/1.1 200 OK','');
        $response->setHeader('Pragma', 'public', true);
        $response->setHeader('Cache-Control', 'must-revalidate, post-check=0, pre-check=0', true);
        $response->setHeader('Content-Disposition', 'attachment; filename='.$fileName);
        $response->setHeader('Last-Modified', date('r'));
        $response->setHeader('Accept-Ranges', 'bytes');
        $response->setHeader('Content-Length', strlen($content));
        $response->setHeader('Content-type', $contentType);
        $response->setBody($content);
        $response->sendResponse();
        die;
    }
}
