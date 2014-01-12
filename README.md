interconnected
==============


This plugin uses various methods to allow users to share elgg items/pages on various social networks. 

- no javascript from external sites is used and the button images are intentionally stored locally so that connections to external servers only occur when shares are intentionally made, rather than on every page load - this is to support privacy and limit the use of social network as spying devices.
- there is no javascript loaded at all by this plugin.

features:

* adds sharing buttons to appropriate locations in elgg - currently adds a sidebar module to appropriate elgg pages and buttons to the bottom of profile info boxes (you can edit start.php to change this).
* passes appropriate images/thumbnails and text to target sites for sharing.
* adds opengraph and standard metatags to each page header to ensure sites that use metatag fields (e.g. <meta property="og:image") for sharing are accessing the correct information (this also improves SEO).
* adds descriptive text and titles to common pages in elgg which otherwise would be non-unique.
* adds profile buttons for social site profiles belonging to profile owner (using profile_manager fields).
* supports common elgg objects such as videolist, tidypics, blogs, pages, bookmarks, files and pinboards etc. (sharing items from pages created by other 3rd party plugins may function correctly or may not - these plugins are not all tested).
* supports site-wide categories and the hypecategories plugin.
* allows twitter tweets to be linked automatically to a twitter handle that is specific for your site (requires admin setting to be configured).
* code is lightweight and does not use external server connections until sharing occurs.
* can be extended to include more target sites - will be made easier in future releases.
* includes a widget for homepage_cms (could be used for other areas of elgg if desired).
* all text is multi-language compatible.
* supports profile manager's custom field features to allow profile/group data, such as 'about me' for profiles, to be shared (requires field names being configured in the admin settings for this plugin).
* allows different sized images to be used when sharing the homepage or other areas of the site which do not have images (large or small version images).
* intelligently chooses images to be used if no icons are available - may use group icon, item container, item owner or site default images.
* supports profile_url plugin.
* uses url sniffing to be view independent - so you can 'theoretically' use the views in this plugin anywhere on an elgg site.
* does not allow non-public items (and unpublished blogs) to be shared since they cannot be seen by recipient sites.
* supports the pagehandler_hijack plugin feature of changing the url path of different parts of the site.
* supports the donation modules.
* if entities are shared from an edit page or non 'view' mode page, the resulting url will point to the 'view' version of the page.

install:

1. deactivate and remove any previous version of the plugin from the mod folder
2. extract the zip file for this plugin and move the extracted files into the mod folder
3. activate the plugin.
4. optional: create profile fields in profile_manager for social profiles. they should be of type 'url'. currently the supported sites are as follows:

* youtube (name the profile field as: youtube)
* google+ (name the profile field as: googleplus)
* twitter (name the profile field as: twitter)
* facebook (name the profile field as: facebook)
* linked in (name the profile field as: linkedin)

n.b. you will need to edit the views/default/page/default.php file to include the opengraph namespace before your pages will fully comply with the opengraph standard. this plugin does not include the change since this file is such a fundamental file of an elgg installation. to make the change yourself you only need to add the following tag inside the <html> tag:  xmlns:og="http://ogp.me/ns#" 
so the full html tag will look like this: <html xmlns="http://www.w3.org/1999/xhtml" xmlns:og="http://ogp.me/ns#" xml:lang="<?php echo $lang; ?>" lang="<?php echo $lang; ?>">

todo:

* could add a settings page for each user to allow them to write their default greeting or signature for messages sent to external sharing services.
* setting option to choose whether to share internal urls for videos/bookmarks or to share source urls. e.g. share youtube videos directly or share elgg page. 
* add more target sites
* integrate wire functionality to allow wire posts to be auto-shared to multiple target sites.
* integrate multi-access functionality to upgrade thewire to allow posts to be made to multiple subsets of users, rather than only to public. 
* auto-share option for new items (requires extension/over-riding of 'add' forms - and/or a hook).
* fix: linked-in does not pick up images when pages are shared.
* better support for groups - (requires re-structuring of functions) 

notes:

* og:author is not included because facebook uses that to point to a facebook profile and if we add data to that field that contains spaces, the facebook validator will error.
* og:image for groups - there are not master icons available for groups in elgg... which results in fb complaining that some group images are too small.
* facebook's sharer page and opengraph code is sometimes glitchy - even when image paths are passed directly to facebook they sometimes do not render - regardless of whether the facebook opengraph debugger throws an error or not.