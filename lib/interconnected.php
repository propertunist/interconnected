<?php
/**
 * interconnected function library for elgg
 *
 * @license GNU Public License version 2
 * @author ura soul
 * @website ureka.org
 */

 // returns integer values for width and height of image entities. optional size variable allows thumbnails to be sized too.

 function interconnected_get_image_dimensions_from_entity($entity, $size){
   if ($entity instanceof ElggEntity)
   {
     $sizes = array('topbar','tiny', 'small', 'medium', 'large', 'master');
     switch ($entity->getType())
     {
       case 'object':
       {
         switch ($entity->getSubtype()){
           case 'bookmarks':
           {
             $readfile = new ElggFile();
             if (!in_array($size, $sizes))
               $size = 'master';
             if ($size != 'master')
               $path_id = 'thumb';

             $readfile->owner_guid = $entity->owner_guid;
             $readfile->setFilename("bookmarks/{$size}{$path_id}-{$entity->guid}.jpg");
             if ($readfile->exists()) {
               $thumbpath = $readfile->getFilenameOnFilestore();
             }
             break;
           }
           default:
           {
             break;
           }
         }
         break;
       }
     }

   }
   else {
     return false;
   }

 //elgg_dump($thumbpath);
 //elgg_dump(getimagesize($thumbpath));
   if ($thumbpath)
     return getimagesize($thumbpath);
   else {
     return false;
   }
 }


function get_icon_for_title($context)
{
    if ($context)
    {
        if (elgg_is_active_plugin('pagehandler_hijack'))
        {
            $hijack_handlers = MBeckett\pagehandler_hijack\get_replacement_handlers();
            $original_handler = array_search($context, $hijack_handlers);
            if ($original_handler)
                $context = $original_handler;
        }
      //  elgg_dump($context);
        switch ($context)
        {
            case 'activity':
            {
                $icon = 'heartbeat';
                break;
            }
            case 'blog':
            {
                $icon = 'cloud';
                break;
            }
            case 'bookmarks':
            {
                $icon = 'bookmark';
                break;
            }
            case 'categories':
            {
                $icon = 'sitemap';
                break;
            }
            case 'discussion':
            {
                $icon = 'comments-o';
                break;
            }
            case 'file':
            {
                $icon = 'file';
                break;
            }
            case 'groups':
            case 'group-profile':
            {
                $icon = 'group';
                break;
            }
            case 'pages':
            {
                $icon = 'book';
                break;
            }
            case 'photos':
            {
                $icon = 'camera';
                break;
            }
            case 'poll':
            {
                $icon = 'list-ol';
                break;
            }
            case 'members':
            case 'profile':
            {
                $icon = 'user';
                break;
            }
            case 'pinboards':
            {
                $icon = 'flask';
                break;
            }
            case 'search':
            {
                $icon = 'search';
                break;
            }
            case 'settings':
            case 'profile_edit':
            {
                $icon = 'cogs';
                break;
            }
            case 'tags':
            {
                $icon = 'tags';
                break;
            }
            case 'thewire':
            {
                $icon = 'bullhorn';
                break;
            }
            case 'videolist':
            {
                $icon = 'film';
                break;
            }
            default:
            {
                return false;
            }
        }
    }
    else
        return false;

    return '<span class="fa fa-' . $icon . '"></span> ';
}

// get_nice_name_for_subtype - retrieves the elgg text label (singular) for a given subtype

if (!function_exists('get_nice_name_for_subtype'))
{
        function get_nice_name_for_subtype($subtype)
        {
                switch($subtype)
                {
                    case 'image':
                    case 'album':
                    case 'au_set':
                    case 'page_top':
                    case 'pages':
                    case 'bookmarks':
                    case 'videolist_item':
                    {
                        $type_label = elgg_echo ($subtype);
                        break;
                    }
                    case 'file':
                    case 'blog':
                    {
                        $type_label = elgg_echo ($subtype . ':' . $subtype);
                        break;
                    }
                    default:
                    {
                        $type_label = elgg_echo('item:object:' . $subtype);
                        break;
                    }
                }
                return $type_label;
        }
}

function interconnected_social_counts_pagesetup()
{
    // Add admin menu item
    elgg_register_admin_menu_item('administer', 'count_table', 'statistics');
}

// interconnected_get_graph_data - retrieves opengraph metadata for a given external URL

function interconnected_get_graph_data($entity, $url)
{
    $result = array();
    if (($entity->address)&&($entity instanceof ElggObject)&&($entity->getSubtype() == 'bookmarks'))
    {
        $url = $entity->address;
    }

    if ($url)
    {
        $plugin_path = elgg_get_plugins_path();
        require_once($plugin_path . 'interconnected/lib/opengraph.php');

        $graph = OpenGraph::fetch($url);
        if ($graph)
            error_log('interconnected opengraph data exists!');
     // search opengraph data for images and use the 1st one located
        if ($graph)
        {
            foreach ($graph as $key => $value)
            {
                switch($key)
                {
                    case 'image':
                    case 'image:secure_url':
                    case 'image_src':
                        {

                            if (!$result['image'])
                             {
                                $x = 0;
                                while ($x <= (count($value)-1))
                                {
                                    if (@getimagesize($value[$x]))
                                    {
                                        $result['image'] = $value[$x];
                                        error_log('interconnected image: ' . $result['image']);
                                        break;
                                    }
                                    $x = $x + 1;
                                }
                             }
                             break;
                        }
                    case 'description':
                    case 'title':
                    default:
                    {
                        if (is_array($value))
                            $data = $value[0];
                        else
                            $data = $value;

                        $result[$key] = $data;
                        break;
                    }
                }
            }
            return $result;
        }
        else
        {
            return false;
        }
    }
    else
    {
        return false;
    }
}

