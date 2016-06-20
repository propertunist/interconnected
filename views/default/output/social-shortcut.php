<?php
    $vars['class'] = 'elgg-social-shortcut-' . $vars['target'];
    $vars['src'] = elgg_get_site_url() . 'mod/interconnected/graphics/' . $vars['target'] . '.png';
    $vars['alt'] = elgg_echo ('interconnected:profile-on', array($vars['owner_name'], elgg_echo('interconnected:' . $vars['target'])));
    $vars['width'] = '32';
    $vars['height'] = '32';
    echo elgg_view('output/url', array('href' => $vars['profile_url'],
                                        'text' => elgg_view('output/img', $vars),
                                        'title' => $vars['alt']));