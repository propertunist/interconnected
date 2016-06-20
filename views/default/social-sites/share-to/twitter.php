<?php

    $title = elgg_echo('interconnected:twitter');
    if ($vars['button_size'] == 'large')
        $label = $title;
    else 
        $label = ''; 

    if ($vars['item_title'])
    {
        $vars['item_title'] = html_entity_decode ($vars['item_title'] . ': ', ENT_QUOTES);
        $twitter_string = '&text=' . rawurlencode($vars['item_title']);
    }
    
    $twitter_handle = '&via=' . rawurlencode($vars['twitter_handle']);
    
    $vars['button'] = '<a target="_blank" rel="nofollow" href="https://twitter.com/intent/tweet?url=' . rawurlencode($vars['url']);
    
    if ($twitter_string)
        $vars['button'] .= $twitter_string;
    
    if (($twitter_handle)&&((strlen($twitter_string) + strlen($vars['twitter_handle']) <= 140)))
        $vars['button'].= $twitter_handle;
    
    $vars['button'] .= '" title="' . urlencode($title) . '"><div class="elgg-button-share-wrapper"><div class="elgg-button-share-' . $vars['button_size'] . ' elgg-button elgg-button-twitter" data-service="tw_shares">' . rawurlencode($label) . '<div class="elgg-sharing-logo-' . $vars['button_size'] . '"></div></div></div></a>';
    
    echo $vars['button'];
    
    return true;