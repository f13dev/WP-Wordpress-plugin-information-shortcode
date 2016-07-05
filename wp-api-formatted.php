<?php
require_once('wp-api.class.php');
$wpapi = new wordpress_pluing_information('buddypress');
?>
<!DOCTYPE html>
<html>
    <head>
        <title>WordPress plugins API template</title>
        <link rel="stylesheet" type="text/css" href="css/wp-api.css">
    </head>
    <body>
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
    </body>
</html>