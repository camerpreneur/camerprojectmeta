<?php

/**
 *  CamerProject Plugin 
 * 
 * @package ElggGroup
 */


elgg_register_event_handler('init', 'system', 'camerproject_init');

require_once(dirname(__FILE__) . '/lib/functions.php');

function camerproject_init(){
    
    elgg_register_entity_type('object', Needproject::SUBTYPE);
  
    
    // event handler
   // elgg_register_event_handler('update:after', 'object', '\camerpreneur\camerproject\Access::updateAnnotationAccess');    
    // plugin hook
  //  elgg_register_plugin_hook_handler('access:collections:write', 'all', '\camerpreneur\camerproject\Access::accessArray', 999);

}   
    

        
         

