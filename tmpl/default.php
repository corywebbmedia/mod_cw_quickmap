<?php
/**
 * @copyright   Copyright (C) 2015-2016 Cory Webb Media, LLC. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

    // Set a unique map ID using the module's ID. This enables support for multiple maps on the same page.
    $mapid = 'map' . $module->id;

    // Set width and height from parameters if they are set.
    $style = '';
    if($width || $height)
    {
        $style = '#' . $mapid . ' { ';
        if($width)
        {
            $style .= 'width: ' . $width . ';';            
        }
        if($height)
        {
            $style .= 'height: ' . $height . ';';
        }
        $style .= ' }';
    }

    // Link to Google Maps API javascript
    $map_api = 'https://maps.googleapis.com/maps/api/js?key=' . $api_key;

    // Start map markers javascript array
    $markers = 'var markers = [';

    // Start info windows javascript array
    $infowindows = 'var infoWindowContent = [';

    // Loop through the map makers added in the module and add them to the map markers and info windows.
    if($pins) {
        foreach ($pins as $index => $pin) {
            $markers .= '[' . $pin['latitude'] . ', ' . $pin['longitude'] . ']';
            $infowindows .= '\'' . $pin['caption'] . '\'';
            if($index < count($pins) - 1) {
                $markers .= ', ';
                $infowindows .= ', ';
            }
        }
    }

    // Close the map markers javascript array
    $markers .= '];';

    // Close the info windows javascript array
    $infowindows .= '];';

    // Create the script to initialize the Google map
    $script = <<< EOD
    function initialize_map() {
        var mapCanvas = document.getElementById('$mapid');
        var mapOptions = {
          center: new google.maps.LatLng($center_lat, $center_lon),
          zoom: $zoom,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        }
        var map = new google.maps.Map(mapCanvas, mapOptions);

        $markers

        $infowindows

        var infoWindow = new google.maps.InfoWindow(), marker, i;
    
        // Loop through our array of markers & place each one on the map  
        for( i = 0; i < markers.length; i++ ) {
            var position = new google.maps.LatLng(markers[i][0], markers[i][1]);
            marker = new google.maps.Marker({
                position: position,
                map: map
            });
            
            // Allow each marker to have an info window    
            google.maps.event.addListener(marker, 'click', (function(marker, i) {
                return function() {
                    infoWindow.setContent(infoWindowContent[i]);
                    infoWindow.open(map, marker);
                }
            })(marker, i));

        }
    }
    google.maps.event.addDomListener(window, 'load', initialize_map);
EOD;

$document = JFactory::getDocument();

// Add the Google Maps API to the Joomla HTML document
$document->addScript($map_api);

// Add the script to initialize the Google map to the Joomla HTML document
$document->addScriptDeclaration($script);

// If the width and height are set in the parameters, add them to the Joomla HTML document
if($style != '')
{
    $document->addStyleDeclaration($style);
}
?>

<!-- Google Map Container - <?php echo $mapid; ?> -->
<div id="<?php echo $mapid; ?>" class="quickmap"></div>
