<?php
    $title = elgg_echo('interconnected:stumbleupon');
    if ($vars['button_size'] == 'large')
        $label = $title;
    else 
        $label = ''; 

     $vars['button'] = '<a target="_blank" rel="nofollow" href="https://www.stumbleupon.com/submit?url=' . urlencode($vars['url']) . '" title="' . $title . '"><div class="elgg-button-share-wrapper"><div class="elgg-button-share-' . $vars['button_size'] . ' elgg-button elgg-button-stumbleupon" data-service="stumble_shares">' . $label . '<div class="elgg-sharing-logo-' . $vars['button_size'] . '"></div></div></div></a>';
    
    echo $vars['button'];

    return true;