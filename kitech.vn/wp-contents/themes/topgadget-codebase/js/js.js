jQuery(document).ready(function ($) {

    $('<select />').appendTo('#mobile-menu');

    $('<option />', {
        'selected': 'selected',
        'value': '',
        'text': 'Điều hướng đến..'
    }).appendTo('#mobile-menu select');

    $('.ddsmoothmenu a').each(function () {
        var el = $(this);
        if (el.parents('.sub-menu').length) {
            $('<option />', {
                'value': el.attr('href'),
                'text': '— ' + el.text()
            }).appendTo('nav select');
        } else {
            $('<option />', {
                'value': el.attr('href'),
                'text': el.text()
            }).appendTo('nav select');
        }
    });

    $('#mobile-menu select').change(function () {
        window.location = $(this).find('option:selected').val();
    });


    $(".sub-menu").parent("li").addClass("parent");
    $(".ddsmoothmenu li:first-child").addClass("firstul");
    $(".sub-menu li:first-child").addClass("first");
    $(".sub-menu li:last-child").addClass("last");


    //When page loads...
    $('.tabs-wrapper').each(function () {
        $(this).find(".tab_content").hide(); //Hide all content
        $(this).find("ul.tabs li:first").addClass("active").show(); //Activate first tab
        $(this).find(".tab_content:first").show(); //Show first tab content
    });

    //On Click Event
    $("ul.tabs li").click(function (e) {
        $(this).parents('.tabs-wrapper').find("ul.tabs li").removeClass("active"); //Remove any "active" class
        $(this).addClass("active"); //Add "active" class to selected tab
        $(this).parents('.tabs-wrapper').find(".tab_content").hide(); //Hide all tab content

        var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
        $(this).parents('.tabs-wrapper').find(activeTab).fadeIn(); //Fade in the active ID content

        e.preventDefault();
    });

    $("ul.tabs li a").click(function (e) {
        e.preventDefault();
    })

});
