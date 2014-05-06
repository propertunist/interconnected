<?php
    $title = elgg_echo('interconnected:email');
    if ($vars['item_title'])
        $vars['item_title'] = $vars['item_title'] . NEW_LINE;
    
    if ($vars['subtext'])
        $vars['subtext'] = $vars['subtext'] . NEW_LINE;
    
    if ($vars['description'])
        $vars['description'] = $vars['description'] . NEW_LINE;      
    
    if ($vars['button_size'] == 'large')
        $label = $title;
    else 
        $label = '';
    
    
    $vars['button'] = '<a target="_blank" href="mailto:?subject=' . $vars['item_title'] . '&body=' . elgg_echo('interconnected:emailbody', array($vars['subtext'],$vars['description'],$vars['url'])) . '" title="' . $title . '"><div class="elgg-button-share-' . $vars['button_size'] . ' elgg-button elgg-button-email">' . $label . '<div class="elgg-sharing-logo-' . $vars['button_size'] . '"></div></div></a>';
    
    echo $vars['button'];
    return true;

?>