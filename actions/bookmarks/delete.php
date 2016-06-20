<?php
/**
 * Delete a bookmark
 *
 * @package Bookmarks
 */

$guid = get_input('guid');
$bookmark = get_entity($guid);
//error_log('my delete bookmark action');
if (elgg_instanceof($bookmark, 'object', 'bookmarks') && $bookmark->canEdit()) {
	$container = $bookmark->getContainerEntity();
        $thumbnail = $bookmark->thumbnail;
        $smallthumbnail = $bookmark->smallthumb;
        $mediumthumbnail = $bookmark->mediumthumb;
        $largethumbnail = $bookmark->largethumb;
        $bookmark_owner_guid = $bookmark->getOwnerGUID();
	if ($bookmark->delete()) {
                $result = removeBookmarkThumbnails($thumbnail, $smallthumbnail, $mediumthumbnail, $largethumbnail, $bookmark_owner_guid);
		system_message(elgg_echo("bookmarks:delete:success"));
		if (elgg_instanceof($container, 'group')) {
			forward("bookmarks/group/$container->guid/all");
		} else {
			forward("bookmarks/owner/$container->username");
		}
	}
}

register_error(elgg_echo("bookmarks:delete:failed"));
forward(REFERER);
