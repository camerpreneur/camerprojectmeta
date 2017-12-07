<?php
/**
 * Entity view for a Devise
 *
 * @uses $vars['entity'] the Devise to show
 */

$entity = elgg_extract('entity', $vars);
if (!($entity instanceof Devise)) {
	return;
}

if (elgg_extract('full_view', $vars, false)) {
	echo elgg_view('object/camerproject_devise/full', $vars);
} else {
	echo elgg_view('object/camerproject_devise/list', $vars);
}
