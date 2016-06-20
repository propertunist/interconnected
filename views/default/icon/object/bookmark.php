<?php
/**
 * bookmark icon view.
 *
 * @package Elgg
 * @subpackage Core
 *
 * @uses $vars['entity'] The entity the icon represents - uses getIconURL() method
 * @uses $vars['size']   topbar, tiny, small, medium (default), large, master
 * @uses $vars['href']   Optional override for link
 */

$entity = $vars['entity'];
/* @var ElggObject $entity */

$sizes = array('small', 'medium', 'large', 'master');
//$img_width = array('small' => 75, 'medium' => 150, 'large' => 400);
//$img_height = array('small' => 75, 'medium' => 150, 'large' => 400);
// Get size
if (!in_array($vars['size'], $sizes)) {
	$size = "medium";
} else {
	$size = $vars['size'];
}

if (isset($entity->name)) {
	$title = $entity->name;
} else {
	$title = $entity->title;
}

$url = $entity->getURL();
if (isset($vars['href'])) {
	$url = $vars['href'];
}
if ($entity->thumbnail)
$img_src = $entity->getIconURL($vars['size']);

if ($entity->thumbnail)
{
    //$img = "<img src=\"$img_src\" class=\"elgg-bookmark-icon\" alt=\"$title\" width=\"{$img_width[$size]}\" height=\"{$img_height[$size]}\"/>";
    //$img = "<img src=\"$img_src\" class=\"elgg-bookmark-icon\" alt=\"$title\" width=\"100%\"/>";
    $view_vars['src'] = $img_src;
    $view_vars['class'] = 'elgg-bookmark-icon';
    $view_vars['alt'] = $title;
    $sizes = interconnected_get_image_dimensions_from_entity($entity, $vars['size']);
    $view_vars['width'] = $sizes[0];
    $view_vars['height'] = $sizes[1];
    $img = elgg_view('output/img', $view_vars);

    if ($img) {
    	echo elgg_view('output/url', array(
    		'href' => $url,
    		'text' => $img,
                'is_trusted' => TRUE,
    	));
    } else {
    	echo $img;
    }
}
