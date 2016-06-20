<?php

    $INTERCONNECTED_PAGE_DATA = get_sharing_data_for_current_page();
    $sitename = elgg_get_config('sitename');
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
    $canonical_url = $url;
    $keywords = $INTERCONNECTED_PAGE_DATA['keywords'];
    $og_type = $INTERCONNECTED_PAGE_DATA['type'];
    $robots = $INTERCONNECTED_PAGE_DATA['robots'];
 //elgg_dump($robots);
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
        $description = htmlspecialchars(str_replace(array("\r", "\n"), '', $description));
        $description = htmlspecialchars_decode($description);
    }
    if ($item_title)
    {
        $item_title = html_entity_decode ($item_title, ENT_QUOTES);
        $item_title = strip_tags(filter_tags($item_title));
        $item_title = htmlspecialchars(str_replace(array("\r", "\n"), '', $item_title));
        $item_title = htmlspecialchars_decode($item_title);
    }
    
    if ($subtext)
    {
        $subtext = strip_tags(filter_tags($subtext));
        $subtext = htmlspecialchars(str_replace(array("\r", "\n"), '', $subtext));
        $subtext = htmlspecialchars_decode($subtext);
    }
    
    if ($author)
    {
        $author = htmlspecialchars(strip_tags(filter_tags($author)));
        $author = htmlspecialchars_decode($author);
    }

    $vars['url'] = $url;
    
    if ($keywords)
    {
        foreach ($keywords as $index => $keyword)
        {
            $keywords[$index] = htmlspecialchars(strip_tags(filter_tags($keyword)));
            $keywords[$index] = htmlspecialchars_decode($keywords[$index]);
        }
    }
    
    if (!$robots)
        $robots = 'index,follow';

?>
<title><?php echo $item_title; ?></title> 
<?php
if($description) { ?>  
<meta name="description" property="og:description" content="<?php echo substr($description, 0, $max_meta_description); ?>" />
<?php } ?>
<meta name="author" content="<?php echo $author;?>" />
<meta property="og:site_name" content="<?php echo $sitename; ?>" />
<meta property="og:type" content="<?php echo $og_type; ?>" />
<meta property="og:title" content="<?php echo $item_title; ?>" />
<meta property="og:url" content="<?php echo $url; ?>" />
<meta property="og:image" content="<?php echo $icon_url; ?>" />
<meta property="og:image:secure_url" content="<?php echo $icon_url; ?>" />
<meta name="robots" content="<?php echo $robots; ?>"/>
<?php
if ($max_meta_keywords > 0) 
{ ?>
<meta name="keywords" content="<?php 
for ($i = 0; (($i <= $max_meta_keywords)&&(count($keywords) >= $i)); $i++)
{
    echo $keywords[$i];
    if (($i+1) < count($keywords))
        echo ','; 
}
?>" />
<link rel="image_src" href="<?php echo $icon_url; ?>"/>
<link rel="canonical" href="<?php echo $canonical_url; ?>"/>
<?php }