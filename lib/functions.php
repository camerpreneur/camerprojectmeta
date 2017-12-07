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