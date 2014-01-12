<?php
    $label = elgg_echo('interconnected:profile:share');
    $body = elgg_view('interconnected/interconnected');
    echo elgg_view_module('main', $label, $body);
?>