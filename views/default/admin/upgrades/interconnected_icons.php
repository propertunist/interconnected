<?php

// Upgrade also possible hidden entities. This feature get run
// by an administrator so there's no need to ignore access.
$access_status = access_get_show_hidden_status();
access_show_hidden_entities(true);

$options = array(
	"type" => "object",
        "subtype" => 'bookmarks',
	"count" => true
);
$count = elgg_get_entities($options);

echo elgg_view("admin/upgrades/view", array(
    	"count" => $count,
	"action" => "action/interconnected/interconnected_icons",
));

access_show_hidden_entities($access_status);