<?php
/**
 * New bookmarks river entry
 *
 * @package Bookmarks
 */

$object = $vars['item']->getObjectEntity();
$excerpt = elgg_get_excerpt($object->description);

$thumbnail =  elgg_view('icon/object/bookmark', array(
    'entity' => $object,
    'size' => 'large',
));
//echo '<pre>';
//var_dump($thumbnail);
//echo '</pre>';

if ($thumbnail)
    $message = '<div class="elgg-river-thumb">' . $thumbnail . '</div>' . $excerpt;
else
    $message = $excerpt;

echo elgg_view('river/elements/layout', array(
	'item' => $vars['item'],
	'message' => $message,
	'attachments' => elgg_view('output/url', array('href' => $object->address, 'text' => elgg_get_excerpt($object->address, 120)))));