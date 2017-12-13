<?php

/**
 *  CamerProject Plugin 
 * 
 * @package ElggGroup
 */
require_once __DIR__ . '/lib/functions.php';
elgg_register_event_handler('init', 'system', 'camerproject_init');
elgg_register_event_handler('init', 'system', 'camerproject_fields_setup', 10000);

use Needproject;

function camerproject_init(){
    
   elgg_register_entity_type('object', Needproject::SUBTYPE); 
   
    // event handler
   elgg_register_event_handler('update:after', 'object', '\camerpreneur\camerproject\Access::updateAnnotationAccess');
   
    // register actions
   $actions_bases = __DIR__.'/actions/needproject/';
    
   elgg_register_action('needproject/edit', "$actions_bases/edit.php","admin");
   elgg_register_action('needproject/delete', "$actions_bases/delete.php","admin");
   
    // register page handlers
   elgg_register_page_handler('needproject', '\camerpreneur\camerproject\Router::needproject');
      
}   
    

function camerproject_fields_setup(){
    
    $profile_defaults = [
        'description' => 'longtext',
        'progress' => 'text',
        'activity' => 'text',
        'markettype' => 'text',
        'typemark' => 'text',
        'offertype' => 'text',
        'turnover' => 'text',
        'currency' => 'text',
        'location' => 'location',
        'projectwebsite' => 'url',
        'projectblog' => 'url',
        'projectpitch' => 'url',
	];
    
    $profile_defaults = elgg_trigger_plugin_hook('profile:fields', 'group', NULL, $profile_defaults);

    elgg_set_config('group', $profile_defaults);
    
    // register any tag metadata names
    foreach ($profile_defaults as $name => $type) {
            if ($type == 'tags') {
                elgg_register_tag_metadata_name($name);

                // only shows up in search but why not just set this in en.php as doing it here
                // means you cannot override it in a plugin
                add_translation(get_current_language(), array("tag_names:$name" => elgg_echo("camerproject:$name")));
            }
    }
    
}
        
         

