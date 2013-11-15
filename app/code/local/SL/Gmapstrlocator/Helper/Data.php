<?php

class SL_Helper_Data extends Mage_Core_Helper_Abstract
{
    
    const XML_GMAP_PAGE_TITLE                   =   'gmapstrlocator/general/page_title';
    const XML_GMAP_IDENTIFIER                   =   'gmapstrlocator/general/identifier';
    const XML_GMAP_PAGE_METAKEYWORD             =   'gmapstrlocator/general/meta_keywords';
    const XML_GMAP_PAGE_METADESCRIPTION         =   'gmapstrlocator/general/meta_description';
    const XML_GMAP_STANDARD_LATITUDE            =   'gmapstrlocator/general/standard_lat';
    const XML_GMAP_STANDARD_LONGITUDE           =   'gmapstrlocator/general/standard_long';
    const XML_GMAP_PAGE_HEADING                 =   'gmapstrlocator/general/page_heading';
    const XML_GMAP_PAGE_SUBHEADING              =   'gmapstrlocator/general/page_subheading';
    const XML_GMAP_API_KEY                      =   'gmapstrlocator/general/api_key';
    const XML_GMAP_ZIP_NEAREST_STORE            =   'gmapstrlocator/general/zip_nearest';
    const XML_GMAP_ADDRESS_NEAREST_STORE        =   'gmapstrlocator/general/address_nearest';
    
    const XML_GMAP_GET_DIRECTION_BTN_TEXT       =   'gmapstrlocator/info_popup/button_text';
    const XML_GMAP_MARKER                       =   'gmapstrlocator/info_popup/marker_image';
    const XML_GMAP_POPUP_BG_PRIMARY_IMAGE       =   'gmapstrlocator/info_popup/bg_primary_image';
    const XML_GMAP_POPUP_BG_SECONDARY_IMAGE     =   'gmapstrlocator/info_popup/bg_secondary_image';
    const XML_GMAP_ZOOM                         =   'gmapstrlocator/info_popup/map_zoom';
    
    const XML_GMAP_SEARCH_PRODUDCT              =   'gmapstrlocator/manage_search/product';
    const XML_GMAP_SEARCH_ZIPCODE               =   'gmapstrlocator/manage_search/zipcode';
    const XML_GMAP_SEARCH_ADDRESS               =   'gmapstrlocator/manage_search/address';
    const XML_GMAP_SEARCH_STORE_SELECT          =   'gmapstrlocator/manage_search/store_select';
    
    const XML_GMAP_HEADERLINK_ENABLE            =   'gmapstrlocator/manage_links/header_enable';
    const XML_GMAP_HEADERLINK_TEXT              =   'gmapstrlocator/manage_links/header_text';
    const XML_GMAP_FOOTERLINK_ENABLE            =   'gmapstrlocator/manage_links/footer_enable';
    const XML_GMAP_FOOTERLINK_TEXT              =   'gmapstrlocator/manage_links/footer_text';
    
    const XML_GMAP_LAYOUT_UPDATE                =   'gmapstrlocator/layout_update/page_column';
    
    const XML_GMAP_SEO_SUFFIX                   =   'gmapstrlocator/seo/url_suffix';
    
    
    public function getGMapNearestZipEnabled(){
        
        return Mage::getStoreConfig(self::XML_GMAP_ZIP_NEAREST_STORE);
    }
    public function getGMapNearestAddressEnabled(){
        
        return Mage::getStoreConfig(self::XML_GMAP_ADDRESS_NEAREST_STORE);
    }
    public function getGMapPageTitle(){
        
        return Mage::getStoreConfig(self::XML_GMAP_PAGE_TITLE);
    }
    
    public function getGMapIdentifier(){
        
        return Mage::getStoreConfig(self::XML_GMAP_IDENTIFIER);
    }
    
    public function getGMapAPIKey(){
        
        return Mage::getStoreConfig(self::XML_GMAP_API_KEY);
    }
    
    public function getGMapMetaKeywords(){
        
        return Mage::getStoreConfig(self::XML_GMAP_PAGE_METAKEYWORD);
    }
    public function getGMapMetadescription(){
        
        return Mage::getStoreConfig(self::XML_GMAP_PAGE_METADESCRIPTION);
    }
    
    public function getGMapSeoSuffix(){
        
        return Mage::getStoreConfig(self::XML_GMAP_SEO_SUFFIX);
    }
    
    public function getGMapZoom(){
        
        if(self::XML_GMAP_ZOOM == ''){
            return 8;
        }
        
        return Mage::getStoreConfig(self::XML_GMAP_ZOOM);
    }
    
    
    public function isSearchByProductEnable(){
        
        return Mage::getStoreConfig(self::XML_GMAP_SEARCH_PRODUDCT);
    }
    
