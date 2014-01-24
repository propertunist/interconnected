<?php
    $vars['button'] = '<a target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&url=' . $vars['url'] . '&title='. $vars['item_title'] . '&summary=' . $vars['subtext'] . $vars['description'] . '&source=' . $vars['url'] . '"><div class="elgg-button-share elgg-button elgg-button-linkedin">' . elgg_echo('interconnected:linkedin-button') . '<div class="elgg-sharing-logo"></div></div></a>';
    
    echo $vars['button'];
    return true;
?>