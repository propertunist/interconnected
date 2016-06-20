<?php
    $title = elgg_echo('interconnected:reddit');
    if ($vars['button_size'] == 'large')
        $label = $title;
    else 
        $label = '';

    $vars['button'] = '<a target="_blank" rel="nofollow" href="https://reddit.com/submit?url=' . urlencode($vars['url']) . '" title="' . $title . '"><div class="elgg-button-share-wrapper"><div class="elgg-button-share-' . $vars['button_size'] . ' elgg-button elgg-button-reddit" data-service="reddit_likes">' . $label . '<div class="elgg-sharing-logo-' . $vars['button_size'] . '"></div></div></div></a>';
    
    echo $vars['button'];
   
    return true;