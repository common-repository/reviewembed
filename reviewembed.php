<?php
/*
Plugin Name: ReviewEmbed
Plugin URI: http://reviewembed.com
Description: ReviewEmbed enables online businesses to make the most out of their reviews by displaying widgets containing Facebook, Google and Yelp reviews in pursuit of greater conversion.
Author: ReviewEmbed.com
Version: 1.1.2
*/

function rvwmbd_init() {
    add_options_page('ReviewEmbed settings', 'ReviewEmbed settings', 'manage_options', 'reviewembed/settings.php', 'rvwmbd_settings');
}

function rvwmbd_settings() {
    if ($_REQUEST && array_key_exists('request', $_REQUEST) && $_REQUEST['request'] != '' && $_REQUEST['request'] != '[object Object]') {
        $status = 'ok';
        $request = json_decode(stripslashes($_REQUEST['request']), $assoc = true);
        $widgets = $request['widgets'];
        $account = $request['account'];

        update_option('rvwmbd_widgets_list', $widgets);
        update_option('rvwmbd_account', $account);
        update_option('rvwmbd_authorized', true);
    }

    $authorized = get_option('rvwmbd_authorized', false);
    $widgets = get_option('rvwmbd_widgets_list', []);
    $account = get_option('rvwmbd_account', []);
    $host = 'http://www.reviewembed.com';

    include('views/settings.php');
}
add_action('admin_menu', 'rvwmbd_init');

function rvwmbd_func($attrs) {
    shortcode_atts(['hash' => ''], $attrs);
    $host = 'www.reviewembed.com';
    $hash = $attrs['hash'];
    $script = '<script>!function() { function e() { n = window.jQuery.noConflict(!0), t() } function t() { n(document).ready(function(e) { var searchParams = new URLSearchParams(window.location.search); var t = "//' . $host . '/loadExternal/' . $hash . '?callback=?&utm_content=" + searchParams.get(\'utm_content\') + "&utm_source=" + searchParams.get(\'utm_source\') + "&utm_channel=" + searchParams.get(\'utm_channel\') + "&utm_campaign=" + searchParams.get(\'utm_campaign\'); e.getJSON(t,function(t){e(".widget-container-'.$hash.'").html(t.html)})}) } var n; n=window.jQuery,t() }(); </script>';

    wp_enqueue_script('jquery');

    return '<div class="widget-container-' . $hash . '">' . $script . '</div>';
}
add_shortcode( 'reviewembed', 'rvwmbd_func');

function rvwmbd_admin_style($hook) {
    if ($hook != 'settings_page_reviewembed/settings') {
        return;
    }

    wp_register_style( 'rvwmbd_ionicons', plugins_url('/css/ionicons/css/ionicons.min.css', __FILE__));
    wp_register_style( 'rvwmbd_styles', plugins_url('/css/style.css', __FILE__));
    wp_register_script('rvwmbd_clipboard', plugins_url('/js/clipboard.min.js', __FILE__));
    wp_register_script('rvwmbd_scripts', plugins_url('/js/scripts.js', __FILE__));

    wp_enqueue_script('jquery');
    wp_enqueue_style('rvwmbd_ionicons');
    wp_enqueue_style('rvwmbd_styles');
    wp_enqueue_script('rvwmbd_clipboard');
    wp_enqueue_script('rvwmbd_scripts');
}
add_action('admin_enqueue_scripts', 'rvwmbd_admin_style');
?>
