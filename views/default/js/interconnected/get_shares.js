/*
 * interconnected function for retrieving shares / counts
 * @package: interconnected
 * author: ura soul
 */

define(function(require)
{
        var $ = require('jquery');
        var elgg = require('elgg');

        $(document).ready(function()
        {
                var url = window.location.href;

                elgg.action('interconnected/get_share_data', {
                        data: {
                                url: url
                        },
                        success: function (json) {
                                if ($(json.output).children.length>0)
                                {
                                        var shares = $(json.output).children('shares:first').html();
                                        if (shares != 'null')
                                        {
                                            var service_arr = $.parseJSON(shares);
                                            //console.log($(json.output).html());
                                            $(".elgg-button-share-small,.elgg-button-share-large").each(function (index, el) {
                                                service = $(el).attr("data-service");
                                                count = service_arr[service];
                                                if (count > 0)
                                                {
                                                        // Divide large numbers eg. 5500 becomes 5.5k
                                                        if(count>1000) {
                                                                count = (count / 1000).toFixed(1);
                                                                if(count>1000) count = (count / 1000).toFixed(1) + "M";
                                                                else count = count + "k";
                                                        }
                                                        $(el).parents(".elgg-button-share-wrapper").append('<div class="elgg-share-count">' + count + '</div><div class="elgg-share-count-arrow">◄</div>');
                                                }
                                            });
                                      }
                                }
                        }
                });
        });
});