// interconnected_update_thumbnail - saves thumbnails for a bookmark

function interconnected_update_thumbnail($entity, $temp, $url)
{
    // scan target page for opengraph data
    $graph_data = interconnected_get_graph_data($entity, $url);

    if ($graph_data['image'])
    {
       $thumbnail = file_get_contents($graph_data['image']);

        if ($size = getimagesizefromstring($thumbnail))
        {
           ob_start();
           imagejpeg(imagecreatefromstring($thumbnail));
           $thumbnail = ob_get_clean();
           ob_clean();

           if ($temp == TRUE)
           {
                    $user =  elgg_get_logged_in_user_entity();
                    $prefix = "bookmarks/temp";
                    $filehandler = new ElggFile();
                    $filehandler->owner_guid = $user->guid;
                    $filehandler->container_guid =  $user->guid;
                    $filehandler->setFilename($prefix . ".jpg");
                    $filehandler->open("write");
                    $filehandler->write($thumbnail);
                    $filestorename = $filehandler->getFilenameOnFilestore();
                    $filehandler->close();
                    $user->temp_bookmark_thumb = $prefix . ".jpg" ;
                    return true;
           }
           else
           {
                    $default_icon_sizes = elgg_get_config("icon_sizes");

                    // save master image
                    $prefix = "bookmarks/master-" . $entity->guid;
                    $filehandler = new ElggFile();
                    $filehandler->owner_guid = $entity->owner_guid;
                    $filehandler->container_guid = $entity->container_guid;
                    $filehandler->setFilename($prefix . ".jpg");
                    $filehandler->open("write");
                    $filehandler->write($thumbnail);
                    $filestorename = $filehandler->getFilenameOnFilestore();
                    $filehandler->close();
                    $entity->thumbnail = $prefix . ".jpg" ;

                    // save small image
                    $small_maxwidth= elgg_get_plugin_setting('image_small_w','interconnected', $default_icon_sizes['small']['w']);
                    $small_maxheight= elgg_get_plugin_setting('image_small_h','interconnected',  $default_icon_sizes['small']['h']);
                    $small_thumb = get_resized_image_from_existing_file($filestorename, $small_maxwidth, $small_maxheight,FALSE, null, null, null, null, TRUE);
                    $prefix = "bookmarks/smallthumb-" . $entity->guid;
                    $filehandler->setFilename($prefix . ".jpg");
                    $filehandler->open("write");
                    $filehandler->write($small_thumb);
                    $filehandler->close();
                    $entity->smallthumb = $prefix . ".jpg" ;

                    // save medium image
                    $medium_maxwidth= elgg_get_plugin_setting('image_medium_w','interconnected', $default_icon_sizes['medium']['w']);
                    $medium_maxheight= elgg_get_plugin_setting('image_medium_h','interconnected', $default_icon_sizes['medium']['h']);
                    $medium_thumb = get_resized_image_from_existing_file($filestorename, $medium_maxwidth, $medium_maxheight,FALSE, null, null, null, null, FALSE);
                    $prefix = "bookmarks/mediumthumb-" . $entity->guid;
                    $filehandler->setFilename($prefix . ".jpg");
                    $filehandler->open("write");
                    $filehandler->write($medium_thumb);
                    $filehandler->close();
                    $entity->mediumthumb = $prefix . ".jpg" ;

                    // save large image
                    $large_maxwidth= elgg_get_plugin_setting('image_large_w','interconnected', $default_icon_sizes['large']['w']);
                    $large_maxheight= elgg_get_plugin_setting('image_large_h','interconnected', $default_icon_sizes['large']['h']);
                    $large_thumb = get_resized_image_from_existing_file($filestorename, $large_maxwidth, $large_maxheight,FALSE, null, null, null, null, FALSE);
                    $prefix = "bookmarks/largethumb-" . $entity->guid;
                    $filehandler->setFilename($prefix . ".jpg");
                    $filehandler->open("write");
                    $filehandler->write($large_thumb);
                    $filehandler->close();
                    $entity->largethumb = $prefix . ".jpg" ;
                    $entity->iconcheck = date(DATE_RSS,time());
                    return true;
           }
       }
       else
       {
           error_log('update thumbnail: image processing error');
           unset($entity->thumbnail);
           unset($entity->smallthumb);
           unset($entity->mediumthumb);
           unset($entity->largethumb);
           return 'error';
       }
   }
   else {
        error_log('update thumbnail: no image retrieved');
        unset($entity->thumbnail);
        unset($entity->smallthumb);
        unset($entity->mediumthumb);
        unset($entity->largethumb);
        return 'no_image';
   }
}

