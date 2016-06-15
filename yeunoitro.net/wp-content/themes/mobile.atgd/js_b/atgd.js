/**
 * Created with JetBrains PhpStorm.
 * User: vocuc
 * Date: 4/12/15
 * Time: 3:54 PM
 * To change this template use File | Settings | File Templates.
 */
var DOMAIN = 'http://yeunoitro.net/';
var scrollY = 0;
var touchstart = 0;
$( document ).ready( function ()
{
	$( '.category-menu' ).on( 'click', function ()
	{
		activeMenuLeft();
	} );
	$( '.fr-search, .menu-search > .title' ).click( function ()
	{
		activeMenuRight();
	} );

	/*
	 * event khi click btn xem nhiều hơn
	 */
	var eClick = 0;
	$( '.btn-xt' ).on( 'click', function ( e )
	{
		e.preventDefault();
		if ( eClick != 0 )
		{
			return false
		}
		;
		eClick = 1;
		var id_category = $( this ).attr( 'id' );
		$( '#' + id_category ).parent().find( '.wrapper-post' ).append( '<div class="text-center process"><img src="processing.gif"></div>' );
		var offset = $( '#' + id_category ).parent().find( '.post-block' ).length;
		$.get( DOMAIN + "api/api.php?type=getpost&subaction=category&term_id=" + id_category + "&offset=" + offset )
			.fail( function ()
			{
				$( '.process' ).fadeOut( 300 );
				$( '.btn-no-data' ).hide();
				$( '#' + id_category ).parent().find( '.wrapper-post' ).append( '' +
					'<div class="btn-xt btn-no-data">Không tìm thấy dữ liệu yêu cầu<span class="icon-mt"></span></div>'
				);
				eClick = 0;
			} )
			.success( function ( data )
			{
				$( '.process' ).fadeOut( 300 );
				$( '.btn-no-data' ).hide();
				$.each( data.data, function ( i, item )
				{
					$( '#' + id_category ).parent().find( '.wrapper-post' ).append(
						'<article class="post-block top-20">' +
						'<figure class="post-img w130 pull-left">' +
						'<img width="185" height="117" src="' + item.thumb_img + '" class="img-full-width wp-post-image">' +
						'</figure>' +
						'<div class="post-content ps-1">' +
						'<a href="' + item.guid + '" title="' + item.post_title + '"><h3>' + item.post_title + '</h3></a>' +
						'<div class="description font-3 top-10">' + item.description + '</div>' +
						'<div class="info">' +
						'<div class="auth">' +
						'<span class="icon-user"></span>' +
						'<span class="font-1 color-2"><em><strong>' + item.post_author + '</strong></em></span>' +
						'</div>' +
						'<div class="date">' +
						'<span class="icon-date"></span>' +
						'<span class="font-1 color-2"><em>' + item.post_date + '</em></span>' +
						'</div>' +
						'<div class="clearfix"></div>' +
						'</div>' +
						'</div>' +
						'</article>'
					);
				} );
				eClick = 0;
			} );
	} );

	$( '#dropdown-search' ).on( 'focus', function ()
	{
		showTemplateOne();
	} )

	$( document ).on( 'scroll', function ()
	{
		var scroll = $( window ).scrollTop();
		if ( scrollY < scroll )
		{
			$( '#header' ).removeClass( 'active' );
			$( '#header' ).addClass( 'moverHide' );
		}
		else
		{
			$( '#header' ).removeClass( 'moverHide' );
			$( '#header' ).addClass( 'active' );
		}
		scrollY = scroll;
	} );

	$('.clearContent').click(function(){
		$('.container').removeClass('search');
		$('.container').removeClass('danhmuc');
	});
} );

function activeMenuLeft()
{
	container = $( '.container' );
	if ( !$( '.container' ).hasClass( 'search' ) )
	{
		container.removeClass( 'mvrCenter' );
		container.removeClass( 'mvlCenter' );
		container.toggleClass( 'danhmuc' );
	}
	else
	{
		container.removeClass( 'search' );
		container.addClass( 'mvlCenter' )
	}
}
function activeMenuRight()
{
	container = $( '.container' );
	if ( !$( '.container' ).hasClass( 'danhmuc' ) )
	{
		container.removeClass( 'mvrCenter' );
		container.removeClass( 'mvlCenter' );
		container.toggleClass( 'search' );
	}
	else
	{
		container.removeClass( 'danhmuc' );
		container.addClass( 'mvrCenter' );
	}
}

function showTemplateOne()
{
	var input = $( '#dropdown-search' );
	if ( input.val().length === 0 )
	{
		$( '#template-1' ).show();
		$( '#template-2' ).hide();
	}
}

function showData( data, idElement )
{
	$( '#' + idElement ).html( "" );
	$.each( data.data, function ( i, item )
	{
		$( '#' + idElement ).append( '<a class="#" href="' + item.guid + '">' +
			'<div class="col-md-12 sr-ct">' +
			'<figure class="pull-left sr-img w1">' +
			'<img class="img-full-width" src="' + item.thumb_img +
			'">' +
			'</figure>' +
			'<div class="sr-tt">' +
			'<lable>' + item.post_title + '</lable>' +
			'<div class="sr-info">' +
			'<div class="info">' +
			'<i class="icon-date"></i>' +
			'<span class="color-2">' + item.post_date + '</span>' +
			'</div>' +
			'<div class="clearfix"></div>' +
			'</div>' +
			'</div>' +
			'</div>' +
			'</a>' );
	} );
}

















