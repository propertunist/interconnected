<?php
     $vars['button'] = '<a target="_blank" href="https://www.stumbleupon.com/submit?url=' . $vars['url'] . '"><div class="elgg-button-share elgg-button elgg-button-stumbleupon">' . elgg_echo('interconnected:stumbleupon') . '</div></a>';
    
    echo $vars['button'];
    return true;
?>