//interconnected_get_counts - retrieves share/like data for a given url. data either comes from external services or from the internal cache.

function interconnected_get_counts($url, $handler, $entity){
    if ($url)
    {
        // protect against injections
        //$url = mysqli_real_escape_string($url);
        // only keep query parameters for search pages
        if ($handler != 'search')
        {
            $parsed_url = parse_url($url);
            $url = $parsed_url['scheme'] . '://' . $parsed_url['host'] . $parsed_url['path'];
        }

        $dbprefix = elgg_get_config('dbprefix');

        // check for locally cached data
        $data = get_data_row("SELECT * FROM {$dbprefix}social_share_counts WHERE url = '{$url}'");

        if(count($data) > 0)
            $cache_found = TRUE;

        $current_timestamp = new DateTime(date("Y-m-d H:i:s"));

        // 600 seconds = 10 minutes
        $cache_expire = elgg_get_plugin_setting('count_share_cache', 'interconnected');
        $cache_expire = $current_timestamp->sub(new DateInterval('PT' . $cache_expire . 'S'));

        // check if cache has expired
        if ((($data->url == $url)&&(new DateTime($data->date) <= $cache_expire))||($cache_found != TRUE))
        {
                $fb_counts = get_facebook_counts($url);
                if ($fb_counts->likes)
                        $return['fb_likes'] = (int) $fb_counts->likes;
                else
                    $return['fb_likes'] = 0;

                if ($fb_counts->shares)
                        $return['fb_shares'] = (int) $fb_counts->shares;
                else
                    $return['fb_shares'] = 0;

                // tweet counting is unavailable until twitter's api 1.1 is understood
                $tw_counts = get_twitter_counts($url);
                if ($tw_counts)
                        $return['tw_shares'] = (int) $tw_counts;
                else
                    $return['tw_shares'] = 0;

                $pin_counts = get_pinterest_counts($url);
                if ($pin_counts)
                    $return['pin_shares'] = (int) $pin_counts;
                else
                    $return['pin_shares'] = 0;

                $linked_counts = get_linked_in_counts($url);
                if ($linked_counts)
                    $return['linked_shares'] = (int) $linked_counts;
                else
                    $return['linked_shares'] = 0;

                $stumble_counts = get_stumble_upon_counts($url);
                if ($stumble_counts)
                    $return['stumble_shares'] = (int) $stumble_counts;
                else
                    $return['stumble_shares'] = 0;

                $google_counts = get_googleplus_counts($url);
                if ($google_counts)
                    $return['google_likes'] = (int) $google_counts;
                else
                    $return['google_likes'] = 0;

                $reddit_counts = get_reddit_counts($url);
                if ($reddit_counts)
                    $return['reddit_likes'] = (int) $reddit_counts;
                else
                    $return['reddit_likes'] = 0;

                // if counts are retrieved then cache data in database
                $x = 1;
                foreach ($return as $key => $value)
                {
                        $insert_field_list .= $key;
                        $insert_value_list .= $value;
                        $update_list .= $key . ' = ' . $value;
                        if ($x < count($return))
                        {
                            $insert_field_list .= ',';
                            $insert_value_list .= ',';
                            $update_list .= ',';
                        }
                        $x++;
                }

                if (($insert_field_list)&&($insert_value_list))
                {
                    if ($entity->guid)
                    {
                        $entity_guid = ',' . $entity->guid;
                        $entity_guid_field = 'entity_guid,';
                    }
                    else
                    {
                        $entity_guid = '';
                        $entity_guid_field = '';
                    }
                        $result_insert = insert_data("INSERT INTO {$dbprefix}social_share_counts (url," . $entity_guid_field . $insert_field_list . ") VALUES ('" . $url . "'" . $entity_guid . "," . $insert_value_list . ") ON DUPLICATE KEY UPDATE " . $update_list . ",date = CURRENT_TIMESTAMP");
                }
        }
        else
        {
            // use cached data
            $return['fb_likes'] = $data->fb_likes;
            $return['fb_shares'] = $data->fb_shares;
            $return['google_likes'] = $data->google_likes;
            $return['google_shares'] = $data->google_shares;
            $return['tw_favs'] = $data->tw_favs;
            $return['tw_shares'] = $data->tw_shares;
            $return['pin_shares'] = $data->pin_shares;
            $return['stumble_shares'] = $data->stumble_shares;
            $return['linked_shares'] = $data->linked_shares;
            $return['reddit_likes'] = $data->reddit_likes;
        }
        return $return;
    }
    else {
        return false;
    }

}

function get_reddit_counts( $url )
{
   if ($api = file_get_contents( 'http://www.reddit.com/api/info.json?&url=' . $url ))
   {
      $data = json_decode( $api );
      foreach($data->data->children as $child) {
            $ups+= (int) $child->data->ups;
            $downs+= (int) $child->data->downs;
         }
         $count = $ups - $downs;
         return $count;
   }
   else {
      return false;
   }
}

