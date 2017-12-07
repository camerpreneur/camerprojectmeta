<?php
/**
 * This file is called during the activation of the plugin
 */

if (get_subtype_id('object', Needproject::SUBTYPE)) {
    update_subtype('object', Needproject::SUBTYPE, 'Needproject');
} else {
    add_subtype('object', Needproject::SUBTYPE, 'Needproject');
}

