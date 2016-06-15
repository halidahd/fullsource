<?php
/**
 * HALH
 * Get Meta title and meta description from SEO PREMIUM PACK
 */
function get_meta_key_title_psp() {

	$tax_seo = get_option('psp_taxonomy_seo');

	$current_term_id = get_queried_object()->term_id;;

	if(is_tag()) {
		if( !empty($tax_seo['post_tag'][$current_term_id]['psp_meta']))
			echo $tax_seo['post_tag'][$current_term_id]['psp_meta']['title'];

	} else if(is_category()) {

		if(!empty($tax_seo['category'][$current_term_id]['psp_meta'])) {
			echo $tax_seo['category'][$current_term_id]['psp_meta']['title'];
		}
	} else if(!empty($tax_seo['series'][$current_term_id]['psp_meta'])) {
		echo $tax_seo['series'][$current_term_id]['psp_meta']['title'];
	} else {
		echo single_tag_title();
	}
}

/**
 * @param int $ppp
 * @param int $cat
 * @param $type example array('wpcf-dac-biet-1' => 1, 'wpcf-hien-thi-tu' => array('value'=> strtotime(current_time( 'mysql' )) , 'compare' => '<='
 * @param relation and | or
 * @return WP_Query
 *
 */
function m_get_post_args($ppp = 1, $cat = 0, $type, $relation = 'AND') {
	$postids = array();
	$post_options = array(
		'wpcf-dac-biet-1',
		'wpcf-dac-biet-2',
		'wpcf-noi-bat',
		'tin-quang-cao',
		'wpcf-hien-thi-tu',
		'wpcf-hien-thi-den'
	);

	$meta_query = array('relation' => $relation);
	$default_value = 1;
	$id = 0;
	if(isset($type) && !is_array($type)) {
		$type = array($type => $default_value);
	}
	foreach ($post_options as $post_option) {
		if(array_key_exists($post_option,$type)) {
			$sub_meta_query = array('key' => $post_option);

			if(is_array($type[$post_option]))
				$sub_meta_query = array_merge($sub_meta_query,$type[$post_option]);
			else
				$sub_meta_query = array_merge($sub_meta_query, array('value' => $type[$post_option]));

			$meta_query = array_merge($meta_query,array($id => $sub_meta_query));
			$id++;
		}
	}
	$args = array('meta_query' => $meta_query);

	if($ppp > 0) {
		$args['posts_per_page'] = $ppp;
	}

	if($cat) {
		$args['cat'] = $cat;
	}

	return $args;
}

/**
 * @params $date: d/m/Y $time: G:i;
 * @relate: get_the_date
 * @return echo string
 */
function show_date_category($date = '',$time = '') {
	$date_created = explode('/',$date);

	$day = $date_created[0];
	$month = $date_created[1];
	$year = $date_created[2];

	$strday =  $day . "/" . $month . "/" . $year;

	$today = getdate();
	if($today["year"] == $year) {
		if($today["mon"] == $month) {
			if($today["mday"] == $day) {
				echo "Hôm nay";
			}
			elseif(($today["mday"] - 1) == $day) {
				echo "Hôm qua";
			}
			else {
				echo $strday;
			}
		}
		else {
			echo $strday;
		}
	}
	else {
		echo $strday;
	}

	echo ' lúc '.$time;
}

function list_noi_bat($posts_id) {

	$args = array(
		'posts_per_page' => -1,
		'meta_key' => 'wpcf-noi-bat',
		'meta_value' => 1
	);

	$arr = array();

	$the_query = new WP_Query( $args );
	if ($the_query -> have_posts() ) :
		while ($the_query -> have_posts() ) : $the_query -> the_post();
			$arr[] = get_the_ID();
		endwhile;
	endif;
	wp_reset_query();

	$result = array();

	foreach($arr as $i) {
		if(in_array($i, $posts_id)) {
			$result[] = $i;
		}
	}

	return $result;
}


if ( ! function_exists( 'the_archive_description' ) ) :
	/**
	 * Shim for `the_archive_description()`.
	 *
	 * Display category, tag, or term description.
	 *
	 * @todo Remove this function when WordPress 4.3 is released.
	 *
	 * @param string $before Optional. Content to prepend to the description. Default empty.
	 * @param string $after  Optional. Content to append to the description. Default empty.
	 */
	function the_archive_description( $before = '', $after = '' ) {
		$description = apply_filters( 'get_the_archive_description', term_description() );

		if ( ! empty( $description ) ) {
			/**
			 * Filter the archive description.
			 *
			 * @see term_description()
			 *
			 * @param string $description Archive description to be displayed.
			 */
			echo $before . $description . $after;
		}
	}
