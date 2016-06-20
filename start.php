<?php

/**
 * interconnected - social sharing plugin for elgg
 * @license GNU Public License version 2
 * @author ura soul
 */

define("NEW_LINE", "%0D%0A");

function interconnected_init() {

    $lib = elgg_get_plugins_path() . 'interconnected/lib/interconnected.php';
    elgg_register_library('interconnected', $lib);
    elgg_load_library('interconnected');

    $lib = elgg_get_plugins_path() . 'interconnected/lib/hooks.php';
    elgg_register_library('interconnected-hooks', $lib);
    elgg_load_library('interconnected-hooks');

    $lib = elgg_get_plugins_path() . 'interconnected/lib/events.php';
    elgg_register_library('interconnected-events', $lib);
    elgg_load_library('interconnected-events');

    // define js
    elgg_register_simplecache_view('js/interconnected');
    $interconnected_ui_js = elgg_get_simplecache_url('js', 'interconnected');
    elgg_register_js("elgg.ui.interconnected", $interconnected_ui_js);

    elgg_define_js('tablesorter', [
        'src' => '//cdn.jsdelivr.net/tablesorter/2.17.4/js/jquery.tablesorter.min.js',
        'deps' => array('jquery'),
        'exports' => 'jQuery.fn.tablesorter',
    ]);

    elgg_register_css('tablesorter', '//cdn.jsdelivr.net/tablesorter/2.17.4/css/theme.black-ice.css');

    $actions_base = elgg_get_plugins_path() . 'interconnected/actions/';
    elgg_register_action('bookmarks/refreshthumb', $actions_base . 'bookmarks/refreshthumb.php');
    elgg_register_action('interconnected/validate-url', $actions_base . 'interconnected/validate-url.php');
    elgg_register_action('interconnected/get_share_data', $actions_base . 'interconnected/get_share_data.php', 'public');

    // register upgrade action
    elgg_register_action("interconnected/interconnected_icons", dirname(__FILE__) . "/actions/upgrades/interconnected_icons.php");
  //  elgg_register_event_handler('upgrade', 'system', 'interconnected_upgrade_system_event_handler');

    elgg_unregister_action('bookmarks/save');
    elgg_register_action('bookmarks/save', $actions_base . 'bookmarks/save.php');
    elgg_unregister_action('bookmarks/delete');
    elgg_register_action('bookmarks/delete', $actions_base . 'bookmarks/delete.php');
    elgg_register_plugin_hook_handler('entity:icon:url', 'object', 'interconnected_bookmark_icon_url_override');

    elgg_extend_view('admin.css', 'interconnected/admin', 1);
    elgg_extend_view('page/elements/head', 'interconnected/metatags', 500);
    elgg_extend_view('elgg.css', 'interconnected/css');

    if (elgg_in_context('categories'))
    {
        elgg_extend_view('page/elements/sidebar','sidebar/interconnected',500);
    }

    elgg_extend_view('profile/details','interconnected/profile',500);
    elgg_extend_view('widgets/set_description/content', 'interconnected/simple', 500);

    if (elgg_get_plugin_setting('footer_follow', 'interconnected') == TRUE)
        elgg_extend_view('page/elements/footer', 'interconnected/followus', 0);

    if (elgg_is_active_plugin('profile_manager'))
        elgg_extend_view('profile/owner_block', 'interconnected/social-shortcuts',500);

    // Register widgets

    elgg_register_widget_type('interconnected', elgg_echo('interconnected:widget:buttons'), elgg_echo('interconnected:widget:buttons_descr'), array('profile,index'));

    // admin utility
    elgg_register_event_handler('pagesetup', 'system', 'interconnected_social_counts_pagesetup');
}

// call init
elgg_register_event_handler('init','system','interconnected_init');
