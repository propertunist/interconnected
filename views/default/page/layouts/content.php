<?php
/**
 * Main content area layout
 *
 * @uses $vars['content']        HTML of main content area
 * @uses $vars['sidebar']        HTML of the sidebar
 * @uses $vars['header']         HTML of the content area header (override)
 * @uses $vars['nav']            HTML of the content area nav (override)
 * @uses $vars['footer']         HTML of the content area footer
 * @uses $vars['filter']         HTML of the content area filter (override)
 * @uses $vars['title']          Title text (override)
 * @uses $vars['context']        Page context (override)
 * @uses $vars['filter_context'] Filter context: everyone, friends, mine
 * @uses $vars['class']          Additional class to apply to layout
 */

$context = elgg_extract('context', $vars, elgg_get_context());

switch ($context)
{
    case 'videolist':
    {
        $vars['microformat'] = 'http://schema.org/VideoObject';
        break;
    }
    case 'blog':
    {
        $vars['microformat'] = 'http://schema.org/BlogPosting';
        break;
    }
    default:
        break;
}

$vars['title'] = elgg_extract('title', $vars, '');
if (!$vars['title'] && $vars['title'] !== false) {
	$vars['title'] = elgg_echo($context);
}

// 1.8 supported 'filter_override'
if (isset($vars['filter_override'])) {
	$vars['filter'] = $vars['filter_override'];
}

// register the default content filters
if (!isset($vars['filter']) && elgg_is_logged_in() && $context) {
	if (elgg_is_active_plugin('river_addon'))
        {
            $tab_order = elgg_get_plugin_setting('tab_order', 'river_addon');
            if ($tab_order == 'friend_order') {
                    $all_priority = 400;
                    $friend_priority = 200;
            } else if ($tab_order == 'mine_order'){
                    $all_priority = 500;
                    $friend_priority = 400;
            } else {
                    $all_priority = 200;
                    $friend_priority = 400;
            }
        }
        else
        {
                $all_priority = 200;
                $friend_priority = 400;
        }
	$username = elgg_get_logged_in_user_entity()->username;
	$filter_context = elgg_extract('filter_context', $vars, 'all');

	// generate a list of default tabs
	$tabs = array(
		'all' => array(
			'text' => elgg_echo('all'),
			'href' => (isset($vars['all_link'])) ? $vars['all_link'] : "$context/all",
			'selected' => ($filter_context == 'all'),
			'priority' => $all_priority,
		),
		'mine' => array(
			'text' => elgg_echo('mine'),
			'href' => (isset($vars['mine_link'])) ? $vars['mine_link'] : "$context/owner/$username",
			'selected' => ($filter_context == 'mine'),
			'priority' => 300,
		),
		'friend' => array(
			'text' => elgg_echo('friends'),
			'href' => (isset($vars['friend_link'])) ? $vars['friend_link'] : "$context/friends/$username",
			'selected' => ($filter_context == 'friends'),
			'priority' => $friend_priority,
		),
	);

	foreach ($tabs as $name => $tab) {
		$tab['name'] = $name;
		elgg_register_menu_item('filter', $tab);
	}
}

$filter = elgg_view('page/layouts/elements/filter', $vars);
$vars['content'] = $filter . $vars['content'];

$context = elgg_get_context();

if (elgg_is_active_plugin('river_addon'))
{
    $plugin = elgg_get_plugin_from_id('river_addon');
    $selected = $plugin->three_column_context;
    $selected = explode(",", $selected);
}

if ((is_array($selected)) &&(in_array($context, $selected))) {
	echo elgg_view_layout('two_sidebar', $vars);
} else {
	echo elgg_view_layout('one_sidebar', $vars);
}
