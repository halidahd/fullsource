<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb='https://www.facebook.com/2008/fbml' <?php language_attributes(); ?>>
<head>
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<meta content='295463810632874' property='fb:app_id'/>
	<meta name="google-site-verification" content="ffXeyFv_qYaMiP8aVybThxjqZx_my_VpxSrSx0K-fXc" />
	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/bootstrap/css/bootstrap.min.css"/>
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" media="screen" />
	<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico" />

	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<!--	--><?php //get_canonical($_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]); ?>
	<!-- <link href='http://fonts.googleapis.com/css?family=Lato:400,700,400italic|Copse' rel='stylesheet' type='text/css'>
	 -->
	<script src="<?php echo get_stylesheet_directory_uri();?>/js/jquery.min.js"></script>
	<?php wp_head(); ?>
	<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
	<script>
		(adsbygoogle = window.adsbygoogle || []).push({
			google_ad_client: "ca-pub-2636118200160818",
			enable_page_level_ads: true
		});
	</script>
</head>
<body>
<!-- Google Tag Manager -->
<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-WQNLJS"
				  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
		new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
		j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
		'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-WQNLJS');</script>
<!-- End Google Tag Manager -->
<!-- Place this tag in your head or just before your close body tag. G+ button-->
<script type="text/javascript" src="https://apis.google.com/js/platform.js"></script>

<!-- Start Container -->
<div class="container">
<script>
	window.fbAsyncInit = function() {
		FB.init({
			appId      : '295463810632874',
			xfbml      : true,
			version    : 'v2.5'
		});
	};

	(function(d, s, id){
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) {return;}
		js = d.createElement(s); js.id = id;
		js.src = "//connect.facebook.net/vi_VN/sdk.js";
		fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));
</script>

	<!--menu slide khi click danh mục món-->
	<div id="content-md" class="menu-dmn">
		<div class="title"><span class="glyphicon glyphicon-list font-2 pull-left" aria-hidden="true"></span> Danh muc </div>
		<ul class="list-unstyled">
			<?php
			wp_nav_menu( array( 'container' => '',
								'menu' => 'menu-mobile',
								'menu_class' => '',
								'items_wrap'      => '%3$s',
								'link_before' => '<span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span><span>',
								'link_after' => '</span>'
			) );
			?>
		</ul>
		<div class="footer">
			<?php static_footer_info();?>
		</div>
	</div>
	<!--menu search -->
	<!-- START search sidebar-->
	<div class="menu-search">
		<div class="title">Tìm kiếm nâng cao</div>
		<div class="from-search">
			<form class="form-inline text-canter" method="get" role="search">
				<div class="form-group img-full-width">
					<div id="search-dr" class="dropdown">
						<input type="search" class="form-control search-input img-full-width" id="dropdown-search" data-toggle="dropdown" placeholder="Tên nguyên liệu món ăn..." autocomplete="off">
						<button class="sSearch" id="btn-search" type="button"><span class="glyphicon glyphicon-search"></span></button>
						<div class="result-search dropdown-menu" role="menu" aria-labelledby="dropdown-search">
							<!--giao dien khi người dùng chưa nhập keyword-->
							<div id="template-1" class="template-1">
								<div class="list-hd">GỢI Ý ĐIỀU HƯỚNG THEO CHỦ ĐỀ</div>
								<a href="<?php echo home_url();?>/nau-an/mon-an-hang-ngay/">
									<div class="show-result">
										<span class="sr-ctnahg"></span>
										<div>Công thức nấu ăn hằng ngày</div>
									</div>
								</a>
								<a href="<?php echo home_url();?>/bi-quyet-nau-an/">
									<div class="show-result">
										<span class="sr-bqnacdb"></span>
										<div>Bí quyết nấu ăn của đầu bếp</div>
									</div>
								</a>
								<a href="<?php echo home_url();?>/series/mon-an-boi-bo-suc-khoe/">
									<div class="show-result">
										<span class="sr-mnbbsk"></span>
										<div>Món ăn bồi bổ sức khỏe</div>
									</div>
								</a>
								<a href="<?php echo home_url();?>/nau-an/mon-an-chay/">
									<div class="show-result">
										<span class="sr-cmac"></span>
										<div>Các món ăn chay</div>
									</div>
								</a>
								<a href="<?php echo home_url();?>/series/mon-an-giup-lam-dep/">
									<div class="show-result">
										<span class="sr-auld"></span>
										<div>Ăn uống và làm đẹp</div>
									</div>
								</a>
								<a href="<?php echo home_url();?>/series/mon-an-giam-can/">
									<div class="show-result">
										<span class="sr-ddvgc"></span>
										<div>Dinh dưỡng và giảm cân</div>
									</div>
								</a>
								<a href="<?php echo home_url();?>/series/mon-an-tiet-kiem/">
									<div class="show-result">
										<span class="sr-manvtk"></span>
										<div>Món ăn ngon và tiết kiệm</div>
									</div>
								</a>
								<a href="<?php echo home_url(); ?>/tin-am-thuc/dinh-duong-suc-khoe/">
									<div class="show-result">
										<span class="sr-tvskvat"></span>
										<div>Tin về sức khỏe và ẩm thực</div>
									</div>
								</a>
							</div>
							<!--giao dien khi người dùng đã nhập keyword-->
							<div id="template-2" class="template-2">
								<div class="list-hd">CÓ THỂ BẠN QUAN TÂM</div>
								<!--mục Công thức nấu ăn hàng ngày-->
								<div class="sr-wp col-md-12 no-padding">
									<div id="ajax-append-1"></div>
								</div>
								<div class="clearfix"></div>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
		<div class="footer">
			<?php static_footer_info(); ?>
		</div>
	</div>
