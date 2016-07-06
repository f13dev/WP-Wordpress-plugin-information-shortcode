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

// Register the shortcode
add_shortcode( 'wpplugin', 'wp_plugin_information');
// Register the css
add_action( 'wp_enqueue_scripts', 'wp_plugin_information_stylesheet');

// How to handle the shortcode
function wp_plugin_information( $atts, $content = null )
{
    // Get the attributes
    extract( shortcode_atts ( array (
        'slug' => 'none' // Default slug won't show a plugin
    ), $atts ));
    
    require_once('wp-api/wp-api.class.php');
    $wpapi = new wordpress_pluing_information($slug);
    // Check if a correct slug was entered
    if ($wpapi->results != [])
        {
        ?>
        <div class="wp-container">
            <div class="wp-header" style="background-image: url(<?php echo $wpapi->getBannerURL(); ?>);">
                <p class="wp-name"><?php echo $wpapi->getName(); ?></p>
            </div>
            <div class="wp-information">
                <div class="wp-description">
                    <p class="wp-rating">
                        <?php echo $wpapi->getRatingStars(); ?> 
                        <?php echo $wpapi->getRating(); ?> from 
                        <?php echo $wpapi->getRatingNumber(); ?> ratings
                    </p>
                    <p class="wp-downloads">
                        Downloads: <?php echo $wpapi->getNumberDownloads(); ?>
                    </p>
                    <br/>
                    <p class="wp-short-description">
                        <strong>Description: </strong><?php echo $wpapi->getShortDescription(); ?>
                    </p>
                </div>
                <div class="wp-links">
                    <a class="wp-button" href="<?php echo $wpapi->getDownloadURL(); ?>">Download Version <?php  echo $wpapi->getVersion();?></a>
                    <a class="wp-button" href="<?php echo $wpapi->getPluginURL(); ?>">More information</a>
                </div>
                <br style="clear: both" />
                <div class="wp-tags">Tags: <?php echo $wpapi->getTagsList(); ?></div>
            </div>
        </div>
        <?php
        }
        else
        {
            echo 'The slug "' . $wpapi->slug . '" was not found on WordPress.org';
        }
}

// Add the stylesheet
function wp_plugin_information_stylesheet()
{
    wp_register_style( 'prefix-style', plugins_url('wp-api/css/wp-api.css', __FILE__));
    wp_enqueue_style( 'prefix-style' );
}