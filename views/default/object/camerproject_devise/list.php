<?php
/**
 * Entity list view for a Devise
 *
 * @uses $vars['entity'] the Devise to show
 */

$entity = elgg_extract('entity', $vars);
if (!($entity instanceof Devise)) {
	return;
}

$icon = elgg_view_entity_icon($entity, 'tiny');

$entity_menu = '';
if (!elgg_in_context('widgets')) {
	$entity_menu = elgg_view_menu('entity', [
		'sort_by' => 'priority',
		'class' => 'elgg-menu-hz',
		'entity' => $entity,
		'handler' => 'devise',
	]);
}

$excerpt = elgg_get_excerpt($entity->codedevise);

$params = [
	'metadata' => $entity_menu,
	'content' => $excerpt,
        'icon' => $icon,
];
$params = $params + $vars;
echo elgg_view('object/elements/summary', $params);
