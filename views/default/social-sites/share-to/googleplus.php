<?php
    $title = elgg_echo('interconnected:googleplus');
    if ($vars['button_size'] == 'large')
        $label = $title;
    else 
        $label = '';

    $vars['button'] = '<a target="_blank" href="https://plus.google.com/share?url=' . $vars['url'] . '" title="' . $title . '"><div class="elgg-button-share-' . $vars['button_size'] . ' elgg-button elgg-button-googleplus">' . $label . '<div class="elgg-sharing-logo-' . $vars['button_size'] . '"></div></div></a>';
    
    echo $vars['button'];
    if ((int)$vars['counts']['google']> 0)
        echo '<div class="elgg-share-count" title="' . elgg_echo('interconnected:share_count', array($vars['social_site'],$vars['counts']['google'])) . '">' . $vars['counts']['google'] . '</div><div class="elgg-share-count-arrow">◄</div>';
    
    return true;
?>