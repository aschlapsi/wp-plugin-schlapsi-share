<?php
/*
Plugin Name:       Schlapsi Share
Description:       A plugin that shows share buttons in a THA compliant theme after the content.
Version:           0.1
Author:            Andreas Schlapsi
Author URI:        http://schlapsi.com/
License:           Apache License 2.0
*/

function schlapsi_share_register_scripts() {
    wp_register_style( 'schlapsi-share', plugins_url( 'css/style.css', __FILE__ ) );
    wp_enqueue_style( 'schlapsi-share' );
}
add_action( 'wp_enqueue_scripts', 'schlapsi_share_register_scripts' );

function schlapsi_share_buttons() {
    $options = get_option( 'schlapsi_share_options' );
    $twitter_handle = esc_attr( $options['twitter_handle'] );

    ?>
    <div class="schlapsi-share">
        <div class="tweet">
            <a href="https://twitter.com/share" class="twitter-share-button" data-via="<?php echo $twitter_handle; ?>">Tweet</a>
        </div>
        <div class="googleplus">
            <div class="g-plus" data-action="share" data-annotation="bubble"></div>
        </div>
    </div>
    <?php
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

function schlapsi_share_admin_init() {
    register_setting(
        'discussion',
        'schlapsi_share_options',
        'schlapsi_share_validate_options'
    );

    add_settings_field(
        'schlapsi_share_twitter_handle',
        'Twitter Handle',
        'schlapsi_share_setting_input',
        'discussion',
        'default'
    );
}
add_action( 'admin_init', 'schlapsi_share_admin_init' );

function schlapsi_share_setting_input() {
    $options = get_option( 'schlapsi_share_options' );
    $value = $options['twitter_handle'];

    ?>
    <input id="twitter_handle" name="schlapsi_share_options[twitter_handle]" type="text"
           value="<?php echo esc_attr( $value ); ?>"> Twitter handle to use when someone tweets a post.
    <?php
}

function schlapsi_share_validate_options( $input ) {
    $valid = array();
    $valid['twitter_handle'] = sanitize_user( $input['twitter_handle'] );
    return $valid;
}
