<?php
if( ! defined('WP_UNINSTALL_PLUGIN') ) exit;

delete_option('re_widgets_list');
delete_option('re_authorized');
delete_option('re_account');

?>