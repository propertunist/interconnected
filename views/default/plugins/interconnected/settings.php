<div class="plugin-panel">
<?php 
	$site_logo = elgg_get_plugin_setting('site_logo', 'interconnected');
    
    $full_site_logo = elgg_get_plugin_setting('full_site_logo', 'interconnected');
    if (!$full_site_logo) {
        $full_site_logo = $site_logo;
        elgg_set_plugin_setting('full_site_logo',$full_site_logo);
    }   
    
    $twitter_handle = elgg_get_plugin_setting('twitter_handle', 'interconnected');
    if (!$twitter_handle) {
        $twitter_handle = '';
        elgg_set_plugin_setting('twitter_handle',$twitter_handle);
    }     

    $about_me = elgg_get_plugin_setting('about_me', 'interconnected');
    if (!$about_me) {
        $about_me = 'description';
        elgg_set_plugin_setting('about_me',$about_me);
    }     
    
    $group_description= elgg_get_plugin_setting('group_description', 'interconnected');
    if (!$group_description) {
        $group_description = 'briefdescription';
        elgg_set_plugin_setting('group_description',$group_description);
    }    

    $default_title = elgg_get_plugin_setting('default_title', 'interconnected');
    if (!$default_title) {
        $default_title = $CONFIG->sitename;
        elgg_set_plugin_setting('default_title',$default_meta_keywords);
    } 

    $default_meta_keywords = elgg_get_plugin_setting('default_meta_keywords', 'interconnected');
    if (!$default_meta_keywords) {
        $default_meta_keywords = '';
        elgg_set_plugin_setting('default_meta_keywords',$default_meta_keywords);
    } 
    
    $max_meta_keywords = elgg_get_plugin_setting('max_meta_keywords', 'interconnected');
    if (!$max_meta_keywords) {
        $max_meta_keywords = 0;
        elgg_set_plugin_setting('max_meta_keywords',$max_meta_keywords);
    } 
    
    $max_meta_description = elgg_get_plugin_setting('max_meta_description', 'interconnected');
    if (!$max_meta_description) {
        $max_meta_description = 160;
        elgg_set_plugin_setting('max_meta_description',$max_meta_description);
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
    echo "<br />"; 
 
    echo '<label>' . elgg_echo('interconnected:admin:default-meta-keywords') . ':' . '</label>';
    echo "<br />";    
    echo elgg_view('input/text', array('name'=>'params[default_meta_keywords]', 'value'=>$default_meta_keywords));  
    echo "<br />";

    echo '<label>' . elgg_echo('interconnected:admin:max-meta-keywords') . ':' . '</label>';
    echo "<br />";    
    echo elgg_view('input/text', array('name'=>'params[max_meta_keywords]', 'value'=>$max_meta_keywords));  
    echo "<br />";
    
    echo '<label>' . elgg_echo('interconnected:admin:max-meta-description') . ':' . '</label>';
    echo "<br />";    
    echo elgg_view('input/text', array('name'=>'params[max_meta_description]', 'value'=>$max_meta_description));  
    echo "<br />";    
                    
?>	
</div>