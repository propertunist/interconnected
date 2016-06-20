<?php
/**
 * interconnected - list all social shares
 */

$limit = 1000;

$data = get_data('SELECT *, IFNULL(fb_likes ,0) + IFNULL(reddit_likes ,0) + IFNULL(google_likes ,0) + IFNULL(tw_favs ,0) AS total_likes, IFNULL(fb_shares ,0) + IFNULL(google_shares ,0) + IFNULL(tw_shares ,0)+ IFNULL(pin_shares ,0) + IFNULL(pin_shares ,0) + IFNULL(linked_shares ,0) AS total_shares, IFNULL(fb_likes ,0) + IFNULL(google_likes ,0) + IFNULL(tw_favs ,0) + IFNULL(fb_shares ,0) + IFNULL(google_shares ,0) + IFNULL(tw_shares ,0)+ IFNULL(pin_shares ,0) + IFNULL(pin_shares ,0) + IFNULL(linked_shares ,0) AS total_shares_likes FROM social_share_counts ORDER BY total_shares_likes DESC, total_shares DESC, total_likes DESC LIMIT ' . $limit);
echo '<br/>';

if (count($data > 0))
{
        elgg_require_js('tablesorter');
        elgg_require_js('tablesorter-init');
        elgg_load_css('tablesorter');
        $title = elgg_echo('admin:interconnected:social_shares_table');

        $body ='<table cellspacing="0" cellpadding="0" border="0" class="tablesorter-blackice" id="social_counts_table">';
        $body .= '<thead><tr>'
                . '<th>' . elgg_echo('admin:interconnected:share_count_url') . '</th>'
                . '<th>' . elgg_echo('admin:interconnected:share_count_subtype') . '</th>'
                . '<th>' . elgg_echo('admin:interconnected:share_count_timestamp') . '</th>'
       //         . '<th>' . elgg_echo('admin:interconnected:share_count_tw_favs') . '</th>'
                . '<th>' . elgg_echo('admin:interconnected:share_count_tw_shares') . '</th>'             //         . '<th>' . elgg_echo('admin:interconnected:share_count_fb_likes') . '</th>'
                . '<th>' . elgg_echo('admin:interconnected:share_count_fb_shares') . '</th>'
                . '<th>' . elgg_echo('admin:interconnected:share_count_google_likes') . '</th>'
       //         . '<th>' . elgg_echo('admin:interconnected:share_count_google_shares') . '</th>'
                . '<th>' . elgg_echo('admin:interconnected:share_count_pin_shares') . '</th>'
                . '<th>' . elgg_echo('admin:interconnected:share_count_stumble_shares') . '</th>'
                . '<th>' . elgg_echo('admin:interconnected:share_count_linked_shares') . '</th>'
                . '<th>' . elgg_echo('admin:interconnected:share_count_reddit_likes') . '</th>'
                . '<th>' . elgg_echo('admin:interconnected:share_count_total_likes') . '</th>'
                . '<th>' . elgg_echo('admin:interconnected:share_count_total_shares') . '</th>'
                . '<th>' . elgg_echo('admin:interconnected:share_count_total_shares_likes') . '</th>'
                . '</tr></thead><tbody>';
        foreach($data as $row)
        {
                if (($row->total_likes + $row->total_shares) > 0)
                {
                        unset ($entity_title);
                        unset ($subtype);
                        unset ($entity);
                        if ($row->entity_guid)
                        {
                                if ($entity = get_entity($row->entity_guid))
                                {
                                        $entity_title = $entity->title;
                                        if ($subtype = $entity->subtype)
                                        {
                                                $subtype = get_subtype_from_id($subtype);
                                                $subtype = get_nice_name_for_subtype($subtype);
                                        }
                                }
                        }
                        if (!$entity_title)
                            $entity_title = $row->url;
                        if (($entity && (!$subtype == 0))||(!$entity))
                        {
                                $body .= '<tr>';
                                $body .= '<td>';
                                $body .= elgg_view('output/url', array('href' => $row->url, 'text' => $entity_title, 'target' => '_blank'));
                                $body .= '</td>';
                                $body .= '<td>';
                                $body .= $subtype;
                                $body .= '</td>';
                                $body .= '<td>';
                                $body .= $row->date;
                                $body .= '</td>';
                 //               $body .= '<td>';
                  //              $body .= isset($row->tw_favs)?$row->tw_favs:0;
                   //             $body .= '</td>';
                                $body .= '<td>';
                                $body .= isset($row->tw_shares)?$row->tw_shares:0;
                                $body .= '</td>';
                  //              $body .= '<td>';
                  //              $body .= isset($row->fb_likes)?$row->fb_likes:0;
                  //              $body .= '</td>';
                                $body .= '<td>';
                                $body .= isset($row->fb_shares)?$row->fb_shares:0;
                                $body .= '</td>';
                                $body .= '<td>';
                                $body .= isset($row->google_likes)?$row->google_likes:0;
                                $body .= '</td>';
                  //              $body .= '<td>';
                   //             $body .= isset($row->google_shares)?$row->google_shares:0;
                    //            $body .= '</td>';
                                $body .= '<td>';
                                $body .= isset($row->pin_shares)?$row->pin_shares:0;
                                $body .= '</td>';
                                $body .= '<td>';
                                $body .= isset($row->stumble_shares)?$row->stumble_shares:0;
                                $body .= '</td>';
                                $body .= '<td>';
                                $body .= isset($row->linked_shares)?$row->linked_shares:0;
                                $body .= '</td>';
                                $body .= '<td>';
                                $body .= isset($row->reddit_likes)?$row->reddit_likes:0;
                                $body .= '</td>';
                                $body .= '<td>';
                                $body .= $row->total_likes;
                                $body .= '</td>';
                                $body .= '<td>';
                                $body .= $row->total_shares;
                                $body .= '</td>';
                                $body .= '<td>';
                                $body .= $row->total_shares_likes;
                                $body .= '</td>';
                                $body .= '</tr>';
                        }
                }
        }
        $body .= '</tbody></table>';
}
else
{
    $body = elgg_echo('admin:interconnected:database_share_error');
}
echo '<div id="social_counts_panel">';
echo elgg_view_module('inline', $title, $body);
echo '</div>';
