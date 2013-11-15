<?php

$installer = $this;

$installer->startSetup();

$installer->run("

DROP TABLE IF EXISTS {$this->getTable('gmapstrlocator')};

CREATE TABLE {$this->getTable('gmapstrlocator')} (
            `gmapstrlocator_id` int(11) unsigned NOT NULL auto_increment,  
                  `store_name` varchar(255) NOT NULL default '',                 
                  `district` varchar(255) NOT NULL default '',
                  `state` varchar(255) default '',
                  `country` varchar(255) NOT NULL default '',                    
                  `postal_code` varchar(255) NOT NULL default '',                
                  `address` varchar(255) NOT NULL default '',                    
                  `latitude` float(10,6) NOT NULL default '0.000000',            
                  `longitude` float(10,6) NOT NULL default '0.000000',           
                  `store_phone` tinytext,                                        
                  `store_fax` tinytext,                                          
                  `store_image` varchar(255) default '',                         
                  `store_description` text,                                      
                  `status` smallint(6) NOT NULL default '0',                     
                  `created_time` datetime default NULL,                          
                  `update_time` datetime default NULL,                           
                  PRIMARY KEY  (`gmapstrlocator_id`)  
                  
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS {$this->getTable('gmapstrlocator_store')};
CREATE TABLE {$this->getTable('gmapstrlocator_store')} (  
                    `gmapstrlocator_id` int(11) NOT NULL,                                 
                    `store_id` smallint(5) unsigned NOT NULL,                             
                    PRIMARY KEY  (`gmapstrlocator_id`,`store_id`),                        
                    KEY `FK_GMAPSTRLOCATOR_STORE_STORE` (`store_id`)                     
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='GMapStoreLocator Stores';


DROP TABLE IF EXISTS {$this->getTable('gmapstrlocator_products')};
CREATE TABLE {$this->getTable('gmapstrlocator_products')} (                           
                    `gmapstrlocator_product_id` int(11) NOT NULL auto_increment,          
                    `gmapstrlocator_id` int(11) default NULL,                             
                    `product_id` int(11) default NULL,                                    
                    UNIQUE KEY `gmapstrlocator_product_id` (`gmapstrlocator_product_id`)   
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 ;


    ");

$installer->setConfigData('gmapstrlocator/general/page_title','G - Map Store Locator');
$installer->setConfigData('gmapstrlocator/general/identifier','store-locator');
$installer->setConfigData('gmapstrlocator/general/meta_keywords','G - Map Store Locator');
$installer->setConfigData('gmapstrlocator/general/meta_description','G - Map Store Locator');
$installer->setConfigData('gmapstrlocator/general/page_heading','FIND A  STORE NEAR YOU');
$installer->setConfigData('gmapstrlocator/general/page_subheading','Select a store if you want to shop or find it through Address');
$installer->setConfigData('gmapstrlocator/general/standard_long','90.98877');
$installer->setConfigData('gmapstrlocator/general/standard_lat','26.12585');

$installer->setConfigData('gmapstrlocator/info_popup/button_text','Get Directions');

$installer->setConfigData('gmapstrlocator/info_popup/map_zoom',2);

$installer->setConfigData('gmapstrlocator/manage_search/product',1);
$installer->setConfigData('gmapstrlocator/manage_search/address',1);
$installer->setConfigData('gmapstrlocator/manage_search/store_select',1);

$installer->setConfigData('gmapstrlocator/manage_links/header_enable',1);
$installer->setConfigData('gmapstrlocator/manage_links/header_text','Store locator');
$installer->setConfigData('gmapstrlocator/manage_links/footer_enable',1);
$installer->setConfigData('gmapstrlocator/manage_links/footer_text','Store locator');

$installer->setConfigData('gmapstrlocator/layout_update/page_column','one_column');

$installer->setConfigData('gmapstrlocator/seo/url_suffix','.html');




$installer->endSetup(); 