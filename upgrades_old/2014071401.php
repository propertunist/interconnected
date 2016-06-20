<?php
/**
 * refresh the bookmark thumbnails from the host site
 * First determine if the upgrade is needed and then if needed, batch the update
 */

  
$items = elgg_get_entities(array(
	'type' => 'object',
	'subtype' => 'bookmarks',
	'limit' => 5,
	'order_by' => 'e.time_created asc',
));

// if not items, no upgrade required
if (!$items) {
	return;
}


/**
 * Downloads the thumbnail and saves into data folder
 *
 * @param ElggObject $item
 * @return bool
 */
function interconnected_2014071401($item) {
	require_once(elgg_get_plugins_path() . 'upgrade-tools/lib/upgrade_tools.php');
    require_once(elgg_get_plugins_path() . 'interconnected/lib/interconnected.php');
       
    static $item_counter = 0; 
    static $items_upgraded = 0;
    static $items_not_upgraded = 0;
    $item_counter = $item_counter +1;
    error_log("Elgg bookmark thumbs upgrade (2014071401): " . $item_counter . ". id = " . $item->guid);
    if (!$item->iconcheck)
    {
        $result = interconnected_update_thumbnail($item);
        if ($result == TRUE) {
            $items_upgraded = $items_upgraded + 1;
            error_log("Elgg bookmark thumbs upgrade (2014071401): item: " . $item->getGUID() . " was upgraded; " );
            error_log($items_upgraded . " items upgraded; " . $items_not_upgraded . " have been skipped, since were already upgraded"); 
            return true;
        }
        else
        {
            $items_not_upgraded = $items_not_upgraded + 1;
            error_log("Elgg bookmark thumbs upgrade (2014071401): file could not be retrieveḑ - item: " . $item->getGUID() . " was not upgraded; " );
            error_log($items_upgraded . " items upgraded; " . $items_not_upgraded . " have been skipped"); 
            return false;
        }
    }
    else
    {
        error_log("Elgg bookmark thumbs upgrade (2014071401): id is already upgraded:" . $item->guid . ' - iconcheck = ' . date(DATE_RSS,$item->iconcheck));
        $items_not_upgraded = $items_not_upgraded + 1;
        error_log($items_upgraded . " items upgraded; " . $items_not_upgraded . " have been skipped"); 
        return false;
    }

}

$dbprefix = elgg_get_config("dbprefix");
$previous_access = elgg_set_ignore_access(true);
$options = array(
	'type' => 'object',
	'subtype' => 'bookmarks',
//	'guids' => array (4391,),
	'limit' => 0,
);
//$options['wheres'][] = "NOT EXISTS ( SELECT 1 FROM {$dbprefix}metadata md WHERE md.entity_guid = e.guid AND md.name_id = 'iconcheck')";

$c_options = array(
    'type' => 'object',
    'subtype' => 'bookmarks',
    'limit' => 0,
    'count' => TRUE
);
//$c_options['wheres'][] = "NOT EXISTS ( SELECT 1 FROM {$dbprefix}metadata md WHERE md.entity_guid = e.guid AND md.name_id = 'iconcheck')";

$item_count = elgg_get_entities_from_metadata ($c_options);

error_log("Elgg bookmark thumbs upgrade (2014071401): begin batch - total items = " . $item_count . '; start time = ' . date(DATE_RSS,time()));

$batch = new ElggBatch('elgg_get_entities_from_metadata', $options, 'interconnected_2014071401', 5);
elgg_set_ignore_access($previous_access);

if ($batch->callbackResult) {
	error_log("Elgg bookmark thumbs upgrade (2014071401) succeeded");
} else {
	error_log("Elgg bookmark thumbs upgrade (2014071401) failed");
}

error_log("Elgg bookmark thumbs upgrade (2014071401): end batch; end time = " . date(DATE_RSS,time()));