<?php

class SL_Controller_Router extends Mage_Core_Controller_Varien_Router_Abstract
{
    public function initControllerRouters($observer)
    {    		
        $front = $observer->getEvent()->getFront();
        $router = new FME_Gmapstrlocator_Controller_Router();
        $front->addRouter('gmapstrlocator', $router);
        
    }

    public function match(Zend_Controller_Request_Http $request)
    {
	if (!Mage::isInstalled()) {
            Mage::app()->getFrontController()->getResponse()
                ->setRedirect(Mage::getUrl('install'))
                ->sendResponse();
            exit;
        }
		

        $route = Mage::helper('gmapstrlocator')->getGMapListIdentifier();
	
	$identifier = trim($request->getPathInfo(), '/');
	
        $identifier = str_replace(Mage::helper('gmapstrlocator')->getGMapSeoSuffix(), '', $identifier);
	
	
	$condition = new Varien_Object(array(
            'identifier' => $identifier,
            'continue'   => true
        ));
	
	Mage::dispatchEvent('gmapstrlocator_controller_router_match_before', array(
            'router'    => $this,
            'condition' => $condition
        ));
	
	
	$identifier = $condition->getIdentifier();
	
	
	if ($condition->getRedirectUrl()) {
            Mage::app()->getFrontController()->getResponse()
                ->setRedirect($condition->getRedirectUrl())
                ->sendResponse();
            $request->setDispatched(true);
            return true;
        }

        if (!$condition->getContinue()) {
            return false;
        }
	
	
		if ( $identifier == $route ) {

		    $request->setModuleName('gmapstrlocator')
				    ->setControllerName('index')
				    ->setActionName('index');
				    
		    return true;
				    
		}
		
		
		return false;
		    
		
	    
	
	
	
		
       

    }
}