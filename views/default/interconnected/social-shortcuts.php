<?php
    $owner = elgg_get_page_owner_entity();
    $vars['owner_name'] = $owner->name;
    $social_profiles = array('twitter'=>'twitter.com',
                             'facebook'=>'www.facebook.com',
                             'googleplus'=>'plus.google.com',
                             'youtube'=>'www.youtube.com',
                             'linkedin' => 'www.linkedin.com',
                             'infiniteeureka' => 'www.infiniteeureka.com');

    $i = 0;   
    $title = elgg_echo('interconnected:my-profiles');
    $body = '<div class="elgg-my-profiles">';
    $body .= '<h3>' . $title . '</h3>';                         
    $body .= '<ul class="elgg-social-shortcuts">';
                             
    foreach ($social_profiles as $social_profile => $base_url)
    {
        $vars['profile_url'] = '';
        $vars['target'] = '';
        if (isset($owner->$social_profile))
        {
            $profile_url_array = parse_url(strip_tags(filter_tags($owner->$social_profile)));
            if ($profile_url_array['host'] == $base_url)
            {
                $vars['profile_url'] = $owner->$social_profile;
                $vars['target'] = $social_profile;
                $body .= '<li class="elgg-social-shortcut">' . elgg_view('output/social-shortcut', $vars) . '</li>';
                $i++;
            }
        }
    }
    $body .= '</ul></div>';
    if ($i > 0)
    {
        echo $body;
    }
?>