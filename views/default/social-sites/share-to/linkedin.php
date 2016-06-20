<?php
    $title = elgg_echo('interconnected:linkedin-button');
    if ($vars['button_size'] == 'large')
        $label = $title;
    else 
        $label = '';

    if ($vars['item_title'])
    {
        $vars['item_title'] = html_entity_decode ($vars['item_title'] . ': ', ENT_QUOTES);
        $item_title = '&text=' . rawurlencode($vars['item_title']);
    }

    if ($vars['subtext'])
    {
        $vars['subtext'] = html_entity_decode ($vars['subtext'], ENT_QUOTES);
        $subtext = rawurlencode($vars['subtext']);
    }

    if ($vars['description'])
    {
        $vars['description'] = html_entity_decode ($vars['description'], ENT_QUOTES);
        $description = rawurlencode($vars['description']);
    }
    
    $vars['button'] = '<a target="_blank" rel="nofollow" href="https://www.linkedin.com/shareArticle?mini=true&amp;url=' . urlencode($vars['url']) . '&amp;title='. $item_title . '&amp;summary=' . $subtext . $description . '&amp;source=' . urlencode($vars['url']) . '" title="' . $title . '"><div class="elgg-button-share-wrapper"><div class="elgg-button-share-' . $vars['button_size'] . ' elgg-button elgg-button-linkedin" data-service="linked_shares">' . $label . '<div class="elgg-sharing-logo-' . $vars['button_size'] . '"></div></div></div></a>';
    
    echo $vars['button'];

    return true;