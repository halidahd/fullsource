<?php
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

    function get_hot_list_post($qobj) {
        $ids = array();
        
        $arr = array(
              'posts_per_page' => 10,
              'meta_key' => 'wpcf-noi-bat',
              'meta_value' => 1,
              'tax_query' => array(
                array(
                  'taxonomy' => $qobj->taxonomy,
                  'field' => 'id',
                  'terms' => $qobj->term_id,						  
                )
              )
            );
            
        $the_query = new WP_Query($arr);
					
        if ($the_query->have_posts() ) :
        while ($the_query->have_posts() ) : $the_query->the_post();         
            $ids[] = get_the_ID();
        endwhile;
        endif; 
        wp_reset_query();
        
        if(count($ids) < 10) {
            $arr = array(
              'posts_per_page' => (10 - count($ids)),
              'orderby'   => 'rand',
              'tax_query' => array(
                array(
                  'taxonomy' => $qobj->taxonomy,
                  'field' => 'id',
                  'terms' => $qobj->term_id,						  
                )
              )
            );
            
            $the_query = new WP_Query($arr);
                        
            if ($the_query->have_posts() ) :
            while ($the_query->have_posts() ) : $the_query->the_post();         
                $ids[] = get_the_ID();
            endwhile;
            endif; 
            wp_reset_query();            
        }
        
        return $ids;
    }

    function get_hot_list_post_popup($qobj) {
        $ids = array();
        
        $arr = array(
              'posts_per_page' => 3,
              'meta_key' => 'wpcf-noi-bat',
              'meta_value' => 1,
              'tax_query' => array(
                array(
                  'taxonomy' => $qobj->taxonomy,
                  'field' => 'id',
                  'terms' => $qobj->term_id,                          
                )
              )
            );
            
        $the_query = new WP_Query($arr);
                    
        if ($the_query->have_posts() ) :
        while ($the_query->have_posts() ) : $the_query->the_post();         
            $ids[] = get_the_ID();
        endwhile;
        endif; 
        wp_reset_query();
        
        if(count($ids) < 10) {
            $arr = array(
              'posts_per_page' => (10 - count($ids)),
              'meta_key'  => 'hits',
              'orderby'   => 'meta_value_num',
              'tax_query' => array(
                array(
                  'taxonomy' => $qobj->taxonomy,
                  'field' => 'id',
                  'terms' => $qobj->term_id,                          
                )
              )
            );
            
            $the_query = new WP_Query($arr);
                        
            if ($the_query->have_posts() ) :
            while ($the_query->have_posts() ) : $the_query->the_post();         
                $ids[] = get_the_ID();
            endwhile;
            endif; 
            wp_reset_query();            
        }
        
        return $ids;
    }

    function get_the_slug( $id=null ){
      if( empty($id) ):
        global $post;
        if( empty($post) )
          return ''; // No global $post var available.
        $id = $post->ID;
      endif;

      $slug = basename( get_permalink($id) );
      return $slug;
    }

    function get_canonical($url) {
        $str = $url;
        if (strpos($url,'page') !== false) {
            $str = substr($url, 0, strrpos($url, 'page'));
        }   
        echo  "<link rel='canonical' href='http://".$str."' />";
    }

    function get_list_noi_bat_popup($qobj, $number) 
    {
        $list = array();
        $tax_query = array();
        if(is_archive()){
            $tax_query = array(
                array(
                  'taxonomy' => $qobj->taxonomy,
                  'field' => 'id',
                  'terms' => $qobj->term_id,                          
                )
              );
        }
        
        $arr = array(
            'meta_key' => 'wpcf-noi-bat',
            'meta_value' => 1,
            'tax_query' => $tax_query
        );  

        $the_query = new WP_Query($arr);
        if ($the_query -> have_posts() ) :  
            while( $the_query->have_posts() ) : 
                $the_query->the_post();
                if(
                    get_post_meta(get_the_ID(), 'wpcf-hien-thi-tu', true ) <= strtotime(current_time( 'mysql' )) 
                    && get_post_meta(get_the_ID(), 'wpcf-hien-thi-den', true ) >= strtotime(current_time( 'mysql' )) 
                  ) 
                {
                    $list[] = get_the_ID();
                }
            endwhile;
        endif;
        wp_reset_query();

        if(count($list) < $number) {
            $the_query2 = new WP_Query('posts_per_page='.($number - count($list)));
            while ($the_query2->have_posts()) 
            {
                $the_query2->the_post();
                $list[] = get_the_ID();
            }
            wp_reset_query();
        }

        return $list;
    }

	function url_origin($use_forwarded_host=false)
	{
		$s = $_SERVER;
		$ssl = (!empty($s['HTTPS']) && $s['HTTPS'] == 'on') ? true:false;
		$sp = strtolower($s['SERVER_PROTOCOL']);
		$protocol = substr($sp, 0, strpos($sp, '/')) . (($ssl) ? 's' : '');
		$port = $s['SERVER_PORT'];
		$port = ((!$ssl && $port=='80') || ($ssl && $port=='443')) ? '' : ':'.$port;
		$host = ($use_forwarded_host && isset($s['HTTP_X_FORWARDED_HOST'])) ? $s['HTTP_X_FORWARDED_HOST'] : (isset($s['HTTP_HOST']) ? $s['HTTP_HOST'] : null);
		$host = isset($host) ? $host : $s['SERVER_NAME'] . $port;
		return $protocol . '://' . $host;
	}
	function full_url($use_forwarded_host=false)
	{
		echo trim(url_origin($use_forwarded_host) . $_SERVER['REQUEST_URI']);
	}


	function get_menu_header_top($menu_name = 'menu_header_top') {

		$menu = wp_get_nav_menu_object( $menu_name );

		$menu_items = wp_get_nav_menu_items($menu->term_id);

		$menu_list = '';
		$not_ul_li = false;
		$parent_note = 0;$current_child = 0;
		$prev_item = ''; $prev_menu = ''; $prev_menu_item = '';

		foreach ( (array) $menu_items as $key => $menu_item ) {

			if($parent_note && $parent_note == $menu_item->post_parent) {

				if($current_child == 0) {
					$prev_menu='<li class="dropdown fixd"><a href="'.$prev_menu_item->url.'" class="dropdown-toggle" data-hover="dropdown">'.$prev_menu_item->title.'  <i class="fa fa-caret-down"></i></a>';
					$prev_item='<ul class="dropdown-menu" role="menu" aria-labelledby="drop2">';
					$prev_item.='<li>
						<a href="'.$menu_item->url.'">
							<span class="glyphicon glyphicon-play" aria-hidden="true"></span>
							'.$menu_item->title.'
						</a>
					</li>';
					$current_child = 1;
				} else {
					$prev_item = '<li>
						<a href="'.$menu_item->url.'">
							<span class="glyphicon glyphicon-play" aria-hidden="true"></span>
							'.$menu_item->title.'
						</a>
					</li>';
				}
				$not_ul_li = true;
				$menu_list .= $prev_menu.$prev_item; //Them ca menu va item;
				$prev_menu = ''; // xoa prev_menu
			}
			else
			{
				if($not_ul_li) { $not_ul_li = false; $menu_list .= '</ul></li>'; $current_child = 0; }
				//Luu lai menu
				$menu_list .= $prev_menu;
				$prev_menu = '<li><a href="'.$menu_item->url.'">'.$menu_item->title.'</a></li>';
				$parent_note = $menu_item->object_id;
			}
			$prev_menu_item = $menu_item;
		}
		if($not_ul_li) { $menu_list .= '</ul></li>'; }

		echo $menu_list;
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
	// $menu_list now ready to output
?>