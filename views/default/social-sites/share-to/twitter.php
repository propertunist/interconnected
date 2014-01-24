<?php
    if ($vars['item_title'])
        $vars['item_title'] = $vars['item_title'] . NEW_LINE;
 
    $vars['button'] = '<a target="_blank" href="https://twitter.com/intent/tweet?text=' . $vars['item_title'] . $vars['subtext'] . '&url=' . $vars['url'];
    if ($vars['twitter_handle'])
        $vars['button'].= '&via=' . $vars['twitter_handle'];
    $vars['button'] .= '"><div class="elgg-button-share elgg-button elgg-button-twitter">' . elgg_echo('interconnected:twitter') . '<div class="elgg-sharing-logo"></div></div></a>';
    
    echo $vars['button'];
    return true;
?>