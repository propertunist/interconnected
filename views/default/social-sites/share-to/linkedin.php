<?php
    $title = elgg_echo('interconnected:linkedin-button');
    if ($vars['button_size'] == 'large')
        $label = $title;
    else 
        $label = '';


    $vars['button'] = '<a target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&url=' . $vars['url'] . '&title='. $vars['item_title'] . '&summary=' . $vars['subtext'] . $vars['description'] . '&source=' . $vars['url'] . '" title="' . $title . '"><div class="elgg-button-share-' . $vars['button_size'] . ' elgg-button elgg-button-linkedin">' . $label . '<div class="elgg-sharing-logo-' . $vars['button_size'] . '"></div></div></a>';
    
    echo $vars['button'];
    if ((int)$vars['counts']['linkedin']> 0)
        echo '<div class="elgg-share-count" title="' . elgg_echo('interconnected:share_count', array($vars['social_site'],$vars['counts']['linkedin'])) . '">' . $vars['counts']['linkedin'] . '</div><div class="elgg-share-count-arrow">◄</div>';
    return true;
?>