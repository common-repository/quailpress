<?php
/*
Plugin Name: QuailPress
Version: 0.1.3
Plugin URI: http://tekrat.com
Author: <a href="http://tekrat.com">Brian Shire <shire@tekrat.com></a>
Description: Integrates Facebook Share into your WordPress posts. 
*/ 

// Common include 
include_once('common.php');

$quailpress_buttons = array();

// Share button callbacks (modifies $quailpress_buttons array defined above)
include_once('share_buttons.php');

// Add a hook into the admin menu to display our options page 
add_action('admin_menu', 'quailpress_admin_menu');


/* quailpress_share()
 *   Call this function to display the Facebook Share button
 */
function quailpress_share() {
  global $id; // post id
  global $quailpress_buttons;

  if(get_option('quailpress.share.disabled') == 'true') {
    return;
  }

  // Call the function to display the button
  $url = get_permalink($id);
  $button = (int)get_option('quailpress.share.button');
  call_user_func($quailpress_buttons[$button], 'SHOW', $url);

}


/* Add a 'QuailPress' button under Options */
function quailpress_admin_menu() {
  if(function_exists('add_options_page')) {
    add_options_page('QuailPress', 'QuailPress', 8, basename(__FILE__), 'quailpress_options');
  }
}

/* Display the 'QuailPress' options page */
function quailpress_options() {
  global $quailpress_buttons;

  if(isset($_GET['quailpress_options_save'])) {
    quailpress_process_options();
  }

  print '<div class="wrap">';
  print '<h2>QuailPress</h2>';
  print '<b>A Facebook Extension</b><br/>';
  print '<b>Version</b>: '.QUAILPRESS_VERSION.'<br/>';
  print '<b>Homepage</b>: <a href="http://tekrat.com">http://tekrat.com</a><br/>';
  print '<br/>';
  print '<h2>Share</h2>';
  $share_disabled = get_option('quailpress.share.disabled');
  if($share_disabled == 'true') {
    print '<a href="?page=share.php&quailpress_options_save=true&disable=false&updated=true">Enable</a> <i>(share is currently disabled)</i>';
  } else {
    print '<a href="?page=share.php&quailpress_options_save=true&disable=true&updated=true">Disable</a>';
  }
  print '<br/><br/>';
  print '<form action="options-general.php?page=share.php&quailpress_options_save=true&updated=true" method="post">';
  print '<input type="hidden" name="quailpress_options_save" value="1"/>';

  print 'Please select an image to use for the Facebook Share button:<br/><br/>';
  $button = (int)get_option('quailpress.share.button');
  foreach($quailpress_buttons as $key => $func) {
    if($button == $key) {
      print '<input type="radio" name="button" value="'.$key.'" CHECKED/>';
    } else {
      print '<input type="radio" name="button" value="'.$key.'"/>';
    }
    call_user_func($func, 'CONFIG', get_settings('home'));
    print '<br/><br/>';
  }
  print '<br/>';
  print '<div class="submit"><input type="submit" name="Submit" value="Update Options &raquo;" /></div>'; 
  print '</form>';
  print '</div>';
} 

/* Process any POST data from the 'QuailPress' options page */
function quailpress_process_options() {
  global $quailpress_buttons;

  if($_GET['disable'] == "true") {
    update_option('quailpress.share.disabled', 'true');
  } else if($_GET['disable'] == "false") {
    update_option('quailpress.share.disabled', 'false');
  }

  if(isset($_POST['button'])) {
    update_option('quailpress.share.button', $_POST['button']);
  }

  foreach($quailpress_buttons as $key => $func) {
    call_user_func($func, 'SAVE', ($key == $_POST['button']));
  }

}



?>
