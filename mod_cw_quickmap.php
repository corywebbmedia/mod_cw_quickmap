<?php
/**
 * @copyright   Copyright (C) 2015-2016 Cory Webb Media, LLC. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$api_key = $params->get('api_key', '');

// Get the map pins to add to the map.
$pins_obj = json_decode($params->get('pins'));
$pins = array();
for($i=0; $i<count($pins_obj->caption); $i++)
{
    $pins[] = array(
        'caption'   => preg_replace('/\v+|\\\[rn]/','<br/>',$pins_obj->caption[$i]),
        'latitude'  => $pins_obj->latitude[$i],
        'longitude' => $pins_obj->longitude[$i]
    );
}

// Get the center point of the map
$center_lat = $params->get('center_lat');
$center_lon = $params->get('center_lon');

// Get the map zoom level
$zoom = $params->get('zoom');

// Get the map width
$width = $params->get('width');

// Get the map height
$height = $params->get('height');

// Get the module class suffix
$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));

require JModuleHelper::getLayoutPath('mod_cw_quickmap', $params->get('layout', 'default'));
