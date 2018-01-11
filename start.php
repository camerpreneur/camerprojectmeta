<?php

/**
 *  CamerProject Plugin 
 * 
 * @package ElggGroup
 */
require_once __DIR__ . '/lib/functions.php';

//elgg_register_plugin_hook_handler('route:rewrite', 'groups', 'camerproject_rewrite_handler');

elgg_register_event_handler('init', 'system', 'camerproject_init');
elgg_register_event_handler('init', 'system', 'camerproject_fields_setup', 10000);


function camerproject_init(){
   elgg_register_entity_type('group', Camerproject::SUBTYPE);
   elgg_register_entity_type('object', Needproject::SUBTYPE);   
   // plugin hook
   elgg_register_plugin_hook_handler('access:collections:write', 'all', '\camerpreneur\camerproject\Access::accessArray', 999); 
   // Register a page handler, so we can have nice URLs
   elgg_unregister_page_handler('groups','groups_page_handler');
   elgg_register_page_handler('camerproject', 'camerproject_page_handler');
    
//   // Set up the menu
    $item = new ElggMenuItem('groups', elgg_echo('groups'), 'camerproject/all'); 
    elgg_register_menu_item('site', $item);
//    
   // Register URL handlers for groups
   elgg_unregister_plugin_hook_handler('entity:url','group', 'groups'); 
   elgg_register_plugin_hook_handler('entity:url', 'group', 'camerprojects_set_url');

   // prepare profile buttons to be registered in the title menu
   elgg_unregister_plugin_hook_handler('profile_buttons', 'group', 'groups_prepare_profile_buttons'); 
   elgg_register_plugin_hook_handler('profile_buttons', 'group', 'camerproject_prepare_profile_buttons');
//   
    // register actions
   $actions_bases = __DIR__.'/actions/needproject/';
    
   elgg_register_action('needproject/edit', "$actions_bases/save.php");
   elgg_register_action('needproject/delete', "$actions_bases/delete.php");
   
    // register page handlers
   elgg_register_page_handler('needproject', '\camerpreneur\camerproject\Router::needproject');
      
}   

function camerproject_rewrite_handler($hook, $type, $value, $params) {
    
    $value['identifier'] = 'camerproject';
    return $value;

}


function camerproject_fields_setup(){
    
    $profile_defaults = [
        'description' => 'longtext',
        'progress' => 'text',
        'activity' => 'text',
        'markettype' => 'text',
        'typemark' => 'text',
        'offertype' => 'text',
        'turnover' => 'text',
        'currency' => 'text',
        'location' => 'location',
        'projectwebsite' => 'url',
        'projectblog' => 'url',
        'projectpitch' => 'url',
	];
    
    $profile_defaults = elgg_trigger_plugin_hook('profile:fields', 'group', NULL, $profile_defaults);

    elgg_set_config('group', $profile_defaults);
    
    // register any tag metadata names
    foreach ($profile_defaults as $name => $type) {
            if ($type == 'tags') {
                elgg_register_tag_metadata_name($name);

                // only shows up in search but why not just set this in en.php as doing it here
                // means you cannot override it in a plugin
                add_translation(get_current_language(), array("tag_names:$name" => elgg_echo("camerproject:$name")));
            }
            
            if($type == 'select' or $type == 'dropdown'){
                
                elgg_register_tag_metadata_name($name);

                // only shows up in search but why not just set this in en.php as doing it here
                // means you cannot override it in a plugin
                add_translation(get_current_language(), array("tag_names:$name" => elgg_echo("camerproject:$name")));
            }
    }
    
}


function camerproject_page_handler($page) {

	if (!isset($page[0])) {
		$page[0] = 'all';
	}

	elgg_push_breadcrumb(elgg_echo('camerproject'), "camerproject/all");

	$vars = [];
	switch ($page[0]) {
		case 'add':
		case 'all':
		case 'owner':
		case 'search':
			echo elgg_view_resource("camerproject/{$page[0]}");
			break;
		case 'invitations':
		case 'member':
			echo elgg_view_resource("camerproject/{$page[0]}", [
				'username' => $page[1],
			]);
			break;
		case 'members':
			$vars['sort'] = elgg_extract('2', $page, 'alpha');
			$vars['guid'] = elgg_extract('1', $page);
			if (elgg_view_exists("resources/camerproject/members/{$vars['sort']}")) {
				echo elgg_view_resource("camerproject/members/{$vars['sort']}", $vars);
			} else {
				echo elgg_view_resource('camerproject/members', $vars);
			}
			break;
		case 'profile':
			// Page owner and context need to be set before elgg_view() is
			// called so they'll be available in the [pagesetup, system] event
			// that is used for registering items for the sidebar menu.
			// @see groups_setup_sidebar_menus()
			elgg_push_context('group_profile');
			elgg_set_page_owner_guid($page[1]);
		case 'activity':
		case 'edit':
		case 'invite':
		case 'requests':
			echo elgg_view_resource("camerproject/{$page[0]}", [
				'guid' => $page[1],
			]);
			break;
		default:
			return false;
	}
	return true;
}
        
/**
 * Populates the ->getUrl() method for group objects
 *
 * @param string $hook
 * @param string $type
 * @param string $url
 * @param array  $params
 * @return string
 */
function camerprojects_set_url($hook, $type, $url, $params) {
	$entity = $params['entity'];
	$title = elgg_get_friendly_title($entity->name);
	return "camerproject/profile/{$entity->guid}/$title";
}         

/**
 * Returns menu items to be registered in the title menu of the group profile
 *
 * @param string         $hook   "profile_buttons"
 * @param string         $type   "group"
 * @param ElggMenuItem[] $items  Buttons
 * @param array          $params Hook params
 * @return ElggMenuItem[]
 */
function camerproject_prepare_profile_buttons($hook, $type, $items, $params) {

	$group = elgg_extract('entity', $params);
	if (!$group instanceof ElggGroup) {
		return;
	}

	$actions = [];

	if ($group->canEdit()) {
		// group owners can edit the group and invite new members
		$actions['groups:edit'] = "camerproject/edit/{$group->guid}";
		$actions['groups:invite'] = "camerproject/invite/{$group->guid}";
	}

	$user = elgg_get_logged_in_user_entity();
	if ($user && $group->isMember($user)) {
		if ($group->owner_guid != $user->guid) {
			// a member can leave a group if he/she doesn't own it
			$actions['groups:leave'] = "action/groups/leave?group_guid={$group->guid}";
		}
	} else if ($user) {
		$url = "action/groups/join?group_guid={$group->guid}";
		if ($group->isPublicMembership() || $group->canEdit()) {
			// admins can always join
			// non-admins can join if membership is public
			$actions['groups:join'] = $url;
		} else {
			// request membership
			$actions['groups:joinrequest'] = $url;
		}
	}

	foreach ($actions as $action => $url) {
		$items[] = ElggMenuItem::factory(array(
			'name' => $action,
			'href' => elgg_normalize_url($url),
			'text' => elgg_echo($action),
			'is_action' => 0 === strpos($url, 'action'),
			'link_class' => 'elgg-button elgg-button-action',
		));
	}

	return $items;
}