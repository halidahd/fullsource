jQuery(document).ready(function ($) {
    $.fn.delay = function (time, func) {
        return this.each(function () {
            setTimeout(func, time);
        });
    };
    // Slide Fade toggle
    $.fn.slideFadeToggle = function (speed, easing, callback) {
        // nice slide fade toggle animation - pew pew pew
        return this.animate({opacity: 'toggle', height: 'toggle'}, speed, easing, callback);
    }


    activateTabs = {
        init: function () {
            // Activate
            $("#options_tabs").tabs();
            // Append Toggle Button
            // Toggle Tabs
            $('.toggle_tabs').toggle(function () {
                $("#options_tabs").tabs('destroy');
                $(this).addClass('off');
            }, function () {
                $("#options_tabs").tabs();
                $(this).removeClass('off');
            });
        }
    };


    $('.mmtheme_singlecheck :checkbox').iphoneStyle();
    $('#options_tabs .ui-tabs-panel:first').removeClass('ui-tabs-hide');
    activateTabs.init()


    if ($('#mm-admin a.info-icon').size() > 0) {
        $('#mm-admin a.info-icon').hover(
            function () {
                $(this).next().stop(false, true).fadeIn(500);
            },
            function () {
                $(this).next().stop(false, true).fadeOut(500);
            }
        );

    }

});
