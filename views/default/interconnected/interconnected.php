<?php
/*************************
 * elgg plugin - simply sharing
 * view: creates sharing buttons for social sites
 * notes: image and description for facebook is taken from metatags - so if these are not set in the page header specifically then they will not be shared.
 * process: entity guid is grabbed from the current url if possible. if no guid is available/found then the page context will be used to locate the data to use to populate the sharing fields for the recipient social network. images are used where possible - blog_tools is supported for blog images. videolist currently only supports medium sized icons.
 *
 *************************/

$INTERCONNECTED_PAGE_DATA = get_sharing_data_for_current_page();

$social_sites = array(
                        'reddit',
                        'voat',
                        'diaspora',
                        'twitter',
                        'googleplus',
                        'facebook',
                        'linkedin',
                        'pinterest',
                        'stumbleupon',
                        'email');

$item_title = elgg_get_excerpt($INTERCONNECTED_PAGE_DATA['item_title'],250);
$subtext = elgg_get_excerpt($INTERCONNECTED_PAGE_DATA['subtext'],250);
$description = elgg_get_excerpt($INTERCONNECTED_PAGE_DATA['description'],250);
$icon_url = $INTERCONNECTED_PAGE_DATA['icon_url'];
$full_icon_url = $INTERCONNECTED_PAGE_DATA['full_icon_url'];
$url = $INTERCONNECTED_PAGE_DATA['url'];
$twitter_handle = $INTERCONNECTED_PAGE_DATA['twitter_handle'];
$button_size = $INTERCONNECTED_PAGE_DATA['button_size'];
$count_data = $INTERCONNECTED_PAGE_DATA['count_data'];
$handler = $INTERCONNECTED_PAGE_DATA['handler'];
$subtype = $INTERCONNECTED_PAGE_DATA['subtype'];
// clean fields ready for html output

if ($icon_url)
{
    $icon_url = htmlspecialchars(html_entity_decode(strip_tags(filter_tags($icon_url)), ENT_QUOTES, 'UTF-8'), ENT_QUOTES, 'UTF-8');
    $full_icon_url = htmlspecialchars(urlencode(html_entity_decode(strip_tags(filter_tags($full_icon_url)), ENT_QUOTES, 'UTF-8')), ENT_QUOTES, 'UTF-8');
}

if ($description)
{
    $description = htmlspecialchars(html_entity_decode(strip_tags (filter_tags($description)), ENT_QUOTES, 'UTF-8'), ENT_QUOTES, 'UTF-8');
    $description = str_replace(array("\r", "\n"), '', $description);
}
if ($item_title)
{
    $item_title = htmlspecialchars(html_entity_decode(strip_tags(filter_tags($item_title)), ENT_QUOTES, 'UTF-8'), ENT_QUOTES, 'UTF-8');
    $item_title = str_replace(array("\r", "\n"), '', $item_title);
}

if ($subtext)
{
    $subtext = htmlspecialchars(html_entity_decode(strip_tags(filter_tags($subtext)), ENT_QUOTES, 'UTF-8'), ENT_QUOTES, 'UTF-8');
    $subtext = str_replace(array("\r", "\n"), '', $subtext);
}

// build buttons

$options = array('url' => $url,
                 'twitter_handle' => $twitter_handle,
                 'item_title' => $item_title,
                 'subtext' => $subtext,
                 'description' => $description,
                 'button_size' => $button_size,
                 'counts' => $count_data,
                 );
$remove_url_params = TRUE;

elgg_require_js('interconnected/get_shares');

$body = '<ul class="elgg-sharing-wrapper">';
foreach ($social_sites as $social_site)
{
    $options['social_site'] = $social_site;
    switch ($social_site)
    {
        case 'pinterest':
            {
                $options['icon_url'] = $full_icon_url;
                break;
            }
        case 'email':
            {
                // keep full url params for email links since there will never be share count data to retrieve for emails and so the uniqueness of the url is irrelevant
                $remove_url_params = FALSE;
                break;
            }
        default:
            {
                $options['icon_url'] = $icon_url;
                break;
            }
    }

    // specify site section that will keep the full url params
    switch ($handler)
    {
        case 'search':
        {
            $remove_url_params = FALSE;
            break;
        }
        default:
        {
            break;
        }
    }

    if ($remove_url_params == TRUE)
    {
            $parsed_url = parse_url($url);
            $options['url'] = $parsed_url['scheme'] . '://' . $parsed_url['host'] . $parsed_url['path'];
    }
    else
    {
            $options['url'] = $url;
    }

    $body .= '<li>';
    $body .= elgg_view('social-sites/share-to/' . $social_site, $options);
    $body .= '</li>';
}
$body.= '</ul>';

echo $body;
return TRUE;
