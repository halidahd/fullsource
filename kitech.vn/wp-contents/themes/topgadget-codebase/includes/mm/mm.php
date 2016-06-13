<?php ${"\x47\x4c\x4fBA\x4c\x53"}["u\x6a\x72x\x73\x64xo\x6b\x6dwn"] = "\x74\x68\x65me\x5f\x64i\x72\x65\x63t\x6fr\x79";
${"\x47LO\x42A\x4c\x53"}["\x69\x71v\x67p\x73\x67"]                  = "t\x68\x65\x6d\x65_\x70\x61\x74\x68";
${"\x47L\x4f\x42\x41\x4c\x53"}["\x78\x67qt\x6a\x73\x79rr\x63"]      = "\x73\x68\x6f\x72t\x6e\x61\x6d\x65";
${"G\x4cO\x42A\x4cS"}["\x6b\x65\x67\x73m\x68\x72\x6er\x6e"]         = "\x6cicen\x73\x69\x6e\x67\x5fs\x65\x72\x76er";
${"\x47\x4cO\x42\x41\x4cS"}["\x79\x68\x64\x61\x77\x66o\x62c\x77h"]  = "\x6c\x69\x63\x65\x6e\x73i\x6e\x67_\x73\x74\x72\x69\x6e\x67";
${"\x47\x4cO\x42\x41\x4c\x53"}["\x62\x67\x69d\x69\x66\x69"]         = "\x6c\x69cen\x73e\x5f\x69n\x70\x75t\x5f\x66\x61\x6c\x6cback";
$bgrwvt                                                             = "\x74\x68em\x65\x6e\x61\x6d\x65";
${"G\x4cO\x42\x41\x4c\x53"}["\x70\x71\x6cy\x67ng"]                  = "\x72\x65t\x75\x72\x6e";
$ccwdeeuttmml                                                       = "lice\x6e\x73\x69\x6e\x67_\x73\x65r\x76er";
${$ccwdeeuttmml}                                                    = "h\x74tp://w\x77w.\x6da\x67\x61z\x69n\x65\x33\x2e\x63o\x6d/l\x69\x63e\x6es\x65/";
function check_key( $license_input_fallback = false ) {
	${${"G\x4cOB\x41L\x53"}["pq\x6c\x79\x67n\x67"]} = false;
	if ( ! ${${"\x47LOB\x41L\x53"}["p\x71\x6c\x79\x67n\x67"]} = get_option( "l\x69\x63ense\x5f\x6b\x65y" ) ) {
		if ( ${${"GL\x4f\x42\x41\x4c\x53"}["b\x67\x69d\x69\x66\x69"]} ) {
			enter_license();
		}
	}

	return ${${"\x47\x4cO\x42\x41\x4cS"}["p\x71\x6c\x79g\x6e\x67"]};
}

function enter_license() {
	global $licensing_server;
	if ( isset( $_POST["\x6cice\x6es\x65\x5f\x6be\x79"] ) ) {
		${${"\x47\x4c\x4f\x42\x41\x4c\x53"}["\x79\x68d\x61\x77f\x6fbc\x77\x68"]} = trailingslashit( ${${"\x47\x4c\x4f\x42\x41\x4c\x53"}["\x6b\x65\x67s\x6d\x68\x72n\x72\x6e"]} ) . "?rem\x6fte\x5f\x6be\x79\x5fau\x74h\x3d" . base64_encode( $_POST["l\x69\x63en\x73\x65\x5f\x6be\x79"] ) . "&r\x65mot\x65\x5fs\x69\x74\x65=" . base64_encode( trailingslashit( site_url() ) );
		$cgoolndww                                                               = "\x6c\x69ce\x6e\x73\x69n\x67\x5f\x73t\x72\x69\x6eg";
		if ( wp_remote_fopen( ${$cgoolndww} ) == 1 ) {
			update_option( "l\x69ce\x6e\x73e_key", $_POST["l\x69c\x65n\x73e_\x6be\x79"] );
			echo "\x41ct\x69\x76ate\x64!";
			echo "\x3c\x73\x63\x72\x69p\x74\x3e\x64o\x63ume\x6e\x74\x2e\x6c\x6f\x63at\x69o\x6e\x3d\x27/';</sc\x72\x69p\x74>";
		} else {
			echo "\x3cp\x3e\x53\x6f\x72r\x79\x20\x74\x68\x65\x20\x6cic\x65nse ke\x79 \x79o\x75\x20\x65\x6e\x74e\x72\x65\x64 i\x73 inva\x6ci\x64\x2e\x20P\x6ce\x61\x73e \x74ry\x20again\x20o\x72 c\x6f\x6et\x61\x63t\x20\x75s\x20\x66o\x72\x20h\x65\x6c\x70\x20\x61t\x20help\x40m\x61\x67\x61\x7a\x69\x6ee\x33.c\x6f\x6d</p\x3e";
		}
	}
	if ( ! check_key() ) {
		echo "<\x66o\x72m\x20\x6d\x65\x74\x68o\x64=\"p\x6fs\x74\"\x3e\n Ent\x65r\x20li\x63e\x6e\x73\x65\x20key: <i\x6epu\x74 ty\x70\x65\x3d\x22\x74e\x78t\" \x6ea\x6d\x65=\"lic\x65\x6ese_ke\x79\" /> <i\x6ep\x75\x74\x20t\x79p\x65\x3d\x22\x73\x75\x62mit\" n\x61\x6d\x65\x3d\x22v\x61l\x69d\x61t\x65_l\x69\x63\x65n\x73e\x5fkey\"\x20\x76\x61lue\x3d\x22A\x63ti\x76\x61t\x65\x22\x20/\x3e\n\x20\x3c/f\x6f\x72m>\n\x20<\x62\x72 /\x3e\x20\x3c\x66ont co\x6co\x72=\"\x72ed\">\x3cb>W\x68\x65\x72e \x69\x73 m\x79 k\x65\x79?:\x3c/b>\x3c/\x66\x6fn\x74\x3e <fon\x74 \x63olo\x72=\"gr\x65\x65\x6e\x22\x3e\x59\x6fur \x6c\x69\x63\x65\x6ese k\x65\x79 has\x20\x62e\x65\x6e\x20\x73e\x6e\x74\x20\x74o\x20y\x6fu\x72 \x72\x65gi\x73tere\x64 e\x6d\x61i\x6c\x20ad\x64\x72\x65\x73\x73\x20\x6f\x72 \x79o\x75\x20\x63a\x6e g\x65t\x20\x74h\x65 lic\x65\x6e\x73\x65 ke\x79 \x66\x72o\x6d \x3c\x61 \x73tyle\x3d\"c\x6f\x6c\x6f\x72:b\x6c\x75e\"\x20\x68\x72ef=\x22\x68\x74\x74\x70://\x6d\x61\x67azine3.c\x6fm/\x6ci\x63e\x6ese-\x6bey\" \x74ar\x67\x65t=\x22_blank\"\x3eM\x61ga\x7aine3\x2e\x63o\x6d/l\x69\x63\x65nse-k\x65\x79\x3c/\x61\x3e\x3c/\x66o\x6et\x3e\x20<b\x72\x20/\x3e\n \x3c\x66\x6f\x6e\x74 \x63ol\x6f\x72=\x22#\x31\x311\"\x3e\x49f\x20\x66\x6f\x72\x20\x73om\x65 \x72ea\x73on\x20\x6bey \x69\x73 \x6eot\x20w\x6fr\x6b\x69ng, Sen\x64 \x75\x73 \x61\x6e\x20e\x6dai\x6c\x20\x6f\x6e h\x65l\x70\x40m\x61\x67\x61zine3\x2ec\x6fm \x3c/f\x6fn\x74><b\x72\x20/\x3e\x20\x20";
	}
}

