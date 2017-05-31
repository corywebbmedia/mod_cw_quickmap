# CW Quick Map Module for Joomla

CW Quick Map is the quickest and easiest way to add a map with map markers to your Joomla website.

Simply add the module, add your map markers, set the center, zoom level, width and height, and then publish your module.

## Features

* Standard Joomla MVC structure
* Add multiple maps to the same page.
* Add multiple map markers and info windows to the same map.
* Set the center point on the map.
* Set the zoom level on the map.
* Set the width and height, or control it with your own CSS.
* All managed in the module editor.
* GPL License

## Documentation

### Add a CW Quick Map module to any page(s) on your site

1. In the Joomla administrator, go to Extensions > Modules and click "New" to add a new module.
2. Select the CW Quick Map module type.

### Parameters Explained

* **Map Markers:** A Joomla repeatable field that enables you to add multiple map markers. In the pop-up window, click a green plus button to add a new map marker, or a red minus button to remove a map marker.
    * Caption: Enter a caption for each map marker
    * Latitude: Enter the latitude coordinate for each map marker. *
    * Longitude: Enter the longitude coordinate for each map marker. *
* **Center Latitude:** Enter the latitude coordinate for the center of the map. *
* **Center Longitude:** Enter the longitude coordinate for the center of the map. *
* **Zoom Level:** Enter the initial zoom level of the map.
* **Width:** Enter the width of the map. Leave this blank if you want to control the map width with your own CSS.
* **Height:** Enter the height of the map. Leave this blank if you want to control the map height with your own CSS.

### Creating a Template Override

If you want to override the standard layout, you have to create a template override as follows:

1. Copy `/modules/mod_cw_quickmap/default.php` to `/templates/{YOUR_TEMPLATE}/html/mod_cw_quickmap/default.php` **
2. Modify as needed

_Note: * You can get latitude and longitude coordinates at http://www.latlong.net/_
_Note: ** If you want to have multiple template overrides, you can create multiple copies of `default.php`, but give it different names. Each new override will be available in as an option in the Alternate Layout parameter in the Advanced parameter tab in the module._
