<?php
    $title = elgg_echo('interconnected:pinterest');
    if ($vars['button_size'] == 'large')
        $label = $title;
    else 
        $label = '';    
    
    if ($vars['item_title'])
        $vars['item_title'] = $vars['item_title'] . NEW_LINE;
    
    if ($vars['subtext'])
        $vars['subtext'] = $vars['subtext'] . NEW_LINE;
    
    if ($vars['description'])
        $vars['description'] = $vars['new_line'] . $vars['description'];   
    
    $description = substr($vars['item_title'] . $vars['subtext'] . $vars['description'],0,500);

    $vars['button'] = '<a target="_blank" href="https://pinterest.com/pin/create/button/?url=' . $vars['url'] . '&description='. $description . '&media=' . $vars['icon_url'] . '" title="' . $title . '"><div class="elgg-button-share-' . $vars['button_size'] . ' elgg-button elgg-button-pinterest">' . $label . '<div class="elgg-sharing-logo-' . $vars['button_size'] . '"></div></div></a>';
    
    echo $vars['button'];
    if ((int)$vars['counts']['pinterest']> 0)
        echo '<div class="elgg-share-count" title="' . elgg_echo('interconnected:share_count', array($vars['social_site'],$vars['counts']['pinterest'])) . '">' . $vars['counts']['pinterest'] . '</div><div class="elgg-share-count-arrow">◄</div>';
    return true;
?>