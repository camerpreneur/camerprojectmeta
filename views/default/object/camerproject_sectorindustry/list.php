<?php
/**
 * Entity list view for a Sectorindustry
 *
 * @uses $vars['entity'] the Sectorindustry to show
 */

$entity = elgg_extract('entity', $vars);
if (!($entity instanceof Sectorindustry)) {
	return;
}

//$icon = elgg_view_entity_icon($entity, 'tiny');

$entity_menu = '';
if (!elgg_in_context('widgets')) {
	$entity_menu = elgg_view_menu('entity', [
		'sort_by' => 'priority',
		'class' => 'elgg-menu-hz',
		'entity' => $entity,
		'handler' => 'sectorindustry',
	]);
}

$excerpt = elgg_get_excerpt($entity->description);

$params = [
	'metadata' => $entity_menu,
	'content' => $excerpt,
];
$params = $params + $vars;
echo elgg_view('object/elements/summary', $params);
