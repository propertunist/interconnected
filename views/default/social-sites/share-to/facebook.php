<?php
    $title = elgg_echo('interconnected:facebook');
    if ($vars['button_size'] == 'large')
        $label = $title;
    else 
        $label = '';

     $vars['button'] = '<a target="_blank" href="https://www.facebook.com/sharer/sharer.php?s=100&p[title]=' . $vars['item_title'] . '&p[summary]=' . $vars['description'] . '&p[url]=' . $vars['url'] . '&p[images][0]=' . $vars['icon_url'] . '" title="' . $title . '"><div class="elgg-button-share-' . $vars['button_size'] . ' elgg-button elgg-button-facebook">' . $label . '<div class="elgg-sharing-logo-' . $vars['button_size'] . '"></div></div></a>';
    echo $vars['button'];
    if ((int)$vars['counts']['facebook']['share_count'] > 0)
        echo '<div class="elgg-share-count" title="' . elgg_echo('interconnected:share_count', array($vars['social_site'],$vars['counts']['facebook']['share_count'])) . '">' . $vars['counts']['facebook']['share_count'] . '</div><div class="elgg-share-count-arrow">◄</div>';

    return true;
?>