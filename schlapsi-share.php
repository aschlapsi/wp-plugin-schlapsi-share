<?php
/*
Plugin Name:       Schlapsi Share
Description:       A plugin that shows share buttons in a THA compliant theme after the content.
Version:           0.1
Author:            Andreas Schlapsi
Author URI:        http://schlapsi.com/
License:           Apache License 2.0
*/

function schlapsi_share_buttons() {
    echo '
    <div class="social-links">
        <div class="tweet">
            <a href="https://twitter.com/share" class="twitter-share-button" data-via="aschlapsi">Tweet</a>
        </div>
        <div class="googleplus">
            <div class="g-plus" data-action="share" data-annotation="bubble"></div>
        </div>
    </div>
    ';
}
add_action( 'tha_entry_bottom', 'schlapsi_share_buttons' );

function schlapsi_share_footer() {
    // Twitter code
    echo "
    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
    ";
    // Google+ code
    echo '
    <script type="text/javascript">
      (function() {
        var po = document.createElement("script"); po.type = "text/javascript"; po.async = true;
        po.src = "https://apis.google.com/js/platform.js";
        var s = document.getElementsByTagName("script")[0]; s.parentNode.insertBefore(po, s);
      })();
    </script>
    ';
}
add_action( 'wp_footer', 'schlapsi_share_footer' );
