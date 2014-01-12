<?php
    $INTERCONNECTED_PAGE_DATA = get_sharing_data_for_current_page();
    $access_denied = $INTERCONNECTED_PAGE_DATA['access_denied'];
    
    if ($access_denied)
    {
        $body = elgg_echo ('interconnected:access-denied');
        $label = elgg_echo ('interconnected:no-share');
    }
    else 
    {
        $label = elgg_echo('interconnected:share');
        $body = elgg_view('interconnected/interconnected');
    }

    echo elgg_view_module('aside', $label, $body);
?>