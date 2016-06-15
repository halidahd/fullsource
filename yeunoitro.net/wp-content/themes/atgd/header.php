<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb='https://www.facebook.com/2008/fbml' <?php language_attributes(); ?>>
<head>	
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
  <meta name="p:domain_verify" content="bfdf3716de62564faab33273e6d96aea"/>
	<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php get_canonical($_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]); ?>
	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/bootstrap/css/bootstrap.min.css"/>
	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/font-awesome/css/font-awesome.min.css"/>
	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/style.css"/>
	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/extra.css"/>
	<script src="<?php echo get_stylesheet_directory_uri();?>/js/jquery.min.js"></script>
<?php wp_head(); ?>
	<meta content='295463810632874' property='fb:app_id'/>
</head>

<body <?php body_class(); ?>>
<!-- adnow-verification-code:c2f146600b095d8163bd167d770fbcc1 -->
<script src="https://apis.google.com/js/platform.js" async defer>
	{lang: 'vi'}
</script>
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

<!-- Google Tag Manager -->
<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-WQNLJS"
				  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
		new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
		j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
		'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-WQNLJS');</script>
<!-- End Google Tag Manager -->
<!-- Remarketing -->
<script type="text/javascript">
	/* <![CDATA[ */
	var google_conversion_id = 961075039;
	var google_custom_params = window.google_tag_params;
	var google_remarketing_only = true;
	/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js"></script>
<noscript>
	<div style="display:inline;">
		<img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/961075039/?value=0&amp;guid=ON&amp;script=0"/>
	</div>
</noscript>
<!-- END Remarketing -->
<!-- block popup trải nghiệm -->
<!--	<div class="pbm-wp">-->
<!--		<div class="w1024">-->
<!--			<div class="pull-left">-->
<!--				<img src="--><?php //bloginfo('template_url') ?><!--/images/1.png">-->
<!--			</div>-->
<!--			<div class="pull-left left10">-->
<!--				<p style="font-size: 21px;margin-top: 20px; margin-bottom: 10px;"><a rel="nofollow" href="http://yeunoitro.net/thong-bao-chuyen-amthucgiadinh-net-sang-ten-mien-yeunoitro-net/">Từ ngày 17/06/2015 Ẩm thực gia đình.Net chính thức chuyển tên miền mới Yeunoitro.net</a></p>-->
<!--			</div>-->
<!--			<div class="clearfix"></div>-->
<!--		</div>-->
<!--		<div class="close-popup">-->
<!--			<img src="--><?php //bloginfo('template_url') ?><!--/images/close_popup.png">-->
<!--		</div>-->
<!--	</div>-->
<!-- end block popup trải nghiệm -->
<div class="header-menu">
	<div class="header-part-1 no-padding">
		<div class="header-menu-bg">
			<div class="container">				
				<div class="menu-wrapper">
					<ul class="nav navbar-nav navbar-left">
