<?php

    if ($vars['item_title'])
        $vars['item_title'] = $vars['item_title'] . NEW_LINE;
    
    if ($vars['subtext'])
        $vars['subtext'] = $vars['subtext'] . NEW_LINE;
    
    if ($vars['description'])
        $vars['description'] = $vars['description'] . NEW_LINE;      
    
    $vars['button'] = '<a target="_blank" href="mailto:?subject=' . $vars['item_title'] . '&body=' . elgg_echo('interconnected:emailbody', array($vars['subtext'],$vars['description'],$vars['url'])) . '"><div class="elgg-button-share elgg-button elgg-button-email">' . elgg_echo('interconnected:email') . '</div></a>';
    
    echo $vars['button'];
    return true;

?>