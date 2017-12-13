<?php

namespace Camerpreneur\camerproject;

/**
 * Description of Router
 *
 * @author Kana
 */
class Router {
    
/**
 * Handle /needproject URLs
 *
 * @param array $page URL segments
 *
 * @return bool
 */
public static function needproject($page) {

        $vars = [];

        switch (elgg_extract(0, $page)) {
                case 'all':

                        echo elgg_view_resource('needproject/all');
                        return true;

                        break;
                case 'add':

                        echo elgg_view_resource('needproject/add');
                        return true;

                        break;
                case 'view':

                        $vars['guid'] = (int) elgg_extract(1, $page);

                        echo elgg_view_resource('needproject/view', $vars);
                        return true;

                        break;
                case 'edit':

                        $vars['guid'] = (int) elgg_extract(1, $page);

                        echo elgg_view_resource('needproject/edit', $vars);
                        return true;

                        break;

                default:

                        forward('needproject/all');
                        break;
        }

        return false;
}
    
}
