<?php
/**
 * All event handler functions are bundled in this file
 */

/**
 * Listen to the upgrade event to make sure upgrades can be run
 *
 * @param string $event  the name of the event
 * @param string $type   the type of the event
 * @param null   $object nothing
 *
 * @return void
 */
function interconnected_upgrade_system_event_handler($event, $type, $object) {
	//error_log('interconnected upgrade event');
	// Upgrade also possible hidden entities. This feature get run
	// by an administrator so there's no need to ignore access.
	$access_status = access_get_show_hidden_status();
	access_show_hidden_entities(true);
	
	// register an upgrade script

        $path = "admin/upgrades/interconnected_icons";
        $upgrade = new ElggUpgrade();
        if (!$upgrade->getUpgradeFromPath($path)) {
                $upgrade->setPath($path);
                $upgrade->title = "interconnected bookmark icons upgrade";
                $upgrade->description = "interconnected adds support for bookmark icons. run this script to make sure icons are generated for existing bookmarks.";

                $upgrade->save();
        }
	
	
	access_show_hidden_entities($access_status);
}


function interconnected_icon_upgrade($bookmark)
{
    error_log('interconnected icon upgrade: entity = ' . $bookmark->guid);
    error_log('error count = ' . $error_count);
    $item_counter++;
    $result = interconnected_update_thumbnail($bookmark);
    if ($result == TRUE) {
        $success_count++;
    }
    elseif ($result == 'no_image')
    {
        $warning_count++;
    }
    elseif ($result == 'error')
    {
        $error_count++;
    }
}
