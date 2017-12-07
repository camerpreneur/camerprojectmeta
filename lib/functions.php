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
 * Prepare the form vars for add/edit a Sectorindustry
 *
 * @param Sectorindustry $entity (optional) the entity to edit
 *
 * @return array
 */
function camerproject_prepare_sectorindustry_vars(Sectorindustry $entity = null) {
	
	// defaults
	$result = [
		'title' => '',
		'descriptionsector' => '',
		'access_id' => get_default_access(null, [
			'entity_type' => 'object',
			'entity_subtype' => Sectorindustry::SUBTYPE,
			'container_guid' => elgg_get_site_entity()->guid,
		]),
	];
	
        $sticky_vars = elgg_get_sticky_values('sectorindustry/edit');
	
        if (!empty($sticky_vars)) {
            
            foreach ($sticky_vars as $name => $value) {
                    $result[$name] = $value;
            }		
            elgg_clear_sticky_form('sectorindustry/edit');
	}
	
	return $result;
}

/**
 * Prepare the form vars for add/edit a Devise
 *
 * @param Devise $entity (optional) the entity to edit
 *
 * @return array
 */
function camerproject_prepare_devise_vars(Devise $entity = null) {
	
	// defaults
	$result = [
		'title' => '',
		'codedevise' => '',
		'access_id' => get_default_access(null, [
			'entity_type' => 'object',
			'entity_subtype' => Devise::SUBTYPE,
			'container_guid' => elgg_get_site_entity()->guid,
		]),
	];
		
	$sticky_vars = elgg_get_sticky_values('devise/edit');
	if (!empty($sticky_vars)) {
		foreach ($sticky_vars as $name => $value) {
			$result[$name] = $value;
		}		
		elgg_clear_sticky_form('devise/edit');
	}
	
	return $result;
}