endif;

function get_list_post_by_term($term, $terms_id) {
	$arr = array();
	if(count($terms_id) > 0) {
		$arr['posts_per_page'] = -1;
		if($term == 'category') {
			$arr[] = array( 'category__in' => $terms_id);
		}
		elseif($term == 'series') {
			$arr['tax_query'] = array(
				array(
					'taxonomy' => 'series',
					'field'    => 'term_id',
					'terms'    => $terms_id,
					'operator' => 'IN',
				),
			);
		}
		else {
			$arr[] = array( 'tag__in' => $terms_id);
		}

		$arr2 = array();

		$query = new WP_Query($arr);

		if ($query -> have_posts() ) :
			while ($query -> have_posts() ) : $query -> the_post();
				$arr2[] = get_the_ID();
			endwhile;
		endif;
		wp_reset_query();
	}
	return $arr2;
}

function get_list_post_id_by_custom_field($fieldname, $fieldvalue) {
	$args = array(
		'posts_per_page' => -1,
		'meta_key' => $fieldname,
		'meta_value' => $fieldvalue,
		'meta_compare' => 'IN'
	);

	$arr = array();

	$the_query = new WP_Query( $args );
	if ($the_query -> have_posts() ) :
		while ($the_query -> have_posts() ) : $the_query -> the_post();
			$arr[] = get_the_ID();
		endwhile;
	endif;
	wp_reset_query();

	return $arr;
}

function merge_two_array_exclude_existed($arr1, $arr2) {
	for($i = 0; $i < count($arr2); $i++) {
		if(!in_array($arr2[$i], $arr1)) {
			$arr1[] = $arr2[$i];
		}
	}

	return $arr1;
}

function merge_two_array_exclude_existed_2($arr1, $arr2) {
	$arr = array();

	for($i = 0; $i < count($arr2); $i++) {
		if(!in_array($arr2[$i], $arr1)) {
			$arr[] = $arr2[$i];
		}
	}

	return merge_two_array_exclude_existed($arr, $arr1);
}

/**
 * echo footer info
 */
function static_footer_info() {
//				<div class="localtion">
//					<div class="text-uppercase _lhvct">Liên hệ với chúng tôi:</div>
//					<div class="top-10 bottom-10">
//						<span class="pull-left icon-phone"></span>
//						<span class="color-3 font-1 left-10">Hotline: 090.402.5555 - Minh Vũ (Mr.)</span>
//						<div class="clearfix"></div>
//						<span class="pull-left icon-add"></span>
//						<span class="color-3 font-1 left-10">Địa chỉ: 15D1 - Tòa nhà CT4 - KĐT Văn Khê - Hà Đông - Hà Nội</span>
//					</div>
//					<div class="clearfix"></div>
//				</div>
	echo '<div class="bg-footer">
			<div class="content">
				<div class="clearfix"></div>
				<div class="logo-f top-10 bottom-10">
					<img class="img-full-width" src="'.get_stylesheet_directory_uri() .'/images/logo-footer.png">
				</div>
			</div>
		</div>
		<div class="copy-right">
			<div class="content ">
				<span class="font-1">© 2015 Yeunoitro.net</span>
				<a href="https://plus.google.com/+AmthucgiadinhNet"><span class="pull-right icon-google left-10"></span></a>
				<a href="https://www.facebook.com/yeunoitro.net"><span class="pull-right icon-fb"></span></a>
				<div class="clearfix"></div>
			</div>
		</div>';
}

function edit_first_image($content) {
	global $post, $posts;
	$first_img = '';

	$output = preg_match_all('/(src=[\'"][^\'"]+[\'"])/i', $post->post_content, $matches);
	$first_img = $matches[1][0];

	if(!empty($first_img))
		$content = str_replace($first_img, ' itemprop="image" '.$first_img, $content);
	return $content;
}


add_filter( 'the_content', 'edit_first_image' );

require_once dirname(__FILE__)."/topreview.php";
require_once dirname(__FILE__)."/widgets/recentposts.php";