<!--						<li class="dropdown fixd">-->
<!--							<style>.fa-list{margin-left:-12px;}</style>-->
<!--							<a href="#" class="dropdown-toggle" data-hover="dropdown"><i class="fa fa-list font-24 pull-left"></i>Khóa học nấu ăn</a>-->
<!--							<ul class="dropdown-menu" role="menu" aria-labelledby="drop2">-->
<!--								--><?php //
//									wp_nav_menu( array( 'container' => '',
//														'menu' => 'khoa_hoc',
//														'menu_class' => '',
//														'items_wrap'      => '%3$s',
//														'link_before' => '<span class="glyphicon glyphicon-play" aria-hidden="true"></span>'
//									) );
//								?>
<!--							</ul>-->
<!--						</li>-->
						<?php get_menu_header_top(); ?>
					</ul>
					<ul class="nav navbar-nav pull-right">
						<li style="margin-top:4px;">
							<div class="fb-like" data-href="https://www.facebook.com/yeunoitro.net" data-layout="button_count" data-action="recommend" data-show-faces="true" data-share="true"></div>
						</li>
						<li style="margin-top:4px;margin-left:10px;">
							<div class="g-plusone" data-size="medium" data-annotation="none"></div>
						</li>
					</ul>
					<ul class="nav navbar-nav pull-right register" style="display:none;">
						<li>
							<a class="pull-left" href=""><i class="icon-user"></i></a>
							<div class="clearfix"></div>
						</li>
						<li>
							<a class="no-padding pull-left" href="/dang-nhap">Đăng nhập</a>
							<span class="pull-left">|</span>
							<a class="no-padding pull-left" href="/dang-ky">Đăng ký</a>

							<div class="clearfix"></div>
						</li>
					</ul>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
		<div class="container top-20">
			<div class="logo-search header-part-2">
				<div class="pull-left">
					<a href="<?php echo home_url();?>"><img src="<?php echo get_stylesheet_directory_uri();?>/images/logo-am-thuc-gia-dinh.png" alt="Ẩm thực gia đình" title="Ẩm thực gia đình"></a>
				</div>
				<div class="pull-right top-15">
					<form class="form-inline text-canter" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
					<div class="form-group">
						<div id="search-dr" class="input-group dropdown">
							<div id="search-dr" class="input-group dropdown pull-left">
								<input type="text" value="<?php echo get_search_query(); ?>" name="s" class="form-control search-input" id="dropdown-search" data-toggle="dropdown" placeholder="Tên nguyên liệu món ăn..."/>
								<span class="input-group-btn">
									<button class="btn btn-default btn-search" id="btn-search" type="submit"><i class="fa fa-search"></i>
									</button>
								</span>
							<div class="result-search dropdown-menu" role="menu" aria-labelledby="dropdown-search">
								<!--giao dien khi người dùng chưa nhập keyword -->
								<div id="template-1" class="template-1">
									<div class="list-hd">GỢI Ý ĐIỀU HƯỚNG THEO CHỦ ĐỀ</div>
									<a href="<?php echo home_url(); ?>/nau-an/mon-an-hang-ngay/">
										<div class="show-result">
											<span class="sr-ctnahg"></span>
											<span>Công thức nấu ăn hằng ngày</span>
										</div>
									</a>
									<a href="<?php echo home_url(); ?>/bi-quyet-nau-an/">
										<div class="show-result">
											<span class="sr-bqnacdb"></span>
											<span>Bí quyết nấu ăn của đầu bếp</span>
										</div>
									</a>
									<a href="<?php echo home_url(); ?>/series/mon-an-boi-bo-suc-khoe/">
										<div class="show-result">
											<span class="sr-mnbbsk"></span>
											<span>Món ăn bồi bổ sức khỏe</span>
										</div>
									</a>
									<a href="<?php echo home_url(); ?>/nau-an/mon-an-chay/">
										<div class="show-result">
											<span class="sr-cmac"></span>
											<span>Các món ăn chay</span>
										</div>
									</a>
									<a href="<?php echo home_url(); ?>/series/mon-an-giup-lam-dep/">
										<div class="show-result">
											<span class="sr-auld"></span>
											<span>Ăn uống và làm đẹp</span>
										</div>
									</a>
									<a href="<?php echo home_url(); ?>/series/mon-an-giam-can/">
										<div class="show-result">
											<span class="sr-ddvgc"></span>
											<span>Dinh dưỡng và giảm cân</span>
										</div>
									</a>
									<a href="<?php echo home_url(); ?>/series/mon-an-tiet-kiem/">
										<div class="show-result">
											<span class="sr-manvtk"></span>
											<span>Món ăn ngon và tiết kiệm</span>
										</div>
									</a>
									<a href="<?php echo home_url(); ?>/tin-am-thuc/dinh-duong-suc-khoe/">
										<div class="show-result">
											<span class="sr-tvskvat"></span>
											<span>Tin về sức khỏe và ẩm thực</span>
										</div>
									</a>
								</div>
								<!--giao dien khi người dùng đã nhập keyword-->
								<div id="template-2" class="template-2">
									<div class="list-hd">CÓ THỂ BẠN QUAN TÂM</div>

									<!--mục Công thức nấu ăn hàng ngày-->
									<div class="sr-wp col-md-12 no-padding">
										<div class="pull-left col-md-4 gr-1">
											<div class="pull-left">
												<div class="sr-icon-black"><span class="sr-icon-ctnahn"></span></div>
											</div>
											<div class="">
												Công thức nấu ăn hàng ngày
											</div>
										</div>
										<div id="ajax-append-1" class="col-md-8 no-padding "></div>
									</div>


									<!--mục thực đơn đăc biệt-->
									<div class="sr-wp st-wp-tddb col-md-12 no-padding">
										<div class="pull-left col-md-4 gr-1">
											<div class="pull-left">
												<div class="sr-icon-black" style="padding: 7px 5px;"><span class="sr-icon-tddb"></span></div>
											</div>
											<span>Thực đơn đặc biệt</span>
										</div>
										<div id="ajax-append-2" class="col-md-8 no-padding"></div>
									</div>
									<div class="clearfix"></div>
								</div>
							</div>
						</div>
					</div>
					<div class="pull-right">
						<a class="_ct pull-left" href="<?php site_url(); ?>yeu-cau-cong-thuc-nau-an/">
							<i class="icon-dct pull-left"></i>
							<span class="pull-left _tr ">Gửi yêu cầu công thức</span>
							<div class="clearfix"></div>
						</a>
					</div>
				</div>
					</form>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="header-part-3">
			<?php if ( is_single() ) { ?>
				<?php cmp_ads('pc_single_header'); ?>
			<?php } else { cmp_ads('pc_home_header'); }?>
		</div>
	</div>
</div>
<div id="bswrapper_inhead"></div>
<div class="wrapper">
<div class="container mn-fix">