function get_stumble_upon_counts( $url ) {
   if ($api = file_get_contents( 'https://www.stumbleupon.com/services/1.01/badge.getinfo?url=' . $url ))
   {
      $count = json_decode( $api );
      return $count->result->views;
   }
   else {
      return false;
   }
}

function get_googleplus_counts( $url ) {
    $curl = curl_init();
    curl_setopt( $curl, CURLOPT_URL, "https://clients6.google.com/rpc" );
    curl_setopt( $curl, CURLOPT_POST, 1 );
    curl_setopt( $curl, CURLOPT_POSTFIELDS, '[{"method":"pos.plusones.get","id":"p","params":{"nolog":true,"id":"' . $url . '","source":"widget","userId":"@viewer","groupId":"@self"},"jsonrpc":"2.0","key":"p","apiVersion":"v1"}]' );
    curl_setopt( $curl, CURLOPT_RETURNTRANSFER, true );
    curl_setopt( $curl, CURLOPT_HTTPHEADER, array( 'Content-type: application/json' ) );
    $curl_results = curl_exec( $curl );
    curl_close( $curl );
    $json = json_decode( $curl_results, true );

    return intval( $json[0]['result']['metadata']['globalCounts']['count'] );
}

function get_facebook_counts($url) {
   if ($api = file_get_contents( 'http://graph.facebook.com/?id=' . $url ))
   {
      $count = json_decode( $api );
   }
   else
   {
      $count = false;
   }

    return $count;
}

function get_twitter_counts( $url ) {

    //$api = file_get_contents( 'https://cdn.api.twitter.com/1/urls/count.json?url=' . $url );

    $api = file_get_contents( 'http://opensharecount.com/count.json?url=' . urlencode($url));
   // $api = file_get_contents( 'https://cdn.api.twitter.com/1.1/search/tweets.json?q=' . urlencode($url));
    $count = json_decode( $api );
    return $count->count;
}

function get_pinterest_counts ( $url ) {

    $api = file_get_contents( 'http://widgets.pinterest.com/v1/urls/count.json?callback%20&url=' . $url );
    $body = preg_replace( '/^receiveCount\((.*)\)$/', '\\1', $api );
    $count = json_decode( $body );

    return $count->count;
}

function get_linked_in_counts( $url ) {

    $api = file_get_contents( 'https://www.linkedin.com/countserv/count/share?url=' . $url . '&format=json' );
     $count = json_decode( $api );
     return $count->count;
}

// use the URL sniffer for a given url

