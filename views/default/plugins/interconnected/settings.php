<div class="plugin-panel">
<?php 
	$site_logo = elgg_get_plugin_setting('site_logo', 'interconnected');
    
    $full_site_logo = elgg_get_plugin_setting('full_site_logo', 'interconnected');
    if (!$full_site_logo) {
        $full_site_logo = $site_logo;
        elgg_set_plugin_setting('full_site_logo',$full_site_logo, 'interconnected');
    }   
    
    $twitter_handle = elgg_get_plugin_setting('twitter_handle', 'interconnected');
    if (!$twitter_handle) {
        $twitter_handle = '';
        elgg_set_plugin_setting('twitter_handle',$twitter_handle, 'interconnected');
    }     
    
    $facebook_handle = elgg_get_plugin_setting('facebook_handle', 'interconnected');
    if (!$facebook_handle) {
        $facebook_handle = '';
        elgg_set_plugin_setting('facebook_handle',$facebook_handle, 'interconnected');
    }      

    $googleplus_handle = elgg_get_plugin_setting('googleplus_handle', 'interconnected');
    if (!$googleplus_handle) {
        $googleplus_handle = '';
        elgg_set_plugin_setting('googleplus_handle',$googleplus_handle, 'interconnected');
    }   

    $youtube_handle = elgg_get_plugin_setting('youtube_handle', 'interconnected');
    if (!$youtube_handle) {
        $youtube_handle = '';
        elgg_set_plugin_setting('youtube_handle',$youtube_handle, 'interconnected');
    }  

    $about_me = elgg_get_plugin_setting('about_me', 'interconnected');
    if (!$about_me) {
        $about_me = 'description';
        elgg_set_plugin_setting('about_me',$about_me, 'interconnected');
    }     
    
    $group_description= elgg_get_plugin_setting('group_description', 'interconnected');
    if (!$group_description) {
        $group_description = 'briefdescription';
        elgg_set_plugin_setting('group_description',$group_description, 'interconnected');
    }    

    $default_title = elgg_get_plugin_setting('default_title', 'interconnected');
    if (!$default_title) {
        $default_title = $CONFIG->sitename;
        elgg_set_plugin_setting('default_title',$default_meta_keywords, 'interconnected');
    } 

    $default_meta_keywords = elgg_get_plugin_setting('default_meta_keywords', 'interconnected');
    if (!$default_meta_keywords) {
        $default_meta_keywords = '';
        elgg_set_plugin_setting('default_meta_keywords',$default_meta_keywords, 'interconnected');
    } 
    
    $max_meta_keywords = elgg_get_plugin_setting('max_meta_keywords', 'interconnected');
    if (!$max_meta_keywords) {
        $max_meta_keywords = 0;
        elgg_set_plugin_setting('max_meta_keywords',$max_meta_keywords, 'interconnected');
    } 
    
    $max_meta_description = elgg_get_plugin_setting('max_meta_description', 'interconnected');
    if (!$max_meta_description) {
        $max_meta_description = 160;
        elgg_set_plugin_setting('max_meta_description',$max_meta_description, 'interconnected');
    } 
    
    $add_item_to_title = elgg_get_plugin_setting('add_item_to_title', 'interconnected');
    if (!$add_item_to_title) {
        $add_item_to_title = '';
        elgg_set_plugin_setting('add_item_to_title',$add_item_to_title, 'interconnected');
    }     
    
    $button_size = elgg_get_plugin_setting('button_size', 'interconnected');
    if (!$button_size) {
        $button_size = 'small';
        elgg_set_plugin_setting('button_size',$button_size, 'interconnected');
    }     
    
    $footer_follow = elgg_get_plugin_setting('footer_follow', 'interconnected');
    if (!$footer_follow) {
        $button_size = false;
        elgg_set_plugin_setting('footer_follow',$footer_follow, 'interconnected');
    }    

    $image_small_w = elgg_get_plugin_setting('image_small_w', 'interconnected');
    if (!$image_small_w) {
        $image_small_w = 150;
        elgg_set_plugin_setting('image_small_w',$image_small_w, 'interconnected');
    }  
    
    $image_small_h = elgg_get_plugin_setting('image_small_h', 'interconnected');
    if (!$image_small_h) {
        $image_small_h = 150;
        elgg_set_plugin_setting('image_small_h',$image_small_h, 'interconnected');
    }              

    $image_medium_w = elgg_get_plugin_setting('image_medium_w', 'interconnected');
    if (!$image_medium_w) {
        $image_medium_w = 250;
        elgg_set_plugin_setting('image_medium_w',$image_medium_w, 'interconnected');
    }  
    
    $image_medium_h = elgg_get_plugin_setting('image_medium_h', 'interconnected');
    if (!$image_medium_h) {
        $image_medium_h = 250;
        elgg_set_plugin_setting('image_medium_h',$image_medium_h, 'interconnected');
    }     
    
    $image_large_w = elgg_get_plugin_setting('image_large_w', 'interconnected');
    if (!$image_large_w) {
        $image_large_w = 400;
        elgg_set_plugin_setting('image_large_w',$image_large_w, 'interconnected');
    }  
    
    $image_large_h = elgg_get_plugin_setting('image_large_h', 'interconnected');
    if (!$image_large_h) {
        $image_large_h = 400;
        elgg_set_plugin_setting('image_large_h',$image_large_h, 'interconnected');
    }     

    $count_shares = elgg_get_plugin_setting('count_shares', 'interconnected');
    if (!$count_shares) {
        $count_shares = 'no';
        elgg_set_plugin_setting('count_shares',$count_shares, 'interconnected');
    }   
    
    $count_share_cache = elgg_get_plugin_setting('count_share_cache', 'interconnected');
    if (!$count_share_cache) {
        $count_share_cache = 1800;
        elgg_set_plugin_setting('count_share_cache',$count_share_cache, 'interconnected');
    }     
    
	echo "<h4>";
	echo elgg_echo('interconnected:admin:title:social');
	echo "</h4><br/>";
	echo '<label>' . elgg_echo('interconnected:admin:site-logo') . ':' . '</label>';
    echo "<br />";
	echo elgg_view('input/text', array('name'=>'params[site_logo]', 'value'=>$site_logo));
	echo "<br /><br/>";
    echo '<label>' . elgg_echo('interconnected:admin:full-site-logo') . ':' . '</label>';
    echo "<br />";    
    echo elgg_view('input/text', array('name'=>'params[full_site_logo]', 'value'=>$full_site_logo));    
    echo "<br /><br/>";
    
    echo '<label>' . elgg_echo('interconnected:admin:twitter-handle') . ':' . '</label>';
    echo "<br />";    
    echo elgg_view('input/text', array('name'=>'params[twitter_handle]', 'value'=>$twitter_handle));        
    echo "<br /><br/>";
    
    echo '<label>' . elgg_echo('interconnected:admin:facebook-handle') . ':' . '</label>';
    echo "<br />";    
    echo elgg_view('input/text', array('name'=>'params[facebook_handle]', 'value'=>$facebook_handle));        
    echo "<br /><br/>";
    
    echo '<label>' . elgg_echo('interconnected:admin:googleplus-handle') . ':' . '</label>';
    echo "<br />";    
    echo elgg_view('input/text', array('name'=>'params[googleplus_handle]', 'value'=>$googleplus_handle));        
    echo "<br /><br/>";
    
    echo '<label>' . elgg_echo('interconnected:admin:youtube-handle') . ':' . '</label>';
    echo "<br />";    
    echo elgg_view('input/text', array('name'=>'params[youtube_handle]', 'value'=>$youtube_handle));        
    echo "<br /><br/>";    
    
    echo '<label>' . elgg_echo('interconnected:admin:about-me') . ':' . '</label>';
    echo "<br />";    
    echo elgg_view('input/text', array('name'=>'params[about_me]', 'value'=>$about_me));  
    echo "<br /><br/>";
    echo '<label>' . elgg_echo('interconnected:admin:group-description') . ':' . '</label>';
    echo "<br />";    
    echo elgg_view('input/text', array('name'=>'params[group_description]', 'value'=>$group_description));  
    echo "<br /><br/>";
    
    echo "<h4>";
    echo elgg_echo('interconnected:admin:title:seo');
    echo "</h4><br/>";
 
    echo '<label>' . elgg_echo('interconnected:admin:default-title') . ':' . '</label>';
    echo "<br />";    
    echo elgg_view('input/text', array('name'=>'params[default_title]', 'value'=>$default_title));  
    echo "<br /><br />"; 
 
    echo '<label>' . elgg_echo('interconnected:admin:add_item_to_title') . ':' . '</label>';
    echo "<br />";    
    echo elgg_view('input/text', array('name'=>'params[add_item_to_title]', 'value'=>$add_item_to_title));  
    echo "<br /><br />"; 
    
    echo '<label>' . elgg_echo('interconnected:admin:default-meta-keywords') . ':' . '</label>';
    echo "<br />";    
    echo elgg_view('input/text', array('name'=>'params[default_meta_keywords]', 'value'=>$default_meta_keywords));  
    echo "<br /><br />";

    echo '<label>' . elgg_echo('interconnected:admin:max-meta-keywords') . ':' . '</label>';
    echo "<br />";    
    echo elgg_view('input/text', array('name'=>'params[max_meta_keywords]', 'value'=>$max_meta_keywords));  
    echo "<br /><br />";
    
    echo '<label>' . elgg_echo('interconnected:admin:max-meta-description') . ':' . '</label>';
    echo "<br />";    
    echo elgg_view('input/text', array('name'=>'params[max_meta_description]', 'value'=>$max_meta_description));  
    echo "<br /><br />";    

    echo '<label>' . elgg_echo('interconnected:admin:footer_follow') . ':' . '</label>';
    echo "<br />";    
    echo elgg_view('input/dropdown', array(
                        'name' => 'params[footer_follow]',
                        'value' => $footer_follow,
                        'options_values' => array(
                                false => elgg_echo('option:no'),
                                true => elgg_echo('option:yes'))));
    echo "<br /><br/>"; 
        
    echo '<label>' . elgg_echo('interconnected:admin:button_size') . ':' . '</label>';
    echo "<br />";    
    echo elgg_view('input/dropdown', array(
                        'name' => 'params[button_size]',
                        'value' => $button_size,
                        'options_values' => array(
                                'small' => elgg_echo('interconnected:admin:option:small'),
                                'large' => elgg_echo('interconnected:admin:option:large'),
                        ),
                ));
    echo "<br /><br/>";
    echo "<h4>";
    echo elgg_echo('interconnected:admin:title:input_data');
    echo "</h4>";                
    echo "<br />";  
    echo '<label>' . elgg_echo('interconnected:admin:thumb_size') . ':' . '</label>';
    echo "<br /><br/>"; 

    echo '<table id="interconnected_thumbs">';
    $sizes = array('small', 'medium','large');
    foreach ($sizes as $size) {
        echo '<tr>';
        echo '<td class="pas">';
        echo elgg_echo("interconnected:admin:{$size}size");
        echo '</td><td>';
        echo 'width: ';
        echo elgg_view('input/text', array(
            'name' => "params[image_{$size}_w]",
            'value' => ${'image_' .$size .'_w'},
            'class' => 'interconnected-input-thin',
        ));
        echo '</td><td>';
        echo 'height: ';
        echo elgg_view('input/text', array(
            'name' => "params[image_{$size}_h]",
            'value' => ${'image_' .$size .'_h'},
            'class' => 'interconnected-input-thin',
        ));
        echo '</td>';
        echo '</tr>';
    }
    echo '</table>';
    echo '<br/>';
    echo "<h4>";
    echo elgg_echo('interconnected:admin:title:share_counts');
    echo "</h4>";                
    echo "<br />";  
    echo '<label>' . elgg_echo('interconnected:admin:share_count_enabled') . ':' . '</label>';
    echo "<br /><br/>";  
    echo elgg_view('input/dropdown', array(
                    'name' => 'params[count_shares]',
                    'value' => $count_shares,
                    'options_values' => array(
                            false => elgg_echo('option:no'),
                            true => elgg_echo('option:yes'))));
    echo "<br /><br/>";  
    echo '<label>' . elgg_echo('interconnected:admin:share_count_cache') . ':' . '</label>';
    echo elgg_view('input/text', array(
            'name' => "params[count_share_cache]",
            'value' => $count_share_cache,
            'class' => 'interconnected-input-thin',
        ));
    echo "<br /><br/>";     
    echo '<h3>'. elgg_echo('admin:upgrades:interconnected_icons').'</h3>';
    echo elgg_view('admin/upgrades/interconnected_icons');
    
?>	
</div>