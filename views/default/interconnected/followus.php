<?php

$target_sites = array(
        'facebook',
        'twitter',
        'googleplus',
        'youtube'
);
$count = 0;
$to_output = FALSE;
foreach($target_sites as $site)
{
    $site_handle = elgg_get_plugin_setting($site . '_handle', 'interconnected');
    if ($site_handle != '')
    {
        if ($site == 'twitter')
            $href = 'https://www.twitter.com/' . $site_handle;
        else
            $href = $site_handle;
        $output .= elgg_view('output/url', array('href'=>$href,
                                                 'text'=>elgg_view('output/img', array('src'=> elgg_get_site_url(). 'mod/interconnected/graphics/' . $site . '.png',
                                                                                       'alt'=> elgg_echo('interconnected:followus-on', array($site)),
                                                                                       'title' => elgg_echo('interconnected:followus-on', array($site))))));
        $to_output = TRUE;
    }
    $count++;
    if ($count < count($target_sites))
        $output .= ' ';
} 
if ($to_output == TRUE)
    echo '<div id="elgg-sharing-followus">' . '<label>' . elgg_echo('interconnected:title:followus') . ':</label>  ' . $output . '</div>';
?>