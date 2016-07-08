<?php
/*
Plugin Name: WordPress plugin information shortcode
Plugin URI: http://f13dev.com
Description: This plugin enables you to enter shortcode on any page or post in your blog to show information about a WP plugin you have written.
Version: 1.0
Author: Jim Valentine - f13dev
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

// How to handle the shortcode
function f13_plugin_information( $atts, $content = null )
{
    // Get the attributes
    extract( shortcode_atts ( array (
        'slug' => 'none' // Default slug won't show a plugin
    ), $atts ));

    $results = f13_getWPPluginResults($slug);

    $string = '
        <div class="f13-wp-container">
            <div class="f13-wp-header" style="background-image: url(' . f13_getBannerURL($results['slug']) . ');">
                <p class="f13-wp-name">' . $results['name'] . '</p>
            </div>
            <div class="f13-wp-information">
                <div class="f13-wp-description">
                    <div class="f13-wp-rating">' .
                        f13_getRatingStars($results['rating'] / 20) . ' ' .
                        $results['rating'] . ' from ' .
                        $results['num_ratings'] . ' ratings
                    </div>
                    <br/>
                    <p class="f13-wp-short-description">
                        <strong>Description: </strong>' . $results['short_description'] . '
                    </p>
                    <div class="f13-wp-downloads">
                        <strong>Downloads</strong>: ' . $results['downloaded'] . '
                    </div>
                </div>
                <div class="f13-wp-links">
                    <a class="f13-wp-button f13-wp-download" href="' .  $results['download_link'] . '">Download Version ' .  $results['version'] . '</a>
                    <a class="f13-wp-button f13-wp-moreinfo" href="' .  f13_getPluginURL($slug) . '">More information</a>
                </div>
                <br style="clear: both" />
                <div class="f13-wp-tags">Tags: ' . f13_getTagsList($results['tags']) . '</div>
            </div>
        </div>';
    return $string;

}

// Add the stylesheet
function f13_plugin_information_stylesheet()
{
    wp_register_style( 'f13information-style', plugins_url('css/wp-api.css', __FILE__));
    wp_enqueue_style( 'f13information-style' );
}

// Register the shortcode
add_shortcode( 'wpplugin', 'f13_plugin_information');
// Register the css
add_action( 'wp_enqueue_scripts', 'f13_plugin_information_stylesheet');

/**
 * Functions used to create the plugin information
 */

 function f13_getRatingStars($aRating)
 {
     $string = '';
     for ($x = 1; $x < $aRating; $x++ )
     {
         $string .= '<img src="' . plugin_dir_url( __FILE__ ) . 'img/star-full.png" />';
     }
     if (strpos($aRating, '.'))
     {
         $string .= '<img src="' . plugin_dir_url(__FILE__) . 'img/star-half.png" />';
         $x++;
     }
     while ($x <= 5)
     {
         $string .= '<img src="' . plugin_dir_url(__FILE__) . 'img/star-empty.png" />';
         $x++;
     }

     return $string;
 }

 function f13_getWPPluginResults($aSlug)
 {
     // start curl
     $curl = curl_init();

     // set the curl URL
     $url = 'https://api.wordpress.org/plugins/info/1.0/' . $aSlug . '.json';

     // Set curl options
     curl_setopt($curl, CURLOPT_URL, $url);
     curl_setopt($curl, CURLOPT_HTTPGET, true);

     // Set the user agent
     curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
     // Set curl to return the response, rather than print it
     curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

     // Get the results and store the XML to results
     $results = json_decode(curl_exec($curl), true);

     // Close the curl session
     curl_close($curl);

     return $results;
 }

 function f13_getBannerURL($aSlug)
 {
     $baseURL = 'https://ps.w.org/' . $aSlug . '/assets/banner-772x250';
     if (f13_remoteFileExists($baseURL . '.jpg'))
     {
         return $baseURL . '.jpg';
     }
     else if (f13_remoteFileExists($baseURL . '.png'))
     {
         return $baseURL . '.png';
     }
     else
     {
         return plugin_dir_url(__FILE__) . 'img/default_banner.png';
     }
 }

 function f13_remoteFileExists($url)
 {
     $curl = curl_init($url);
     curl_setopt($curl, CURLOPT_NOBODY, true);
     $result = curl_exec($curl);
     if ($result != false)
     {
         if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 200)
         {
             return true;
         }
     }
     else
     {
         return false;
     }
 }

 function f13_getPluginURL($aSlug)
 {
     return 'https://wordpress.org/plugins/' . $aSlug . '/';
 }

 function f13_getTagsList($tagList)
 {
     $string = '<ul>';
     foreach ($tagList as $key => $value)
     {
         $string .= '<li>' . $value . '</li>';
     }
     $string .= '</ul>';
     return $string;
 }