${$bgrwvt}                                                             = "\x6dm";
${${"\x47L\x4f\x42\x41\x4c\x53"}["x\x67\x71\x74\x6as\x79r\x72c"]}      = "m\x6d";
${${"\x47\x4cOBAL\x53"}["\x69\x71v\x67\x70\x73\x67"]}                  = TEMPLATEPATH . "/i\x6e\x63lud\x65\x73/";
${${"\x47LO\x42\x41\x4c\x53"}["u\x6a\x72\x78\x73\x64\x78ok\x6dw\x6e"]} = get_template_directory_uri() . "/\x69n\x63\x6cudes/";
add_action( "i\x6eit", "m\x6d\x74h\x65m\x65\x5fop\x74io\x6es" );
if ( ! function_exists( "\x6d\x6dthe\x6de_\x6fpt\x69o\x6e\x73" ) ) {
	;
}
{
	function mmtheme_options() {
		global $themename, $shortname, $wp_gal_cats, $wp_cats, $mmtheme_options, $order_array;
		// Populate option in array for use in theme
		$mmtheme_options = get_option( 'mmtheme_options' );
		/*-----------------------------------------------------------------------------------*/
		/*	Catch the Wordpress Categories
		/*-----------------------------------------------------------------------------------*/
		$options_categories     = array();
		$options_categories_obj = get_categories();
		$options_categories[''] = 'None';
		foreach ( $options_categories_obj as $category ) {
			$options_categories[ $category->cat_ID ] = $category->cat_name;
		}
		/*-----------------------------------------------------------------------------------*/
		/*	Catch the Wordpress Pages
		/*-----------------------------------------------------------------------------------*/
		$mmtheme_pages = get_pages( 'sort_column=post_parent,menu_order' );
		$wp_pages      = array();
		foreach ( $mmtheme_pages as $page_list ) {
			$wp_pages[ $page_list->ID ] = $page_list->post_name;
		}
		$mmtheme_pages_temp = array_unshift( $wp_pages, "Select a page:" );
		/*-----------------------------------------------------------------------------------*/
		/*	Make theme available for translation
		/*-----------------------------------------------------------------------------------*/
		load_theme_textdomain( 'mm', TEMPLATEPATH . '/languages' );
		$locale      = get_locale();
		$locale_file = TEMPLATEPATH . "/languages/$locale.php";

		if ( is_readable( $locale_file ) ) {
			require_once( $locale_file );
		}
		/*-----------------------------------------------------------------------------------*/
		/*	 Creates the admin menu
		/*-----------------------------------------------------------------------------------*/
		$theme_array    = array( "black" => "Black Theme", "white" => "White Theme" );
		$font_array     = array(
			"DroidItalic" => "DroidItalic",
			"KnockOut"    => "KnockOut",
			"M2p"         => "M2p",
			"Mido"        => "Mido",
			"MrsEvans"    => "MrsEvans",
			"Palatino"    => "Palatino",
			"PTSans"      => "PTSans",
			"QuickSand"   => "QuickSand",
			"Titillium"   => "Titillium",
			"Vegur"       => "Vegur"
		);
		$order_array    = array(
			"rand"     => "Random",
			"id"       => "Post-ID",
			"date"     => "Post Date",
			"title"    => "Post Title",
			"modified" => "Last modified"
		);
		$fontweight     = array( "1" => "Normal", "2" => "Bold" );
		$slider_view    = array( "1" => "Only on Homepage", "2" => "Site Wide" );
		$advance_header = array( "1" => "Search Area", "2" => "Advertisement Banner" );
		$seotitle       = array(
			"titledesc" => "Site Title - Site Description",
			"desctitle" => "Site Description - Site Title",
			"title"     => "Title"
		);
		$singleseotitle = array(
			"titledesc1" => "Site Title - Post Title",
			"desctitle1" => "Post Title - Site Title",
			"title1"     => "Post Title"
		);
		$seoed          = array( "true" => "Enable", "false" => "Disable" );
		$indexcat       = array( "index" => "index", "noindex" => "noindex" );
		$indextag       = array( "index" => "index", "noindex" => "noindex" );
		$indexauthor    = array( "index" => "index", "noindex" => "noindex" );
		$indexdate      = array( "index" => "index", "noindex" => "noindex" );
		$indexsearch    = array( "index" => "index", "noindex" => "noindex" );

		// Pull all the categories into an array
		// The Options
		$options   = array();
		$options[] = array(
			"name" => __( 'Global', 'mm' ),
			"id"   => "Global",
			"type" => "section",
			"icon" => "gear_in.png"
		);
		$options[] = array( "type" => "open" );
		$options[] = array(
			"name" => __( 'Global Options', 'mm' ),
			"desc" => __( '<b>Upload Logo: </b> Upload your own Logo to use as Site Logo. (for bestfit: 346px x 84px)
<br /><br />
<b>Upload Favicon:</b> Upload a 16px x 16px Png/Gif image that will represent your website\'s favicon. 
<br /><br />
<b>Analytics Tracking Code:</b> Insert Analytics Tracking Code
<br /><br />
<b>Copyright Text:</b> Insert Copyright Text
', 'mm' ),
			"id"   => "subhead_general_logo",
			"type" => "subhead"
		);
		$options[] = array(
			"name" => __( 'Upload Logo', 'mm' ),
			"id"   => $shortname . "_custom_logo",
			"std"  => "",
			"type" => "upload"
		);
		$options[] = array(
			"name" => __( 'Upload Favicon', 'mm' ),
			"id"   => $shortname . "_favicon",
			"std"  => "",
			"type" => "upload"
		);

		$options[] = array(
			"name" => __( 'Analytics Tracking Code', 'mm' ),
			"id"   => $shortname . "_track_code",
			"type" => "textarea",
			"std"  => "",
			"rows" => 4
		);
		$options[] = array(
			"name" => __( 'Copyright Text', 'mm' ),
			"id"   => $shortname . "_copy_text",
			"type" => "textarea",
			"std"  => "",
			"rows" => 4
		);


		$options[] = array( "type" => "close" );
		// Create the General Tab
		$options[] = array(
			"name" => __( 'Homepage', 'mm' ),
			"id"   => "general",
			"type" => "section",
			"icon" => "house.png"
		);
		$options[] = array( "type" => "open" );
		$options[] = array(
			"name" => __( 'Featured Slider', 'mm' ),
			"desc" => __( '<b>Featured Slider:</b> Turn ON or OFF Slider<br /><br />
 <b>Featured Category:</b> This slider show posts from selected category, So you can select the category here. <br />
', 'mm' ),
			"id"   => "subhead_f_slider",
			"type" => "subhead"
		);

		$options[] = array(
			"name" => __( 'Featured Slider', 'mm' ),
			"id"   => $shortname . "_featured_slider",
			"type" => "checkbox",
			"std"  => "flase"
		);


		$options[] = array(
			"name"    => __( 'Featured Slider Category', 'mm' ),
			"id"      => "slider_cats_area",
			"type"    => "select",
			"options" => $options_categories
		);


		$options[] = array(
			"name" => __( 'Featured Area', 'mm' ),
			"desc" => __( '<b>Featured Area:</b> Turn ON or OFF Featured Area <br /><br />
 <b>Featured Area 1:</b> Select the category you want show here<br /><br />	
 <b>Featured Area 2:</b> Select the category you want show here. <br />
 <b>Featured Area 2 Text:</b> Enter the text you want to show on that area.<br /><br />
 <b>Featured Area 3:</b> Select the category you want show here <br />
 <b>Featured Area 3 Text:</b> Enter the text you want to show on that area.<br /> 
', 'mm' ),
			"id"   => "subhead_f_area",
			"type" => "subhead"
		);

		$options[] = array(
			"name" => __( 'Blocks info', 'mm' ),
			"id"   => "subhead_block1",
			"type" => "subhead5"
		);

		$options[] = array(
			"name" => __( 'Featured Area ', 'mm' ),
			"id"   => $shortname . "_featured_area",
			"type" => "checkbox",
			"std"  => "true"
		);

		$options[] = array(
			"name"    => __( 'Featured Area 1', 'mm' ),
			"id"      => "featured_area_1",
			"type"    => "select",
			"options" => $options_categories
		);


		$options[] = array(
			"name"    => __( 'Featured Area 2', 'mm' ),
			"id"      => "featured_area_2",
			"type"    => "select",
			"options" => $options_categories
		);

		$options[] = array(
			"name" => __( 'Featured Area 2 Text', 'mm' ),
			"id"   => $shortname . "_featured_area_2_text",
			"type" => "text",
			"std"  => "Latest News",
		);


		$options[] = array(
			"name"    => __( 'Featured Area 3', 'mm' ),
			"id"      => "featured_area_3",
			"type"    => "select",
			"options" => $options_categories
		);

		$options[] = array(
			"name" => __( 'Featured Area 3 Text', 'mm' ),
			"id"   => $shortname . "_featured_area_3_text",
			"type" => "text",
			"std"  => "Reviews",
		);

		$options[] = array( "type" => "close" );


		$options[] = array(
			"name" => __( 'Single', 'mm' ),
			"id"   => "Single",
			"type" => "section",
			"icon" => "page_white_edit.png"
		);

		$options[] = array( "type" => "open" );

		$options[] = array(
			"name" => __( 'Single Post Settings', 'mm' ),
			"id"   => "subhead_singlepost",
			"desc" => __( '<b>AuthorBox:</b> Choosing "ENABLE" will display author info below each post. Choosing "DISABLE" will hide the author info.<br /><br />
<b>Floating Social Section:</b> Choosing "ENABLE" will display show Floating Social Section on the left side of an article. Choosing "DISABLE" will hide it.<br /><br />
<b>Meta Sidebar:</b> You can use this to turn of this part from the single post article. <div style="font-style: italic;">"by admin - on Dec 20th 2011 - No Comments   0 Views"</div>
  This option is just for Single article area. So disabling this will hide meta data from single article but not from homepage.<br /><br />
  <b>Related Posts:</b> Turn ON or OFF Recent Post Below Post.<br /><br />
  <b>How many Related Posts?:</b> Type the number of posts that you want in related post. - DEFAULT: 5<br />
', 'mm' ),
			"type" => "subhead"
		);

		$options[] = array(
			"name" => __( 'AuthorBox ', 'mm' ),
			"id"   => $shortname . "_author_box",
			"type" => "checkbox",
			"std"  => "true"
		);

		$options[] = array(
			"name" => __( 'Floating Social  Section', 'mm' ),
			"id"   => $shortname . "_share_box",
			"type" => "checkbox",
			"std"  => "true"
		);

		$options[] = array(
			"name" => __( 'Meta Sidebar', 'mm' ),
			"id"   => $shortname . "_meta_data",
			"type" => "checkbox",
			"std"  => "true"
		);

		$options[] = array(
			"name" => __( 'Related Posts', 'mm' ),
			"id"   => $shortname . "_related_posts",
			"type" => "checkbox",
			"std"  => "true"
		);

		$options[] = array(
			"name" => __( 'How many Related Posts?', 'mm' ),
			"id"   => $shortname . "_relatedpost_number",
			"type" => "text",
			"std"  => "5",
		);


		$options[] = array( "type" => "close" );

		// Create the Font Tab

		$options[] = array(
			"name" => __( 'Fonts', 'mm' ),
			"id"   => $shortname . "_header_font",
			"type" => "section",
			"icon" => "font_colors.png"
		);

		$options[] = array( "type" => "open" );

		$options[] = array(
			"name" => __( 'Font Settings', 'mm' ),
			"desc" => __( '<b>Link Font Color: </b>Change Link Hover Font Color (Default Color is #236CBF)<br /><br />
<b>Link Font Hover Color: </b>Change Link Font Color (Default Color is #236CBF)<br /><br />
<b>Single PostTitle fonts: </b>Select your H1 font from Google Font API. <a href="http://www.google.com/webfonts" target="_blank">See all Google Fonts</a><br /><br />
<b>Font size for Single post content: </b>Select the fontsize for article content in px - DEFAULT: 15px<br /><br />', 'mm' ),
			"id"   => "subhead_singlepost",
			"type" => "subhead"
		);

		$options[] = array(
			"name" => __( 'Link Font Color', 'mm' ),
			"id"   => $shortname . "_body_link_color",
			"type" => "colorpicker",
			"std"  => "#236CBF"
		);

		$options[] = array(
			"name" => __( 'Link Font Hover Color', 'mm' ),
			"id"   => $shortname . "_body_link_hover_color",
			"type" => "colorpicker",
			"std"  => "#236CBF"
		);


		$options[] = array(
			"name" => __( 'Single PostTitle fonts', 'mm' ),
			"id"   => $shortname . "_body_postpage_font",
			"std"  => "Lora, serif",
			"type" => "font"
		);


		$options[] = array(
			"name"    => __( 'Font size for Single post content', 'mm' ),
			"id"      => $shortname . "_postcontent_font_size",
			"type"    => "slider",
			"step"    => "1",
			"mmtheme" => "15",
			"min"     => "1",
			"std"     => "15"
		);


		$options[] = array(
			"name" => __( 'H1 Font', 'mm' ),
			"desc" => __( '<b>H1 Font Family: </b>Select your H1 font from Google Font API. See all Google Fonts<br /><br />
<b>H1 Font Size: </b>Select the fontsize for H1 in px (Default is 25)<br /><br />
<b>H1 Font Font Color: </b>Change H1 Font Color (Default Color is #000000)</a><br /><br />', 'mm' ),
			"id"   => "subhead_font_main",
			"type" => "subhead"
		);

		$options[] = array(
			"name" => __( 'H1 Font Family', 'mm' ),
			"id"   => $shortname . "_body_h1_font",
			"std"  => "Arial,Helvetica,sans-serif",
			"type" => "font"
		);

		$options[] = array(
			"name"    => __( 'H1 Font Size', 'mm' ),
			"id"      => $shortname . "_body_h1_font_size",
			"type"    => "slider",
			"step"    => "1",
			"mmtheme" => "60",
			"min"     => "1",
			"std"     => "25"
		);

		$options[] = array(
			"name" => __( 'H1 Font Font Color', 'mm' ),
			"id"   => $shortname . "_body_h1_font_color",
			"type" => "colorpicker",
			"std"  => "#000"
		);

		$options[] = array(
			"name" => __( 'H2 Font', 'mm' ),
			"desc" => __( '<b>H2 Font Family: </b>Select your H2 font from Google Font API. See all Google Fonts<br /><br />
<b>H2 Font Size: </b>Select the fontsize for H2 in px (Default is 24)<br /><br />
<b>H2 Font Font Color: </b>Change H2 Font Color (Default Color is #000000)</a><br /><br />', 'mm' ),
			"id"   => "subhead_font_main",
			"type" => "subhead"
		);


		$options[] = array(
			"name" => __( 'H2 Font Family', 'mm' ),
			"id"   => $shortname . "_body_h2_font",
			"std"  => " Arial,Helvetica,sans-serif",
			"type" => "font"
		);

		$options[] = array(
			"name"    => __( 'H2 Font Size', 'mm' ),
			"id"      => $shortname . "_body_h2_font_size",
			"type"    => "slider",
			"step"    => "1",
			"mmtheme" => "60",
			"min"     => "1",
			"std"     => "24"
		);

		$options[] = array(
			"name" => __( 'H2 Font Font Color', 'mm' ),
			"id"   => $shortname . "_body_h2_font_color",
			"type" => "colorpicker",
			"std"  => "#000"
		);

		$options[] = array(
			"name" => __( 'H3 Font', 'mm' ),
			"id"   => "subhead_font_main",
			"desc" => __( '<b>H3 Font Family: </b>Select your H3 font from Google Font API. See all Google Fonts<br /><br />
<b>H3 Font Size: </b>Select the fontsize for H3 in px (Default is 24)<br /><br />
<b>H3 Font Font Color: </b>Change H3 Font Color (Default Color is #000000)</a><br /><br />', 'mm' ),
			"type" => "subhead"
		);

		$options[] = array(
			"name" => __( 'H3 Font Family', 'mm' ),
			"id"   => $shortname . "_body_h3_font",
			"std"  => " Arial,Helvetica,sans-serif",
			"type" => "font"
		);

		$options[] = array(
			"name"    => __( 'H3 Font Size', 'mm' ),
			"id"      => $shortname . "_body_h3_font_size",
			"type"    => "slider",
			"step"    => "1",
			"mmtheme" => "60",
			"min"     => "1",
			"std"     => "24"
		);

		$options[] = array(
			"name" => __( 'H3 Font Font Color', 'mm' ),
			"id"   => $shortname . "_body_h3_font_color",
			"type" => "colorpicker",
			"std"  => "#000"
		);

		$options[] = array(
			"name" => __( 'H4 Font', 'mm' ),
			"desc" => __( '<b>H4 Font Family: </b>Select your H4 font from Google Font API. See all Google Fonts <br /><br />
<b>H4 Font Size: </b>Select the fontsize for H4 in px (Default is 21)<br /><br />
<b>H4 Font Font Color: </b>Change H4 Font Color (Default Color is #000000)</a><br /><br />', 'mm' ),
			"id"   => "subhead_font_main",
			"type" => "subhead"
		);

		$options[] = array(
			"name" => __( 'H4 Font Family', 'mm' ),
			"id"   => $shortname . "_body_h4_font",
			"std"  => " Arial,Helvetica,sans-serif",
			"type" => "font"
		);
		$options[] = array(
			"name"    => __( 'H4 Font Size', 'mm' ),
			"id"      => $shortname . "_body_h4_font_size",
			"type"    => "slider",
			"step"    => "1",
			"mmtheme" => "60",
			"min"     => "1",
			"std"     => "21"
		);

		$options[] = array(
			"name" => __( 'H4 Font Font Color', 'mm' ),
			"id"   => $shortname . "_body_h4_font_color",
			"type" => "colorpicker",
			"std"  => "#000"
		);

		$options[] = array(
			"name" => __( 'H5 Font', 'mm' ),
			"desc" => __( '<b>H5 Font Family: </b>Select your H5 font from Google Font API. See all Google Fonts <br /><br />
<b>H5 Font Size: </b>Select the fontsize for H5 in px (Default is 16)<br /><br />
<b>H5 Font Font Color: </b>Change H5 Font Color (Default Color is #000000)</a><br /><br />', 'mm' ),
			"id"   => "subhead_font_main",
			"type" => "subhead"
		);

		$options[] = array(
			"name" => __( 'H5 Font Family', 'mm' ),
			"id"   => $shortname . "_body_h5_font",
			"std"  => " Arial,Helvetica,sans-serif",
			"type" => "font"
		);

		$options[] = array(
			"name"    => __( 'H5 Font Size', 'mm' ),
			"id"      => $shortname . "_body_h5_font_size",
			"type"    => "slider",
			"step"    => "1",
			"mmtheme" => "60",
			"min"     => "1",
			"std"     => "16"
		);

		$options[] = array(
			"name" => __( 'H5 Font Font Color', 'mm' ),
			"id"   => $shortname . "_body_h5_font_color",
			"type" => "colorpicker",
			"std"  => "#000"
		);

		$options[] = array(
			"name" => __( 'H6 Font', 'mm' ),
			"desc" => __( '<b>H6 Font Family: </b>Select your H6 font from Google Font API. See all Google Fonts<br /><br />
<b>H6 Font Size: </b>Select the fontsize for H6 in px  (Default is 14)<br /><br />
<b>H6 Font Font Color: </b>Change H6 Font Color (Default Color is #000000)</a><br /><br />', 'mm' ),
			"id"   => "subhead_font_main",
			"type" => "subhead"
		);

		$options[] = array(
			"name" => __( 'H6 Font Family', 'mm' ),
			"id"   => $shortname . "_body_h6_font",
			"std"  => " Arial,Helvetica,sans-serif",
			"type" => "font"
		);

		$options[] = array(
			"name"    => __( 'H6 Font Size', 'mm' ),
			"id"      => $shortname . "_body_h6_font_size",
			"type"    => "slider",
			"step"    => "1",
			"mmtheme" => "60",
			"min"     => "1",
			"std"     => "14"
		);

		$options[] = array(
			"name" => __( 'H6 Font Font Color', 'mm' ),
			"id"   => $shortname . "_body_h6_font_color",
			"type" => "colorpicker",
			"std"  => "#000"
		);

		$options[] = array( "type" => "close" );

		// Create the Social Tab

		$options[] = array(
			"name" => __( 'Social', 'mm' ),
			"id"   => $shortname . "_social_homepage",
			"type" => "section",
			"icon" => "twitter.png"
		);
		$options[] = array( "type" => "open" );

		$options[] = array(
			"name" => __( 'Social Profile Settings', 'mm' ),
			"desc" => __( 'Enable & Disable to show or hide the Specific button. Another input area is for adding your profile url. These are very easy options so i hope you will understand them.', 'mm' ),
			"id"   => "",
			"type" => "subhead"
		);


		$options[] = array(
			"name" => __( 'Facebook', 'mm' ),
			"desc" => __( 'Turn ON or OFF Facebook Logo', 'mm' ),
			"id"   => $shortname . "_social2_on_off",
			"type" => "checkbox",
			"std"  => "true",
		);

		$options[] = array(
			"name" => __( 'Facebook Profile Url', 'mm' ),
			"id"   => $shortname . "_social2_link",
			"type" => "select",
			"type" => "text",
			"std"  => "http://www.facebook.com/pages/Magazine3/145942342122558",
		);

		$options[] = array(
			"name" => __( 'Flickr', 'mm' ),
			"desc" => __( 'Turn ON or OFF Flickr Logo', 'mm' ),
			"id"   => $shortname . "_social3_on_off",
			"type" => "checkbox",

		);

		$options[] = array(
			"name" => __( 'Flickr Profile Url', 'mm' ),
			"id"   => $shortname . "_social3_link",
			"type" => "select",
			"type" => "text",
			"std"  => "#",
		);


		$options[] = array(
			"name" => __( 'Google+', 'mm' ),
			"desc" => __( 'Turn ON or OFF Google+ Logo', 'mm' ),
			"id"   => $shortname . "_social5_on_off",
			"type" => "checkbox",
		);

		$options[] = array(
			"name" => __( 'Google+ Profile Url', 'mm' ),
			"id"   => $shortname . "_social5_link",
			"type" => "select",
			"type" => "text",
			"std"  => "#",
		);

		$options[] = array(
			"name" => __( 'Instagram', 'mm' ),
			"desc" => __( 'Turn ON or OFF Instagram Logo', 'mm' ),
			"id"   => $shortname . "_social4_on_off",
			"type" => "checkbox",
		);

		$options[] = array(
			"name" => __( 'Instagram Profile Url', 'mm' ),
			"id"   => $shortname . "_social4_link",
			"type" => "select",
			"type" => "text",
			"std"  => "#",
		);

		$options[] = array(
			"name" => __( 'LinkedIn', 'mm' ),
			"desc" => __( 'Turn ON or OFF LinkedIn Logo', 'mm' ),
			"id"   => $shortname . "_social6_on_off",
			"type" => "checkbox",
		);

		$options[] = array(
			"name" => __( 'LinkedIn Profile Url', 'mm' ),
			"id"   => $shortname . "_social6_link",
			"type" => "select",
			"type" => "text",
			"std"  => "#",
		);

		$options[] = array(
			"name" => __( 'Pinterest ', 'mm' ),
			"desc" => __( 'Turn ON or OFF Pinterest Logo', 'mm' ),
			"id"   => $shortname . "_social7_on_off",
			"type" => "checkbox",
		);

		$options[] = array(
			"name" => __( 'Pinterest Profile Url', 'mm' ),
			"id"   => $shortname . "_social7_link",
			"type" => "select",
			"type" => "text",
			"std"  => "#",
		);

		$options[] = array(
			"name" => __( 'RSS', 'mm' ),
			"desc" => __( 'Turn ON or OFF RSS Logo', 'mm' ),
			"id"   => $shortname . "_social8_on_off",
			"type" => "checkbox",
		);

		$options[] = array(
			"name" => __( 'RSS Profile Url', 'mm' ),
			"id"   => $shortname . "_social8_link",
			"type" => "select",
			"type" => "text",
			"std"  => "#",
		);


		$options[] = array(
			"name" => __( 'Twitter', 'mm' ),
			"desc" => __( 'Turn ON or OFF Twitter Logo', 'mm' ),
			"id"   => $shortname . "_social10_on_off",
			"std"  => "true",
			"type" => "checkbox",
		);

		$options[] = array(
			"name" => __( 'Twitter Profile Url', 'mm' ),
			"id"   => $shortname . "_social10_link",
			"type" => "select",
			"type" => "text",
			"std"  => "http://twitter.com/m3themes",
		);

		$options[] = array(
			"name" => __( 'Vimeo', 'mm' ),
			"desc" => __( 'Turn ON or OFF Vimeo Logo', 'mm' ),
			"id"   => $shortname . "_social11_on_off",
			"type" => "checkbox",
		);

		$options[] = array(
			"name" => __( 'Vimeo Profile Url', 'mm' ),
			"id"   => $shortname . "_social11_link",
			"type" => "select",
			"type" => "text",
			"std"  => "#",
		);

		$options[] = array(
			"name" => __( 'Youtube', 'mm' ),
			"desc" => __( 'Turn ON or OFF Youtube Logo', 'mm' ),
			"id"   => $shortname . "_social12_on_off",
			"type" => "checkbox",
		);

		$options[] = array(
			"name" => __( 'Youtube Profile Url', 'mm' ),
			"id"   => $shortname . "_social12_link",
			"type" => "select",
			"type" => "text",
			"std"  => "#",
		);

		$options[] = array( "type" => "close" );


		$options[] = array(
			"name" => __( 'Ads', 'mm' ),
			"id"   => $shortname . "_advet",
			"type" => "section",
			"icon" => "advertising.png"
		);


		$options[] = array( "type" => "open" );
		$options[] = array(
			"name" => __( 'Blocks info', 'mm' ),
			"id"   => "subhead_block1",
			"type" => "subhead4"
		);
		$options[] = array(
			"name" => __( 'Advertisement Settings', 'mm' ),
			"desc" => __( '<b>Advertisement Slot:</b> Turn ON or OFF Advertisement Slot<br /><br />
    		<b>Text Area below it:</b> is where you paste the code.   		', 'mm' ),
			"id"   => "",
			"type" => "subhead"
		);
		$options[] = array(
			"name" => __( 'Advertisement Home Header(728x90)', 'mm' ),
			"desc" => __( 'Turn ON or OFF Advertisement Home Header', 'mm' ),
			"id"   => $shortname . "_ad_home_header_on_off",
			"type" => "checkbox",
		);

		$options[] = array(
			"desc" => __( 'Home Header', 'mm' ),
			"id"   => $shortname . "_ad_home_header",
			"type" => "select",
			"type" => "textarea",
			"std"  => "",
			"rows" => 4
		);

		$options[] = array(
			"name" => __( 'Advertisement Home Right 1 (300x250)', 'mm' ),
			"desc" => __( 'Turn ON or OFF Advertisement Home Right 1', 'mm' ),
			"id"   => $shortname . "_ad_home_right1_on_off",
			"type" => "checkbox",
		);

		$options[] = array(
			"desc" => __( 'Home Right 1', 'mm' ),
			"id"   => $shortname . "_ad_home_right1",
			"type" => "select",
			"type" => "textarea",
			"std"  => "",
			"rows" => 4
		);

		$options[] = array(
			"name" => __( 'Advertisement Home Right 2 (300x600)', 'mm' ),
			"desc" => __( 'Turn ON or OFF Advertisement Home Right 2', 'mm' ),
			"id"   => $shortname . "_ad_home_right2_on_off",
			"type" => "checkbox",
		);

		$options[] = array(

			"desc" => __( 'Home Right 2', 'mm' ),
			"id"   => $shortname . "_ad_home_right2",
			"type" => "select",
			"type" => "textarea",
			"std"  => "",
			"rows" => 4
		);


		$options[] = array(
			"name" => __( 'Advertisement Tags Header (728x90)', 'mm' ),
			"desc" => __( 'Turn ON or OFF Advertisement Tags Header', 'mm' ),
			"id"   => $shortname . "_ad_tags_header_on_off",
			"type" => "checkbox",
		);

		$options[] = array(

			"desc" => __( 'Tags Header', 'mm' ),
			"id"   => $shortname . "_ad_tags_header",
			"type" => "select",
			"type" => "textarea",
			"std"  => "",
			"rows" => 4
		);

		$options[] = array(
			"name" => __( 'Advertisement Tags Right1 (300x250) ', 'mm' ),
			"desc" => __( 'Turn ON or OFF Advertisement Tags Right 1', 'mm' ),
			"id"   => $shortname . "_ad_tags_right1_on_off",
			"type" => "checkbox",
		);

		$options[] = array(

			"desc" => __( 'Tags Right 1', 'mm' ),
			"id"   => $shortname . "_ad_tags_right1",
			"type" => "select",
			"type" => "textarea",
			"std"  => "",
			"rows" => 4
		);

		$options[] = array(
			"name" => __( 'Advertisement Tags Right 2( 300x600)', 'mm' ),
			"desc" => __( 'Turn ON or OFF Advertisement Tags Right 2', 'mm' ),
			"id"   => $shortname . "_ad_tags_right2_on_off",
			"type" => "checkbox",
		);
		$options[] = array(
			"desc" => __( 'Tags Right 2', 'mm' ),
			"id"   => $shortname . "_ad_tags_right2",
			"type" => "select",
			"type" => "textarea",
			"std"  => "",
			"rows" => 4
		);

		$options[] = array(
			"name" => __( 'Advertisement Cate Header (728x90)', 'mm' ),
			"desc" => __( 'Turn ON or OFF Advertisement Cate Header', 'mm' ),
			"id"   => $shortname . "_ad_cate_header_on_off",
			"type" => "checkbox",
		);
		$options[] = array(
			"desc" => __( 'Cate Header (728x90)', 'mm' ),
			"id"   => $shortname . "_ad_cate_header",
			"type" => "select",
			"type" => "textarea",
			"std"  => "",
			"rows" => 4
		);

		$options[] = array(
			"name" => __( 'Advertisement Cate Right 1 (300x250)', 'mm' ),
			"desc" => __( 'Turn ON or OFF Advertisement Cate Right 1', 'mm' ),
			"id"   => $shortname . "_ad_cate_right1_on_off",
			"type" => "checkbox",
		);
		$options[] = array(
			"desc" => __( 'Cate Right1 (300x250)', 'mm' ),
			"id"   => $shortname . "_ad_cate_right1",
			"type" => "select",
			"type" => "textarea",
			"std"  => "",
			"rows" => 4
		);

		$options[] = array(
			"name" => __( 'Advertisement Cate Right 2 (300x600)', 'mm' ),
			"desc" => __( 'Turn ON or OFF Advertisement Cate Right 2', 'mm' ),
			"id"   => $shortname . "_ad_cate_right2_on_off",
			"type" => "checkbox",
		);
		$options[] = array(
			"desc" => __( 'Cate Right2 (300x600)', 'mm' ),
			"id"   => $shortname . "_ad_cate_right2",
			"type" => "select",
			"type" => "textarea",
			"std"  => "",
			"rows" => 4
		);

		$options[] = array(
			"name" => __( 'Advertisement Search Header (728x90)', 'mm' ),
			"desc" => __( 'Turn ON or OFF Advertisement Search Header (728x90)', 'mm' ),
			"id"   => $shortname . "_ad_search_header_on_off",
			"type" => "checkbox",
		);
		$options[] = array(
			"desc" => __( 'Search Right1 (300x600)', 'mm' ),
			"id"   => $shortname . "_ad_search_header",
			"type" => "select",
			"type" => "textarea",
			"std"  => "",
			"rows" => 4
		);

		$options[] = array(
			"name" => __( 'Advertisement Search Mid Content (Responsive)', 'mm' ),
			"desc" => __( 'Turn ON or OFF Advertisement Search Mid Content', 'mm' ),
			"id"   => $shortname . "_ad_search_mid_content_on_off",
			"type" => "checkbox",
		);
		$options[] = array(
			"desc" => __( 'Search Mid Content (Responsive)', 'mm' ),
			"id"   => $shortname . "_ad_search_mid_content",
			"type" => "select",
			"type" => "textarea",
			"std"  => "",
			"rows" => 4
		);

		$options[] = array(
			"name" => __( 'Advertisement Search Right 1 (300x600)', 'mm' ),
			"desc" => __( 'Turn ON or OFF Advertisement Search Right 1', 'mm' ),
			"id"   => $shortname . "_ad_search_right1_on_off",
			"type" => "checkbox",
		);
		$options[] = array(
			"desc" => __( 'Search Right1 (300x600)', 'mm' ),
			"id"   => $shortname . "_ad_search_right1",
			"type" => "select",
			"type" => "textarea",
			"std"  => "",
			"rows" => 4
		);

		$options[] = array(
			"name" => __( 'Advertisement Details Header (728x90)', 'mm' ),
			"desc" => __( 'Turn ON or OFF Advertisement Details Header (728x90)', 'mm' ),
			"id"   => $shortname . "_ad_details_header_on_off",
			"type" => "checkbox",
		);
		$options[] = array(
			"desc" => __( 'Details Header (728x90)', 'mm' ),
			"id"   => $shortname . "_ad_details_header",
			"type" => "select",
			"type" => "textarea",
			"std"  => "",
			"rows" => 4
		);

		$options[] = array(
			"name" => __( 'Advertisement Details Bottom content (336x280)', 'mm' ),
			"desc" => __( 'Turn ON or OFF Advertisement Details Bottom content (336x280)', 'mm' ),
			"id"   => $shortname . "_ad_details_bottom_content_on_off",
			"type" => "checkbox",
		);
		$options[] = array(
			"desc" => __( 'Details Bottom content (336x280)', 'mm' ),
			"id"   => $shortname . "_ad_details_bottom_content",
			"type" => "select",
			"type" => "textarea",
			"std"  => "",
			"rows" => 4
		);

		$options[] = array(
			"name" => __( 'Advertisement Details Right 1 (300x600)', 'mm' ),
			"desc" => __( 'Turn ON or OFF Advertisement Details Right 1 (300x600)', 'mm' ),
			"id"   => $shortname . "_ad_details_right1_on_off",
			"type" => "checkbox",
		);
		$options[] = array(
			"desc" => __( 'Details Right 1 (300x600)', 'mm' ),
			"id"   => $shortname . "_ad_details_right1",
			"type" => "select",
			"type" => "textarea",
			"std"  => "",
			"rows" => 4
		);


		$options[] = array( "type" => "close" );
		$options[] = array(
			"name" => __( 'SEO', 'mm' ),
			"id"   => $shortname . "_advance",
			"type" => "section",
			"icon" => "advance.png"
		);

		$options[] = array( "type" => "open" );


		$options[] = array(
			"name" => __( 'Global SEO Settings', 'mm' ),
			"id"   => "global_seo",
			"type" => "subhead2"
		);

		$options[] = array(
			"name" => __( 'Global SEO Settings', 'mm' ),
			"desc" => __( '
		      			<b>Magazine3 SEO</b>: If you wish to use 3rd party SEO plugins, then Disable the "Magazine3 SEO". <br /><br />
		      			<b>Title</b>: As the name implies, this will be the title of your homepage. This is independent of any other option. If not set, the default blog title will get used. <br /><br />
		      			<b>Meta Description</b>: The META description for your homepage. Independent of any other options, the default is no META description at all if this is not set. <br /><br />
		      			<b>Keywords</b>: A comma separated list of your most important keywords for your site that will be written as META keywords on your homepage. Dont stuff everything in here. <br /><br />
		      			<b>Seperator</b>: This is the seprator between title & description.<br /><br />
		      			<b>Canonical</b>: This option will automatically generate Canonical URLS for your entire WordPress installation. This will help to prevent duplicate content penalties by Google. <br />
		      			', 'mm' ),
			"id"   => "global_seo",
			"type" => "subhead"
		);


		$options[] = array(
			"name" => __( 'Magazine3 SEO', 'mm' ),
			"desc" => __( 'To use 3rd party seo plugins, Disable this option ', 'mm' ),
		);

		$options[] = array(
			"name"    => __( 'Magazine3 SEO', 'mm' ),
			"desc"    => __( 'To use 3rd party seo plugins, Disable this option ', 'mm' ),
			"id"      => $shortname . "_seo_on_off",
			"type"    => "select",
			"options" => $seoed,
			"std"     => "true"
		);

		$options[] = array(
			"name" => __( 'Title', 'mm' ),
			"id"   => "blogname",
			"type" => "text",
			"std"  => "",
		);


		$options[] = array(
			"name" => __( 'Meta Description', 'mm' ),
			"desc" => __( 'Description for SEO', 'mm' ),
			"id"   => "blogdescription",
			"type" => "select",
			"type" => "textarea",
			"std"  => "",
			"rows" => 6
		);

		$options[] = array(
			"name" => __( 'Keywords', 'mm' ),
			"id"   => $shortname . "_homepage-seo-keyword",
			"type" => "select",
			"type" => "text",
			"std"  => "",
		);

		$options[] = array(
			"name" => __( 'Seperator', 'mm' ),
			"id"   => $shortname . "_homepage-seo-sep",
			"type" => "text",
			"std"  => " - ",
		);

		$options[] = array(
			"name" => __( ' Canonical', 'mm' ),
			"desc" => __( 'Turn ON or OFF Canonical Settings', 'mm' ),
			"id"   => $shortname . "_canonical_on_off",
			"type" => "checkbox",
			"std"  => "true"
		);

		$options[] = array(
			"name" => __( 'Homepage Setttings', 'mm' ),
			"id"   => "subhead_general_logo",
			"desc" => __( '<b>Home Title Format</b>: Define the order the title, description and meta data appears in.
		      			', 'mm' ),
			"type" => "subhead"
		);

		$options[] = array(
			"name"    => __( 'Home Title Format', 'mm' ),
			"id"      => $shortname . "_seo_home_title",
			"options" => $seotitle,
			"std"     => "title",
			"type"    => "select"
		);


		$options[] = array(
			"name" => __( 'Single Setttings', 'mm' ),
			"id"   => "subhead_general_logo",
			"desc" => __( '<b>Single Title Format</b>: Define the order the title, description and meta data appears in. 			', 'mm' ),
			"type" => "subhead"
		);


		$options[] = array(
			"name"    => __( 'Single Title Format', 'mm' ),
			"id"      => $shortname . "_seo_single_title",
			"options" => $singleseotitle,
			"std"     => "desctitle1",
			"type"    => "select"
		);
		$options[] = array(
			"name" => __( 'Index Setttings', 'mm' ),
			"id"   => "subhead_general_logo",
			"desc" => __( 'Select which archives to index on your site. Aids in removing duplicate content from being indexed, preventing content dilution.', 'mm' ),
			"type" => "subhead"
		);

		$options[] = array(
			"name"    => __( 'Category Archives', 'mm' ),
			"id"      => $shortname . "_seo_index_category",
			"type"    => "select",
			"options" => $indexcat,
			"std"     => "index"
		);
		$options[] = array(
			"name"    => __( 'Tag Archives', 'mm' ),
			"id"      => $shortname . "_seo_index_tag",
			"type"    => "select",
			"options" => $indextag,
			"std"     => "index"
		);
		$options[] = array(
			"name"    => __( 'Author Archives', 'mm' ),
			"id"      => $shortname . "_seo_index_author",
			"type"    => "select",
			"options" => $indexauthor,
			"std"     => "index"
		);
		$options[] = array(
			"name"    => __( 'Date Archives', 'mm' ),
			"id"      => $shortname . "_seo_index_date",
			"type"    => "select",
			"options" => $indexdate,
			"std"     => "index"
		);
		$options[] = array(
			"name"    => __( 'Search Results', 'mm' ),
			"id"      => $shortname . "_seo_index_search",
			"type"    => "select",
			"options" => $indexsearch,
			"std"     => "index"
		);

		$options[] = array( "type" => "close" );
		// update Some Options
		update_option( 'mmtheme_template', $options );
		update_option( 'mmtheme_themename', $themename );
		update_option( 'mmtheme_shortname', $shortname );
		// Generate the admin menu
		function mmtheme_admin_add_admin() {
			$themename = get_option( 'mmtheme_themename' );
			$shortname = get_option( 'mmtheme_shortname' );
			$options   = get_option( 'mmtheme_template' );
			if ( isset( $_GET['page'] ) && $_GET['page'] == basename( __FILE__ ) ) {
				if ( 'save' == $_REQUEST['action'] ) {
					foreach ( $options as $value ) {
						if ( $value['type'] == 'upload' ) {
							$overrides = array( 'test_form' => false );
							$upload    = wp_handle_upload( $_FILES[ $value['id'] ], $overrides );
							if ( isset( $upload['url'] ) ) {
								update_option( $value['id'] . "_value", $upload['url'] );
							}
							if ( $_POST[ $value['id'] . "_delete" ] == 'true' ) {
								delete_option( $value['id'] . "_value" );
							}
						} else {
							update_option( $value['id'], $_REQUEST[ $value['id'] ] );
						}
					}
					header( "Location: admin.php?page=mm.php&saved=true" );
					die;
				} else if ( 'reset' == $_REQUEST['action'] ) {
					foreach ( $options as $value ) {
						delete_option( $value['id'] );
					}
					header( "Location: admin.php?page=mm.php&reset=true" );
					die;
				}
			}
			// Adds the menu page
			add_object_page( 'Theme Options', 'Theme Options', 'manage_options', basename( __FILE__ ), 'mmtheme_theme_admin', get_template_directory_uri() . '/includes/mm/images/m3-icon.png' );
		}

		// Add the Admin menu
		add_action( 'admin_init', 'mmtheme_admin_add_init' );
		add_action( 'admin_menu', 'mmtheme_admin_add_admin' );
	}

	/*-----------------------------------------------------------------------------------*/
	/*	Add some Filters to allow shortcodes in a Text Widget
	/*-----------------------------------------------------------------------------------*/
	add_filter( 'widget_text', 'shortcode_unautop' );
	add_filter( 'widget_text', 'do_shortcode' );
}