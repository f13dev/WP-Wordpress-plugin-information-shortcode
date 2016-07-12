=== Plugin Name ===
Contributors: f13dev
Donate link: http://f13dev.com/
Tags: WordPress, plugin, api, information, shortcode
Requires at least: 3.0.1
Tested up to: 4.5.3
Stable tag: 4.5.3
License: GPLv3 or later
License URI: http://www.gnu.org/licenses/gpl-3.0.html

If you have written a plugin for WordPress, showcase it's stats on your blog using WP Plugin Information Shortcode.

== Description ==

Using WP Plugin Information Shortcode you can simply add information and statistics about your plugin to any page or post on your WordPress powered website.

Simply find the slug to your plugin on wordpress.org, which will be the last section of the URL, usually formatted as my-plugin-name, then add the shortcode [wpplugin slug="my-plugin-name"] to the desired location of your blog.

== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/plugin-name` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress
3. Add the shortcode [wpplugin slug="my-plugin-name"] to the desired location on your blog

== Frequently Asked Questions ==

= How do I find my plugin slug =

Find your plugin on 'https://wordpress.org/plugins/', for example Buddy Press is at https://wordpress.org/plugins/buddypress/, the slug is the final part of the URL, in this case 'buddypress'. The slug may also contain '-' hyphens.

== Screenshots ==

1. The results of adding [wpplugin slug="akismet"] to a blog post.

== Changelog ==

= 1.1 =
* Added a 10 minute transient cache to the shortcode response, each instance of the shortcode may now make a maximum of 6 api calls per hour to speed up page loading times.
= 1.0 =
* Initial release

== Upgrade Notice ==

= 1.0 =
Initial release

== Arbitrary section ==
