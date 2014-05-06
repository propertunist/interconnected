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

    elgg_extend_view('css/admin', 'interconnected/admin', 1);
    elgg_extend_view('page/elements/head', 'interconnected/metatags', 500);
    elgg_extend_view('css/elgg', 'interconnected/css');
    if ((!elgg_in_context('admin'))&&(!elgg_in_context('members'))&&(!elgg_in_context('messages'))&&(!elgg_in_context('co-creators'))&&(!elgg_in_context('reportedcontent'))&&(!elgg_in_context('settings'))&&(!elgg_in_context('suggested_friends'))&&(!elgg_in_context('suggested_friends_extended')))
    {
        elgg_extend_view('page/elements/sidebar','sidebar/interconnected',700);
      	elgg_extend_view('profile/details','interconnected/profile',500);
        elgg_extend_view('widgets/set_description/content', 'interconnected/simple', 500);
	}
    if (elgg_get_plugin_setting('footer_follow', 'interconnected') == TRUE)
        elgg_extend_view('page/elements/footer', 'interconnected/followus', 0);

    if (elgg_is_active_plugin('profile_manager'))
        elgg_extend_view('profile/owner_block', 'interconnected/social-shortcuts',500);
    
    // Register widgets
    elgg_register_widget_type('interconnected', elgg_echo('interconnected:widget:buttons'), elgg_echo('interconnected:widget:buttons_descr'), 'profile,index');
}

// call init
elgg_register_event_handler('init','system','interconnected_init');

?>