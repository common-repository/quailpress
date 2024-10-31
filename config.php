<?php
// config.php.dist
// QuailPress configuration

// The following values should work for a typical installation, but modify them as necessary
// to fit your needs:


// Directory where the quailpress directory is located (ABSPATH is the WordPress root directory)
define('QUAILPRESS_ROOTDIR', get_settings('siteurl').'/wp-content/plugins/quailpress-v'.QUAILPRESS_VERSION);

// Directory where the quailpress images directory is located
define('QUAILPRESS_IMAGEDIR', QUAILPRESS_ROOTDIR.'/images');

?>
