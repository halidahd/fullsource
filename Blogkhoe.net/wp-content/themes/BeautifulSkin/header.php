<?php global $theme; ?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<title><?php $theme->meta_title(); ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<?php $theme->hook('meta'); ?>
<link rel="stylesheet" href="<?php echo THEMATER_URL; ?>/css/reset.css" type="text/css" media="screen, projection" />
<link rel="stylesheet" href="<?php echo THEMATER_URL; ?>/css/defaults.css" type="text/css" media="screen, projection" />
<!--[if lt IE 8]><link rel="stylesheet" href="<?php echo THEMATER_URL; ?>/css/ie.css" type="text/css" media="screen, projection" /><![endif]-->

<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen, projection" />

<?php if ( is_singular() ) { wp_enqueue_script( 'comment-reply' ); } ?>
<?php  wp_head(); ?>
<?php $theme->hook('head'); ?>

</head>

<body <?php body_class(); ?>>
<!-- adnow-verification-code:c2f146600b095d8163bd167d770fbcc1 -->
<?php $theme->hook('html_before'); ?>

<div id="container">

    <div class="clearfix">
        <?php if($theme->display('menu_primary')) { $theme->hook('menu_primary'); } ?>
        
        <div id="top-social-profiles">
            <?php $theme->hook('social_profiles'); ?>
        </div>
    </div>
    

    <div id="header">
    
        <div class="logo">
          <?php if(is_home()) : ?>
          <h1 class="site_title">
          <?php endif; ?>
        <?php if ($theme->get_option('themater_logo_source') == 'image') { ?>
            <a href="<?php echo home_url(); ?>"><img src="<?php $theme->option('logo'); ?>" alt="<?php bloginfo('name'); ?>" title="<?php bloginfo('name'); ?>" /></a>
        <?php } else { ?> 
            <?php if($theme->display('site_title')) { ?> 
                <h1 class="site_title"><a href="<?php echo home_url(); ?>"><?php $theme->option('site_title'); ?></a></h1>
            <?php } ?> 
            
            <?php if($theme->display('site_description')) { ?> 
                <h2 class="site_description"><?php $theme->option('site_description'); ?></h2>
            <?php } ?> 
        <?php } ?>
            <?php if(is_home()) : ?>
            </h1>
            <?php endif; ?>
        </div><!-- .logo -->

        <div class="header-right">
            <?php
						cmp_ads('cmp_ads_pc_sitewide_header');
						cmp_ads('cmp_ads_mb_sitewide_header');
						?>
        </div><!-- .header-right -->
        
    </div><!-- #header -->
    
    <?php if($theme->display('menu_secondary')) { ?>
        <div class="clearfix">
					<a href="#" class="sp icon-menu"></a>
            <?php $theme->hook('menu_secondary'); ?>
        </div>
    <?php } ?>