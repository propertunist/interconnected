<?php
    $title = elgg_echo('interconnected:diaspora');
    if ($vars['button_size'] == 'large')
        $label = $title;
    else 
        $label = '';

    $vars['button'] = '<a target="_blank" rel="nofollow" href="http://sharetodiaspora.github.io/?url=' . urlencode($vars['url']) . '&title=' . $vars['item_title'] . '" title="' . $title . '"><div class="elgg-button-share-' . $vars['button_size'] . ' elgg-button elgg-button-diaspora">' . $label . '<div class="elgg-sharing-logo-' . $vars['button_size'] . '"></div></div></a>';
    
    echo $vars['button'];
    if ((int)$vars['counts']['diaspora_shares']> 0)
        echo '<div class="elgg-share-count" title="' . elgg_echo('interconnected:diaspora_count', array($vars['social_site'],$vars['counts']['diaspora_shares'])) . '">' . $vars['counts']['diaspora_shares'] . '</div><div class="elgg-share-count-arrow">◄</div>';
    
    return true;