<?php

/**
 *  Add/Edit form of Needproject
 * 
 * @uses $vars['entity'] the needproject edit
 */

use Needproject;

/* @var $entity Needproject */

$entity = elgg_extract('entity', $vars);

if( $entity instanceof Needproject){    
    // edit    
echo elgg_view_field([
        '#type' => 'hidden',
        'name' => 'guid',
        'value' => $entity->guid,
    ]);
}

// title
echo elgg_view_field([
	'#type' => 'text',
	'#label' => elgg_echo('camerproject:needproject:title'),
	'name' => 'titleneed',
	'value' => elgg_extract('titleneed', $vars),
	'required' => true,
]);

// put other field here


// footer
$footer = elgg_view_field([
	'#type' => 'submit',
	'value' => elgg_echo('save'),
]);

elgg_set_form_footer($footer);





