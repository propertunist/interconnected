<?php
    $title = elgg_echo('interconnected:pinterest');
    if ($vars['button_size'] == 'large')
        $label = $title;
    else 
        $label = '';    
    
    if ($vars['item_title'])
        $vars['item_title'] = $vars['item_title'] . ' - ';
    
    if ($vars['subtext'])
        $vars['subtext'] = $vars['subtext'];
    
    if ($vars['description'])
        $vars['description'] = $vars['description'];   
    
    $description =  $vars['subtext'] . substr($vars['item_title'] . $vars['description'],0,500);
//elgg_dump(rawurldecode($vars['icon_url']));
    $vars['button'] = '<a target="_blank" rel="nofollow" href="https://pinterest.com/pin/create/button/?url=' . rawurlencode($vars['url']) . '&amp;description='. rawurlencode(html_entity_decode($description)) . '&amp;media=' . rawurldecode($vars['icon_url']) . '" title="' . $title . '"><div class="elgg-button-share-wrapper"><div class="elgg-button-share-' . $vars['button_size'] . ' elgg-button elgg-button-pinterest" data-service="pin_shares">' . $label . '<div class="elgg-sharing-logo-' . $vars['button_size'] . '"></div></div></div></a>';
    
    echo $vars['button'];

    return true;