<?php
    $vars['button'] = '<a target="_blank" href="https://plus.google.com/share?url=' . $vars['url'] . '"><div class="elgg-button-share elgg-button elgg-button-googleplus">' . elgg_echo('interconnected:googleplus') . '</div></a>';
    
    echo $vars['button'];
    return true;
?>