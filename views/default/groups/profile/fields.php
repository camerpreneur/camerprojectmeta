<?php
/**
 * Project profile fields
 */

$camerproject = $vars['entity'];
$owner = $camerproject->getOwnerEntity();
$profile_fields = elgg_get_config('group');

if (is_array($profile_fields) && count($profile_fields) > 0) {

	$even_odd = 'odd';
	foreach ($profile_fields as $key => $valtype) {
		// do not show the name
		if ($key == 'name') {
			continue;
		}

		$value = $camerproject->$key;
		if (is_null($value)) {
			continue;
		}
		$options = array('value' => $camerproject->$key);
		if ($valtype == 'tags') {
			$options['tag_names'] = $key;
		}

		echo "<div class=\"{$even_odd}\">";
		echo "<b>";
		echo elgg_echo("camerproject:$key");
		echo ": </b>";
		echo elgg_view("output/$valtype", $options);
		echo "</div>";

		$even_odd = ($even_odd == 'even') ? 'odd' : 'even';
	}
        
    if($owner->guid == elgg_get_logged_in_user_guid()){          
        echo "<div class=\"elgg-module clearfix elgg-module-group box elgg-module-info \" style =\" text-align: center\">";
        echo elgg_view('output/url', array(
            'text' => elgg_echo('camerproject:needproject:add'),
            'href' => elgg_get_site_url() . "needproject/add",
            ));
        
        echo "</div>";
    }
 
  
}
