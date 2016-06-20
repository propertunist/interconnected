<?php

/**
 * Override the default entity icon for videoslist items
 *
 * @param string $hook
 * @param string $type
 * @param string $returnvalue
 * @param array $params
 * @return string Relative URL
 */
function interconnected_bookmark_icon_url_override($hook, $type, $returnvalue, $params) {

    // if someone already set this, quit
    if ($return_value) {
        return null;
    }

    $entity = $params['entity'];
    $size = $params['size'];
    
    if ((!elgg_instanceof($entity, 'object', 'bookmarks'))&&((!elgg_instanceof($entity, 'user'))&&($params['size'] != 'temp'))) {
        return null;
    }

    // tiny thumbnails are too small to be useful, so give a generic video icon
    try {
        if (($size != 'tiny' && isset($entity->thumbnail))||(($size == 'temp' && isset($entity->temp_bookmark_thumb)))) {
         //   $owner = $entity->getOwnerEntity();
          //  $owner_guid = $owner->getGUID();
           // $join_date = $owner->getTimeCreated();
            
            return "mod/interconnected/pages/bookmarks/thumbnail.php?guid={$entity->guid}&amp;size=$size";
        }
        elseif (($size == 'small')&&(!$entity->thumbnail))
        {
            // if no small thumbnail then return owner icon instead (for related items)
            $owner = get_entity($entity->owner_guid);
            return $owner->geticonURL($size);
        }
    } catch (InvalidParameterException $e) {
        elgg_log("Unable to get bookmark icon for bookmark with GUID {$entity->guid}", 'ERROR');
        //return "mod/interconnected/graphics/bookmark_icon_{$size}.png";
     //   return "empty";
        return false;
    }
 //   if (in_array($size, array('small', 'medium', 'large'))){
        //return "mod/interconnected/graphics/bookmark_icon_{$size}.png";
        //return "empty";
    //W    return false;
   // }
    return null;
}
