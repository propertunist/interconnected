<?php
/**
 * Edit / add a bookmark
 *
 * @package Bookmarks
 */

elgg_require_js('interconnected');
// once elgg_view stops throwing all sorts of junk into $vars, we can use extract()
$entity = elgg_extract('entity', $vars, null);
$title = elgg_extract('title', $vars, '');
$desc = elgg_extract('description', $vars, '');
$address = elgg_extract('address', $vars, '');
$tags = elgg_extract('tags', $vars, '');
$site_path = elgg_get_site_url();

if (!elgg_is_active_plugin('containers'))
    $container_guid = elgg_extract('container_guid', $vars);
$access_id = elgg_extract('access_id', $vars, ACCESS_DEFAULT);
$guid = elgg_extract('guid', $vars, null);
$shares = elgg_extract('shares', $vars, array());
if ($entity)
    $thumbnail = $entity->getIconURL('medium');
if ($thumbnail)
    $visible = 'initial';
else
{
    $visible = 'none';
    $thumbnail = $site_path . '_graphics/icons/default/medium.png';
}

?>
<div>
	<label><?php echo elgg_echo('title'); ?></label><br />
	<?php echo elgg_view('input/text', array('name' => 'title', 'value' => $title, 'id' => 'bookmark-title')); ?>
</div>
<div>
	<label><?php echo elgg_echo('bookmarks:address'); ?></label><br />
	<?php echo elgg_view('input/text', array('name' => 'address', 'value' => $address, 'id' => 'bookmark-address')); ?>
</div>
<div>
    <label><?php echo elgg_echo('bookmarks:icon'); ?></label><br />
    <div id="bookmark-thumbnail-loader-wrapper">
        <div id="bookmark-thumbnail-loader" class="elgg-ajax-loader"></div>
    </div>
    <?php $options = array('src' => $thumbnail, 'title' => $title, 'id'=> 'bookmark-thumb-icon', 'style' => 'display:'. $visible . ';');
          //  $options = array('src' => $thumbnail, 'title' => $title, 'id'=> 'bookmark-thumb-icon');
          if ($thumb_width > 0)
            $options ['width'] = $thumb_width;
          if ($thumb_height > 0)            
            $options ['height'] = $thumb_height;
          echo elgg_view('output/img', $options); 
          echo '<span class="elgg-refresh-button" onclick="refreshthumb();return false;" style="display:'. $visible . ';" title="' . elgg_echo('interconnected:refresh_thumb') . '">' . elgg_view_icon('refresh') . "</span>";
        ?>
</div>
<div>
	<label><?php echo elgg_echo('description'); ?></label>
	<?php echo elgg_view('input/longtext', array('name' => 'description', 'value' => $desc, 'id' => 'bookmark-desc')); ?>
</div>
<div>
	<label><?php echo elgg_echo('tags'); ?></label>
	<?php echo elgg_view('input/tags', array('name' => 'tags', 'value' => $tags)); ?>
</div>

<div>
	<label><?php echo elgg_echo('access'); ?></label><br />
	<?php echo elgg_view('input/access', array('name' => 'access_id', 'value' => $access_id)); ?>
</div>
<?php

if (elgg_is_active_plugin('containers'))
{
    $containers =  elgg_view('input/containers', $vars);
    if ($containers){
        echo $containers;
    }
}
else
{
    echo elgg_view('input/hidden', array('name' => 'container_guid', 'value' => $container_guid));
}

$categories = elgg_view('input/categories', $vars);
if ($categories) {
	echo $categories;
}
?>
<div class="elgg-foot">
<?php

if ($guid) {
	echo elgg_view('input/hidden', array('name' => 'guid', 'value' => $guid, 'id' => "guid"));
}

echo elgg_view('input/submit', array('value' => elgg_echo("save")));

?>
</div>