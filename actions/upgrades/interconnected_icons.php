<?php
//require_once(elgg_get_plugins_path() . 'interconnected/lib/interconnected.php');
// from engine/start.php
error_log('interconnected icon upgrade: start action');
global $START_MICROTIME;
$batch_run_time_in_secs = 5;
if ($status = get_input("upgrade_completed")) {
    error_log($status);
}

if (get_input("upgrade_completed")) {
	// set the upgrade as completed
	$factory = new ElggUpgrade();
	$upgrade = $factory->getUpgradeFromPath("admin/upgrades/interconnected_icons");
	if ($upgrade instanceof ElggUpgrade) {
		$upgrade->setCompleted();
	}

	return true;
}

// Offset is the total amount of errors so far. We skip these
// annotations to prevent them from possibly repeating the same error.
$offset = (int) get_input("offset", 0);
$limit = 5;
error_log('OFFSET = ' . $offset);
$access_status = access_get_show_hidden_status();
access_show_hidden_entities(true);

// don"t want any event or plugin hook handlers from plugins to run
$original_events = _elgg_services()->events;
$original_hooks = _elgg_services()->hooks;
//_elgg_services()->events = new Elgg_EventsService();
//_elgg_services()->hooks = new Elgg_PluginHooksService();

elgg_register_plugin_hook_handler("permissions_check", "all", "elgg_override_permissions");
elgg_register_plugin_hook_handler("container_permissions_check", "all", "elgg_override_permissions");
_elgg_services()->db->disableQueryCache();

$success_count = 0;
$error_count = 0;
$warning_count = 0;

while ((microtime(true) - $START_MICROTIME) < $batch_run_time_in_secs) 
{
    $options["count"] = false;
    $options["offset"] = $offset;
    $options["limit"] = $limit;
    $options["type"] = 'object';
    $options["subtype"] = 'bookmarks';
    $options["order_by"] = 'e.time_created asc';
    error_log('interconnected icon upgrade: before processing loop');
    $bookmarks = elgg_get_entities($options);
    foreach ($bookmarks as $bookmark) 
    {
        error_log('interconnected icon upgrade: entity = ' . $bookmark->guid);
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
}

access_show_hidden_entities($access_status);

// replace events and hooks
//_elgg_services()->events = $original_events;
//_elgg_services()->hooks = $original_hooks;
_elgg_services()->db->enableQueryCache();

// Give some feedback for the UI
echo json_encode(array(
	"numSuccess" => $success_count,
        "numWarnings" => $warning_count,
	"numErrors" => $error_count
));
