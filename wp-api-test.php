<?php
// Require the api PHP file
require_once('wp-api.class.php');
// Create a new object for the API
$wpapi = new wordpress_pluing_information('WP-Twitter-profile-widget');


// Returning results
echo 'Name: ' . $wpapi->getName() . '<br/>';
echo 'Slug: ' . $wpapi->getSlug() . '<br/>';
echo 'Version: ' . $wpapi->getVersion() . '<br/>';
echo 'Author' . $wpapi->getAuthor() . '<br/>';
echo 'Author profile: ' . $wpapi->getAuthorLink() . '<br/>';
echo 'Contributors: ' . $wpapi->getContributorsList();
echo 'Requires version: ' . $wpapi->getVersionRequired() . '<br/>';
echo 'Tested on: ' . $wpapi->getVersionTestedOn . '<br/>';
echo 'Rating: ' . $wpapi->getRatingStars() . '<br/>';
echo 'Downloaded: ' . $wpapi->getNumberDownloads() . '<br/>';
echo 'Last updated: ' . $wpapi->getLastUpdate() . '<br/>';
echo 'Added: ' . $wpapi->getCreationDate() . '<br/>';
echo 'Header image: ' . $wpapi->getBannerImage() . '<br/>';
echo 'Icon: ' . $wpapi->getIconImage() . '<br/>';
echo 'Short description: ' . $wpapi->getShortDescription() . '<br/>';
echo 'Download: ' . $wpapi->getDownloadLink() . '<br/>';
echo 'Tags: ' . $wpapi->getTagsList();
echo 'Donate link: ' . $wpapi->getDonateLink() . '<br/>';