<?php

    $INTERCONNECTED_PAGE_DATA = get_sharing_data_for_current_page();
    $sitename = $CONFIG->sitename;

    $default_site_logo = elgg_get_plugin_setting('site_logo', 'interconnected');
    
    $default_meta_keywords = elgg_get_plugin_setting('default_meta_keywords', 'interconnected');
    if ($default_meta_keywords)
        $default_meta_keywords = explode(',',$default_meta_keywords);

    if (count($INTERCONNECTED_PAGE_DATA['keywords']) <= 0)
        $INTERCONNECTED_PAGE_DATA['keywords'] = $default_meta_keywords;

    $max_meta_keywords = (elgg_get_plugin_setting('max_meta_keywords', 'interconnected')-1);

    $max_meta_description = elgg_get_plugin_setting('max_meta_description', 'interconnected');

    $author = $INTERCONNECTED_PAGE_DATA['author'];
    $item_title = $INTERCONNECTED_PAGE_DATA['item_title'];
    $subtext = $INTERCONNECTED_PAGE_DATA['subtext'];
    $description = $INTERCONNECTED_PAGE_DATA['description'];
    $icon_url = $INTERCONNECTED_PAGE_DATA['icon_url'];
    $full_icon_url = $INTERCONNECTED_PAGE_DATA['full_icon_url'];
    $url = $INTERCONNECTED_PAGE_DATA['url'];
    $keywords = $INTERCONNECTED_PAGE_DATA['keywords'];
    $og_type = $INTERCONNECTED_PAGE_DATA['type'];
 
    if (!is_array($keywords))
        $keywords = $default_meta_keywords;
 
    // clean fields ready for html output

    if ($icon_url)
    {
        $icon_url = strip_tags(filter_tags($icon_url));
        $full_icon_url = strip_tags(filter_tags($full_icon_url));
    }

    if ($description)
    {
        $description = strip_tags (filter_tags($description));
        $description = str_replace(array("\r", "\n"), '', $description);
    }

    if ($item_title)
    {
        $item_title = strip_tags(filter_tags($item_title));
        $item_title = str_replace(array("\r", "\n"), '', $item_title);
    }
    
    if ($subtext)
    {
        $subtext = strip_tags(filter_tags($subtext));
        $subtext = str_replace(array("\r", "\n"), '', $subtext);
    }
    
    if ($author)
    {
        $author = strip_tags(filter_tags($author));
    }

    $vars['url'] = $url;
    
    if (isset($keywords))
    {
        foreach ($keywords as $index => $keyword)
        {
            $keywords[$index] = strip_tags(filter_tags($keyword));
        }
    }

   // $size = getimagesize($icon_url);

 
if($description) { ?>  
<meta name="description" property="og:description" content="<?php echo substr($description, 0, $max_meta_description); ?>" />
<?php } ?>
<meta name="author" content="<?php echo $author;?>" />
<meta property="og:site_name" content="<?php echo $sitename; ?>" />
<meta property="og:type" content="<?php echo $og_type; ?>" />
<meta property="og:title" content="<?php echo $item_title; ?>" />
<meta property="og:url" content="<?php echo $url; ?>" />
<meta property="og:image" content="<?php echo $icon_url; ?>" />
<meta property="og:image:type" content="<?php echo $size['mime']; ?>" />
<meta property="og:image:width" content="<?php echo $size[0]; ?>" />
<meta property="og:image:height" content="<?php echo $size[1]; ?>" />
<meta property="og:image:secure_url" content="<?php echo $icon_url; ?>" />
<meta property="og:image:type" content="<?php echo $size['mime']; ?>" />
<meta property="og:image:width" content="<?php echo $size[0]; ?>" />
<meta property="og:image:height" content="<?php echo $size[1]; ?>" />

<?php if ($max_meta_keywords > 0) 
{ ?>
<meta name="keywords" content="<?php 
for ($i = 0; (($i <= $max_meta_keywords)&&(count($keywords) >= $i)); $i++)
{
    echo $keywords[$i];
    if (($i+1) < count($keywords))
        echo ','; 
}
?>" />
<?php } ?>