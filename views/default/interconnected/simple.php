<?php

    $INTERCONNECTED_PAGE_DATA = get_sharing_data_for_current_page();
    $access_denied = $INTERCONNECTED_PAGE_DATA['access_denied'];
    
    if (!$access_denied)
            echo '<div class="elgg-sharing-wrapper-simple">' . '<h3>' . elgg_echo('interconnected:share') . ':</h3>  ' . elgg_view('interconnected/interconnected') . '</div>';
?>