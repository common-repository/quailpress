<?php

$quailpress_buttons[] = 'quailpress_sharebutton_plaintext';
$quailpress_buttons[] = 'quailpress_sharebutton_html';
$quailpress_buttons[] = 'quailpress_sharebutton_mac';
$quailpress_buttons[] = 'quailpress_sharebutton_shareplus';
$quailpress_buttons[] = 'quailpress_sharebutton_poke';
$quailpress_buttons[] = 'quailpress_sharebutton_partner';
$quailpress_buttons[] = 'quailpress_sharebutton_partner_text';

function quailpress_sharebutton_plaintext($action, $url) {
  quailpress_showjavascript();
  if($action == 'SHOW') {
    echo '<a href="http://www.facebook.com/share.php?u='.$url.'" onclick="return fbs_click(\''.$url.'\', \''.$title.'\')" target="_blank">'.get_option('quailpress.share.plaintext').'</a>';
  } else if($action == 'SAVE') {
    update_option('quailpress.share.plaintext', htmlentities($_POST['plaintext']));
  } else if($action == 'CONFIG') {
    echo '<input type="text" name="plaintext" value="'.get_option('quailpress.share.plaintext').'"/> [plain text link]';
  }
}

function quailpress_sharebutton_html($action, $url) {
  quailpress_showjavascript();
  if($action == 'SHOW') {
    echo '<a href="http://www.facebook.com/share.php?u='.$url.'" onclick="return fbs_click(\''.$url.'\', \''.$title.'\')" target="_blank">'.stripslashes(get_option('quailpress.share.html')).'</a>';
  } else if($action == 'SAVE') {
    update_option('quailpress.share.html', $_POST['html']);
  } else if($action == 'CONFIG') {
    echo '<input type="text" name="html" value="'.htmlentities(stripslashes(get_option('quailpress.share.html'))).'"/> [html source ie: &lt;img src="foo.jpg"/&gt;]';
  }
}

function quailpress_sharebutton_mac($action, $url) {
  quailpress_showjavascript();
  if($action == 'SHOW') {
    echo '<a href="http://www.facebook.com/share.php?u='.$url.'" onclick="return fbs_click(\''.$url.'\', \''.$title.'\')" target="_blank"><img src="'.QUAILPRESS_IMAGEDIR.'/share_button_mac.png" border="0"/></a>';
  } else if($action == 'SAVE') {
  } else if($action == 'CONFIG') {
    echo '<a href="http://www.facebook.com/share.php?u='.$url.'" onclick="return fbs_click(\''.$url.'\', \''.$title.'\')" target="_blank"><img src="'.QUAILPRESS_IMAGEDIR.'/share_button_mac.png" border="0"/></a>';
  }
}

function quailpress_sharebutton_shareplus($action, $url) {
  quailpress_showjavascript();
  if($action == 'SHOW') {
    echo '<a href="http://www.facebook.com/share.php?u='.$url.'" onclick="return fbs_click(\''.$url.'\', \''.$title.'\')" target="_blank"><img src="'.QUAILPRESS_IMAGEDIR.'/share_button_shareplus.png" border="0"/></a>';
  } else if($action == 'SAVE') {
  } else if($action == 'CONFIG') {
    echo '<a href="http://www.facebook.com/share.php?u='.$url.'" onclick="return fbs_click(\''.$url.'\', \''.$title.'\')" target="_blank"><img src="'.QUAILPRESS_IMAGEDIR.'/share_button_shareplus.png" border="0"/></a>';
  }
}

function quailpress_sharebutton_poke($action, $url) {
  static $loaded=0;
  $title = the_title('','',false);
  $imagedir = QUAILPRESS_IMAGEDIR;

  quailpress_showjavascript();

  if($loaded == 0) {
    echo <<<END
    <style> .fb_share_poke_link {
      background: url('$imagedir/share_button_poke.png') no-repeat left center;
      padding-left: 20px; }
    </style>
END;
    $loaded++;
  } 

  if($action == 'SHOW') {
    echo '<a class="fb_share_poke_link" href="http://www.facebook.com/share.php?u=$url" onclick="return fbs_click(\''.$url.'\', \''.$title.'\')" target="_blank">Share on Facebook</a>';
  } else if($action == 'SAVE') {
  } else if($action == 'CONFIG') {
    echo '<a class="fb_share_poke_link" href="http://www.facebook.com/share.php?u=$url" onclick="return fbs_click(\''.$url.'\', \''.$title.'\')" target="_blank">Share on Facebook</a>';
  }
}

function quailpress_sharebutton_partner($action, $url) {
  static $loaded=0;
  $title = the_title('','',false);
  $imagedir = QUAILPRESS_IMAGEDIR;

  quailpress_showjavascript();

  if($loaded == 0) {
    echo <<<END
    <style> .fbs_link {
      background: url('$imagedir/facebook_share_icon.png') no-repeat left center;
      padding-left: 20px; }
    </style>
END;
    $loaded++;
  } 

  if($action == 'SHOW') {
    echo '<a class="fbs_link" href="http://www.facebook.com/share.php?u=$url" onclick="return fbs_click(\''.$url.'\', \''.$title.'\')" target="_blank"></a>';
  } else if($action == 'SAVE') {
  } else if($action == 'CONFIG') {
    echo '<a class="fbs_link" href="http://www.facebook.com/share.php?u=$url" onclick="return fbs_click(\''.$url.'\', \''.$title.'\')" target="_blank"></a>';
  }
}

function quailpress_sharebutton_partner_text($action, $url) {
  static $loaded=0;
  $title = the_title('','',false);
  $imagedir = QUAILPRESS_IMAGEDIR;

  quailpress_showjavascript();

  if($loaded == 0) {
    echo <<<END
    <style> .fbs_link {
      background: url('$imagedir/facebook_share_icon.png') no-repeat left center;
      padding-left: 20px; }
    </style>
END;
    $loaded++;
  } 

  if($action == 'SHOW') {
    echo '<a class="fbs_link" href="http://www.facebook.com/share.php?u=$url" onclick="return fbs_click(\''.$url.'\', \''.$title.'\')" target="_blank">Share on Facebook</a>';
  } else if($action == 'SAVE') {
  } else if($action == 'CONFIG') {
    echo '<a class="fbs_link" href="http://www.facebook.com/share.php?u=$url" onclick="return fbs_click(\''.$url.'\', \''.$title.'\')" target="_blank">Share on Facebook</a>';
  }
}



function quailpress_showjavascript() {
  static $printed=0;
  if($printed == 1) { return; }
  $printed++;
echo <<< END
    <script> function fbs_click(u,t) {
      void(window.open('http://www.facebook.com/sharer.php'+
      '?u='+encodeURIComponent(u)+
      '&t='+encodeURIComponent(t),
      'sharer','toolbar=no,width=642,height=436'));
      return false;
      }
    </script>
END;
}


?>
