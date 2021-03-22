(function ($) {

    function abbreviateText(text, length) {
        var abbreviated = decodeURIComponent(text);
        if (abbreviated.length <= length) {
            return text;
        }

        var lastWhitespaceIndex = abbreviated.substring(0, length - 1).lastIndexOf(' ');
        abbreviated = encodeURIComponent(abbreviated.substring(0, lastWhitespaceIndex)) + "\u2026";

        return abbreviated;
    }

    function getMeta(name) {
        var metaContent = $('meta[name="' + name + '"]').attr('content');
        return metaContent || '';
    }
    
    function getTweetText() {
        var title = getMeta('DC.title');
        var creator = getMeta('DC.creator');

        if (title.length > 0 && creator.length > 0) {
            title += ' - ' + creator;
        } else {
            title = $('title').text();
        }

        return encodeURIComponent(title);
    }

    function getURI() {
        var uri = document.location.href;
        var canonical = $("link[rel=canonical]").attr("href");

        if (canonical && canonical.length > 0) {
            if (canonical.indexOf("http") < 0) {
                canonical = document.location.protocol + "//" + document.location.host + canonical;
            }
            uri = canonical;
        }

        return uri;
    }

    $.fn.socialSharePrivacy = function (settings) {
        var defaults = {
            'services' : {
                'facebook' : {
                    'txt_info'          : '{{$lang['facebookinfo']->value|escape}}',
                    'display_name'      : '{{$lang['facebookdisplayname']->value|escape}}',
                    'referrer_track'    : '',
                    'language'          : 'de_DE',
                    'action'            : 'recommend'
                }, 
                'twitter' : {
                    'txt_info'          : '{{$lang['twitterinfo']->value|escape}}',
                    'display_name'      : '{{$lang['twitterdisplayname']->value|escape}}',
                    'referrer_track'    : '', 
                    'tweet_text'        : getTweetText,
                    'language'          : 'en'
                },
                'gplus' : {
                    'txt_info'          : '{{$lang['gplusinfo']->value|escape}}',
                    'display_name'      : '{{$lang['gplusdisplayname']->value|escape}}',
                    'referrer_track'    : '',
                    'language'          : 'de'
                }
            },
            'txt_help'          : '{{$lang['help']->value|escape}}',
            'settings_perma'    : '{{$lang['perm']->value|escape}}',
            'uri'               : getURI
        };

        var options = $.extend(true, defaults, settings);

        var facebook_on = ($(this).attr('data-showfacebook')=='on');
        var twitter_on  = ($(this).attr('data-showtwitter')=='on');
        var gplus_on    = ($(this).attr('data-showgplus')=='on');
        
        if (!facebook_on && !twitter_on && !gplus_on) {
            return;
        }


        return this.each(function () {

            $(this).prepend('<ul class="social_share_privacy_area"></ul>');
            var context = $('.social_share_privacy_area', this);

            var uri = options.uri;
            if (typeof uri === 'function') {
                uri = uri(context);
            }

            if (facebook_on) {
                var fb_enc_uri = encodeURIComponent(uri + options.services.facebook.referrer_track);
                var fb_code = '<iframe src="//www.facebook.com/plugins/like.php?locale=' + options.services.facebook.language + '&amp;href=' + fb_enc_uri + '&amp;send=false&amp;layout=button_count&amp;width=120&amp;show_faces=false&amp;action=' + options.services.facebook.action + '&amp;colorscheme=light&amp;font&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:145px; height:21px;" allowTransparency="true"></iframe>';
                var fb_dummy_btn = '<div class="fb_like_privacy_dummy"></div>';

                context.append('<li class="facebook help_info"><span class="info">' + options.services.facebook.txt_info + '</span><span class="switch off"></span><div class="fb_like dummy_btn">' + fb_dummy_btn + '</div></li>');

                var $container_fb = $('li.facebook', context);

                $('li.facebook div.fb_like div.fb_like_privacy_dummy,li.facebook span.switch', context).on('click', function () {
                    if ($container_fb.find('span.switch').hasClass('off')) {
                        $container_fb.addClass('info_off');
                        $container_fb.find('span.switch').addClass('on').removeClass('off');
                        $container_fb.find('div.fb_like_privacy_dummy').replaceWith(fb_code);
                    } else {
                        $container_fb.removeClass('info_off');
                        $container_fb.find('span.switch').addClass('off').removeClass('on');
                        $container_fb.find('.fb_like').html(fb_dummy_btn);
                    }
                });
            }

            if (twitter_on) {
                var text = options.services.twitter.tweet_text;
                if (typeof text === 'function') {
                    text = text();
                }
                text = abbreviateText(text, '120');

                var twitter_enc_uri = encodeURIComponent(uri + options.services.twitter.referrer_track);
                var twitter_count_url = encodeURIComponent(uri);
                var twitter_code = '<iframe allowtransparency="true" frameborder="0" scrolling="no" src="//platform.twitter.com/widgets/tweet_button.html?url=' + twitter_enc_uri + '&amp;counturl=' + twitter_count_url + '&amp;text=' + text + '&amp;count=horizontal&amp;lang=' + options.services.twitter.language + '" style="width:130px; height:25px;"></iframe>';
                var twitter_dummy_btn = '<div class="tweet_this_dummy"></div>';

                context.append('<li class="twitter help_info"><span class="info">' + options.services.twitter.txt_info + '</span><span class="switch off"></span><div class="tweet dummy_btn">' + twitter_dummy_btn + '</div></li>');

                var $container_tw = $('li.twitter', context);

                $('li.twitter div.tweet div.tweet_this_dummy,li.twitter span.switch', context).on('click', function () {
                    if ($container_tw.find('span.switch').hasClass('off')) {
                        $container_tw.addClass('info_off');
                        $container_tw.find('span.switch').addClass('on').removeClass('off');
                        $container_tw.find('div.tweet_this_dummy').replaceWith(twitter_code);
                    } else {
                        $container_tw.removeClass('info_off');
                        $container_tw.find('span.switch').addClass('off').removeClass('on');
                        $container_tw.find('.tweet').html(twitter_dummy_btn);
                    }
                });
            }

            if (gplus_on) {
                var gplus_uri = uri + options.services.gplus.referrer_track;
                
                var gplus_code = '<div class="g-plusone" data-size="medium" data-href="' + gplus_uri + '"></div><script>window.___gcfg = {lang: "' + options.services.gplus.language + '"}; (function() { var po = document.createElement("script"); po.type = "text/javascript"; po.async = true; po.src = "//apis.google.com/js/plusone.js"; var s = document.getElementsByTagName("script")[0]; s.parentNode.insertBefore(po, s); })(); </script>';
                var gplus_dummy_btn = '<div class="gplus_one_dummy"></div>';

                context.append('<li class="gplus help_info"><span class="info">' + options.services.gplus.txt_info + '</span><span class="switch off"></span><div class="gplusone dummy_btn">' + gplus_dummy_btn + '</div></li>');

                var $container_gplus = $('li.gplus', context);

                $('li.gplus div.gplusone div.gplus_one_dummy,li.gplus span.switch', context).on('click', function () {
                    if ($container_gplus.find('span.switch').hasClass('off')) {
                        $container_gplus.addClass('info_off');
                        $container_gplus.find('span.switch').addClass('on').removeClass('off');
                        $container_gplus.find('div.gplus_one_dummy').replaceWith(gplus_code);
                    } else {
                        $container_gplus.removeClass('info_off');
                        $container_gplus.find('span.switch').addClass('off').removeClass('on');
                        $container_gplus.find('.gplusone').html(gplus_dummy_btn);
                    }
                });
            }

            context.append('<li class="settings_info"><div class="settings_info_menu off perma_option_off"><a><span class="help_info icon"><span class="info">' + options.txt_help + '</span></span></a></div></li>');

            $('.help_info:not(.info_off)', context).on('mouseenter', function () {
                var $info_wrapper = $(this);
                var timeout_id = window.setTimeout(function () { $($info_wrapper).addClass('display'); }, 500);
                $(this).data('timeout_id', timeout_id);
            });
            $('.help_info', context).on('mouseleave', function () {
                var timeout_id = $(this).data('timeout_id');
                window.clearTimeout(timeout_id);
                if ($(this).hasClass('display')) {
                    $(this).removeClass('display');
                }
            });

            var facebook_perma = ($(this).attr('data-permfacebook')=='on');
            var twitter_perma  = ($(this).attr('data-permtwitter')=='on');
            var gplus_perma    = ($(this).attr('data-permgplus')=='on');


            if (((facebook_on && facebook_perma)
                || (twitter_on && twitter_perma)
                || (gplus_on && gplus_perma))) {


                var $container_settings_info = $('li.settings_info', context);

                $container_settings_info.find('.settings_info_menu').removeClass('perma_option_off');

                $container_settings_info.find('.settings_info_menu').append('<span class="settings">Einstellungen</span><form><fieldset><legend>' + options.settings_perma + '</legend></fieldset></form>');


                // Die Dienste mit <input> und <label>, sowie checked-Status laut Cookie, schreiben
                var checked = ' checked="checked"';
                if (facebook_on && facebook_perma) {
                    var perma_status_facebook = $.cookie('ngsocial_facebook') === 'perma_on' ? checked : '';
                    $container_settings_info.find('form fieldset').append(
                        '<input type="checkbox" name="perma_status_facebook" id="perma_status_facebook"'
                            + perma_status_facebook + ' /><label for="perma_status_facebook">'
                            + options.services.facebook.display_name + '</label>'
                    );
                }

                if (twitter_on && twitter_perma) {
                    var perma_status_twitter = $.cookie('ngsocial_twitter') === 'perma_on' ? checked : '';
                    $container_settings_info.find('form fieldset').append(
                        '<input type="checkbox" name="perma_status_twitter" id="perma_status_twitter"'
                            + perma_status_twitter + ' /><label for="perma_status_twitter">'
                            + options.services.twitter.display_name + '</label>'
                    );
                }

                if (gplus_on && gplus_perma) {
                    var perma_status_gplus = $.cookie('ngsocial_gplus') === 'perma_on' ? checked : '';
                    $container_settings_info.find('form fieldset').append(
                        '<input type="checkbox" name="perma_status_gplus" id="perma_status_gplus"'
                            + perma_status_gplus + ' /><label for="perma_status_gplus">'
                            + options.services.gplus.display_name + '</label>'
                    );
                }

                $container_settings_info.find('span.settings').css('cursor', 'pointer');

                $($container_settings_info.find('span.settings'), context).on('mouseenter', function () {
                    var timeout_id = window.setTimeout(function () { $container_settings_info.find('.settings_info_menu').removeClass('off').addClass('on'); }, 500);
                    $(this).data('timeout_id', timeout_id);
                }); 
                $($container_settings_info, context).on('mouseleave', function () {
                    var timeout_id = $(this).data('timeout_id');
                    window.clearTimeout(timeout_id);
                    $container_settings_info.find('.settings_info_menu').removeClass('on').addClass('off');
                });

                $($container_settings_info.find('fieldset input')).on('click', function (event) {
                    var click = event.target.id;
                    var service = click.substr(click.lastIndexOf('_') + 1, click.length);
                    var cookie_name = 'ngsocial_' + service;

                    if ($('#' + event.target.id + ':checked').length) {
                        $.cookie(cookie_name, 'perma_on', {expires: 360} );
                        $('form fieldset label[for=' + click + ']', context).addClass('checked');
                    } else {
                        $.cookie(cookie_name, null);
                        $('form fieldset label[for=' + click + ']', context).removeClass('checked');
                    }
                });

                if (facebook_on && facebook_perma && $.cookie('ngsocial_facebook') === 'perma_on') {
                    $('li.facebook span.switch', context).click();
                }
                if (twitter_on && twitter_perma && $.cookie('ngsocial_twitter') === 'perma_on') {
                    $('li.twitter span.switch', context).click();
                }
                if (gplus_on && gplus_perma && $.cookie('ngsocial_gplus') === 'perma_on') {
                    $('li.gplus span.switch', context).click();
                }
            }
        }); 
    };      
}(jQuery));

jQuery(document).ready(function($){
    if($('.ngpluginparagraphsocial').length > 0){
      $('.ngpluginparagraphsocial').socialSharePrivacy(); 
    }
  });