<?php
/*
Plugin Name: WordPress plugin information shortcode
Plugin URI: http://f13dev.com
Description: This plugin enables you to enter shortcode on any page or post in your blog to show information about a WP plugin you have written.
Version: 1.0
Author: James Valentine - f13dev
Author URI: http://f13dev.com
Text Domain: wp-plugin-information-shortcode
License: GPLv3
*/

/*
Copyright 2016 James Valentine - f13dev (jv@f13dev.com)
This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 3 of the License, or
any later version.
This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software 
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
*/

add_shortcode( 'wpplugin', 'wp_plugin_information');

function wp_plugin_information()
{
    include_once('wp-api/wp-api-formatted.php');
}