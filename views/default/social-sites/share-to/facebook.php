<?php
    $title = elgg_echo('interconnected:facebook');
    if ($vars['button_size'] == 'large')
        $label = $title;
    else 
        $label = '';
    
     $vars['button'] = '<a target="_blank" rel="nofollow" href="https://www.facebook.com/sharer/sharer.php?s=100&amp;p[title]=' . urlencode($vars['item_title']) . '&amp;p[summary]=' . urlencode($vars['description']) . '&amp;p[url]=' . urlencode($vars['url']) . '&amp;p[images][0]=' . urlencode($vars['icon_url']) . '" title="' . $title . '"><div class="elgg-button-share-wrapper"><div class="elgg-button-share-' . $vars['button_size'] . ' elgg-button elgg-button-facebook" data-service="fb_shares">' . $label . '<div class="elgg-sharing-logo-' . $vars['button_size'] . '"></div></div></div></a>';
    echo $vars['button'];
    return true;