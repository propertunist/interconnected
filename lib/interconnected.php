<?php
/**
 * interconnected function library for elgg
 * 
 * @license GNU Public License version 2
 * @author ura soul 
 * @website infiniteeureka.com 
 */

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
        global $CONFIG;
        $site_url = elgg_get_site_url();
        $sitename = $CONFIG->sitename;
        $siteinfo = $CONFIG->sitedescription;
    
      // these variables can be moved to an admin page
    
        $size = 'large';
        $full_size = 'master';     
                      
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
   
        $context = elgg_get_context();
        $url = current_page_url(); 
        $url_array = interconnected_analyze_url($url);
        $handler = $url_array['handler'];
        
        $type = 'website';
        
        if ($url_array['guid']) // if 3rd url path parameter is a numeric
        {
            $entity = get_entity(sanitise_int($url_array['guid'])); // check to see if an entity can be found
        }

      
        if ($entity instanceof ElggEntity) // if an entity is found get entity specific data
        {
            $container = $entity->getContainerEntity();
            $owner = $entity->getOwnerEntity();
            $author = $owner->name;
            $subtype = $entity->getSubtype();
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
            
            if ($entity instanceof ElggGroup) 
            {
                $item_title = elgg_echo('group') . ': ' . $entity->name; 
                  
                $description = $entity->$group_description;
    
                $icon_url = $entity->getIconURL($size);
                $full_icon_url = $icon_url;

            }
            else
            {
                $item_title = $entity->title;
                $access_id = $entity->access_id;
                $access_id_string = get_readable_access_level($access_id);
    
                if (($access_id_string != 'Public')&&($access_id_string != 'public'))
                {
                    $content['access_denied'] = TRUE;
                } 
             
                switch ($subtype)
                {
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
                                $icon_url = $site_url . "blogicon/{$entity->getGUID()}/$size/$icontime.jpg";
                                $full_icon_url = $site_url . "blogicon/{$entity->getGUID()}/$full_size/$icontime.jpg";
                            }
                        }
                        $description = $entity->description;
                        $subtext = elgg_echo('interconnected:' . $subtype) .' ' . $author . '... ';
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
                        }
                        $description = $entity->description;
                        $subtext = elgg_echo('interconnected:' . $subtype) .' ' . $author . '... ';
                        $type = 'article';
                        break;
                    }
                    case 'hjcategory':
                        {
                            $icon_url = $entity->getIconURL($size);
                            $full_icon_url = $entity->getIconURL($full_size);
                            $description = $entity->description;
                            $tags = array(elgg_echo('interconnected:category'), $item_title, $sitename);
                            $item_title = elgg_echo('interconnected:' . $subtype) . ' ' . $item_title;
                            break;
                        }
                    case 'videolist_item':
                    default:
                    {
                        $icon_url = $entity->getIconURL($size);
                        $full_icon_url = $entity->getIconURL($full_size);
                        $description = $entity->description;
                        $subtext = elgg_echo('interconnected:' . $subtype) .' ' . $author . '... ';
                        $type = 'article';
                        break;
                    }
                }  
            }
    
        }
        else // there is no specific entity on the page, then look at contexts next
        {
            if (elgg_is_active_plugin('pagehandler_hijack'))
            {
                $hijack_handlers = pagehandler_hijack_get_replacements();
                $original_handler = array_search($handler, $hijack_handlers);
                if ($original_handler)
                    $handler = $original_handler;
            }
         //   elgg_dump ($handler);
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
                case 'search':
                case 'tags':
                case 'donation':
                case 'liked_content':
                {
                    $item_title = elgg_echo('interconnected:rootpage:title:' . $handler);
                    $description = elgg_echo('interconnected:rootpage:description:' . $handler);    
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
                    $item_title = elgg_echo('interconnected:rootpage:title:' . $handler);
                    $description = elgg_echo('interconnected:rootpage:description:' . $handler);    
                    $tags = array(elgg_echo('interconnected:' . $handler),$sitename);                
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
                        $item_title = elgg_echo('interconnected:title:' . $handler, array($owner->name)); 
                        if ($handler == 'profile')
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
                    if ($url_array['handler_segments'][0] = 'album')
                    {
                        $item_title = elgg_echo('interconnected:rootpage:title:albums');       
                        $description = elgg_echo('interconnected:rootpage:description:albums');
                        $tags = array(elgg_echo('interconnected:albums'), $item_title, $sitename);
                    }
                    else
                    {
                        $item_title = elgg_echo('interconnected:rootpage:title:photos');       
                        $description = elgg_echo('interconnected:rootpage:description:photos');
                        $tags = array(elgg_echo('interconnected:photos'), $item_title, $sitename);
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
                default:
                {
                    $profile_user_entity = get_user_by_username($handler);
                    if ($profile_user_entity) // profile_url plugin is being used so page is a profile
                    {
                        $owner = $profile_user_entity;
                        $icon_url = $owner->getIconURL($size);
                        $full_icon_url = $owner->getIconURL($full_size);
                        $item_title = elgg_echo('interconnected:title:profile', array($owner->name)); 
                        $description = $owner->$aboutme;
                        $author = $owner->name;
                        $tags = array(elgg_echo('interconnected:profile'),$author,$sitename);
                    }
    
                    break;
                }
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
            $content['item_title'] = $item_title;
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
  //  elgg_dump($content);
  //  elgg_dump($url_array);
    return $content;
 }
 
 ?>