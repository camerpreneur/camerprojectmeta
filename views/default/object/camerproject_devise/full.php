<?php
/**
 * Entity full view for a Devise
 *
 * @uses $vars['entity'] the Devise to show
 */

$entity = elgg_extract('entity', $vars);
if (!($entity instanceof Devise)) {
	return;
}
//$icon = elgg_view_entity_icon($entity, 'small');
//$icon = '';

// prepare summary
$entity_menu = '';
if (!elgg_in_context('widgets')) {
	$entity_menu = elgg_view_menu('entity', [
		'sort_by' => 'priority',
		'class' => 'elgg-menu-hz',
		'entity' => $entity,
		'handler' => 'devise',
	]);
}

$params = [
	'metadata' => $entity_menu,
	'title' => false,
];
$params = $params + $vars;
$summary = elgg_view('object/elements/summary', $params);

// prepare body
$body = '';

$general_info = '';

// description
if (!empty($entity->codedevise)) {
	$general_info .= elgg_view('output/text', [
		'value' => $entity->codedevise,
	]);
}

if (!empty($general_info)) {
	$body .= elgg_view_module('info', '', $general_info);
}


// show full view
echo elgg_view('object/elements/full', [
	'entity' => $entity,
	'summary' => $summary,
	'body' => $body,
]);