function interconnected_analyze_url($url) {

    if (!class_exists('UFCOE\\Elgg\\Url')) {
        require dirname(dirname(__FILE__)) . '/classes/UFCOE/Elgg/Url.php';
    }

    $sniffer = new UFCOE\Elgg\Url();

    return $sniffer->analyze($url);
}

 /***************
  * get_sharing_data_for_current_page()
  *
  * returns: array - $content - containing:
  *              author = name of page creator
  *              item_title = the most relevant title for the current page
  *              subtext = a formatted string that describes the sharing action
  *              description = a relevant description of the current page (commonly built from page content)
  *              icon_url = a smaller sized image url to represent the current page
  *              full_icon_url = a larger sized image url to represent the current page
  *              url = the url to be shared
  *              keywords = the current page's relevant tags
  *
  *************/


 function get_sharing_data_for_current_page()
 {
    static $content; // static variable is held in memory to be accessed again
    if ($content === null) {     // this allows multiple calls to the function to be made and the code to only be run once

        $site_url = elgg_get_site_url();
        $sitename = elgg_get_config('sitename');
        $siteinfo = elgg_get_config('sitedescription');

      // these variables can be moved to an admin page

        $size = 'medium';
        $full_size = 'large';

     /*****************************/
        $current_user = elgg_get_logged_in_user_entity();

        $site_logo = elgg_get_plugin_setting('site_logo', 'interconnected');
        if ($site_logo == '')
        {
            if (elgg_is_logged_in())
                $site_logo = $current_user->getIconURL($size);
        }

        $full_site_logo = elgg_get_plugin_setting('full_site_logo', 'interconnected');
        if ($full_site_logo == '')
        {
            if (elgg_is_logged_in())
            $full_site_logo = $current_user->getIconURL($full_size);
        }
        $default_title = elgg_get_plugin_setting('default_title', 'interconnected');

        if ($default_title == '')
            $default_title = $sitename;

        $content['twitter_handle'] = elgg_get_plugin_setting('twitter_handle', 'interconnected');
        $aboutme = elgg_get_plugin_setting('about_me', 'interconnected');

        $group_description = elgg_get_plugin_setting('group_description', 'interconnected');

        $button_size = elgg_get_plugin_setting('button_size', 'interconnected');
        if ($button_size)
            $content['button_size'] = $button_size;
        else
            $content['button_size'] = $button_size='large';

        $context = elgg_get_context();
        $url = current_page_url();
        $url_array = interconnected_analyze_url($url);
        $handler = $url_array['handler'];
        // if no handler is provided then default to homepage
        if (!$handler)
        {
            $url = elgg_get_site_url();
            $url_array = interconnected_analyze_url($url);
        }
        $content['handler'] = $handler;
        $handler_segments = $url_array['handler_segments'];
        //error_log(print_r($url_array,true));
        $type = 'website';
        if ($url_array['guid']) // if 3rd url path parameter is a numeric
        {
            $entity = get_entity(sanitise_int($url_array['guid'])); // check to see if an entity can be found
        }
        elseif ((elgg_is_active_plugin('anypage'))&&(is_array($handler_segments)))
        {
                $handler_segments_copy = $handler_segments;
                array_unshift($handler_segments_copy, $handler);
                $path = AnyPage::normalizePath(implode('/', $handler_segments_copy));
                $page = AnyPage::getAnyPageEntityFromPath($path);
                if (elgg_instanceof($page))
                    $entity = $page;
        }

        if (($entity instanceof ElggEntity)&&(!($entity instanceof ElggGroup)&&(!($entity instanceof ElggUser)))&&($handler != 'related')) // if an entity is found get entity specific data
        {
            $container = $entity->getContainerEntity();
            $owner = $entity->getOwnerEntity();
            $author = $owner->name;
            $subtype = $entity->getSubtype();
            $content['subtype'] = $subtype;
            $tags = $entity->tags;
            if ((($url_array['handler_segments'][0] != 'view')&&($url_array['handler_segments'][0] != 'watch'))&&($url_array['handler_segments'][0] != $url_array['guid'])) // check url structure to see if it is view mode or not
            {
               if ($url_array['handler_segments'][0] != 'album') //tidypics album paths are non-standard
                    $url = $site_url . $handler . '/view/' . $url_array['guid']; // set the shared url to be the view mode url and not edit or another mode which is unsuitable for sharing
            }

            if ($tags) //if the current item has tags
            {
                if (is_array($tags)) //if the current item has more than 1 tag
                {
                    $tags = array_unique($tags); // create unique list
                }
                else
                {
                    $tags = array($tags);
                }
            }

                $item_title = $entity->title;
                $description = $entity->description;
                //error_log($subtype);
                switch ($subtype)
                {
                    case 'anypage':
                    {
                        $type = 'article';
                        break;
                    }
                    case 'blog':
                    {
                        if ((elgg_is_active_plugin('blog_tools'))&&($icontime = $entity->icontime))
                        {
                            $icontime = "{$icontime}";
                            $filehandler = new ElggFile();
                            $filehandler->owner_guid = $entity->getOwnerGUID();
                            $filehandler->setFilename("blogs/" . $entity->getGUID() . $size . ".jpg");

                            if ($filehandler->exists())
                            {
                            $icon_url = $site_url . "mod/blog_tools/pages/thumbnail.php?guid={$owner->getGUID()}&blog_guid={$entity->getGUID()}&size={$size}&icontime={$icontime}";
                                $full_icon_url =  $site_url . "mod/blog_tools/pages/thumbnail.php?guid={$owner->getGUID()}&blog_guid={$entity->getGUID()}&size={$full_size}&icontime={$icontime}";
                            }
                        }
                        //$description = $entity->description;
                        $subtext = elgg_echo('interconnected:' . $subtype) .' ' . $author . '... ';
                        $item_title = elgg_echo('interconnected:title:' . $subtype) . $item_title;
                        $type = 'blog';
                        break;
                    }
                    case 'image':
                    case 'album':
                    {
                        if ($subtype=='album')
                        {
                            $cover_guid = $entity->getCoverImageGuid();
                            if ($cover_guid)
                            {
                                $cover_entity = get_entity($cover_guid);
                                if ($cover_entity)
                                {
                                    $icon_url = $cover_entity->getIconURL($size);
                                    $full_icon_url = $cover_entity->getIconURL($full_size);
                                }
                            }
                        }
                        else
                        {
                            $icon_url = $entity->getIconURL($size);
                            $full_icon_url = $entity->getIconURL($full_size);
                            $album_entity = get_entity($entity->container_guid);
                            $access_id = $album_entity->access_id;
                        }
                       // $description = $entity->description;
                        $subtext = elgg_echo('interconnected:' . $subtype) .' ' . $author . '... ';
                        $type = 'article';
                        $item_title = elgg_echo('interconnected:title:' . $subtype) . $item_title;
                        break;
                    }
                    case 'hjcategory':
                        {
                            $icon_url = $entity->getIconURL($size);
                            $full_icon_url = $entity->getIconURL($full_size);
                         //   $description = $entity->description;
                   //         error_log(print_r($entity,true));
                            $tags = array(elgg_echo('interconnected:category'), $item_title, $sitename);
                            $item_title = elgg_echo('interconnected:' . $subtype) . $item_title;
                            break;
                        }
                    case 'page_top':
                    case 'page':
                    {
                            $icon_url = $entity->getIconURL($size);
                            $full_icon_url = $entity->getIconURL($full_size);
                           // $description = $entity->description;
                            $item_title = elgg_echo('interconnected:title:' . $subtype) . $item_title;
                            break;
                    }
                    case 'videolist_item':
                    {
                            $icon_url = $entity->getIconURL($size);
                            $full_icon_url = $entity->getIconURL($full_size);
                           // $description = $entity->description;
                            $item_title = elgg_echo('interconnected:title:' . $subtype) . $item_title;
                            $content['robots'] = 'noindex,nofollow';
                            break;
                    }
                    case 'discussion':
                    case 'poll':
                    {
                      //  $description = $entity->description;
                        $item_title = elgg_echo('interconnected:title:' . $subtype) . $item_title;
                        $type = 'article';
                        break;
                    }
                    default:
                    {
                        $icon_url = $entity->getIconURL($size);
                        $full_icon_url = $entity->getIconURL($full_size);
                       // $description = $entity->description;
                        $subtext = elgg_echo('interconnected:title:' . $subtype) .'&nbsp;';
                        $type = 'article';
                        break;
                    }
                }
                if (!$access_id)
                    $access_id = $entity->access_id;

                if (($access_id != 2)||($handler_segments[0] == 'add'))
                {
                    $content['access_denied'] = TRUE;
                }
        }
        else // there is no specific entity on the page, then look at contexts next
        {
            if (elgg_is_active_plugin('pagehandler_hijack'))
            {
                $hijack_handlers = MBeckett\pagehandler_hijack\get_replacement_handlers();
                $original_handler = array_search($handler, $hijack_handlers);
                if ($original_handler)
                    $handler = $original_handler;
            }

           // error_log ('handler = ' . $handler);
            switch($handler)
            {
                case 'blog': // pages that are not for specific entities - such as 'all', 'owner', 'friends'
                case 'bookmarks':
                case 'pages':
                case 'videolist':
                case 'market':
                case 'events':
                case 'thewire':
                case 'pinboards':
                case 'tags':
                case 'donation':
                case 'liked_content':
                case 'poll':
                case 'discussion':
                case 'register':
                case 'forgotpassword':
                {
                    switch ($handler_segments[0])
                    {
                        case 'owner':
                        {
                            if ($owner = get_user_by_username($handler_segments[1]))
                                    $owner_name = $owner->name;
                            elseif (($entity instanceof ElggUser)||($entity instanceof ElggGroup))
                            {
                                $owner_name = $entity->name;
                            }
                            else
                            {
                                $owner_name = elgg_echo('user');
                            }
                            $item_title = elgg_echo('interconnected:owner:title:' . $handler, array($owner_name));
                            $description = elgg_echo('interconnected:owner:description:' . $handler, array($owner_name));
                            break;
                        }
                        case 'friends':
                        {
                            if ($owner = get_user_by_username($handler_segments[1]))
                                    $owner_name = $owner->name;
                            elseif ($entity instanceof ElggUser)
                            {
                                $owner_name = $entity->name;
                            }
                            else
                            {
                                $owner_name = elgg_echo('user');
                            }
                            $item_title = elgg_echo('interconnected:friends:title:' . $handler, array($owner_name));
                            $description = elgg_echo('interconnected:friends:description:' . $handler, array($owner_name));
                            break;
                        }
                        case 'featured':
                        {
                            $item_title = elgg_echo('interconnected:featured:title:' . $handler);
                            $description = elgg_echo('interconnected:featured:description:' . $handler);
                            break;
                        }
                        case 'all':
                        default:
                        {
                            $item_title = elgg_echo('interconnected:rootpage:title:' . $handler);
                            $description = elgg_echo('interconnected:rootpage:description:' . $handler);
                        }
                    }
                    break;
                }
                case 'search':
                {
                    $content['robots'] = 'noindex,follow';
                    $query = stripslashes(get_input('q', get_input('tag', '')));
                    if (function_exists('mb_convert_encoding'))
                    {
                        $display_query = mb_convert_encoding($query, 'HTML-ENTITIES', 'UTF-8');
                    }
                    else
                    {
                        // if no mbstring extension, we just strip characters
                        $display_query = preg_replace("/[^\x01-\x7F]/", "", $query);
                    }
                    $display_query = htmlspecialchars($display_query, ENT_QUOTES, 'UTF-8', false);

                    $item_title = elgg_echo('interconnected:rootpage:title:' . $handler, array($display_query));
                    $description = elgg_echo('interconnected:rootpage:description:' . $handler, array($display_query));
                    break;
                }
                case 'activity':
                {
                    $item_title = elgg_echo('interconnected:rootpage:title:' . $handler);
                    $description = elgg_echo('interconnected:rootpage:description:' . $handler);
                    $type = 'activity';
                    break;
                }
                case 'members':
                case 'groups':
                {
                  //  error_log(print_r($entity,true));
                    if ($handler_segments[0] == 'activity')
                    {
                        $item_title = elgg_echo('interconnected:rootpage:title:activity');
                        if ($group_container = get_entity($handler_segments[1]))
                            if ($group_container instanceof ElggGroup)
                                $item_title = elgg_echo('group') . ': ' . $group_container->name . ': ' . $item_title;

                        $description = elgg_echo('interconnected:rootpage:description:activity');
                        $type = 'activity';
                        $tags = array(elgg_echo('interconnected:' . $handler),$sitename);
                    }
                    elseif (!($entity instanceof ElggGroup))
                    {
                        $item_title = elgg_echo('interconnected:rootpage:title:' . $handler);
                        $description = elgg_echo('interconnected:rootpage:description:' . $handler);
                        $tags = array(elgg_echo('interconnected:' . $handler),$sitename);
                    }
                    else
                    {
                        $item_title = elgg_echo('group') . ': ' . $entity->name;

                        $description = $entity->$group_description;

                        $icon_url = $entity->getIconURL($size);
                        $full_icon_url = $icon_url;
                    }
                    break;
                }
                case 'friends':
                case 'profile':
                {
                    $owner = get_user_by_username($url_array['handler_segments'][0]);
                    if ($owner)
                    {
                        $icon_url = $owner->getIconURL($size);
                        $full_icon_url = $owner->getIconURL($full_size);
                        $item_title = elgg_echo('interconnected:title:' . $handler, array($owner->name, $sitename));
                        if (($handler == 'profile')&&($owner->$aboutme))
                            $description = $owner->$aboutme;
                        else
                            $description = elgg_echo('interconnected:description:' . $handler, array($owner->name));
                        $author = $owner->name;
                        $type='profile';
                        $tags = array(elgg_echo('interconnected:' . $handler),$author,$sitename);
                    }
                    break;
                }
                case 'categories':
                    {
                        $item_title = elgg_echo('interconnected:rootpage:title:' . $handler);
                        $description = elgg_echo('interconnected:rootpage:description:'. $handler);
                        $tags = array(elgg_echo('interconnected:categories'), $sitename);
                        break;
                    }
                case 'file':
                    {
                        switch($url_array['handler_segments'][0])
                        {
                            case 'search':
                            {
                                $item_title = elgg_echo('interconnected:title:file-type');
                                $description = elgg_echo('interconnected:description:file-type');
                                $tags = array(elgg_echo('interconnected:file-type'), $item_title, $sitename);
                                break;
                            }
                            case 'owner':
                            {
                                if ($owner = get_user_by_username($handler_segments[1]))
                                        $owner_name = $owner->name;
                                else
                                {
                                    $owner_name = elgg_echo('user');
                                }
                                $item_title = elgg_echo('interconnected:owner:title:' . $handler, array($owner_name));
                                $description = elgg_echo('interconnected:owner:description:' . $handler, array($owner_name));
                                break;
                            }
                            case 'friends':
                            {
                                if ($owner = get_user_by_username($handler_segments[1]))
                                        $owner_name = $owner->name;
                                else
                                {
                                    $owner_name = elgg_echo('user');
                                }
                                $item_title = elgg_echo('interconnected:friends:title:' . $handler, array($owner_name));
                                $description = elgg_echo('interconnected:friends:description:' . $handler, array($owner_name));
                                break;
                            }
                            case 'all':
                            default:
                                {
                                    $item_title = elgg_echo('interconnected:rootpage:title:' . $handler);
                                    $description = elgg_echo('interconnected:rootpage:description:'. $handler);
                                    $tags = array(elgg_echo('interconnected:' . $handler), $item_title, $sitename);
                                    break;
                                }
                        }
                        break;
                    }
                case 'photos':
                {
                    switch ($url_array['handler_segments'][0])
                    {
                        case 'all':
                        {
                            $item_title = elgg_echo('interconnected:rootpage:title:albums');
                            $description = elgg_echo('interconnected:rootpage:description:albums');
                            $tags = array(elgg_echo('interconnected:albums'), $item_title, $sitename);

                            break;
                        }
                        case 'owner':
                        {
                            if ($owner = get_user_by_username($handler_segments[1]))
                                $owner_name = $owner->name;
                            elseif ($entity instanceof ElggUser)
                            {
                                $owner_name = $entity->name;
                            }
                            else
                            {
                                $owner_name = elgg_echo('user');
                            }
                            $item_title = elgg_echo('interconnected:owner:title:albums', array($owner_name));
                            $description = elgg_echo('interconnected:owner:description:album', array($owner_name));
                            $tags = array(elgg_echo('interconnected:albums'), $item_title, $sitename);
                            break;
                        }
                        case 'friends':
                        {
                            if ($owner = get_user_by_username($handler_segments[1]))
                                $owner_name = $owner->name;
                            elseif ($entity instanceof ElggUser)
                            {
                                $owner_name = $entity->name;
                            }
                            else
                            {
                                $owner_name = elgg_echo('user');
                            }
                            $item_title = elgg_echo('interconnected:friends:title:albums', array($owner_name));
                            $description = elgg_echo('interconnected:friends:description:album', array($owner_name));
                            $tags = array(elgg_echo('interconnected:albums'), $item_title, $sitename);
                            break;
                        }
                        case 'siteimagesall':
                        {
                            $item_title = elgg_echo('interconnected:rootpage:title:photos');
                            $description = elgg_echo('interconnected:rootpage:description:photos');
                            $tags = array(elgg_echo('interconnected:photos'), $item_title, $sitename);
                            break;
                        }
                        case 'siteimagesowner':
                        {
                            if ($owner = get_user_by_username($handler_segments[1]))
                                $owner_name = $owner->name;
                            elseif ($entity instanceof ElggUser)
                            {
                                $owner_name = $entity->name;
                            }
                            else
                            {
                                $owner_name = elgg_echo('user');
                            }
                            $item_title = elgg_echo('interconnected:owner:title:photos', array($owner_name));
                            $description = elgg_echo('interconnected:owner:description:photos', array($owner_name));
                            $tags = array(elgg_echo('interconnected:photos'), $item_title, $sitename);
                            break;
                        }
                        case 'siteimagesfriends':
                        {
                            if ($owner = get_user_by_username($handler_segments[1]))
                                $owner_name = $owner->name;
                            elseif ($entity instanceof ElggUser)
                            {
                                $owner_name = $entity->name;
                            }
                            else
                            {
                                $owner_name = elgg_echo('user');
                            }
                            $item_title = elgg_echo('interconnected:friends:title:photos', array($owner_name));
                            $description = elgg_echo('interconnected:friends:description:photos', array($owner_name));
                            $tags = array(elgg_echo('interconnected:photos'), $item_title, $sitename);
                            break;
                        }
                    }

                    break;
                }
                case 'about':
                case 'privacy':
                case 'terms':
                {
                    $item_title = elgg_echo('interconnected:title:' . $handler);
                    $description = elgg_echo('interconnected:rootpage:description:'. $handler);
                    $tags = array(elgg_echo('interconnected:' . $handler), $item_title, $sitename);
                    break;
                }
                case 'related':
                {
                    $item_title = elgg_echo('interconnected:title:' . $handler, array($entity->title));
                    $description = elgg_echo('interconnected:description:'. $handler, array($entity->title));
                    break;
                }
                default:
                {
                    $profile_user_entity = get_user_by_username($handler);
                    if ($profile_user_entity) // profile_url plugin is being used so page is a profile
                    {
                        $owner = $profile_user_entity;
                        $icon_url = $owner->getIconURL($size);
                        $full_icon_url = $owner->getIconURL($full_size);
                        $item_title = elgg_echo('interconnected:title:profile', array($owner->name, $sitename));
                        if ($owner->$aboutme)
                            $description = $owner->$aboutme;
                        else
                            $description = elgg_echo('interconnected:description:profile', array($owner->name));
                        $author = $owner->name;
                        $tags = array(elgg_echo('interconnected:profile'),$author,$sitename);
                    }

                    break;
                }
            }

            //error_log ($handler_segments[0]);
            // handle subtype listing pages for groups
            if ($handler_segments[0] == 'group')
            {
                if ($group_container = get_entity($handler_segments[1]))
                    if ($group_container instanceof ElggGroup)
                        $item_title = elgg_echo('group') . ': ' . $group_container->name . ': ' . $item_title;
            }
        }

        if (empty($icon_url)||(strpos($icon_url, '_graphics/icons/default/'))) // if there is no icon found or if the default icon is returned
        {
            if ($container)
            {
                $icon_url = $container->getIconURL($size);
                if ($container instanceof ElggGroup)
                    $full_icon_url = $icon_url;
                else
                    $full_icon_url = $container->getIconURL($full_size);
            }
            else
            {
                $icon_url = $site_logo;
                $full_icon_url = $full_site_logo;
            }
        }

        if ($icon_url)
        {
            $content['icon_url'] = $icon_url;
            $content['full_icon_url'] = $full_icon_url;
        }

        if ($description)
            $content['description'] = $description;
        else
            $content['description'] = $siteinfo;

        if ($item_title)
        {
            $add_title = elgg_get_plugin_setting('add_item_to_title', 'interconnected');
            if ($add_title)
                $item_title = $item_title . $add_title;
            $content['item_title'] = $item_title;
        }
        else
            $content['item_title'] = $default_title;

        if ($subtext)
        {
            $content['subtext'] = $subtext;
        }

        if ($author)
            $content['author'] = $author;
        else
            $content['author'] = $sitename;

        if ($type)
            $content['type'] = $type;
        else
            $content['type'] = 'website';

        $content['keywords'] = $tags;
        $content['url'] = $url;
    }
    return $content;
 }

// removeBookmarkThumbnails - deletes all thumbnails for a bookmark

function removeBookmarkThumbnails($thumbnail, $smallthumb, $mediumthumb, $largethumb, $entity_owner_guid)
 {
    //delete standard thumbnail image
    if ($thumbnail) {
            $delfile = new ElggFile();
            $delfile->owner_guid = $entity_owner_guid;
            $delfile->setFilename($thumbnail);
            $delfile->delete();
    }
    //delete small thumbnail image
    if ($smallthumb) {
            $delfile = new ElggFile();
            $delfile->owner_guid = $entity_owner_guid;
            $delfile->setFilename($smallthumb);
            $delfile->delete();
    }
    //delete medium thumbnail image
    if ($mediumthumb) {
            $delfile = new ElggFile();
            $delfile->owner_guid = $entity_owner_guid;
            $delfile->setFilename($mediumthumb);
            $delfile->delete();
    }
    //delete large thumbnail image
    if ($largethumb) {
            $delfile = new ElggFile();
            $delfile->owner_guid = $entity_owner_guid;
            $delfile->setFilename($largethumb);
            $delfile->delete();
    }
    return true;
}
