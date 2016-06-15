/**
 * Created with JetBrains PhpStorm.
 * User: vocuc
 * Date: 2/6/15
 * Time: 2:00 PM
 * To change this template use File | Settings | File Templates.
 */
$(function() {
	//script su dung cho menu top khi scroll
  var lastScrollTop = 0;
  $(window).scroll(function()
  {
    var st = $(this).scrollTop();
    if (st > 190 && st < lastScrollTop) { // upscroll code
      $('.header-menu').addClass('header-fixed');
      $('.mn-fix').addClass('pd200');
    }
    else {
      $('.header-menu').removeClass('header-fixed');
      $('.mn-fix').removeClass('pd200');
    }

    lastScrollTop = st;
  });

	//script su dung cho menu fitler
	var click = 0;
	$('.mutliSelect input[type="checkbox"]').on('click', function () {
		var title = $(this).closest('.mutliSelect').find('input[type="checkbox"]').val(),
			title = $(this).val();
		if ($(this).is(':checked')) {
			click++;
			var html = '<span class="text-ellipsis" title="' + title + '">' + title + '</span>';
			$('.lab-search').remove();
			$('.multiSel').append(html);
			if(click > 1 && click <= 3 ) $('.search-input').width($('#exampleInputAmount').width() - 80);
		}
		else {
			click = click - 1;
			$('span[title="' + title + '"]').remove();
			if($('.multiSel span').length == 0 )
			{
				$('.multiSel').append('<span class="lab-search">Mục đích nấu</span>');
			}
			if(click < 3)
			{
				$('.search-input').width($('#exampleInputAmount').width() + 80);
			}
		}

	});//end script

	//open search dropdown
	$(document).bind('click', function (e) {
		var $clicked = $(e.target);
		if ($clicked.parents().hasClass("mutliSelect")){
			$('.dropdown').addClass('open');
		};
	});

	$('#myTab a').click(function (e) {
		$('#myTab a').removeClass('active');
		$(this).addClass('active');
	});

	//sự kiên khi người dùng search từ khóa
	$('#dropdown-search').keyup(function(e){
		var key = $(this).val();
		if(key.length >= 0 ){
			switch (e.keyCode) {
				case 8:  // Backspace
					showTemplateOne();
					break;
				case 27:
					$('#search-dr').removeClass('open');
					break;
				default:
					break;
			}
		}
	});
	$('#dropdown-search').on('focus',function(){
		showTemplateOne();
	})
});

$("#dropdown-search").keyup(function (e) {
		if (e.keyCode == 13) {
			$("#btn-search").trigger("click");
		}
	});

$("#btn-search").click(
	function () {
		var key = $("#dropdown-search").val();
		var scb = [];
		$('#checkboxdiv input:checked').each(function() {
			scb.push(this.value);
		});
		if(scb.length > 0) {
			var array = "";
			for(var i = 0; i < scb.length; i++) {
				array += scb[i] + ",";
			}

			if (key.length > 1) {
				window.location.href = "/?s=" + key.replace(' ', '+') + "&c="+array;
			}
		}
		else {
			if (key.length > 1) {
				window.location.href = "/?s=" + key.replace(' ', '+');
			}
		}

	}
);


function showTemplateOne(){
	var input =$('#dropdown-search');
	if(input.val().length === 0 ){
		$('#template-1').show();
		$('#template-2').hide();
	}
}

$(".close-popup").click(function(){
    $(".pbm-wp").hide();
});

//JS Floating ads
$(function() {
  var docwidth = $( document ).width();

  if( docwidth < 1360 ){
    $(".floating-ads" ).hide();
  }
  else
  {
    containerWidth = $(".container" ).width();
    adsWidth = (docwidth-containerWidth)/2 - 10;
    $(".floating-ads" ).css("width", adsWidth);
    $(".floating-left" ).css("text-align", "right");
  }

  var ads = $(".floating-ads");
  var wrapper = $(".wrapper" ).offset();
  var topPadding = 50, lastScrollTop = 0;

  adsHeight = $(".floating-ads" ).height();
  offset = ads.offset();
  $(document).scroll(function() {
    var st = $(window).scrollTop(),
    offsetBottom = $('.footer').offset().top - $(window).scrollTop();
    if (st > offset.top && st >= lastScrollTop) {
      if( offsetBottom-30 >=  ads.height() ){
        $(".floating-ads").stop().animate({
          top: st - offset.top + topPadding
        });
      }
    }
    else if( st > offset.top && st < lastScrollTop){ //scroll top
      if( offsetBottom - 120 >=  ads.height() ){
        $(".floating-ads").stop().animate({
          top: st - offset.top + 340
        });
      }
    }
    else if(st <= offset.top) {
      $(".floating-ads").stop().animate({
        top: 10
      });
    };
    lastScrollTop = st;
  });
});

//function cmp_ads(element,content, paddingtop){
//  ads = $(element);
//  adsHeight = ads.height();
//  adsWidth = ads.width() * 2;
//  content = $(content);
//  contentWidth = content.width();
//  defaulTop = content.offset().top ;
//  wWidth = $(window).width();
//  totalWidth = adsWidth + contentWidth;
//
//  if(totalWidth <= wWidth){
//    //ads.stop().animate({
//    //  top: defaulTop
//    //});
//    ads.css('top',defaulTop);
//  }else{
//    ads.hide();
//  }
//
//  $(document).scroll(function(){
//
//    scrollTop = defaulTop - $(window).scrollTop();
//    offsetBottom = $('.footer').offset().top - $(window).scrollTop();
//    if(scrollTop >= 0){
//      //ads.stop().animate({
//      //  top: scrollTop
//      //});
//      ads.css('top',scrollTop);
//    }else if(offsetBottom <= adsHeight){
//      //ads.stop().animate({
//      //  top: offsetBottom - adsHeight
//      //});
//      ads.css('top',offsetBottom - adsHeight);
//    }
//    else{
//      //ads.stop().animate({
//      //  top: 0
//      //});
//      ads.css('top',0);
//    }
//  });
//
//  $(window).resize(function(){
//    wWidth = $(window).width();
//    content = $(content);
//    contentWidth = content.width();
//    defaulTop = content.offset().top;
//    scrollTop = defaulTop - $(window).scrollTop();
//    totalWidth = adsWidth + contentWidth;
//    offsetBottom = $('.footer').offset().top - $(window).scrollTop();
//
//    if(totalWidth <= wWidth && scrollTop >= 0 ){
//      //ads.stop().animate({
//      //  top: scrollTop
//      //});
//      ads.css('top',scrollTop);
//      ads.show();
//    }else if(totalWidth <= wWidth && offsetBottom <= adsHeight){
//      //ads.stop().animate({
//      //  top: offsetBottom - adsHeight
//      //});
//      ads.css('top',offsetBottom - adsHeight);
//      ads.show();
//    }else if(totalWidth >= wWidth){
//      ads.hide();
//    }else{
//      ads.show();
//    }
//  });
//
//}