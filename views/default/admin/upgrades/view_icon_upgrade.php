<?php

$count = $vars['count'];
$action = $vars['action'];
echo '<br/>';
echo elgg_echo('admin:interconnected:total_count', array($count)) ;
echo '<br/>';
$action_link = elgg_view('output/url', array(
	'text' => elgg_echo('upgrade'),
	'href' => $action,
	'class' => 'elgg-button elgg-button-action mtl',
	'is_action' => true,
	'id' => 'upgrade-run',
));

echo $action_link;