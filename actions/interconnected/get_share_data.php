<?php

$url = trim(get_input('url'));
$url_data = interconnected_analyze_url($url);

if ($url_data['in_site'] == 1)
{
 //       if (($url_data['handler'] != 'admin')&&($url_data['handler'] != 'activity')&&($url_data['handler'] != 'messages')&&($url_data['handler'] != 'members')&&($url_data['handler'] != 'search'))
   //     {
                $count_shares = elgg_get_plugin_setting('count_shares', 'interconnected');

                if ($count_shares == 1)
                        $share_data = interconnected_get_counts($url, $url_data['handler'] , $url_data['guid']);
     //   }
        echo '<result><shares>' . json_encode($share_data) . '</shares></result>';
}
