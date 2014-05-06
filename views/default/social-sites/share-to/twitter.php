<?php
    $title = elgg_echo('interconnected:twitter');
    if ($vars['button_size'] == 'large')
        $label = $title;
    else 
        $label = ''; 

    if ($vars['item_title'])
        $vars['item_title'] = $vars['item_title'] . NEW_LINE;
 
    $vars['button'] = '<a target="_blank" href="https://twitter.com/intent/tweet?text=' . $vars['item_title'] . $vars['subtext'] . '&url=' . $vars['url'];
    if ($vars['twitter_handle'])
        $vars['button'].= '&via=' . $vars['twitter_handle'];
    $vars['button'] .= '" title="' . $title . '"><div class="elgg-button-share-' . $vars['button_size'] . ' elgg-button elgg-button-twitter">' . $label . '<div class="elgg-sharing-logo-' . $vars['button_size'] . '"></div></div></a>';
    
    echo $vars['button'];
    if ((int)$vars['counts']['twitter']> 0)
        echo '<div class="elgg-share-count" title="' . elgg_echo('interconnected:share_count', array($vars['social_site'],$vars['counts']['twitter'])) . '">' . $vars['counts']['twitter'] . '</div><div class="elgg-share-count-arrow">◄</div>';
    
    return true;
?>