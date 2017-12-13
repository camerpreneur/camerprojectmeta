<?php
 /**
  * function return the the state of the project are
  * @return array
  */
function project_get_progress(){
    
    $codes = [
        'elab_concept',
        'prototype',
        'test',
        'pre_client',
        'pre_result_financiere',
        'develop',
        'develop_inter',
    ];
    
    $progress = [];
    
    foreach ($codes as $code){
        $progress[$code] = elgg_echo("camerproject:projectstatus:title:$code");      
    }
 
    
    return $progress;
}

/**
 * function define the currency of project
 * 
 */

function project_get_currency(){
    
    $codes = [
        'usd',
        'euro',
        'franc',
        'niara',
        'rand',
        'dinar',
        'peso',
        'birr',
        'cedi',    
    ];
    
    $currency = [];
    
    foreach ( $codes as $code){
        $currency[$code] = elgg_echo("camerproject:projectcurrency:name:$code");
    }
    uksort($currency, 'strcasecmp');
    
    return $currency;
}


/**
 * function define industry sector 
 * 
 */

function project_get_industrysector(){
    
    $codes = [
        'agri',
        'auto',
        'bank',
        'biolo',
        'afric',
        'it',       
    ];
    
    $$industry = [];
    
    foreach ($codes as $code){
        $industry[$code] = elgg_echo("camerproject:projectindustrysector:name:$code");
    }
    
    uksort($industry, 'strcasecmp');
    
    return $industry;
}


/**
 * Prepare the form vars for add/edit a Needproject
 *
 * @param Needproject $entity (optional) the entity to edit
 *
 * @return array
 */
function camerproject_prepare_needproject_vars(Needproject $entity = null) {
	
	// defaults
	$result = [
		'titleneed' => '',
		'description' => '',
                'skills' => '',
                'ability' => '',
                'statusneed' => '',
            
		'access_id' => get_default_access(null, [
			'entity_type' => 'object',
			'entity_subtype' => Needproject::SUBTYPE,
			'container_guid' => elgg_get_site_entity()->guid,
		]),
	];
	
        $sticky_vars = elgg_get_sticky_values('needproject/edit');
	
        if (!empty($sticky_vars)) {
            
            foreach ($sticky_vars as $name => $value) {
                    $result[$name] = $value;
            }		
            elgg_clear_sticky_form('needproject/edit');
	}
	
	return $result;
}