<?php
require_once('wp-api.class.php');
$wpapi = new wordpress_pluing_information('WP-Twitter-profile-widget');
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
                    <?php echo $wpapi->getRatingStars(); ?><br/>
                    <?php echo $wpapi->getShortDescription(); ?>
                </div>
                <div class="wp-links">
                    <a class="wp-button" href="<?php echo $wpapi->getDownloadURL(); ?>">Download Version <?php  echo $wpapi->getVersion();?></a>
                    <a class="wp-button" href="<?php echo $wpapi->getPluginURL(); ?>">More information</a>
                </div>
                <br style="clear: both" />
            </div>
        </div>
    </body>
</html>