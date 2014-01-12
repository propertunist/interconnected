<?php
     $vars['button'] = '<a target="_blank" href="https://www.facebook.com/sharer/sharer.php?s=100&p[title]=' . $vars['item_title'] . '&p[summary]=' . $vars['description'] . '&p[url]=' . $vars['url'] . '&p[images][0]=' . $vars['icon_url'] . '"><div class="elgg-button-share elgg-button elgg-button-facebook">' . elgg_echo('interconnected:facebook') . '</div></a>';
    echo $vars['button'];
    return true;
?>