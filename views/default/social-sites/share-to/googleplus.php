<?php
    $title = elgg_echo('interconnected:googleplus');
    if ($vars['button_size'] == 'large')
        $label = $title;
    else 
        $label = '';

    $vars['button'] = '<a target="_blank" rel="nofollow" href="https://plus.google.com/share?url=' . urlencode($vars['url']) . '" title="' . $title . '"><div class="elgg-button-share-wrapper"><div class="elgg-button-share-' . $vars['button_size'] . ' elgg-button elgg-button-googleplus" data-service="google_likes">' . $label . '<div class="elgg-sharing-logo-' . $vars['button_size'] . '"></div></div></div></a>';
    
    echo $vars['button'];
    
    return true;