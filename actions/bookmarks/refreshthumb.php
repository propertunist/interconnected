<?php

    if ($guid = (int) get_input('guid'))
        $entity = get_entity($guid);

    if($url = get_input('url'))
    {
        if (!preg_match("#^((ht|f)tps?:)?//#i", $url)) {
            $url = "http://$url";
        }
        //TODO: use locale and region code to get correct language for current user's language
        //$user = elgg_get_logged_in_user_entity();
        //$language = $user->language;

        $local_code = 'en_US';
        $url_query = parse_url($url,PHP_URL_QUERY);
        if ($url_query)
        {
            $url = $url . '&locale=' . $local_code;
        }
        else
        {
            $url = $url . '?locale=' . $local_code;
        }

    }

    // scan target page for opengraph data
    $graph_data = interconnected_get_graph_data($entity, $url);
    if ($graph_data)
    {
        $output = '<result>';
        // search the open graph data contents and process as needed
        foreach ($graph_data as $key => $value)
        {
            switch ($key)
            {
                // search opengraph data for images and use the 1st one located
                case 'image':
                    {
                         $thumbnail = file_get_contents($value);
                         if ($thumbnail)
                         {

                            if (interconnected_update_thumbnail($entity, TRUE, $url))
                            {
                                    $user = elgg_get_logged_in_user_entity();
                                    $output .= '<src>' . elgg_get_site_url() . 'mod/interconnected/pages/bookmarks/thumbnail.php?guid=' . $user->guid . '&size=temp</src>';
                            }
                         }
                         break;
                    }
                case 'title':
                    {
                        if ($value != '')
                            $output .= '<title>' . $value . '</title>';
                        break;
                    }
                case 'description':
                    {
                        if ($value != '')
                            $output .= '<description>' . $value . '</description>';
                        break;
                    }
            }
        }
        $output .= '</result>';

        echo $output;
    }
else
{
  echo '<result><none>no_data</none></result>';
}