    public function isSearchByZipcodeEnable(){
        
        return Mage::getStoreConfig(self::XML_GMAP_SEARCH_ZIPCODE);
    }
    
    public function isSearchByAddressEnable(){
        
        return Mage::getStoreConfig(self::XML_GMAP_SEARCH_ADDRESS);
    }
    
    public function isSearchStoreSelectEnable(){
        
        return Mage::getStoreConfig(self::XML_GMAP_SEARCH_STORE_SELECT);
    }
    
    
    
    
    public function isHeaderLinkEnable(){
        
        return Mage::getStoreConfig(self::XML_GMAP_HEADERLINK_ENABLE);
    }
    
    public function isFooterLinkEnable(){
        
        return Mage::getStoreConfig(self::XML_GMAP_FOOTERLINK_ENABLE);
    }
    
    public function getHeaderLinkLabel(){
        
        return Mage::getStoreConfig(self::XML_GMAP_HEADERLINK_TEXT);
    }
    
    public function getFooterLinkLabel(){
        
        return Mage::getStoreConfig(self::XML_GMAP_FOOTERLINK_TEXT);
    }
    
    public function getStoreLocatorPageUrl(){
        
        return Mage::getBaseUrl().$this->getGMapIdentifier().$this->getGMapSeoSuffix();
        //return Mage::getUrl('gmapstrlocator/index');
    }
    
    public function getGMapListIdentifier(){
        
        
        $identifier = $this->getGMapIdentifier();
	if ( !$identifier ) {
		$identifier = 'gmapstrlocator';
	}
	return $identifier;
    }
    
    public function getGMapStandardLatitude(){
        
        
        return Mage::getStoreConfig(self::XML_GMAP_STANDARD_LATITUDE);
        
    }
    
    public function getGMapStandardLongitude(){
        
        return Mage::getStoreConfig(self::XML_GMAP_STANDARD_LONGITUDE);
    }
    
    public function getGMapPageHeading(){
        
        return Mage::getStoreConfig(self::XML_GMAP_PAGE_HEADING);
    }
    
    public function getGMapPageSubheading(){
        
        return Mage::getStoreConfig(self::XML_GMAP_PAGE_SUBHEADING);
    }
    
    public function getDirectionButtonText(){
        
        return Mage::getStoreConfig(self::XML_GMAP_GET_DIRECTION_BTN_TEXT);
    }
    
    public function getGMapMarkerExist(){
        
        //Send full path
        return Mage::getStoreConfig(self::XML_GMAP_MARKER);
    }
    
    public function getGMapMarkerSrc(){
        
        //Send full path
        return Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA).'gmapstrlocator/marker'.DS.Mage::getStoreConfig(self::XML_GMAP_MARKER);
    }
    
    public function getGMapPopupBgprimaryExist(){
        
        //Send full path
        return Mage::getStoreConfig(self::XML_GMAP_POPUP_BG_PRIMARY_IMAGE);
    }
    
    public function getGMapPopupBgprimarySrc(){
        
        //Send full path
        return Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA).'gmapstrlocator/bgprimary'.DS.Mage::getStoreConfig(self::XML_GMAP_POPUP_BG_PRIMARY_IMAGE);
    }
    
    public function getGMapPopupBgsecondaryExist(){
        
        //Send full path
        return Mage::getStoreConfig(self::XML_GMAP_POPUP_BG_SECONDARY_IMAGE);
    }
    
    public function getGMapPopupBgsecondarySrc(){
        
        //Send full path
        return Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA).'gmapstrlocator/bgsecondary'.DS.Mage::getStoreConfig(self::XML_GMAP_POPUP_BG_SECONDARY_IMAGE);
    }
    
    
    public function getGMapLayoutupdate(){
        
        $page_layout = Mage::getStoreConfig(self::XML_GMAP_LAYOUT_UPDATE);
        
        switch($page_layout)
        {
            case 'empty':
                $page_layout = 'page/empty.phtml';
                break;
            case 'one_column':
                $page_layout = "page/1column.phtml";
                break;
            case 'two_columns_left':
                $page_layout = 'page/2columns-left.phtml';
                break;
            case 'two_columns_right':
                $page_layout = 'page/2columns-right.phtml';
                break;
            case 'three_columns':
                $page_layout = 'page/3columns.phtml';
                break;
            default:
                $page_layout = 'page/2columns-right.phtml';
        }
        
        return $page_layout;
        
    }
    
    
    
    
    
    public function recursiveReplace($search, $replace, $subject){
		if(!is_array($subject))
		    return $subject;
	
		foreach($subject as $key => $value)
		    if(is_string($value))
			$subject[$key] = str_replace($search, $replace, $value);
		    elseif(is_array($value))
			$subject[$key] = self::recursiveReplace($search, $replace, $value);
	
		return $subject;
    }
        
        

}