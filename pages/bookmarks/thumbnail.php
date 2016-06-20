<?php
/**
 * Elgg bookmark icon cache/bypass
 *
 *
 * @package interconnected
 */
 require_once dirname(dirname(dirname(dirname(__DIR__)))) . '/vendor/autoload.php';
 \Elgg\Application::start();

// Get GUID
$guid = (int) get_input('guid', 0);
//error_log('guid = ' . $guid);
// Get thumbnail size
$size = get_input('size', 'small');
//error_log('size = ' . $size);
$entity = get_entity($guid);

if (!elgg_instanceof($entity)) {
    error_log('interconnected bookmark thumbnail: entity does not exist');
    exit;
}

if (elgg_instanceof($entity, 'object', 'bookmarks'))
{
        // Get thumbnail
        switch ($size) {
            case "master":
                    $thumbfile = $entity->thumbnail;
                    break;
            case "small":
                    $thumbfile = $entity->smallthumb;
                    break;
            case "medium":
                    $thumbfile = $entity->mediumthumb;
                    break;
            case "large":
            default:
                    $thumbfile = $entity->largethumb;
                    break;
        }

        // Grab the file
        if ($thumbfile && !empty($thumbfile))
        {
                $readfile = new ElggFile();
                $readfile->owner_guid = $entity->owner_guid;
                $readfile->setFilename($thumbfile);
                $contents = $readfile->grabFile();
        }
     //   else
       //     forward("mod/interconnected/graphics/bookmark_icon_{$size}.png");
}
else
{

        // check if entity is a user
        if (elgg_instanceof($entity, 'user'))
        {
                $thumbfile = $entity->temp_bookmark_thumb;
                if ($thumbfile && !empty($thumbfile))
                {
                        $readfile = new ElggFile();
                        $readfile->owner_guid = $entity->guid;
                        $readfile->setFilename($thumbfile);
                        $contents = $readfile->grabFile();
                }
           //     else
             //       forward("mod/interconnected/graphics/bookmark_icon_{$size}.png");
        }
}

if ($contents)
{
        // caching images for 10 days
        header("Content-type: image/jpeg");
        header('Expires: ' . gmdate('D, d M Y H:i:s \G\M\T', strtotime("+10 days")), true);
        header("Pragma: public", true);
        header("Cache-Control: public", true);
        header("Content-Length: " . strlen($contents));

        echo $contents;
        exit;
}
//else
  //      forward("mod/interconnected/graphics/bookmark_icon_{$size}.png");