<div id="content" class="content">
	<style>
		.login{
			display: table;
			width: 100%;
			background-color: #ebebeb;
		}
		.login a{
			display: inline-block;
			padding: 10px 15px;
			float: left;
			text-align: center;
			color: rgb(66, 63, 63);
			font-weight: bold;
			float: right;
		}
		.login a:last-child{
			border-right: 1px solid #dcdcdc;
		}
		.fixed{
			position: relative;
			top:0;
			right: 0;
			bottom: 0;
			left: 0;
		}
		.scr{
			height: 566px;
			overflow: hidden;
			position: absolute;
			width: 73%;
			overflow-y: auto;
			z-index: 10;
		}
	</style>
	<header id="header" class="headroom">
<!--		<div class="login">-->
<!--			<a href="#">Đăng nhập</a>-->
<!--			<a href="#">Đăng ký</a>-->
<!--		</div>-->
		<div class="logo text-center">
			<div class="category-menu ic-list text-uppercase pull-left">
				<img class="img-full-width" src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon-list.png">
			</div>
			<a href="<?php echo home_url(); ?>" class="img-logo" title="<?php bloginfo('description'); ?>">
				<img class="img-full-width" height="37" src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo-header.png" alt="Ẩm thực gia đình">
			</a>
			<div class="fr-search pull-right ic-search">
				<img class="img-full-width" src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon-search-2.png">
			</div>
			<div class="clearfix"></div>
		</div>
	</header>
	<!--danh mục món và button search-->
	<!--thêm class top10-->
	<aside class="box-img-ads top-10 top-header-ads">
		<figure>
			<?php if ( is_home() ) { ?>
				<?php cmp_ads('mb_home_header'); ?>
			<?php } else if ( is_single() ) { ?>
				<!--				<a href="http://goo.gl/AuFyND" class="topresponsive" target="_blank" rel="nofollow"><img src="http://amthucgiadinh.net/wp-content/uploads/2015/02/728x90.jpg" style="margin: 3px 0px;" /></a> -->
<!--				--><?php //cmp_ads('mb_detail_header'); ?>

			<?php } else { ?>
				<?php cmp_ads('mb_cate_header'); ?>
			<?php } ?>
		</figure>
	</aside>