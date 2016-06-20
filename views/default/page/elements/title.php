<?php
/**
 * Elgg title element
 *
 * @uses $vars['title'] The page title
 * @uses $vars['class'] Optional class for heading
 */

if (!isset($vars['title'])) {
	return;
}

$class= '';
if (isset($vars['class'])) {
	$class = " class=\"{$vars['class']}\"";
}
$context = elgg_get_context();
//elgg_dump(elgg_get_context_stack());
$icon = get_icon_for_title($context);

if (isset($vars['microformat']))
{
    switch($context)
    {
        case 'blog':
        {
            $microformat_itemprop = '<span itemprop="headline">';
            break;
        }          
        default:
        case 'videolist':
        {
            $microformat_itemprop = '<span itemprop="name">';
            break;
        }
    }
    echo '<h1' . $class . '>' . $icon . $microformat_itemprop .  $vars['title'] . '</span></h1>';
}
else
    echo '<h1' . $class . '>' . $icon . $vars['title'] . '</h1>';