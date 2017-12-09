<?php

/**
 *  CamerProject Plugin 
 * 
 * @package ElggGroup
 */


elgg_register_event_handler('init', 'system', 'camerproject_init');

require_once(dirname(__FILE__) . '/lib/functions.php');

use Needproject;

function camerproject_init(){
    
   elgg_register_entity_type('object', Needproject::SUBTYPE);
    
}   
    

        
         

