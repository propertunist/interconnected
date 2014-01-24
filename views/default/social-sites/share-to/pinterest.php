<?php
    
    if ($vars['item_title'])
        $vars['item_title'] = $vars['item_title'] . NEW_LINE;
    
    if ($vars['subtext'])
        $vars['subtext'] = $vars['subtext'] . NEW_LINE;
    
    if ($vars['description'])
        $vars['description'] = $vars['new_line'] . $vars['description'];   
    
    $description = substr($vars['item_title'] . $vars['subtext'] . $vars['description'],0,500);

    $vars['button'] = '<a target="_blank" href="https://pinterest.com/pin/create/button/?url=' . $vars['url'] . '&description='. $description . '&media=' . $vars['icon_url'] . '"><div class="elgg-button-share elgg-button elgg-button-pinterest">' . elgg_echo('interconnected:pinterest') . '<div class="elgg-sharing-logo"></div></div></a>';
    
    echo $vars['button'];
    return true;
?>