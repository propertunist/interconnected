<?php
    $title = elgg_echo('interconnected:email');
    if ($vars['item_title'])
        $vars['item_title'] = html_entity_decode($vars['item_title']);
    
    if ($vars['subtext'])
        $vars['subtext'] = NEW_LINE . NEW_LINE . $vars['subtext'];
    
    if ($vars['description'])
        $vars['description'] = html_entity_decode($vars['description'] . NEW_LINE);      
    
    if ($vars['button_size'] == 'large')
        $label = $title;
    else 
        $label = '';
    
    
    $vars['button'] = '<a target="_blank" rel="nofollow" href="mailto:?subject=' . rawurlencode($vars['item_title']). '&amp;body=' . elgg_echo('interconnected:emailbody', array($vars['subtext'],$vars['description'],NEW_LINE . $vars['url'])) . '" title="' . $title . '"><div class="elgg-button-share-' . $vars['button_size'] . ' elgg-button elgg-button-email">' . $label . '<div class="elgg-sharing-logo-' . $vars['button_size'] . '"></div></div></a>';
    
    echo $vars['button'];
    return true;