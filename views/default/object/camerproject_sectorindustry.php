<?php
/**
 * Entity view for a Sectorindustry
 *
 * @uses $vars['entity'] the Service to show
 */

$entity = elgg_extract('entity', $vars);
if (!($entity instanceof Sectorindustry)) {
	return;
}

if (elgg_extract('full_view', $vars, false)) {
	echo elgg_view('object/camerproject_sectorindustry/full', $vars);
} else {
	echo elgg_view('object/camerproject_sectorindustry/list', $vars);
}
