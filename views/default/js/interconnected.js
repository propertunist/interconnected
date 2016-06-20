/*
 * interconnected plugin for elgg 1.11.x
 * @package: interconnected
 * author: ura soul
 */

define(function(require)
{
    var $ = require('jquery');
    var elgg = require('elgg');

    var url_timeout = null;
    var proc_status = 'new';
    var address_value = $('#bookmark-address').val();

    refreshthumb = function()
    {

        var url;
        url = $('#bookmark-address').val();
        var def_image_url = elgg.config.wwwroot + '_graphics/icons/default/medium.png';
        $('#bookmark-thumb-icon, fieldset .elgg-refresh-button').css('display', 'none');
        $('#bookmark-thumbnail-loader-wrapper').css('display', 'block');
        //console.log('refreshthumb');
        elgg.action('bookmarks/refreshthumb', {
            data: {
                url: url
            },
            success: function (json) {
              //  console.debug('refresh-thumbnail: success');

                if ($(json.output).children.length>0)
                {
                    var return_url = $(json.output).children('src:first').html();
                //    console.debug(return_url);
                    if (return_url)
                    {
                        $('#bookmark-thumb-icon').attr('src',return_url);
                    }
                    else
                    {
                        $('#bookmark-thumb-icon').attr('src',def_image_url);
                    }
                    $('#bookmark-thumb-icon').attr('data-srcset', $('#bookmark-thumb-icon').attr('src'));
                    $('#bookmark-thumb-icon').attr('srcset', $('#bookmark-thumb-icon').attr('src'));
                    $('#bookmark-thumbnail-loader-wrapper').css('display', 'none');
                    $('#bookmark-thumb-icon, fieldset .elgg-refresh-button').css('display', 'initial');
                }
            },
            error: function()
            {
                  //console.debug('refresh-thumbnail: error');
                  $('#bookmark-thumbnail-loader-wrapper').css('display', 'none');
                  $('#bookmark-thumb-icon').attr('src',def_iamge_url);
                  $('#bookmark-thumb-icon, fieldset .elgg-refresh-button').css('display', 'initial');
            }
        });
        return;
   };

    customConfirm = function(customMessage) {
        $('<div></div>', {
        'id':'popUp',
        'class':'confirmation-dialog'
    }).appendTo('body');
        var dfd = new jQuery.Deferred();
        var yes = elgg.echo('yes');
        var no = elgg.echo('no');
        $("#popUp").html(customMessage);
        $("#popUp").dialog({
            resizable: false,
            height: 240,
            modal: true,
            buttons: {
                yes: function () {
                    $(this).dialog("close");
                    dfd.resolve(true);
                },
                no: function () {
                    $(this).dialog("close");
                    dfd.resolve(false);
                }
            }
        });
        return dfd.promise();
    };

   endrefresh = function()
   {
        $('#bookmark-thumbnail-loader-wrapper').css('display', 'none');
        $('#bookmark-thumb-icon, fieldset .elgg-refresh-button').css('display', 'initial');
        proc_status = 'cleared';
        return;
   };

   validate_url = function(address_to_validate)
   {
        url_timeout = setTimeout(function()
        {
            elgg.action('interconnected/validate-url',
            {
                data:
                {
                    url: address_to_validate
                },
                success: function (json)
                {
                    if ($(json.output).children.length>0)
                    {
                        var status = $(json.output).children('status:first').html();
                    //    console.debug('validate-url: ' + status);
                        if (status)
                        {
                            if (status.indexOf('10 valid') >= 0)
                            {
                                clearTimeout(url_timeout);
                                proc_status = 'incomplete';
                                var refresh_result = refreshpage();
                                if (refresh_result != 'interrupt')
                                {
                                    address_value = address_to_validate;
                                }
                                return true;
                            }
                            else
                            {
                                return false;
                            }
                        }
                        else
                        {
                            return false;
                        }
                    }
                    else
                    {
                        return false;
                    }
                },
                error: function()
                {
                      console.debug('validate-url: error');
                      return false;
                }
            });
        },2000);
    };

   refreshpage = function() {
        var url;
        url = $('#bookmark-address').val();

        $('#bookmark-thumb-icon, fieldset .elgg-refresh-button').css('display', 'none');
        $('#bookmark-thumbnail-loader-wrapper').css('display', 'block');
        //console.debug('refreshpage: ' + proc_status);
        if (proc_status == 'interrupt')
        {
             endrefresh();
             return 'interrupt';
        }
        elgg.action('bookmarks/refreshthumb', {
            data: {
                url: url
            },
            success: function (json)
            {
                 //console.debug('refresh-page: success');
                 if (proc_status == 'interrupt')
                 {
                     endrefresh();
                     return 'interrupt';
                 }
                if (($(json.output).children.length>0)&&($(json.output).children('none').length == 0))
                {
                    //console.log(json);

                    var echo_args = [url],
                        title_text,
                        description_text;
                    $.when(customConfirm(elgg.echo('interconnected:replace_data', echo_args))).then(
                      function(confirm) {
                        if (proc_status == 'interrupt')
                        {
                             endrefresh();
                             return 'interrupt';
                        }
                       if(confirm){
                   //         console.debug('refresh-page: dialog = yes');
                            var def_image_url = elgg.config.wwwroot + '_graphics/icons/default/medium.png';
                            if ($(json.output).children('src:first').html())
                            {
                                $('#bookmark-thumb-icon').attr('src',$(json.output).children('src:first').html());
                                $('#bookmark-thumb-icon').attr('data-srcset',$('#bookmark-thumb-icon').attr('src'));
                                $('#bookmark-thumb-icon').attr('srcset',$('#bookmark-thumb-icon').attr('src'));
                            }
                            else
                                $('#bookmark-thumb-icon').attr('src',def_image_url);

                            if ($(json.output).children('title:first').html())
                            {
                                title_text = $(json.output).children('title:first').html();
                                title_text = $('<div/>').html(title_text).text();
                                $('#bookmark-title').val(title_text);
                            }
                            else
                                $('#bookmark-title').val('');

                            if ($(json.output).children('description:first').html())
                            {
                                description_text = $(json.output).children('description:first').html();
                                description_text = $('<div/>').html(description_text).text();
                                $('#bookmark-desc').val(description_text);
                                $('#bookmark-desc_ifr').contents().find('#tinymce').html(description_text);
                            }
                            else
                            {
                                $('#bookmark-desc').val('');
                                $('#bookmark-desc_ifr').contents().find('#tinymce').html('');
                            }
                             if (proc_status == 'interrupt')
                             {
                                 endrefresh();
                                 return 'interrupt';
                             }
                       }
                    });
                }
                else
                {
                    //console.log('no data retrieved');
                }
                $('#bookmark-thumbnail-loader-wrapper').css('display', 'none');
                $('#bookmark-thumb-icon, fieldset .elgg-refresh-button').css('display', 'initial');
                proc_status = 'complete';
                return true;
            },
            error: function()
            {
                 var def_image_url = elgg.config.wwwroot + '_graphics/icons/default/medium.png';
                 //console.debug('refresh-page: error');
                 $('#bookmark-thumbnail-loader-wrapper').css('display', 'none');
                 $('#bookmark-thumb-icon').attr('src',def_image_url);
                 $('#bookmark-thumb-icon, fieldset .elgg-refresh-button').css('display', 'initial');
                 proc_status = 'error';
            }
        });
        return;
   };

    $('#bookmark-address').bind("keyup change", function() {

        var bookmark_address = $('#bookmark-address').val();
        if ((address_value != bookmark_address)) // change has occurred
        {
            if (url_timeout)
            {
               // console.debug('keyup event | url_timeout exists and status is: ' + proc_status);
                if (proc_status == 'incomplete') // if there is an existing refresh process running
                {
                   console.debug('keyup event | proc_status changed to interrupt');
                   proc_status = 'interrupt';
                }
                else
                {
                    clearTimeout(url_timeout);
                    url_timeout = null;
                }
            }
            if(bookmark_address != '')
            {
                validate_url(bookmark_address);
            }
        }
    });

    $(document).ready(function()
    {
        if(($('.elgg-form-bookmarks-save .elgg-foot > input[name=guid]').length == 0)&&(address_value != ''))
        {
            validate_url(address_value);
        }
    });

});
