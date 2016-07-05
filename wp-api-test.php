<?php
// Require the api PHP file
require_once('wp-api.class.php');
// Create a new object for the API
$wpapi = new wordpress_pluing_information('wp-twitter-profile-widget');

// Returning results
echo 'Name: ' . $wpapi->results['name'] . '<br/>';
echo 'Slug: ' . $wpapi->results['slug'] . '<br/>';
echo 'Version: ' . $wpapi->results['version'] . '<br/>';
echo 'Author' . $wpapi->results['author'] . '<br/>';
echo 'Author profile: ' . $wpapi->results['author_profile'] . '<br/>';
echo 'Contributors: <br/>';
    foreach ($wpapi->results['contributors'] as $key => $value)
    {
        echo '<li><a href="' . $value . '">' . $key . '</a></li>';
    }
echo 'Requires version: ' . $wpapi->results['requires'] . '<br/>';
echo 'Tested on: ' . $wpapi->results['tested'] . '<br/>';
echo 'Rating: ' . $wpapi->results['rating'] . ' from ' . $wpapi->results['num_ratings'] . ' ratings<br/>';
echo 'Downloaded: ' . $wpapi->results['downloaded'] . '<br/>';
echo 'Last updated: ' . $wpapi->results['last_updated'] . '<br/>';
echo 'Added: ' . $wpapi->results['added'] . '<br/>';
